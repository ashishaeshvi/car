<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Mileage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\DataTables;

class MileageController extends Controller
{
    public function index(Request $request)
    {
        abort_if(! auth()->user()->can('mileage.view'), 403, 'User does not have the right permissions.');

        $data['title'] = 'Mileages List';
        $data['create_title'] = 'Mileage';

        $authId = auth()->id();
        $mileages = Mileage::when(auth()->user()->role_id != 1, function ($query) use ($authId) {
            return $query->where('user_id', $authId);
        })->whereNull('deleted_at');

        if ($request->ajax()) {
            return DataTables::of($mileages)
                ->addIndexColumn()
                ->editColumn('action', function ($mileage) {
                    return $this->generateActionButtons($mileage);
                })
                ->editColumn('status', function ($mileage) {
                    return ucfirst($mileage->status === 'active' ? 'active' : 'inactive');
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.mileage.list')->with($data);
    }

    private function generateActionButtons($mileage)
    {
        $html = '';
        if (auth()->user()->can('mileage.edit')) {
            $html .= '<a href="javascript:void(0)"  class="edit-mileage"  
                data-toggle="modal" data-target="#mileageModal"  
                data-id="'.encrypt($mileage->id).'" title="Edit Detail"><i class="fa fa-edit"></i></a>   ';
        }

        if (auth()->user()->can('mileage.status')) {
            $status = $mileage->status;
            $id = encrypt($mileage->id);
            $url = route('mileages.status');
            $title = $status === 'active' ? 'Make Inactive' : 'Make Active';
            $icon = $status === 'active' ? 'fa-toggle-off text-danger' : 'fa-toggle-on text-success';
            $tableid = 'mileageTable';

            $html .= '<a href="javascript:void(0);" class="toggle-status"
                data-id="'.$id.'"
                data-status="'.$status.'"
                data-tableid="'.$tableid.'"
                data-url="'.$url.'"
                title="'.$title.'">
                <i class="fa fa-fw '.$icon.'"></i> 
                </a>';
        }

        if (auth()->user()->can('mileage.delete')) {
            $id = encrypt($mileage->id);
            $url = route('mileages.destroy', $id);
            $tableid = 'mileageTable';

            $html .= '  <button type="button" class="btn btn-danger btn-xs delete-record" 
            data-id="'.$id.'" 
            data-url="'.$url.'" 
            data-tableid="'.$tableid.'" 
            data-title="mileage" 
            title="Delete">
            <i class="fa fa-trash"></i>
          </button>';
        }

        return $html;
    }

    public function store(Request $request)
    {
        $isUpdate = $request->filled('id');
        $id = $request->id;

        if ($isUpdate && ! auth()->user()->can('mileage.edit')) {
            return response()->json([
                'success' => false,
                'message' => 'User does not have the right permissions.',
            ], 403);
        }

        if (! $isUpdate && ! auth()->user()->can('mileage.create')) {
            return response()->json([
                'success' => false,
                'message' => 'User does not have permission to create mileage.',
            ], 403);
        }

         $rules = [
    'name' => [
        'required',
        'string',
        'max:255',
        $isUpdate
            ? "unique:mileages,name,$id,id,deleted_at,NULL"
            : 'unique:mileages,name,NULL,id,deleted_at,NULL',
    ],
];
        $validated = $request->validate($rules);

        try {
           $dataToSave = [
                'name' => $validated['name'],
            ];

            $mileage = $isUpdate ? Mileage::findOrFail($id) : null;

            if ($isUpdate) {
                $mileage->update($dataToSave);
                $message = 'Mileage updated successfully.';
                $type = 'edit';
            } else {
                $dataToSave['user_id'] = auth()->id();
                $mileage = Mileage::create($dataToSave);
                $message = 'Mileage created successfully.';
                $type = 'add';
            }

            return response()->json([
                'success' => true,
                'message' => $message,
                'type' => $type,
                'data' => $mileage,
            ]);
        } catch (\Exception $e) {
            Log::error('Mileage save failed: '.$e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Failed to save mileage. Please try again.',
            ], 500);
        }
    }

    public function edit($id)
    {
        if (! auth()->user()->can('mileage.edit')) {
            return response()->json([
                'success' => false,
                'message' => 'User does not have the right permissions.',
            ], 403);
        }

        try {
            $mileageId = decrypt($id);
            $mileage = Mileage::findOrFail($mileageId);

            return response()->json([
                'status' => true,
                'doc' => $mileage,
            ]);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'status' => false,
                'message' => 'Mileage not found.',
            ], 404);
        } catch (\Exception $e) {
            Log::error('Mileage edit failed: '.$e->getMessage());

            return response()->json([
                'status' => false,
                'message' => 'Failed to retrieve mileage. Please try again.',
            ], 500);
        }
    }

    public function changeStatus(Request $request)
    {
        if (! auth()->user()->can('mileage.status')) {
            return response()->json([
                'success' => false,
                'message' => 'User does not have the right permissions.',
            ], 403);
        }

        try {
            $mileageId = decrypt($request->input('id'));
            $newStatus = $request->input('status') === 'active' ? 'inactive' : 'active';
            $mileage = Mileage::findOrFail($mileageId);
            $mileage->status = $newStatus;
            $mileage->save();

            return response()->json([
                'message' => 'Mileage status updated successfully.',
                'newStatus' => $newStatus,
                'icon' => $newStatus === 'active' ? 'fa-toggle-off' : 'fa-toggle-on',
                'title' => $newStatus === 'active' ? 'Make Inactive' : 'Make Active',
                'class' => $newStatus === 'active' ? 'text-danger' : 'text-success',
            ]);
        } catch (\Exception $e) {
            Log::error('Mileage status update failed: '.$e->getMessage());

            return response()->json([
                'status' => false,
                'message' => 'Failed to update mileage status. Please try again.',
            ], 500);
        }
    }

    public function destroy($id)
    {
        if (! auth()->user()->can('mileage.delete')) {
            return response()->json([
                'success' => false,
                'message' => 'User does not have the right permissions.',
            ], 403);
        }

        try {
            $mileage = Mileage::findOrFail(decrypt($id));
            $mileage->delete();

            return response()->json([
                'message' => 'Mileage deleted successfully.',
            ]);
        } catch (\Exception $e) {
            Log::error('Mileage deletion failed: '.$e->getMessage());

            return response()->json([
                'status' => false,
                'message' => 'Failed to delete mileage. Please try again.',
            ], 500);
        }
    }
}
