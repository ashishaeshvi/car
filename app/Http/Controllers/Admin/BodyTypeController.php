<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BodyType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Storage;

class BodyTypeController extends Controller
{
    public function index(Request $request)
    {
        abort_if(! auth()->user()->can('body_type.view'), 403, 'User does not have the right permissions.');

        $data['title'] = 'Body Type List';
        $data['create_title'] = 'Body Type';

        $authId = auth()->id();
        $bodyTypes = BodyType::when(auth()->user()->role != 'admin', function ($query) use ($authId) {
            return $query->where('user_id', $authId);
        })->whereNull('deleted_at');

        if ($request->ajax()) {
            return DataTables::of($bodyTypes)
                ->addIndexColumn()
                ->editColumn('action', fn($bt) => $this->generateActionButtons($bt))
                ->editColumn('status', fn($bt) => ucfirst($bt->status))
                ->editColumn('created_at', fn($bt) => $bt->created_at->format('d F, Y'))
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.bodytype.list')->with($data);
    }

    private function generateActionButtons($bodyType)
    {
        $html = '';

        if (auth()->user()->can('body_type.edit')) {
            $html .= '<a href="javascript:void(0)" class="edit-bodyType" data-toggle="modal" data-target="#bodyTypeModal" data-id="'.encrypt($bodyType->id).'" title="Edit"><i class="fa fa-edit"></i></a> ';
        }

        if (auth()->user()->can('body_type.view')) {
            $html .= '<a href="javascript:void(0)" class="view-bodyType" data-toggle="modal" data-target="#viewBodyTypeModal" data-id="'.encrypt($bodyType->id).'" title="View"><i class="fa fa-eye"></i></a> ';
        }

        if (auth()->user()->can('body_type.status')) {
            $status = $bodyType->status;
            $id = encrypt($bodyType->id);
            $url = route('body-types.status');
            $title = $status === 'active' ? 'Make Inactive' : 'Make Active';
            $icon = $status === 'active' ? 'fa-toggle-off text-danger' : 'fa-toggle-on text-success';
            $tableid = 'bodyTypeTable';
            $html .= '<a href="javascript:void(0);" class="toggle-status" data-id="'.$id.'" data-status="'.$status.'" data-tableid="'.$tableid.'" data-url="'.$url.'" title="'.$title.'"><i class="fa fa-fw '.$icon.'"></i></a> ';
        }

        if (auth()->user()->can('body_type.delete')) {
            $id = encrypt($bodyType->id);
            $url = route('body-types.destroy', $id);
            $tableid = 'bodyTypeTable';
            $html .= '<button type="button" class="btn btn-danger btn-xs delete-record" data-id="'.$id.'" data-url="'.$url.'" data-tableid="'.$tableid.'" data-title="body type" title="Delete"><i class="fa fa-trash"></i></button>';
        }

        return $html;
    }

    public function store(Request $request)
    {
        $isUpdate = $request->filled('id');
        $id = $request->id;

        // Authorization
        if ($isUpdate && ! auth()->user()->can('body_type.edit')) {
            return response()->json(['success' => false, 'message' => 'No permission'], 403);
        }
        if (! $isUpdate && ! auth()->user()->can('body_type.create')) {
            return response()->json(['success' => false, 'message' => 'No permission'], 403);
        }

        // Validation
        $rules = [
            'name' => [
                'required', 'string', 'max:255',
                $isUpdate ? "unique:body_types,name,$id" : 'unique:body_types,name'
            ],
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:5120',
        ];

        $validated = $request->validate($rules);

        try {
            $dataToSave = ['name' => $validated['name']];
            $bodyType = $isUpdate ? BodyType::findOrFail($id) : null;

            if ($request->hasFile('image')) {
                $oldFile = $isUpdate ? $bodyType->image : null;
                $uploaded = uploadWebpImage($request->file('image'), 'body_type', false, $oldFile);

                if (!$uploaded) {
                    return response()->json(['success' => false, 'message' => 'Image upload failed'], 422);
                }

                $dataToSave['image'] = $uploaded;

                if ($isUpdate && $oldFile && Storage::disk('public')->exists($oldFile)) {
                    Storage::disk('public')->delete($oldFile);
                }
            }

            if ($isUpdate) {
                $bodyType->update($dataToSave);
                $message = 'Body type updated successfully.';
            } else {
                $dataToSave['user_id'] = auth()->id();
                $bodyType = BodyType::create($dataToSave);
                $message = 'Body type created successfully.';
            }

            return response()->json(['success' => true, 'message' => $message, 'data' => $bodyType]);

        } catch (\Exception $e) {
            Log::error('Body type save failed: '.$e->getMessage());
            return response()->json(['success' => false, 'message' => 'Failed to save.'], 500);
        }
    }

    public function edit($id)
    {
        abort_if(! auth()->user()->can('body_type.edit'), 403, 'No permission');

        try {
            $btId = decrypt($id);
            $bodyType = BodyType::findOrFail($btId);
            return response()->json(['status' => true, 'doc' => $bodyType]);
        } catch (\Exception $e) {
            Log::error('Body type edit failed: '.$e->getMessage());
            return response()->json(['status' => false, 'message' => 'Failed to retrieve.'], 500);
        }
    }

    public function changeStatus(Request $request)
    {
        abort_if(! auth()->user()->can('body_type.status'), 403, 'No permission');

        try {
            $btId = decrypt($request->id);
            $bodyType = BodyType::findOrFail($btId);
            $bodyType->status = $request->status === 'active' ? 'inactive' : 'active';
            $bodyType->save();

            return response()->json([
                'message' => 'Status updated successfully.',
                'newStatus' => $bodyType->status,
            ]);
        } catch (\Exception $e) {
            Log::error('Body type status update failed: '.$e->getMessage());
            return response()->json(['status' => false, 'message' => 'Failed to update status'], 500);
        }
    }

    public function destroy($id)
    {
        abort_if(! auth()->user()->can('body_type.delete'), 403, 'No permission');

        try {
            $bodyType = BodyType::findOrFail(decrypt($id));

            if ($bodyType->image) {
                deleteFiles($bodyType->image);
            }

            $bodyType->delete();

            return response()->json(['message' => 'Body type deleted successfully.']);
        } catch (\Exception $e) {
            Log::error('Body type deletion failed: '.$e->getMessage());
            return response()->json(['status' => false, 'message' => 'Failed to delete.'], 500);
        }
    }
}
