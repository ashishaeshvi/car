<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\DataTables;

class BannerController extends Controller
{
    public function index(Request $request)
    {
        abort_if(! auth()->user()->can('banner.view'), 403, 'User document does not have the right permissions.');

        $data['title'] = 'Banner List';
        $data['create_title'] = 'Banner';

        $authId = auth()->id();
        $banners = Banner::when(auth()->user()->role_id != 1, function ($query) use ($authId) {
            return $query->where('user_id', $authId);
        })
            ->whereNull('deleted_at');

        if ($request->ajax()) {
            return DataTables::of($banners)
                ->addIndexColumn()
                ->addColumn('bannerImg', function ($banner) {
                    return '<img src="'.displayImage($banner->bannerImg).'" width="40" height="40" class="" />';
                })
                ->editColumn('action', function ($banner) {
                    return $this->generateActionButtons($banner);
                })
                ->editColumn('status', function ($banner) {
                    return ucfirst($banner->status === 'active' ? 'active' : 'inactive'); // Assuming 1 for active, 0 for inactive
                })
                ->editColumn('created_at', fn ($row) => $row->created_at->format('d F, Y'))
                ->rawColumns(['action', 'bannerImg'])
                ->make(true);
        }

        return view('admin.banner.list')->with($data);
    }

    private function generateActionButtons($banner)
    {
        $html = '';

        if (auth()->user()->can('banner.status')) {
            $status = $banner->status;
            $id = encrypt($banner->id);
            $url = route('banner.status');
            $title = $status === 'active' ? 'Make Inactive' : 'Make Active';
            $icon = $status === 'active' ? 'fa-toggle-off text-danger' : 'fa-toggle-on text-success';
            $tableid = 'bannerTable';
            $html .= '<a href="javascript:void(0);" class="toggle-status"
                data-id="'.$id.'"
                data-status="'.$status.'"
                data-tableid="'.$tableid.'"
                data-url="'.$url.'"
                title="'.$title.'">
                <i class="fa fa-fw '.$icon.'"></i> 
                </a>';
        }
        if (auth()->user()->can('banner.delete')) {
            $id = encrypt($banner->id);
            $url = route('banner.destroy', $id);
            $tableid = 'bannerTable';

            $html .= '  <button type="button" class="btn btn-danger btn-xs delete-record" 
            data-id="'.$id.'" 
            data-url="'.$url.'" 
            data-tableid="'.$tableid.'" 
            data-title="banner" 
            title="Delete">
            <i class="fa fa-trash"></i>
          </button>';
        }

        return $html;
    }

    public function create()
    {
        abort_if(! auth()->user()->can('banner.create'), 403, 'User does not have the right permissions.');

        $title = 'Add Banner';

        return view('admin.banner.add', compact('title'));
    }

    /**
     * Store or update an Fe banner.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        if (! auth()->user()->can('banner.create')) {
            return response()->json([
                'success' => false,
                'message' => 'User does not have permission to create banners.',
            ], 403);
        }

        // Validation rules
        $rules = [
            'bannerImg' => 'required|image|mimes:jpg,jpeg,png|max:5120',
        ];

        $messages = [
            'bannerImg.max' => 'The image must not be greater than 5 MB.',
        ];

        $validated = $request->validate($rules, $messages);

        try {
            $dataToSave = [];

            // Handle image upload
            if ($request->hasFile('bannerImg')) {
                $uploaded = uploadWebpImage($request->file('bannerImg'), 'banner');

                if (! $uploaded) {
                    return response()->json([
                        'success' => false,
                        'message' => 'The banner image failed to upload.',
                    ], 422);
                }

                $dataToSave['bannerImg'] = $uploaded;
            }

            $dataToSave['user_id'] = auth()->id();

            // Store only (no update logic)
            $banner = Banner::create($dataToSave);

            return redirect()->route('banner.index')
                ->with('success', 'Banner added successfully.');

           
        } catch (\Exception $e) {
            Log::error('Banner save failed: '.$e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Failed to save banner. Please try again.',
            ], 500);
        }
    }

    public function changeStatus(Request $request)
    {

        if (! auth()->user()->can('banner.status')) {
            return response()->json([
                'success' => false,
                'message' => 'User does not have the right permissions.',
            ], 403);
        }

        try {

            $bannerId = decrypt($request->input('id'));
            $newStatus = $request->input('status') === 'active' ? 'inactive' : 'active';
            $banner = Banner::findOrFail($bannerId);
            $banner->status = $newStatus;
            $banner->save();

            return response()->json([
                'message' => 'Banner status updated successfully.',
                'newStatus' => $newStatus,
                'icon' => $newStatus === 'active' ? 'fa-toggle-off' : 'fa-toggle-on',
                'title' => $newStatus === 'active' ? 'Make Inactive' : 'Make Active',
                'class' => $newStatus === 'active' ? 'text-danger' : 'text-success',
            ]);
        } catch (\Exception $e) {

            Log::error('Banner status update failed: '.$e->getMessage());

            return response()->json([
                'status' => false,
                'message' => 'Failed to update banner status. Please try again.',
            ], 500);
        }
    }

    public function destroy($id)
    {
        if (! auth()->user()->can('banner.delete')) {
            return response()->json([
                'success' => false,
                'message' => 'User does not have the right permissions.',
            ], 403);
        }
        try {

            $banner = Banner::findOrFail(decrypt($id));

            if ($banner->bannerImg) {
                deleteFiles($banner->bannerImg);
            }

            $banner->delete();

            return response()->json([
                'message' => 'Banner deleted successfully.',

            ]);
        } catch (\Exception $e) {

            Log::error('Banner deletion failed: '.$e->getMessage());

            return response()->json([
                'status' => false,
                'message' => 'Failed to delete banner. Please try again.',
            ], 500);
        }
    }
}
