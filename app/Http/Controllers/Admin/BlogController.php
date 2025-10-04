<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\Request;
use DB;

class BlogController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        // Permission check
        abort_if(! auth()->user()->can('blogs.view'), 403, __('User does not have the right permissions.'));

        $data['title'] = 'Blogs List';
        $data['create_title'] = 'Add Blog';

        $authUser = auth()->user();
        $authId = $authUser->id;

        // Base query for blogs
        $query = Blog::when($authUser->role_id != 1, function ($query) use ($authId) {
            $query->where('added_by', $authId);
        })
            ->select('blogs.*'); // ✅ correct table name

        if ($request->ajax()) {
            return \DataTables::eloquent($query)
                ->addIndexColumn()
                ->filter(function ($query) use ($request) {
                    if ($request->has('search') && $search = $request->input('search.value')) {
                        $search = strtolower($search);
                        $query->where(function ($q) use ($search) {
                            $q->whereRaw('LOWER(blogs.blog_title) LIKE ?', ["%{$search}%"])   // ✅ corrected
                                ->orWhereRaw('LOWER(blogs.blog_description) LIKE ?', ["%{$search}%"]); // ✅ corrected
                        });
                    }
                })
                ->editColumn('created_at', fn($row) => $row->created_at->format('d M, Y'))
                ->addColumn('action', fn($row) => $this->generateActionButtons($row))
                ->rawColumns(['action'])
                ->toJson();
        }

        return view('admin.blog.list')->with($data);
    }

    private function generateActionButtons($blog)
    {
        $html = '';
        if (auth()->user()->can('blogs.edit')) {
            $html .= '<a href="' . route('blog.edit', encrypt($blog->id)) . '" title="Edit"><i class="fa fa-edit"></i></a> ';
        }

        if (auth()->user()->can('blogs.status')) {
            $status = $blog->status;
            $id = encrypt($blog->id);
            $url = route('blog.status');
            $title = $status === 'active' ? 'Make Inactive' : 'Make Active';
            $icon = $status === 'active' ? 'fa-toggle-off text-danger' : 'fa-toggle-on text-success';
            $tableid = 'blogs-table';
            $html .= '<a href="javascript:void(0);" class="toggle-status"
            data-id="' . $id . '"
            data-status="' . $status . '"
            data-tableid="' . $tableid . '"
            data-url="' . $url . '"
            title="' . $title . '">
            <i class="fa fa-fw ' . $icon . '"></i> 
            </a>';
        }

        if (auth()->user()->can('blogs.delete')) {
            $id = encrypt($blog->id);
            $url = route('blog.destroy', $id);
            $tableid = 'blogs-table';

            $html .= '<button type="button" class="btn btn-danger btn-xs delete-record"
            data-id="' . $id . '"
            data-url="' . $url . '"
            data-tableid="' . $tableid . '"
            data-title="blog"
            title="Delete">
            <i class="fa fa-trash"></i>
        </button>';
        }

        return $html;
    }

    public function create()
    {
        abort_if(! auth()->user()->can('blogs.create'), 403, __('User does not have the right permissions.'));
        $title = 'Add Blog';

        return view('admin.blog.add', compact('title'));
    }

    public function seolink(Request $request)
    {

        $string = trim($request->seolink);
        $string = str_replace('--', '-', $string); // Replaces all spaces with hyphens.
        $seolink_val = strtolower($string);

        return trim($seolink_val);
    }

    public function store(Request $request)
    {
        // Validate incoming request
        $validated = $request->validate([
            'blog_title' => 'required|string|max:255',
            'slug_uri' => 'required|string|max:255|unique:blogs,slug_uri',
            'short_description' => 'required|string',
            'description' => 'required|string',
            'meta_title' => 'nullable|string|max:255',
            'meta_keyword' => 'nullable|string|max:255',
            'meta_description' => 'nullable',
            'blog_img'      => 'nullable|image|mimes:jpg,jpeg,png|max:2048', // optional
        ]);

        // Prepare data
        $data = [
            'blog_title' => $validated['blog_title'],
            'short_description' => $validated['short_description'],
            'slug_uri' => $validated['slug_uri'],
            'blog_description' => $validated['description'],
            'meta_title' => $validated['meta_title'] ?? null,
            'meta_keyword' => $validated['meta_keyword'] ?? null,
            'meta_description' => $validated['meta_description'] ?? null,
            'created_at' => now(),
            'updated_at' => now(),
            // Optional: track who added the blog
        ];

        if ($request->hasFile('blog_img')) {


            $data['blog_img'] = uploadWebpImage($request->file('blog_img'), 'blog', false, $request->blog_img);
        }


        if ($request->hasFile('blog_thumbnail_img')) {


            $data['blog_thumbnail_img'] = uploadWebpImage($request->file('blog_thumbnail_img'), 'blog', false, $request->blog_thumbnail_img);
        }

        $page_id = Blog::insertGetId($data);

        return redirect()->route('blog.index')->with('success', 'New post added successfully!');
    }

    public function edit($id)
    {
        abort_if(! auth()->user()->can('blogs.edit'), 403, __('User does not have the right permissions.'));

        try {
            $title = 'Edit Blog';
            $carId = decrypt($id);

            $blogArr = Blog::findOrFail($carId);

            return view('admin.blog.edit', compact('blogArr', 'title'));
        } catch (\Exception $e) {
            Log::error('Car edit failed', ['message' => $e->getMessage()]);

            return redirect()->route('blog.index')->with('error', __('Failed to retrieve car for editing.'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Validate incoming request
        $validated = $request->validate([
            'blog_title'        => 'required|string|max:255',
             'short_description' => 'required|string',
            'slug_uri'          => "required|string|max:255|unique:blogs,slug_uri,$id",
            'description'       => 'required|string',
            'meta_title'        => 'nullable|string|max:255',
            'meta_keyword'      => 'nullable|string|max:255',
            'meta_description'  => 'nullable',
            'upload_image'      => 'nullable|image|mimes:jpg,jpeg,png|max:2048', // optional
        ]);

        try {
            $blog = Blog::findOrFail($id);

            // Prepare data
            $data = [
                'blog_title'        => $validated['blog_title'],
                'short_description'        => $validated['short_description'],
                'slug_uri'          => $validated['slug_uri'],
                'blog_description'  => $validated['description'],
                'meta_title'        => $validated['meta_title'] ?? null,
                'meta_keyword'      => $validated['meta_keyword'] ?? null,
                'meta_description'  => $validated['meta_description'] ?? null,
                'updated_at'        => now(),
            ];
            // Handle image upload



            if ($request->hasFile('blog_img')) {

                if ($blog->blog_img) {
                    deleteFiles($blog->blog_img);
                }
                $data['blog_img'] = uploadWebpImage($request->file('blog_img'), 'blog', false, $blog->blog_img);
            }


            if ($request->hasFile('blog_thumbnail_img')) {

                if ($blog->blog_thumbnail_img) {
                    deleteFiles($blog->blog_thumbnail_img);
                }
                $data['blog_thumbnail_img'] = uploadWebpImage($request->file('blog_thumbnail_img'), 'blog', false, $blog->blog_thumbnail_img);
            }




            // Update blog
            $blog->update($data);

            return redirect('blog')->with('message', 'Post Updated Successfully.');
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->back()->with('error', 'Something went wrong: ' . $e->getMessage());
        }
    }


    public function changeStatus(Request $request)
    {

        if (! auth()->user()->can('blogs.status')) {
            return response()->json([
                'success' => false,
                'message' => __('User does not have the right permissions.'),
            ], 403);
        }

        try {

            $blogId = decrypt($request->input('id'));
            $newStatus = $request->input('status') === 'active' ? 'inactive' : 'active';
            $blog = Blog::findOrFail($blogId);
            $blog->status = $newStatus;
            $blog->save();

            return response()->json([
                'message' => 'Blog status updated successfully.',
                'newStatus' => $newStatus,
                'icon' => $newStatus === 'active' ? 'fa-toggle-off' : 'fa-toggle-on',
                'title' => $newStatus === 'active' ? 'Make Inactive' : 'Make Active',
                'class' => $newStatus === 'active' ? 'text-danger' : 'text-success',
            ]);
        } catch (\Exception $e) {

            Log::error('Blog status update failed: ' . $e->getMessage());

            return response()->json([
                'status' => false,
                'message' => __('Failed to update blog status. Please try again.'),
            ], 500);
        }
    }

    public function destroy($id)
    {
        abort_if(! auth()->user()->can('blogs.delete'), 403, __('User does not have the right permissions.'));

        try {
            DB::beginTransaction();
            $blog = Blog::findOrFail(decrypt($id));
            $blog->delete();

            if ($blog->blog_img) {
                deleteFiles($blog->blog_img);
            }
            if ($blog->blog_thumbnail_img) {
                deleteFiles($blog->blog_thumbnail_img);
            }


            DB::commit();

            return response()->json(['message' => 'Blog detail deleted successfully.']);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Blog deletion failed: ' . $e->getMessage());

            return response()->json([
                'status' => false,
                'message' => 'Failed to delete blog. Please try again.',
            ], 500);
        }
    }
}
