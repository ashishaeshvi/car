<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Car;
use App\Models\CarSpecification;
use App\Models\User;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CarController extends Controller
{
    /**
     * Display car listing.
     */
    public function index(Request $request)
    {
        // Permission check
        abort_if(! auth()->user()->can('cars.view'), 403, __('User does not have the right permissions.'));

        $data['title'] = 'Cars List';
        $data['create_title'] = 'Add Car';

        $authUser = auth()->user();
        $authId = $authUser->id;

        // Base query for cars
        $query = Car::with('dealer') // eager load dealer info
            ->when($authUser->role_id != 1, function ($query) use ($authId) {
                $query->where('added_by', $authId);
            })
            ->select('cars.*');

        if ($request->ajax()) {
            return \DataTables::eloquent($query)
                ->addIndexColumn()
                ->filter(function ($query) use ($request) {
                    if ($request->has('search') && $search = $request->input('search.value')) {
                        $search = strtolower($search);
                        $query->where(function ($q) use ($search) {
                            // Use join for dealer name search
                            $q->whereHas('dealer', function ($q2) use ($search) {
                                $q2->whereRaw('LOWER(name) LIKE ?', ["%{$search}%"]);
                            })
                                ->orWhereRaw('LOWER(car_name) LIKE ?', ["%{$search}%"])
                                ->orWhereRaw('LOWER(brand) LIKE ?', ["%{$search}%"])
                                ->orWhereRaw('LOWER(variant) LIKE ?', ["%{$search}%"])
                                ->orWhereRaw('LOWER(price) LIKE ?', ["%{$search}%"])
                                ->orWhereRaw('LOWER(manufacture_year) LIKE ?', ["%{$search}%"])
                                ->orWhereRaw('LOWER(car_condition) LIKE ?', ["%{$search}%"]);
                        });
                    }
                })
                ->editColumn('created_at', fn ($row) => $row->created_at->format('d M, Y'))
                ->addColumn('dealer_name', fn ($row) => $row->dealer->name ?? 'N/A') // Show dealer name
                ->addColumn('action', fn ($row) => $this->generateActionButtons($row))
                ->rawColumns(['action'])
                ->toJson();
        }

        return view('admin.cars.list')->with($data);
    }

    private function generateActionButtons($car)
    {
        $html = '';
        if (auth()->user()->can('cars.edit')) {
            $html .= '<a href="'.route('cars.edit', encrypt($car->id)).'" title="Edit"><i class="fa fa-edit"></i></a> ';
        }

        if (auth()->user()->can('cars.status')) {
            $status = $car->status;
            $id = encrypt($car->id);
            $url = route('cars.status');
            $title = $status === 'active' ? 'Make Inactive' : 'Make Active';
            $icon = $status === 'active' ? 'fa-toggle-off text-danger' : 'fa-toggle-on text-success';
            $tableid = 'cars-table';
            $html .= '<a href="javascript:void(0);" class="toggle-status"
                data-id="'.$id.'"
                data-status="'.$status.'"
                data-tableid="'.$tableid.'"
                data-url="'.$url.'"
                title="'.$title.'">
                <i class="fa fa-fw '.$icon.'"></i> 
                </a>';
        }

        if (auth()->user()->can('cars.delete')) {
            $id = encrypt($car->id);
            $url = route('cars.destroy', $id);
            $tableid = 'cars-table';

            $html .= '<button type="button" class="btn btn-danger btn-xs delete-record"
                data-id="'.$id.'"
                data-url="'.$url.'"
                data-tableid="'.$tableid.'"
                data-title="car"
                title="Delete">
                <i class="fa fa-trash"></i>
            </button>';
        }

        return $html;
    }

    /**
     * Show create form
     */
    public function create()
    {
        abort_if(! auth()->user()->can('cars.add'), 403, __('User does not have the right permissions.'));
        $dealers = User::select('id', 'name')->where('role_id', '4')->where('status', 'active')->get();
        $title = 'Add Car';

        return view('admin.cars.add', compact('dealers', 'title'));
    }

    /**
     * Store or update cars.
     */
    public function storeOrUpdate(Request $request, $id = null)
    {
        $data = $request->validate([
            'dealer' => 'required|string|max:255',
            'car_name' => 'required|string|max:255',
            'brand' => 'nullable|string|max:255',
            'variant' => 'nullable|string|max:255',
            'price' => 'nullable|numeric',
            'manufacture_year' => 'nullable',
            'registration_year' => 'nullable',
            'ownership' => 'required|string',
            'rto' => 'required|string',
            'car_condition' => 'required|string',

            // Specifications
            'fuel_type' => 'nullable|string',
            'transmission' => 'nullable|string',
            'engine_cc' => 'nullable|numeric',
            'mileage' => 'nullable|numeric',
            'seating_capacity' => 'nullable|numeric',
            'color' => 'nullable|string',
            'description' => 'nullable',

            // Features
            'features' => 'nullable|array',

            // Files (all handled by Spatie)
            'rc_copy' => 'nullable|file|mimes:jpg,jpeg,png,pdf',
            'insurance_doc' => 'nullable|file|mimes:jpg,jpeg,png,pdf',
            'pollution' => 'nullable|file|mimes:jpg,jpeg,png,pdf',
            'image_360' => 'nullable|file|mimes:jpg,jpeg,png',
            'gallery_images.*' => 'nullable|file|mimes:jpg,jpeg,png',
            'car_image' => ($id ? 'nullable' : 'required').'|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        DB::beginTransaction();

        try {
            // 1️⃣ Car Table
            $car = isset($id) ? Car::findOrFail($id) : new Car;

            $car->dealer_id = $data['dealer'] ?? null;
            $car->brand = $data['brand'] ?? null;
            $car->car_name = $data['car_name'];
            $car->variant = $data['variant'] ?? null;
            $car->price = $data['price'] ?? null;
            $car->manufacture_year = $data['manufacture_year'] ?? null;
            $car->registration_year = $data['registration_year'] ?? null;
            $car->ownership = $data['ownership'];
            $car->rto = $data['rto'] ?? null;
            $car->car_condition = $data['car_condition'];
            $car->description = $data['description'];
            $car->features = isset($data['features']) ? implode(',', $data['features']) : null;

            if ($request->hasFile('car_image')) {

                if ($car->car_image) {
                    deleteFiles($car->car_image);
                }
                $car->car_image = uploadWebpImage($request->file('car_image'), 'cars', false, $car->car_image);
            }

            if ($request->hasFile('rc_copy')) {
                if ($car->rc_copy) {
                    deleteFiles($car->rc_copy);
                }
                $car->rc_copy = uploadFiles($request, 'rc_copy', 'cars');
            }

            if ($request->hasFile('insurance_doc')) {
                if ($car->insurance_doc) {
                    deleteFiles($car->insurance_doc);
                }
                $car->insurance_doc = uploadFiles($request, 'insurance_doc', 'cars');
            }

            if ($request->hasFile('pollution')) {
                if ($car->pollution) {
                    deleteFiles($car->pollution);
                }
                $car->pollution = uploadFiles($request, 'pollution', 'cars');
            }
            if ($request->hasFile('image_360')) {
                if ($car->image_360) {
                    deleteFiles($car->image_360);
                }
                $car->image_360 = uploadFiles($request, 'image_360', 'cars');
            }

            if ($request->hasFile('gallery_image')) {
                if ($car->gallery_image) {
                    deleteFiles($car->gallery_image);
                }
                $car->gallery_image = uploadFiles($request, 'gallery_image', 'cars_gallery');
            }

            $car->save();

            // 3️⃣ Car Specifications
            $spec = $car->specifications ?? new CarSpecification;
            $spec->car_id = $car->id;
            $spec->fuel_type = $data['fuel_type'] ?? null;
            $spec->transmission = $data['transmission'] ?? null;
            $spec->engine_cc = $data['engine_cc'] ?? null;
            $spec->mileage = $data['mileage'] ?? null;
            $spec->seating_capacity = $data['seating_capacity'] ?? null;
            $spec->color = $data['color'] ?? null;
            $spec->save();

            // 4️⃣ Car Features

            DB::commit();

            return redirect()->route('cars.index')->with('success', 'Car saved successfully!');
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->back()->with('error', 'Something went wrong: '.$e->getMessage());
        }
    }

    /**
     * Edit dealer
     */
    public function edit($id)
    {
        abort_if(! auth()->user()->can('cars.edit'), 403, __('User does not have the right permissions.'));

        try {
            $title = 'Edit Car';
            $carId = decrypt($id);
            $dealers = User::select('id', 'name')->where('role_id', '4')->where('status', 'active')->get();
            $car = Car::with('specifications')->findOrFail($carId);

            return view('admin.cars.add', compact('car', 'title', 'dealers'));
        } catch (\Exception $e) {
            Log::error('Car edit failed', ['message' => $e->getMessage()]);

            return redirect()->route('cars.index')->with('error', __('Failed to retrieve car for editing.'));
        }
    }

    public function changeStatus(Request $request)
    {

        if (! auth()->user()->can('cars.status')) {
            return response()->json([
                'success' => false,
                'message' => __('User does not have the right permissions.'),
            ], 403);
        }

         try {

            $carId = decrypt($request->input('id'));
            $newStatus = $request->input('status') === 'active' ? 'inactive' : 'active';
            $car = Car::findOrFail($carId);
            $car->status = $newStatus;
            $car->save();

            return response()->json([
                'message' => 'Car status updated successfully.',
                'newStatus' => $newStatus,
                'icon' => $newStatus === 'active' ? 'fa-toggle-off' : 'fa-toggle-on',
                'title' => $newStatus === 'active' ? 'Make Inactive' : 'Make Active',
                'class' => $newStatus === 'active' ? 'text-danger' : 'text-success',
            ]);
        } catch (\Exception $e) {

            Log::error('Car status update failed: '.$e->getMessage());

            return response()->json([
                'status' => false,
                'message' => __('Failed to update car status. Please try again.'),
            ], 500);
        }
    }

    /**
     * Delete car
     */
    public function destroy($id)
    {
        abort_if(! auth()->user()->can('cars.delete'), 403, __('User does not have the right permissions.'));

        try {
            DB::beginTransaction();
            $car = Car::findOrFail(decrypt($id));
            $car->delete();

            if ($car->insurance_doc) {
                deleteFiles($car->insurance_doc);
            }
            if ($car->car_image) {
                deleteFiles($car->car_image);
            }
            if ($car->rc_copy) {
                deleteFiles($car->rc_copy);
            }

            if ($car->pollution) {
                deleteFiles($car->pollution);
            }
            if ($car->image_360) {
                deleteFiles($car->image_360);
            }

            DB::commit();

            return response()->json(['message' => 'Car detail deleted successfully.']);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Car deletion failed: '.$e->getMessage());

            return response()->json([
                'status' => false,
                'message' => __('Failed to delete car. Please try again.'),
            ], 500);
        }
    }
}
