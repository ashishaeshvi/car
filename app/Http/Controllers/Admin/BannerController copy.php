<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Colour;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Storage;

class ColourController extends Controller
{
    public function index(Request $request)
    {
        abort_if(! auth()->user()->can('colour.view'), 403, 'User does not have the right permissions.');

        $data['title'] = 'Colours List';
        $data['create_title'] = 'Colours';

        $authId = auth()->id();
        $colours = Colour::when(auth()->user()->role_id != 1, function ($query) use ($authId) {
            return $query->where('user_id', $authId);
        })
            ->whereNull('deleted_at');

        if ($request->ajax()) {
            return DataTables::of($colours)
                ->addIndexColumn()
                ->editColumn('action', function ($colour) {
                    return $this->generateActionButtons($colour);
                })
                ->editColumn('status', function ($colour) {
                    return ucfirst($colour->status === 'active' ? 'active' : 'inactive');
                })
                ->editColumn('created_at', fn ($row) => $row->created_at->format('d F, Y'))
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.colour.list')->with($data);
    }

    private function generateActionButtons($colour)
    {
        $html = '';
        if (auth()->user()->can('colour.edit')) {
            $html .= '<a href="javascript:void(0)"  class="edit-colour"  
                data-toggle="modal" data-target="#colourModal"  
                data-id="'.encrypt($colour->id).'" title="Edit Detail"><i class="fa fa-edit"></i></a>   ';
        }

        if (auth()->user()->can('colour.view')) {
            $html .= '<a href="javascript:void(0)"  class="view-colour"   
                data-toggle="modal" data-target="#viewColourModal"  
                data-id="'.encrypt($colour->id).'" title="View"><i class="fa fa-eye"></i></a>   ';
        }

        if (auth()->user()->can('colour.status')) {
            $status = $colour->status;
            $id = encrypt($colour->id);
            $url = route('colour.status');
            $title = $status === 'active' ? 'Make Inactive' : 'Make Active';
            $icon = $status === 'active' ? 'fa-toggle-off text-danger' : 'fa-toggle-on text-success';
            $tableid = 'colourTable';

            $html .= '<a href="javascript:void(0);" class="toggle-status"
                data-id="'.$id.'"
                data-status="'.$status.'"
                data-tableid="'.$tableid.'"
                data-url="'.$url.'"
                title="'.$title.'">
                <i class="fa fa-fw '.$icon.'"></i> 
                </a>';
        }

        if (auth()->user()->can('colour.delete')) {
            $id = encrypt($colour->id);
            $url = route('colour.destroy', $id);
            $tableid = 'colourTable';

            $html .= '  <button type="button" class="btn btn-danger btn-xs delete-record" 
            data-id="'.$id.'" 
            data-url="'.$url.'" 
            data-tableid="'.$tableid.'" 
            data-title="colour" 
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

        // Authorization check
        if ($isUpdate && ! auth()->user()->can('colour.edit')) {
            return response()->json([
                'success' => false,
                'message' => 'User does not have the right permissions.',
            ], 403);
        }

        if (! $isUpdate && ! auth()->user()->can('colour.create')) {
            return response()->json([
                'success' => false,
                'message' => 'User does not have permission to create colours.',
            ], 403);
        }

        // Validation rules
        $rules = [
            'name' => [
                'required',
                'string',
                'max:255',
                $isUpdate
                    ? "unique:colours,name,$id"
                    : 'unique:colours,name',
            ],
        ];

        $validated = $request->validate($rules);

        try {
            $dataToSave = [
                'name' => $validated['name'],
            ];

            $colour = $isUpdate ? Colour::findOrFail($id) : null;

            if ($isUpdate) {
                $colour->update($dataToSave);
                $message = 'Colour updated successfully.';
                $type = 'edit';
            } else {
                $dataToSave['user_id'] = auth()->id();
                $colour = Colour::create($dataToSave);
                $message = 'Colour created successfully.';
                $type = 'add';
            }

            return response()->json([
                'success' => true,
                'message' => $message,
                'type' => $type,
                'data' => $colour,
            ]);
        } catch (\Exception $e) {
            Log::error('Colour save failed: '.$e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Failed to save colour. Please try again.',
            ], 500);
        }
    }

    public function edit($id)
    {
        if (! auth()->user()->can('colour.edit')) {
            return response()->json([
                'success' => false,
                'message' => 'User does not have the right permissions.',
            ], 403);
        }

        try {
            $colourId = decrypt($id);
            $colour = Colour::findOrFail($colourId);

            return response()->json([
                'status' => true,
                'doc' => $colour,
            ]);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'status' => false,
                'message' => 'Colour not found.',
            ], 404);
        } catch (\Exception $e) {
            Log::error('Colour edit failed: '.$e->getMessage());

            return response()->json([
                'status' => false,
                'message' => 'Failed to retrieve colour. Please try again.',
            ], 500);
        }
    }

    public function changeStatus(Request $request)
    {
        if (! auth()->user()->can('colour.status')) {
            return response()->json([
                'success' => false,
                'message' => 'User does not have the right permissions.',
            ], 403);
        }

        try {
            $colourId = decrypt($request->input('id'));
            $newStatus = $request->input('status') === 'active' ? 'inactive' : 'active';
            $colour = Colour::findOrFail($colourId);
            $colour->status = $newStatus;
            $colour->save();

            return response()->json([
                'message' => 'Colour status updated successfully.',
                'newStatus' => $newStatus,
                'icon' => $newStatus === 'active' ? 'fa-toggle-off' : 'fa-toggle-on',
                'title' => $newStatus === 'active' ? 'Make Inactive' : 'Make Active',
                'class' => $newStatus === 'active' ? 'text-danger' : 'text-success',
            ]);
        } catch (\Exception $e) {
            Log::error('Colour status update failed: '.$e->getMessage());

            return response()->json([
                'status' => false,
                'message' => 'Failed to update colour status. Please try again.',
            ], 500);
        }
    }

    public function destroy($id)
    {
        if (! auth()->user()->can('colour.delete')) {
            return response()->json([
                'success' => false,
                'message' => 'User does not have the right permissions.',
            ], 403);
        }
        try {
            $colour = Colour::findOrFail(decrypt($id));
            $colour->delete();

            return response()->json([
                'message' => 'Colour deleted successfully.',
            ]);
        } catch (\Exception $e) {
            Log::error('Colour deletion failed: '.$e->getMessage());

            return response()->json([
                'status' => false,
                'message' => 'Failed to delete colour. Please try again.',
            ], 500);
        }
    }
}
