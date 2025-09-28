<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Power;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\DataTables;

class PowerController extends Controller
{
    public function index(Request $request)
    {
        abort_if(! auth()->user()->can('power.view'), 403, 'User does not have the right permissions.');

        $data['title'] = 'Power List';
        $data['create_title'] = 'Power';

        $authId = auth()->id();
        $powers = Power::when(auth()->user()->role_id != 1, function ($query) use ($authId) {
            return $query->where('user_id', $authId);
        })->whereNull('deleted_at');

        if ($request->ajax()) {
            return DataTables::of($powers)
                ->addIndexColumn()
                ->editColumn('action', function ($power) {
                    return $this->generateActionButtons($power);
                })
                ->editColumn('status', function ($power) {
                    return ucfirst($power->status === 'active' ? 'active' : 'inactive');
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.power.list')->with($data);
    }

    private function generateActionButtons($power)
    {
        $html = '';
        if (auth()->user()->can('power.edit')) {
            $html .= '<a href="javascript:void(0)" class="edit-power"  
                data-toggle="modal" data-target="#powerModal"  
                data-id="'.encrypt($power->id).'" title="Edit Detail"><i class="fa fa-edit"></i></a>   ';
        }

        if (auth()->user()->can('power.status')) {
            $status = $power->status;
            $id = encrypt($power->id);
            $url = route('powers.status');
            $title = $status === 'active' ? 'Make Inactive' : 'Make Active';
            $icon = $status === 'active' ? 'fa-toggle-off text-danger' : 'fa-toggle-on text-success';
            $tableid = 'powerTable';

            $html .= '<a href="javascript:void(0);" class="toggle-status"
                data-id="'.$id.'"
                data-status="'.$status.'"
                data-tableid="'.$tableid.'"
                data-url="'.$url.'"
                title="'.$title.'">
                <i class="fa fa-fw '.$icon.'"></i> 
                </a>';
        }

        if (auth()->user()->can('power.delete')) {
            $id = encrypt($power->id);
            $url = route('powers.destroy', $id);
            $tableid = 'powerTable';

            $html .= '  <button type="button" class="btn btn-danger btn-xs delete-record" 
            data-id="'.$id.'" 
            data-url="'.$url.'" 
            data-tableid="'.$tableid.'" 
            data-title="power" 
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

        if ($isUpdate && ! auth()->user()->can('power.edit')) {
            return response()->json([
                'success' => false,
                'message' => 'User does not have the right permissions.',
            ], 403);
        }

        if (! $isUpdate && ! auth()->user()->can('power.create')) {
            return response()->json([
                'success' => false,
                'message' => 'User does not have permission to create power.',
            ], 403);
        }

        $rules = [
            'name' => [
                'required',
                'string',
                'max:255',
                $isUpdate
                    ? "unique:powers,name,$id,id,deleted_at,NULL"
                    : 'unique:powers,name,NULL,id,deleted_at,NULL',
            ],
        ];
        $validated = $request->validate($rules);

        try {
            $dataToSave = [
                'name' => $validated['name'],
            ];

            $power = $isUpdate ? Power::findOrFail($id) : null;

            if ($isUpdate) {
                $power->update($dataToSave);
                $message = 'Power updated successfully.';
                $type = 'edit';
            } else {
                $dataToSave['user_id'] = auth()->id();
                $power = Power::create($dataToSave);
                $message = 'Power created successfully.';
                $type = 'add';
            }

            return response()->json([
                'success' => true,
                'message' => $message,
                'type' => $type,
                'data' => $power,
            ]);
        } catch (\Exception $e) {
            Log::error('Power save failed: '.$e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Failed to save Power. Please try again.',
            ], 500);
        }
    }

    public function edit($id)
    {
        if (! auth()->user()->can('power.edit')) {
            return response()->json([
                'success' => false,
                'message' => 'User does not have the right permissions.',
            ], 403);
        }

        try {
            $powerId = decrypt($id);
            $power = Power::findOrFail($powerId);

            return response()->json([
                'status' => true,
                'doc' => $power,
            ]);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'status' => false,
                'message' => 'Power not found.',
            ], 404);
        } catch (\Exception $e) {
            Log::error('Power edit failed: '.$e->getMessage());

            return response()->json([
                'status' => false,
                'message' => 'Failed to retrieve Power. Please try again.',
            ], 500);
        }
    }

    public function changeStatus(Request $request)
    {
        if (! auth()->user()->can('power.status')) {
            return response()->json([
                'success' => false,
                'message' => 'User does not have the right permissions.',
            ], 403);
        }

        try {
            $powerId = decrypt($request->input('id'));
            $newStatus = $request->input('status') === 'active' ? 'inactive' : 'active';
            $power = Power::findOrFail($powerId);
            $power->status = $newStatus;
            $power->save();

            return response()->json([
                'message' => 'Power status updated successfully.',
                'newStatus' => $newStatus,
                'icon' => $newStatus === 'active' ? 'fa-toggle-off' : 'fa-toggle-on',
                'title' => $newStatus === 'active' ? 'Make Inactive' : 'Make Active',
                'class' => $newStatus === 'active' ? 'text-danger' : 'text-success',
            ]);
        } catch (\Exception $e) {
            Log::error('Power status update failed: '.$e->getMessage());

            return response()->json([
                'status' => false,
                'message' => 'Failed to update Power status. Please try again.',
            ], 500);
        }
    }

    public function destroy($id)
    {
        if (! auth()->user()->can('power.delete')) {
            return response()->json([
                'success' => false,
                'message' => 'User does not have the right permissions.',
            ], 403);
        }

        try {
            $power = Power::findOrFail(decrypt($id));
            $power->delete();

            return response()->json([
                'message' => 'Power deleted successfully.',
            ]);
        } catch (\Exception $e) {
            Log::error('Power deletion failed: '.$e->getMessage());

            return response()->json([
                'status' => false,
                'message' => 'Failed to delete Power. Please try again.',
            ], 500);
        }
    }
}
