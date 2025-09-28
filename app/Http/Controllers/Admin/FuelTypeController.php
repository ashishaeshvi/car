<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FuelType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Storage;

class FuelTypeController extends Controller
{
    public function index(Request $request)
    {
        abort_if(! auth()->user()->can('fuel_type.view'), 403, 'No permission.');

        $data['title'] = 'Fuel Type List';
        $data['create_title'] = 'Fuel Type';

        $authId = auth()->id();
        $fuelTypes = FuelType::when(auth()->user()->role != 'admin', function ($query) use ($authId) {
            return $query->where('user_id', $authId);
        })->whereNull('deleted_at');

        if ($request->ajax()) {
            return DataTables::of($fuelTypes)
                ->addIndexColumn()
                ->editColumn('action', fn($ft) => $this->generateActionButtons($ft))
                ->editColumn('status', fn($ft) => ucfirst($ft->status))
                ->editColumn('created_at', fn($ft) => $ft->created_at->format('d F, Y'))
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.fueltype.list')->with($data);
    }

    private function generateActionButtons($fuelType)
    {
        $html = '';

        if (auth()->user()->can('fuel_type.edit')) {
            $html .= '<a href="javascript:void(0)" class="edit-fuelType" data-toggle="modal" data-target="#fuelTypeModal" data-id="'.encrypt($fuelType->id).'" title="Edit"><i class="fa fa-edit"></i></a> ';
        }

        if (auth()->user()->can('fuel_type.view')) {
            $html .= '<a href="javascript:void(0)" class="view-fuelType" data-toggle="modal" data-target="#viewfuelTypeModal" data-id="'.encrypt($fuelType->id).'" title="View"><i class="fa fa-eye"></i></a> ';
        }

        if (auth()->user()->can('fuel_type.status')) {
            $status = $fuelType->status;
            $id = encrypt($fuelType->id);
            $url = route('fuel-types.status');
            $title = $status === 'active' ? 'Make Inactive' : 'Make Active';
            $icon = $status === 'active' ? 'fa-toggle-off text-danger' : 'fa-toggle-on text-success';
            $tableid = 'fuelTypeTable';
            $html .= '<a href="javascript:void(0);" class="toggle-status" data-id="'.$id.'" data-status="'.$status.'" data-tableid="'.$tableid.'" data-url="'.$url.'" title="'.$title.'"><i class="fa fa-fw '.$icon.'"></i></a> ';
        }

        if (auth()->user()->can('fuel_type.delete')) {
            $id = encrypt($fuelType->id);
            $url = route('fuel-types.destroy', $id);
            $tableid = 'fuelTypeTable';
            $html .= '<button type="button" class="btn btn-danger btn-xs delete-record" data-id="'.$id.'" data-url="'.$url.'" data-tableid="'.$tableid.'" data-title="fuel type" title="Delete"><i class="fa fa-trash"></i></button>';
        }

        return $html;
    }

    public function store(Request $request)
    {
        $isUpdate = $request->filled('id');
        $id = $request->id;

        if ($isUpdate && ! auth()->user()->can('fuel_type.edit')) {
            return response()->json(['success' => false, 'message' => 'No permission'], 403);
        }
        if (! $isUpdate && ! auth()->user()->can('fuel_type.create')) {
            return response()->json(['success' => false, 'message' => 'No permission'], 403);
        }

        $rules = [
            'name' => [
                'required', 'string', 'max:255',
                $isUpdate ? "unique:fuel_types,name,$id" : 'unique:fuel_types,name'
            ],
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:5120',
        ];

        $validated = $request->validate($rules);

        try {
            $dataToSave = ['name' => $validated['name']];
            $fuelType = $isUpdate ? FuelType::findOrFail($id) : null;

            if ($request->hasFile('image')) {
                $oldFile = $isUpdate ? $fuelType->image : null;
                $uploaded = uploadWebpImage($request->file('image'), 'fuel_type', false, $oldFile);

                if (!$uploaded) {
                    return response()->json(['success' => false, 'message' => 'Image upload failed'], 422);
                }

                $dataToSave['image'] = $uploaded;

                if ($isUpdate && $oldFile && Storage::disk('public')->exists($oldFile)) {
                    Storage::disk('public')->delete($oldFile);
                }
            }

            if ($isUpdate) {
                $fuelType->update($dataToSave);
                $message = 'Fuel type updated successfully.';
            } else {
                $dataToSave['user_id'] = auth()->id();
                $fuelType = FuelType::create($dataToSave);
                $message = 'Fuel type created successfully.';
            }

            return response()->json(['success' => true, 'message' => $message, 'data' => $fuelType]);

        } catch (\Exception $e) {
            Log::error('Fuel type save failed: '.$e->getMessage());
            return response()->json(['success' => false, 'message' => 'Failed to save.'], 500);
        }
    }

    public function edit($id)
    {
        abort_if(! auth()->user()->can('fuel_type.edit'), 403, 'No permission');

        try {
            $ftId = decrypt($id);
            $fuelType = FuelType::findOrFail($ftId);
            return response()->json(['status' => true, 'doc' => $fuelType]);
        } catch (\Exception $e) {
            Log::error('Fuel type edit failed: '.$e->getMessage());
            return response()->json(['status' => false, 'message' => 'Failed to retrieve.'], 500);
        }
    }

    public function changeStatus(Request $request)
    {
        abort_if(! auth()->user()->can('fuel_type.status'), 403, 'No permission');

        try {
            $ftId = decrypt($request->id);
            $fuelType = FuelType::findOrFail($ftId);
            $fuelType->status = $request->status === 'active' ? 'inactive' : 'active';
            $fuelType->save();

            return response()->json([
                'message' => 'Status updated successfully.',
                'newStatus' => $fuelType->status,
            ]);
        } catch (\Exception $e) {
            Log::error('Fuel type status update failed: '.$e->getMessage());
            return response()->json(['status' => false, 'message' => 'Failed to update status'], 500);
        }
    }

    public function destroy($id)
    {
        abort_if(! auth()->user()->can('fuel_type.delete'), 403, 'No permission');

        try {
            $fuelType = FuelType::findOrFail(decrypt($id));

            if ($fuelType->image) {
                deleteFiles($fuelType->image);
            }

            $fuelType->delete();

            return response()->json(['message' => 'Fuel type deleted successfully.']);
        } catch (\Exception $e) {
            Log::error('Fuel type deletion failed: '.$e->getMessage());
            return response()->json(['status' => false, 'message' => 'Failed to delete.'], 500);
        }
    }
}
