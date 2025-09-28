<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Torque;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\DataTables;

class TorqueController extends Controller
{
    public function index(Request $request)
    {
        abort_if(! auth()->user()->can('torque.view'), 403, 'User does not have the right permissions.');

        $data['title'] = 'Torque List';
        $data['create_title'] = 'Torque';

        $authId = auth()->id();
        $torques = Torque::when(auth()->user()->role_id != 1, function ($query) use ($authId) {
            return $query->where('user_id', $authId);
        })->whereNull('deleted_at');

        if ($request->ajax()) {
            return DataTables::of($torques)
                ->addIndexColumn()
                ->editColumn('action', function ($torque) {
                    return $this->generateActionButtons($torque);
                })
                ->editColumn('status', function ($torque) {
                    return ucfirst($torque->status === 'active' ? 'active' : 'inactive');
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.torque.list')->with($data);
    }

    private function generateActionButtons($torque)
    {
        $html = '';
        if (auth()->user()->can('torque.edit')) {
            $html .= '<a href="javascript:void(0)" class="edit-torque"  
                data-toggle="modal" data-target="#torqueModal"  
                data-id="'.encrypt($torque->id).'" title="Edit Detail"><i class="fa fa-edit"></i></a>   ';
        }

        if (auth()->user()->can('torque.status')) {
            $status = $torque->status;
            $id = encrypt($torque->id);
            $url = route('torques.status');
            $title = $status === 'active' ? 'Make Inactive' : 'Make Active';
            $icon = $status === 'active' ? 'fa-toggle-off text-danger' : 'fa-toggle-on text-success';
            $tableid = 'torqueTable';

            $html .= '<a href="javascript:void(0);" class="toggle-status"
                data-id="'.$id.'"
                data-status="'.$status.'"
                data-tableid="'.$tableid.'"
                data-url="'.$url.'"
                title="'.$title.'">
                <i class="fa fa-fw '.$icon.'"></i> 
                </a>';
        }

        if (auth()->user()->can('torque.delete')) {
            $id = encrypt($torque->id);
            $url = route('torques.destroy', $id);
            $tableid = 'torqueTable';

            $html .= '  <button type="button" class="btn btn-danger btn-xs delete-record" 
            data-id="'.$id.'" 
            data-url="'.$url.'" 
            data-tableid="'.$tableid.'" 
            data-title="torque" 
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

        if ($isUpdate && ! auth()->user()->can('torque.edit')) {
            return response()->json([
                'success' => false,
                'message' => 'User does not have the right permissions.',
            ], 403);
        }

        if (! $isUpdate && ! auth()->user()->can('torque.create')) {
            return response()->json([
                'success' => false,
                'message' => 'User does not have permission to create torque.',
            ], 403);
        }

        $rules = [
            'name' => [
                'required',
                'string',
                'max:255',
                $isUpdate
                    ? "unique:torques,name,$id,id,deleted_at,NULL"
                    : 'unique:torques,name,NULL,id,deleted_at,NULL',
            ],
        ];
        $validated = $request->validate($rules);

        try {
            $dataToSave = [
                'name' => $validated['name'],
            ];

            $torque = $isUpdate ? Torque::findOrFail($id) : null;

            if ($isUpdate) {
                $torque->update($dataToSave);
                $message = 'Torque updated successfully.';
                $type = 'edit';
            } else {
                $dataToSave['user_id'] = auth()->id();
                $torque = Torque::create($dataToSave);
                $message = 'Torque created successfully.';
                $type = 'add';
            }

            return response()->json([
                'success' => true,
                'message' => $message,
                'type' => $type,
                'data' => $torque,
            ]);
        } catch (\Exception $e) {
            Log::error('Torque save failed: '.$e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Failed to save Torque. Please try again.',
            ], 500);
        }
    }

    public function edit($id)
    {
        if (! auth()->user()->can('torque.edit')) {
            return response()->json([
                'success' => false,
                'message' => 'User does not have the right permissions.',
            ], 403);
        }

        try {
            $torqueId = decrypt($id);
            $torque = Torque::findOrFail($torqueId);

            return response()->json([
                'status' => true,
                'doc' => $torque,
            ]);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'status' => false,
                'message' => 'Torque not found.',
            ], 404);
        } catch (\Exception $e) {
            Log::error('Torque edit failed: '.$e->getMessage());

            return response()->json([
                'status' => false,
                'message' => 'Failed to retrieve Torque. Please try again.',
            ], 500);
        }
    }

    public function changeStatus(Request $request)
    {
        if (! auth()->user()->can('torque.status')) {
            return response()->json([
                'success' => false,
                'message' => 'User does not have the right permissions.',
            ], 403);
        }

        try {
            $torqueId = decrypt($request->input('id'));
            $newStatus = $request->input('status') === 'active' ? 'inactive' : 'active';
            $torque = Torque::findOrFail($torqueId);
            $torque->status = $newStatus;
            $torque->save();

            return response()->json([
                'message' => 'Torque status updated successfully.',
                'newStatus' => $newStatus,
                'icon' => $newStatus === 'active' ? 'fa-toggle-off' : 'fa-toggle-on',
                'title' => $newStatus === 'active' ? 'Make Inactive' : 'Make Active',
                'class' => $newStatus === 'active' ? 'text-danger' : 'text-success',
            ]);
        } catch (\Exception $e) {
            Log::error('Torque status update failed: '.$e->getMessage());

            return response()->json([
                'status' => false,
                'message' => 'Failed to update Torque status. Please try again.',
            ], 500);
        }
    }

    public function destroy($id)
    {
        if (! auth()->user()->can('torque.delete')) {
            return response()->json([
                'success' => false,
                'message' => 'User does not have the right permissions.',
            ], 403);
        }

        try {
            $torque = Torque::findOrFail(decrypt($id));
            $torque->delete();

            return response()->json([
                'message' => 'Torque deleted successfully.',
            ]);
        } catch (\Exception $e) {
            Log::error('Torque deletion failed: '.$e->getMessage());

            return response()->json([
                'status' => false,
                'message' => 'Failed to delete Torque. Please try again.',
            ], 500);
        }
    }
}
