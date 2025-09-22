<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Storage;
class BrandController extends Controller
{
    public function index(Request $request)
    {
        abort_if(! auth()->user()->can('brand.view'), 403, 'User document does not have the right permissions.');

        $data['title'] = 'Brands List';
        $data['create_title'] = 'Brands';

        $authId = auth()->id();
        $brands = Brand::when(auth()->user()->role_id != 1, function ($query) use ($authId) {
            return $query->where('user_id', $authId);
        })
            ->whereNull('deleted_at');

        if ($request->ajax()) {
            return DataTables::of($brands)
                ->addIndexColumn()

                ->editColumn('action', function ($brand) {
                    return $this->generateActionButtons($brand);
                })
                ->editColumn('status', function ($brand) {
                    return ucfirst($brand->status === 'active' ? 'active' : 'inactive'); // Assuming 1 for active, 0 for inactive
                })
                ->editColumn('created_at', fn ($row) => $row->created_at->format('d F, Y'))
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.brand.list')->with($data);
    }

    private function generateActionButtons($brand)
    {
        $html = '';
        if (auth()->user()->can('brand.edit')) {
            $html .= '<a href="javascript:void(0)"  class="edit-brand"  data-toggle="modal" data-target="#brandModal"  data-id="'.encrypt($brand->id).'" title="Edit Detail"><i class="fa fa-edit"></i></a>   ';
        }

        if (auth()->user()->can('brand.view')) {
            $html .= '<a href="javascript:void(0)"  class="view-brand"   data-toggle="modal" data-target="#viewBrandModal"  data-id="'.encrypt($brand->id).'" title="View"><i class="fa fa-eye"></i></a>   ';
        }

        if (auth()->user()->can('brand.status')) {
            $status = $brand->status;
            $id = encrypt($brand->id);
            $url = route('brand.status');
            $title = $status === 'active' ? 'Make Inactive' : 'Make Active';
            $icon = $status === 'active' ? 'fa-toggle-off text-danger' : 'fa-toggle-on text-success';
            $tableid = 'brandTable';
            $html .= '<a href="javascript:void(0);" class="toggle-status"
                data-id="'.$id.'"
                data-status="'.$status.'"
                data-tableid="'.$tableid.'"
                data-url="'.$url.'"
                title="'.$title.'">
                <i class="fa fa-fw '.$icon.'"></i> 
                </a>';
        }
        if (auth()->user()->can('brand.delete')) {
            $id = encrypt($brand->id);
            $url = route('brand.destroy', $id);
            $tableid = 'brandTable';

            $html .= '  <button type="button" class="btn btn-danger btn-xs delete-record" 
            data-id="'.$id.'" 
            data-url="'.$url.'" 
            data-tableid="'.$tableid.'" 
            data-title="brand" 
            title="Delete">
            <i class="fa fa-trash"></i>
          </button>';
        }

        return $html;
    }

    /**
     * Store or update an Fe brand.
     *
     * @return \Illuminate\Http\JsonResponse
     */
   public function store(Request $request)
{
    $isUpdate = $request->filled('id');
    $id = $request->id;

    // Authorization check
    if ($isUpdate && ! auth()->user()->can('brand.edit')) {
        return response()->json([
            'success' => false,
            'message' => 'User does not have the right permissions.',
        ], 403);
    }

    if (! $isUpdate && ! auth()->user()->can('brand.create')) {
        return response()->json([
            'success' => false,
            'message' => 'User does not have permission to create brands.',
        ], 403);
    }

    // Validation rules
    $rules = [
        'name' => [
            'required',
            'string',
            'max:255',
            $isUpdate
                ? "unique:brands,name,$id"
                : 'unique:brands,name',
        ],
        'brandImg' => 'nullable|image|mimes:jpg,jpeg,png|max:5120',
    ];

    $messages = [
        'brandImg.max' => 'The image must not be greater than 5 MB.',
    ];

    $validated = $request->validate($rules, $messages);

    try {
        $dataToSave = [
            'name' => $validated['name'],
        ];

        $brand = $isUpdate ? Brand::findOrFail($id) : null;

        // Handle image upload
        if ($request->hasFile('brandImg')) {
            $oldFile = $isUpdate ? $brand->brandImg : null;
            $uploaded = uploadWebpImage($request->file('brandImg'), 'brand', false, $oldFile);

            if (!$uploaded) {
                return response()->json([
                    'success' => false,
                    'message' => 'The brand image failed to upload.',
                ], 422);
            }

            $dataToSave['brandImg'] = $uploaded;

            // Delete old image only if it's an update and a new image was uploaded
            if ($isUpdate && $oldFile && Storage::disk('public')->exists($oldFile)) {
                Storage::disk('public')->delete($oldFile);
            }
        }

        if ($isUpdate) {
            $brand->update($dataToSave);
            $message = 'Brand updated successfully.';
            $type = 'edit';
        } else {
            $dataToSave['user_id'] = auth()->id();
            $brand = Brand::create($dataToSave);
            $message = 'Brand created successfully.';
            $type = 'add';
        }

        return response()->json([
            'success' => true,
            'message' => $message,
            'type' => $type,
            'data' => $brand,
        ]);
    } catch (\Exception $e) {
        Log::error('Brand save failed: '.$e->getMessage());

        return response()->json([
            'success' => false,
            'message' => 'Failed to save brand. Please try again.',
        ], 500);
    }
}


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! auth()->user()->can('brand.edit')) {
            return response()->json([
                'success' => false,
                'message' => 'User does not have the right permissions.',
            ], 403);
        }

        try {
            $brandId = decrypt($id);
            $brand = Brand::findOrFail($brandId);

            return response()->json([
                'status' => true,
                'doc' => $brand,
            ]);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'status' => false,
                'message' => 'Brand not found.',
            ], 404);
        } catch (\Exception $e) {
            \Log::error('Brand edit failed: '.$e->getMessage());

            return response()->json([
                'status' => false,
                'message' => 'Failed to retrieve brand. Please try again.',
            ], 500);
        }
    }

    public function changeStatus(Request $request)
    {

        if (! auth()->user()->can('brand.status')) {
            return response()->json([
                'success' => false,
                'message' => 'User does not have the right permissions.',
            ], 403);
        }

        try {

            $brandId = decrypt($request->input('id'));
            $newStatus = $request->input('status') === 'active' ? 'inactive' : 'active';
            $brand = Brand::findOrFail($brandId);
            $brand->status = $newStatus;
            $brand->save();

            return response()->json([
                'message' => 'Brand status updated successfully.',
                'newStatus' => $newStatus,
                'icon' => $newStatus === 'active' ? 'fa-toggle-off' : 'fa-toggle-on',
                'title' => $newStatus === 'active' ? 'Make Inactive' : 'Make Active',
                'class' => $newStatus === 'active' ? 'text-danger' : 'text-success',
            ]);
        } catch (\Exception $e) {

            Log::error('Brand status update failed: '.$e->getMessage());

            return response()->json([
                'status' => false,
                'message' => 'Failed to update brand status. Please try again.',
            ], 500);
        }
    }

    public function destroy($id)
    {
        if (! auth()->user()->can('brand.delete')) {
            return response()->json([
                'success' => false,
                'message' => 'User does not have the right permissions.',
            ], 403);
        }
        try {

            $brand = Brand::findOrFail(decrypt($id));

            if ($brand->brandImg) {
                deleteFiles($brand->brandImg);
            }

            $brand->delete();

            return response()->json([
                'message' => 'Brand deleted successfully.',

            ]);
        } catch (\Exception $e) {

            Log::error('Brand deletion failed: '.$e->getMessage());

            return response()->json([
                'status' => false,
                'message' => 'Failed to delete brand. Please try again.',
            ], 500);
        }
    }
}
