<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BodyType;
use App\Models\Brand;
use App\Models\Car;
use App\Models\CarGallery;
use App\Models\CarLatestUpdate;
use App\Models\CarProsCons;
use App\Models\CarSpecification;
use App\Models\City;
use App\Models\Colour;
use App\Models\EngineCapacity;
use App\Models\FuelType;
use App\Models\Mileage;
use App\Models\Power;
use App\Models\Torque;
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
                ->editColumn('created_at', fn($row) => $row->created_at->format('d M, Y'))
                ->addColumn('dealer_name', fn($row) => $row->dealer->name ?? 'N/A') // Show dealer name
                ->addColumn('action', fn($row) => $this->generateActionButtons($row))
                ->rawColumns(['action'])
                ->toJson();
        }

        return view('admin.cars.list')->with($data);
    }

    private function generateActionButtons($car)
    {
        $html = '';
        if (auth()->user()->can('cars.edit')) {
            $html .= '<a href="' . route('cars.edit', encrypt($car->id)) . '" title="Edit"><i class="fa fa-edit"></i></a> ';
        }

        if (auth()->user()->can('cars.status')) {
            $status = $car->status;
            $id = encrypt($car->id);
            $url = route('cars.status');
            $title = $status === 'active' ? 'Make Inactive' : 'Make Active';
            $icon = $status === 'active' ? 'fa-toggle-off text-danger' : 'fa-toggle-on text-success';
            $tableid = 'cars-table';
            $html .= '<a href="javascript:void(0);" class="toggle-status"
                data-id="' . $id . '"
                data-status="' . $status . '"
                data-tableid="' . $tableid . '"
                data-url="' . $url . '"
                title="' . $title . '">
                <i class="fa fa-fw ' . $icon . '"></i> 
                </a>';
        }

        if (auth()->user()->can('cars.delete')) {
            $id = encrypt($car->id);
            $url = route('cars.destroy', $id);
            $tableid = 'cars-table';

            $html .= '<button type="button" class="btn btn-danger btn-xs delete-record"
                data-id="' . $id . '"
                data-url="' . $url . '"
                data-tableid="' . $tableid . '"
                data-title="car"
                title="Delete">
                <i class="fa fa-trash"></i>
            </button>';
        }


        if (auth()->user()->can('cars.gallery')) { // Create a permission for managing gallery if needed
            $html .= '<a href="' . route('cars.gallery', encrypt($car->id)) . '" title="Gallery Images">
                <i class="fa fa-image text-primary"></i>
              </a> |';
        }

        $html .= '<a href="' . route('cars.latestupdates', encrypt($car->id)) . '" title="Latest Updates">
               Latest Updates
              </a>  | ';

        $html .= '<a href="' . route('cars.pros-cons', encrypt($car->id)) . '" title="Latest Updates">
               Pros & Cons
              </a> |';

               $html .= '<a href="' . route('cars.mileages', encrypt($car->id)) . '" title="Latest Updates">
               Car Mileages
              </a> |';

              $html .= '<a href="' . route('cars.faqs', encrypt($car->id)) . '" title="Latest Updates">
               Car Faqs
              </a> | 
              ';

        return $html;
    }

    /**
     * Show create form
     */
    public function create()
    {
        abort_if(! auth()->user()->can('cars.add'), 403, __('User does not have the right permissions.'));

        $dealers = User::select('id', 'name')->where('role_id', 4)->where('status', 'active')->get();

        $bodyTypes = BodyType::select('id', 'name')->where('status', 'active')->get();
        $brands = Brand::select('id', 'name')->where('status', 'active')->get();
        $cities = City::select('id', 'name')->where('status', 'active')->get();
        $colours = Colour::select('id', 'name')->where('status', 'active')->get();
        $engineCapacities = EngineCapacity::select('id', 'name')->where('status', 'active')->get();
        $fuelTypes = FuelType::select('id', 'name')->where('status', 'active')->get();
        $mileages = Mileage::select('id', 'name')->where('status', 'active')->get();
        $powers = Power::select('id', 'name')->where('status', 'active')->get();
        $torques = Torque::select('id', 'name')->where('status', 'active')->get();

        $title = 'Add Car';

        $safetyRatings = ['1 Star', '2 Star', '3 Star', '4 Star', '5 Star'];
        $airbags  = ['Upto 2', '3 to 5', '6 to 8', 'More than 8'];


        return view('admin.cars.add', compact('dealers', 'bodyTypes', 'brands', 'cities', 'colours', 'engineCapacities', 'fuelTypes', 'mileages', 'powers', 'torques', 'title', 'safetyRatings', 'airbags'));
    }


    /**
     * Store or update cars.
     */
    public function storeOrUpdate(Request $request, $id = null)
    {
        $data = $request->validate([
            'dealer' => 'required|string|max:255',
            'car_name' => 'required|string|max:255',
            'city' => 'required|string|max:10',
            'brand' => 'nullable|string|max:255',
            'variant' => 'nullable|string|max:255',
            'price' => 'nullable|string',
            'emi_starting_price' => 'nullable|string',

            'manufacture_year' => 'nullable',
            'registration_year' => 'nullable',
            'ownership' => 'required|string',
            'rto' => 'required|string',
            'car_condition' => 'required|string',

            // Specifications

            'transmission' => 'nullable|array',
            'transmission.*' => 'nullable|string',
            'engine_cc' => 'nullable|numeric',
            'mileage' => 'nullable|numeric',
            'seating_capacity' => 'nullable|numeric',
            'fuel_type' => 'nullable|array',
            'fuel_type.*' => 'nullable|string',
            'colour' => 'nullable|array',
            'colour.*' => 'nullable|string',
            'safety_ratings' => 'nullable|string',
            'airbags' => 'nullable|string',
            'torque_id' => 'nullable|integer',
            'power_id' => 'nullable|integer',
            'body_type' => 'nullable|string',

            'description' => 'nullable',

            // Features
            'features' => 'nullable|array',

            // Files
            'rc_copy' => 'nullable|file|mimes:jpg,jpeg,png,pdf',
            'insurance_doc' => 'nullable|file|mimes:jpg,jpeg,png,pdf',
            'pollution' => 'nullable|file|mimes:jpg,jpeg,png,pdf',
            'image_360' => 'nullable|file|mimes:jpg,jpeg,png',
            'car_image' => ($id ? 'nullable' : 'required') . '|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        DB::beginTransaction();

        try {
            // 1️⃣ Car Table
            $car = isset($id) ? Car::findOrFail($id) : new Car;

            $car->dealer_id = $data['dealer'] ?? null;
            $car->city_id = $data['city'] ?? null;
            $car->car_name = $data['car_name'];
            $car->variant = $data['variant'] ?? null;
            $car->price = $data['price'] ?? null;
            $car->emi_starting_price = $data['emi_starting_price'] ?? null;
            $car->manufacture_year = $data['manufacture_year'] ?? null;
            $car->registration_year = $data['registration_year'] ?? null;
            $car->ownership = $data['ownership'];
            $car->rto = $data['rto'] ?? null;
            $car->car_condition = $data['car_condition'];
            $car->description = $data['description'] ?? null;
            $car->features = isset($data['features']) ? implode(',', $data['features']) : null;

            // 2️⃣ Handle Car Images & Files
            if ($request->hasFile('car_image')) {
                if ($car->car_image) deleteFiles($car->car_image);
                $car->car_image = uploadWebpImage($request->file('car_image'), 'cars', false, $car->car_image);
            }
            if ($request->hasFile('rc_copy')) {
                if ($car->rc_copy) deleteFiles($car->rc_copy);
                $car->rc_copy = uploadFiles($request, 'rc_copy', 'cars');
            }
            if ($request->hasFile('insurance_doc')) {
                if ($car->insurance_doc) deleteFiles($car->insurance_doc);
                $car->insurance_doc = uploadFiles($request, 'insurance_doc', 'cars');
            }
            if ($request->hasFile('pollution')) {
                if ($car->pollution) deleteFiles($car->pollution);
                $car->pollution = uploadFiles($request, 'pollution', 'cars');
            }
            if ($request->hasFile('image_360')) {
                if ($car->image_360) deleteFiles($car->image_360);
                $car->image_360 = uploadFiles($request, 'image_360', 'cars');
            }


            $car->save();

            // 3️⃣ Car Specifications
            $spec = $car->specifications ?? new CarSpecification;
            $spec->car_id = $car->id;
            $spec->fuel_type = isset($data['fuel_type']) ? implode(',', $data['fuel_type']) : null;
            $spec->transmission = isset($data['transmission']) ? implode(',', $data['transmission']) : null;
            $spec->colour = isset($data['colour']) ? implode(',', $data['colour']) : null;
            $spec->engine_cc = $data['engine_cc'] ?? null;
            $spec->mileage = $data['mileage'] ?? null;
            $spec->seating_capacity = $data['seating_capacity'] ?? null;
            $spec->safety_ratings = $data['safety_ratings'] ?? null;
            $spec->airbags = $data['airbags'] ?? null;
            $spec->torque_id = $data['torque_id'] ?? null;
            $spec->power_id = $data['power_id'] ?? null;
            $spec->body_type = $data['body_type'] ?? null;
            $spec->brand = $data['brand'] ?? null;
            $spec->save();

            DB::commit();

            return redirect()->route('cars.index')->with('success', 'Car saved successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Something went wrong: ' . $e->getMessage());
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


            $bodyTypes = BodyType::select('id', 'name')->where('status', 'active')->get();
            $brands = Brand::select('id', 'name')->where('status', 'active')->get();
            $cities = City::select('id', 'name')->where('status', 'active')->get();
            $colours = Colour::select('id', 'name')->where('status', 'active')->get();
            $engineCapacities = EngineCapacity::select('id', 'name')->where('status', 'active')->get();
            $fuelTypes = FuelType::select('id', 'name')->where('status', 'active')->get();
            $mileages = Mileage::select('id', 'name')->where('status', 'active')->get();
            $powers = Power::select('id', 'name')->where('status', 'active')->get();
            $torques = Torque::select('id', 'name')->where('status', 'active')->get();

            $title = 'Add Car';

            $safetyRatings = ['1 Star', '2 Star', '3 Star', '4 Star', '5 Star'];
            $airbags  = ['Upto 2', '3 to 5', '6 to 8', 'More than 8'];

            $car = Car::with('specifications')->findOrFail($carId);
            return view('admin.cars.add', compact('car', 'dealers', 'bodyTypes', 'brands', 'cities', 'colours', 'engineCapacities', 'fuelTypes', 'mileages', 'powers', 'torques', 'title', 'safetyRatings', 'airbags'));
        } catch (\Exception $e) {
            Log::error('Car edit failed', ['message' => $e->getMessage()]);

            return redirect()->route('cars.index')->with('error', __('Failed to retrieve car for editing.'));
        }
    }




    /**
     * Edit dealer
     */
    public function gallery($id)
    {
        abort_if(! auth()->user()->can('cars.edit'), 403, __('User does not have the right permissions.'));

        try {
            $title = 'Add Gallery';
            $carId = decrypt($id);


            $carGallery = CarGallery::where('car_id', $carId)->get();
            return view('admin.cars.gallery', compact('carGallery', 'title', 'carId'));
        } catch (\Exception $e) {
            Log::error('Car edit failed', ['message' => $e->getMessage()]);

            return redirect()->route('cars.index')->with('error', __('Failed to retrieve car for editing.'));
        }
    }





    public function addGallery(Request $request, $carId)
    {
        $data = $request->validate([
            'gallery_image' => 'required|file|mimes:jpg,jpeg,png|max:2048',
        ]);

        DB::beginTransaction();

        try {
            $car = Car::findOrFail($carId);

            // Create a new gallery record
            $carGallery = new CarGallery();
            $carGallery->car_id = $car->id;

            if ($request->hasFile('gallery_image')) {
                $carGallery->image = uploadFiles($request, 'gallery_image', 'cars_gallery');
            }

            $carGallery->save();

            DB::commit();

            return redirect()->route('cars.gallery', encrypt($car->id))
                ->with('success', 'Gallery image added successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Something went wrong: ' . $e->getMessage());
        }
    }


    public function galleryDestroy($id)
    {
        try {
            $gallery = CarGallery::findOrFail(decrypt($id));

            // Delete the image file from storage
            if ($gallery->image) {
                deleteFiles($gallery->image); // Make sure you have this helper function
            }

            $gallery->delete();

            return redirect()->back()->with('success', 'Gallery image deleted successfully!');
        } catch (\Exception $e) {
            \Log::error('Gallery delete failed: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to delete gallery image. Please try again.');
        }
    }


    public function addLatestUpdate(Request $request, $carId)
    {
        $data = $request->validate([
            'notes' => 'required|string|max:191',
        ]);

        DB::beginTransaction();

        try {
            $car = Car::findOrFail($carId);

            // Create a new latest update record
            $latestUpdate = new CarLatestUpdate();
            $latestUpdate->car_id = $car->id;
            $latestUpdate->notes = $data['notes'];
            $latestUpdate->save();

            DB::commit();

            return redirect()->route('cars.latestupdates', encrypt($car->id))
                ->with('success', 'Latest update added successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Something went wrong: ' . $e->getMessage());
        }
    }

    public function latestUpdateDestroy($id)
    {
        try {
            $update = CarLatestUpdate::findOrFail(decrypt($id));
            $update->delete();

            return redirect()->back()->with('success', 'Latest update deleted successfully!');
        } catch (\Exception $e) {
            \Log::error('Latest update delete failed: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to delete latest update. Please try again.');
        }
    }

    public function latestUpdates($id)
    {
        abort_if(! auth()->user()->can('cars.edit'), 403, __('User does not have the right permissions.'));

        try {
            $title = 'Latest Updates';
            $carId = decrypt($id);

            $latestUpdates = CarLatestUpdate::where('car_id', $carId)->get();

            return view('admin.cars.latest-updates', compact('latestUpdates', 'title', 'carId'));
        } catch (\Exception $e) {
            Log::error('Car latest updates retrieval failed', ['message' => $e->getMessage()]);

            return redirect()->route('cars.index')->with('error', __('Failed to retrieve latest updates.'));
        }
    }




    public function addProsCons(Request $request, $carId)
    {
        $data = $request->validate([
            'type' => 'required|in:pro,con',
            'description' => 'required|string|max:191',
        ]);

        DB::beginTransaction();

        try {
            $car = Car::findOrFail($carId);

            // Create a new pro/con record
            $prosCons = new CarProsCons();
            $prosCons->car_id = $car->id;
            $prosCons->type = $data['type'];
            $prosCons->description = $data['description'];
            $prosCons->save();

            DB::commit();

            return redirect()->route('cars.pros-cons', encrypt($car->id))
                ->with('success', ucfirst($data['type']) . ' added successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Something went wrong: ' . $e->getMessage());
        }
    }

    public function prosConsDestroy($id)
    {
        try {
            $item = CarProsCons::findOrFail(decrypt($id));
            $item->delete();

            return redirect()->back()->with('success', ucfirst($item->type) . ' deleted successfully!');
        } catch (\Exception $e) {
            \Log::error('Pro/Con delete failed: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to delete. Please try again.');
        }
    }

    public function prosCons($id)
    {
        abort_if(! auth()->user()->can('cars.edit'), 403, __('User does not have the right permissions.'));

        try {
            $title = 'Pros & Cons';
            $carId = decrypt($id);

            // Fetch pros and cons separately or together
            $prosCons = CarProsCons::where('car_id', $carId)->get();

            return view('admin.cars.pros-cons', compact('prosCons', 'title', 'carId'));
        } catch (\Exception $e) {
            Log::error('Car pros/cons retrieval failed', ['message' => $e->getMessage()]);

            return redirect()->route('cars.index')->with('error', __('Failed to retrieve pros and cons.'));
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

            Log::error('Car status update failed: ' . $e->getMessage());

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
            Log::error('Car deletion failed: ' . $e->getMessage());

            return response()->json([
                'status' => false,
                'message' => __('Failed to delete car. Please try again.'),
            ], 500);
        }
    }
}
