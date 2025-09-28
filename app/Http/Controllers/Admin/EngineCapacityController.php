<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\EngineCapacity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\DataTables;

class EngineCapacityController extends Controller
{
    public function index(Request $request)
    {
        abort_if(! auth()->user()->can('enginecapacity.view'), 403, 'User does not have the right permissions.');

        $data['title'] = 'Engine Capacities List';
        $data['create_title'] = 'Engine Capacity';

        $authId = auth()->id();
        $engineCapacities = EngineCapacity::when(auth()->user()->role_id != 1, function ($query) use ($authId) {
            return $query->where('user_id', $authId);
        })->whereNull('deleted_at');

        if ($request->ajax()) {
            return DataTables::of($engineCapacities)
                ->addIndexColumn()
                ->editColumn('action', function ($capacity) {
                    return $this->generateActionButtons($capacity);
                })
                ->editColumn('status', function ($capacity) {
                    return ucfirst($capacity->status === 'active' ? 'active' : 'inactive');
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.enginecapacity.list')->with($data);
    }

    private function generateActionButtons($capacity)
    {
        $html = '';
        if (auth()->user()->can('enginecapacity.edit')) {
            $html .= '<a href="javascript:void(0)" class="edit-engineCapacity"  
                data-toggle="modal" data-target="#engineCapacityModal"  
                data-id="'.encrypt($capacity->id).'" title="Edit Detail"><i class="fa fa-edit"></i></a>   ';
        }

        if (auth()->user()->can('enginecapacity.status')) {
            $status = $capacity->status;
            $id = encrypt($capacity->id);
            $url = route('engine-capacities.status');
            $title = $status === 'active' ? 'Make Inactive' : 'Make Active';
            $icon = $status === 'active' ? 'fa-toggle-off text-danger' : 'fa-toggle-on text-success';
            $tableid = 'engineCapacityTable';

            $html .= '<a href="javascript:void(0);" class="toggle-status"
                data-id="'.$id.'"
                data-status="'.$status.'"
                data-tableid="'.$tableid.'"
                data-url="'.$url.'"
                title="'.$title.'">
                <i class="fa fa-fw '.$icon.'"></i> 
                </a>';
        }

        if (auth()->user()->can('enginecapacity.delete')) {
            $id = encrypt($capacity->id);
            $url = route('engine-capacities.destroy', $id);
            $tableid = 'engineCapacityTable';

            $html .= '  <button type="button" class="btn btn-danger btn-xs delete-record" 
            data-id="'.$id.'" 
            data-url="'.$url.'" 
            data-tableid="'.$tableid.'" 
            data-title="engine capacity" 
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

        if ($isUpdate && ! auth()->user()->can('enginecapacity.edit')) {
            return response()->json([
                'success' => false,
                'message' => 'User does not have the right permissions.',
            ], 403);
        }

        if (! $isUpdate && ! auth()->user()->can('enginecapacity.create')) {
            return response()->json([
                'success' => false,
                'message' => 'User does not have permission to create engine capacity.',
            ], 403);
        }

        $rules = [
            'name' => [
                'required',
                'string',
                'max:255',
                $isUpdate
                    ? "unique:engine_capacities,name,$id,id,deleted_at,NULL"
                    : 'unique:engine_capacities,name,NULL,id,deleted_at,NULL',
            ],
        ];
        $validated = $request->validate($rules);

        try {
            $dataToSave = [
                'name' => $validated['name'],
            ];

            $capacity = $isUpdate ? EngineCapacity::findOrFail($id) : null;

            if ($isUpdate) {
                $capacity->update($dataToSave);
                $message = 'Engine Capacity updated successfully.';
                $type = 'edit';
            } else {
                $dataToSave['user_id'] = auth()->id();
                $capacity = EngineCapacity::create($dataToSave);
                $message = 'Engine Capacity created successfully.';
                $type = 'add';
            }

            return response()->json([
                'success' => true,
                'message' => $message,
                'type' => $type,
                'data' => $capacity,
            ]);
        } catch (\Exception $e) {
            Log::error('Engine Capacity save failed: '.$e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Failed to save Engine Capacity. Please try again.',
            ], 500);
        }
    }

    public function edit($id)
    {
        if (! auth()->user()->can('enginecapacity.edit')) {
            return response()->json([
                'success' => false,
                'message' => 'User does not have the right permissions.',
            ], 403);
        }

        try {
            $capacityId = decrypt($id);
            $capacity = EngineCapacity::findOrFail($capacityId);

            return response()->json([
                'status' => true,
                'doc' => $capacity,
            ]);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'status' => false,
                'message' => 'Engine Capacity not found.',
            ], 404);
        } catch (\Exception $e) {
            Log::error('Engine Capacity edit failed: '.$e->getMessage());

            return response()->json([
                'status' => false,
                'message' => 'Failed to retrieve Engine Capacity. Please try again.',
            ], 500);
        }
    }

    public function changeStatus(Request $request)
    {
        if (! auth()->user()->can('enginecapacity.status')) {
            return response()->json([
                'success' => false,
                'message' => 'User does not have the right permissions.',
            ], 403);
        }

        try {
            $capacityId = decrypt($request->input('id'));
            $newStatus = $request->input('status') === 'active' ? 'inactive' : 'active';
            $capacity = EngineCapacity::findOrFail($capacityId);
            $capacity->status = $newStatus;
            $capacity->save();

            return response()->json([
                'message' => 'Engine Capacity status updated successfully.',
                'newStatus' => $newStatus,
                'icon' => $newStatus === 'active' ? 'fa-toggle-off' : 'fa-toggle-on',
                'title' => $newStatus === 'active' ? 'Make Inactive' : 'Make Active',
                'class' => $newStatus === 'active' ? 'text-danger' : 'text-success',
            ]);
        } catch (\Exception $e) {
            Log::error('Engine Capacity status update failed: '.$e->getMessage());

            return response()->json([
                'status' => false,
                'message' => 'Failed to update Engine Capacity status. Please try again.',
            ], 500);
        }
    }

    public function destroy($id)
    {
        if (! auth()->user()->can('enginecapacity.delete')) {
            return response()->json([
                'success' => false,
                'message' => 'User does not have the right permissions.',
            ], 403);
        }

        try {
            $capacity = EngineCapacity::findOrFail(decrypt($id));
            $capacity->delete();

            return response()->json([
                'message' => 'Engine Capacity deleted successfully.',
            ]);
        } catch (\Exception $e) {
            Log::error('Engine Capacity deletion failed: '.$e->getMessage());

            return response()->json([
                'status' => false,
                'message' => 'Failed to delete Engine Capacity. Please try again.',
            ], 500);
        }
    }
}
