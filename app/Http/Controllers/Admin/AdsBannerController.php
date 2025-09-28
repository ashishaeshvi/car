<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdsBanner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\DataTables;

class AdsBannerController extends Controller
{
    public function index(Request $request)
    {
        abort_if(! auth()->user()->can('adsbanner.view'), 403, 'User document does not have the right permissions.');

        $data['title'] = 'Ads Banner List';
        $data['create_title'] = 'Ads Banner';

        $authId = auth()->id();
        $banners = AdsBanner::when(auth()->user()->role_id != 1, function ($query) use ($authId) {
            return $query->where('user_id', $authId);
        })
            ->whereNull('deleted_at');

        if ($request->ajax()) {
            return DataTables::of($banners)
                ->addIndexColumn()
                ->addColumn('adsImg', function ($banner) {
                    return '<img src="' . displayImage($banner->adsImg) . '" width="40" height="40" class="" />';
                })
                ->editColumn('action', function ($banner) {
                    return $this->generateActionButtons($banner);
                })
                ->editColumn('status', function ($banner) {
                    return ucfirst($banner->status === 'active' ? 'active' : 'inactive'); // Assuming 1 for active, 0 for inactive
                })
                ->editColumn('created_at', fn($row) => $row->created_at->format('d F, Y'))
                ->rawColumns(['action', 'adsImg'])
                ->make(true);
        }

        return view('admin.adsbanner.list')->with($data);
    }

    private function generateActionButtons($banner)
    {
        $html = '';

        if (auth()->user()->can('adsbanner.status')) {
            $status = $banner->status;
            $id = encrypt($banner->id);
            $url = route('adsbanner.status');
            $title = $status === 'active' ? 'Make Inactive' : 'Make Active';
            $icon = $status === 'active' ? 'fa-toggle-off text-danger' : 'fa-toggle-on text-success';
            $tableid = 'adsbannerTable';
            $html .= '<a href="javascript:void(0);" class="toggle-status"
                data-id="' . $id . '"
                data-status="' . $status . '"
                data-tableid="' . $tableid . '"
                data-url="' . $url . '"
                title="' . $title . '">
                <i class="fa fa-fw ' . $icon . '"></i> 
                </a>';
        }
        if (auth()->user()->can('adsbanner.delete')) {
            $id = encrypt($banner->id);
            $url = route('adsbanner.destroy', $id);
            $tableid = 'adsbannerTable';

            $html .= '  <button type="button" class="btn btn-danger btn-xs delete-record" 
            data-id="' . $id . '" 
            data-url="' . $url . '" 
            data-tableid="' . $tableid . '" 
            data-title="banner" 
            title="Delete">
            <i class="fa fa-trash"></i>
          </button>';
        }

        return $html;
    }

    public function create()
    {
        abort_if(! auth()->user()->can('adsbanner.create'), 403, 'User does not have the right permissions.');

        $title = 'Ads Banner';

        return view('admin.adsbanner.add', compact('title'));
    }

    /**
     * Store or update an Fe adsbanner.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        // Permission check
        if (! auth()->user()->can('adsbanner.create')) {
            return response()->json([
                'success' => false,
                'message' => 'User does not have permission to create banners.',
            ], 403);
        }

        // Validation rules
        $rules = [
            'position' => 'required|string|max:255',
            'adsImg' => 'required|image|mimes:jpg,jpeg,png|max:5120', // max 5MB
        ];

        $messages = [
            'adsImg.max' => 'The image must not be greater than 5 MB.',
        ];

        $validated = $request->validate($rules, $messages);

        try {
            $dataToSave = [];

            // Handle image upload
            if ($request->hasFile('adsImg')) {
                $uploaded = uploadWebpImage($request->file('adsImg'), 'adsImg');

                if (! $uploaded) {
                    return response()->json([
                        'success' => false,
                        'message' => 'The image failed to upload.',
                    ], 422);
                }

                $dataToSave['adsImg'] = $uploaded;
            }

            // Save position and user_id
            $dataToSave['position'] = $request->position;
            $dataToSave['user_id'] = auth()->id();

            // Store the banner
            $banner = AdsBanner::create($dataToSave);

            return redirect()->route('adsbanner.index')
                ->with('success', 'Banner added successfully.');
        } catch (\Exception $e) {
            Log::error('Banner save failed: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Failed to save Ads banner. Please try again.',
            ], 500);
        }
    }


    public function changeStatus(Request $request)
    {

        if (! auth()->user()->can('adsbanner.status')) {
            return response()->json([
                'success' => false,
                'message' => 'User does not have the right permissions.',
            ], 403);
        }

        try {

            $bannerId = decrypt($request->input('id'));
            $newStatus = $request->input('status') === 'active' ? 'inactive' : 'active';
            $banner = AdsBanner::findOrFail($bannerId);
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

            Log::error('Banner status update failed: ' . $e->getMessage());

            return response()->json([
                'status' => false,
                'message' => 'Failed to update banner status. Please try again.',
            ], 500);
        }
    }

    public function destroy($id)
    {
        if (! auth()->user()->can('adsbanner.delete')) {
            return response()->json([
                'success' => false,
                'message' => 'User does not have the right permissions.',
            ], 403);
        }
        try {

            $banner = AdsBanner::findOrFail(decrypt($id));

            if ($banner->adsImg) {
                deleteFiles($banner->adsImg);
            }

            $banner->delete();

            return response()->json([
                'message' => 'Banner deleted successfully.',

            ]);
        } catch (\Exception $e) {

            Log::error('Banner deletion failed: ' . $e->getMessage());

            return response()->json([
                'status' => false,
                'message' => 'Failed to delete ads banner. Please try again.',
            ], 500);
        }
    }
}
