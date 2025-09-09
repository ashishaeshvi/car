<?php

namespace App\Http\Controllers\Admin;

use DB;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use App\Models\User;
use Auth;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;

class UserController extends Controller
{

    public function index(Request $request)
    {
        abort_if(!auth()->user()->can('user.view'), 403, __('User does not have the right permissions.'));

        $data['title'] = 'User List';
        $data['create_title'] = 'User';

        $authUser = auth()->user();
        $authId   = $authUser->id;

        $data['roles'] = Role::where('id', '!=', 1)->get();
        // $data['roles'] = Role::get();

        $query = User::with(['role', 'createdBy'])
            ->when($authUser->role_id != 1, function ($query) use ($authId) {
                return $query->where('users.added_by', $authId);
            })
            ->where('users.role_id', '!=', 1)   // 👈 qualify table
            ->whereNull('users.deleted_at')
            ->select('users.*')
            ->leftJoin('users as creator', 'users.added_by', '=', 'creator.id')
            ->addSelect('creator.name as created_by_name');

        if ($request->ajax()) {
            return DataTables::of($query)
                ->addIndexColumn()

                ->addColumn('profile_image', function ($user) {
                    return '<img src="' . displayImage($user->profile_image) . '" width="40" height="40" class="rounded-circle" />';
                })
                ->editColumn('action', function ($user) {
                    return $this->generateActionButtons($user);
                })
                ->editColumn('status', function ($user) {
                    return ucfirst($user->status === 'active' ? 'active' : 'inactive');
                })
                ->editColumn('created_at', fn($row) => $row->created_at->format('d F, Y'))
                ->rawColumns(['action', 'profile_image'])
                ->make(true);
        }

        return view('admin.user.list')->with($data);
    }


    private function generateActionButtons($user)
    {
        $html = "";
        if (auth()->user()->can('user.edit')) {
            $html .= '<a href="javascript:void(0)"  class="edit-user"  data-id="' . encrypt($user->id) . '" title="Edit Detail"><i class="fa fa-edit"></i></a>   ';
        }

        if (auth()->user()->can('user.status')) {
            $status = $user->status;
            $id = encrypt($user->id);
            $url = route('user.status');
            $title = $status === 'active' ? 'Make Inactive' : 'Make Active';
            $icon = $status === 'active' ? 'fa-user-slash text-danger' : 'fa-user-check text-success';
            $tableid = 'user-table';
            $html .= '<a href="javascript:void(0);" class="toggle-status"
                data-id="' . $id . '"
                data-status="' . $status . '"
                data-tableid="' . $tableid . '"
                data-url="' . $url . '"
                title="' . $title . '">
                <i class="fa fa-fw ' . $icon . '"></i> 
                </a>';
        }


        if (auth()->user()->can('user.delete')) {
            $id = encrypt($user->id);
            $url = route('user.destroy', $id);
            $tableid = 'user-table';

            $html .= '  <button type="button" class="btn btn-danger btn-xs delete-record" 
            data-id="' . $id . '" 
            data-url="' . $url . '" 
            data-tableid="' . $tableid . '" 
            data-title="User" 
            title="Delete">
            <i class="fa fa-trash"></i>
          </button>';
        }

        if (auth()->user()->can('user.show-profile')) {

            $html .= '  <a href="' .  route('user-profile.show', encrypt($user->id))  . '" title="View Profile" class="btn btn-xs btn-primary"><i class="fa fa-eye"></i></a>';
        }
        return $html;
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        if (!auth()->user()->can('user.create')) {
            return response()->json([
                'success' => false,
                'message' => __('User does not have the right permissions.')
            ], 500);
        }

        $messages = [
            'id_proof.max'        => 'The ID proof must not be greater than 5 MB.',
            'profile_image.max'   => 'The profile image must not be greater than 5 MB.',
            'id_proof.mimes'      => 'The ID proof must be a file of type: jpg, jpeg, png.',
            'profile_image.mimes' => 'The profile image must be a file of type: jpg, jpeg, png.',
        ];

        $validatedData = $request->validate([
            'name'            => 'required|string|max:255',
            'email' => 'required|email|regex:/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/|unique:users,email,NULL,id,deleted_at,NULL',
            'password'        => 'required|string|min:8',
            'role_id'         => 'required|integer|exists:roles,id',
            'mobile'          => 'nullable|string|max:15',
            'address'         => 'nullable|string',
            'id_proof'        => 'nullable|file|mimes:jpg,jpeg,png|max:5120',
            'profile_image'   => 'nullable|file|mimes:jpg,jpeg,png|max:5120',
        ], $messages);


        try {

            $validatedData['password'] = bcrypt($validatedData['password']);
            $validatedData['added_by'] = Auth::id();

            if ($request->hasFile('id_proof')) {
                $uploadedFileName = uploadFiles($request, 'id_proof', 'user_docs');
                $validatedData['id_proof'] = $uploadedFileName;
            }

            if ($request->hasFile('profile_image')) {
                $uploadedFileName = uploadFiles($request, 'profile_image', 'user_docs');
                $validatedData['profile_image'] = $uploadedFileName;
            }

            $user =  User::create($validatedData);
            $user->assignRole(Role::findById($validatedData['role_id']));



            return response()->json([
                'success' => true,
                'message' => __('User created successfully.'),
            ]);
        } catch (\Exception $e) {

            Log::error('User creation failed: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => __('Failed to create user. Please try again.')
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


        if (!auth()->user()->can('user.edit')) {
            return response()->json([
                'success' => false,
                'message' => __('User does not have the right permissions.')
            ], 403);
        }

        try {
            $userId = decrypt($id);
            $user = User::findOrFail($userId);

            return response()->json([
                'status' => true,
                'user' => $user,
            ]);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'status' => false,
                'message' => __('User not found.')
            ], 404);
        } catch (\Exception $e) {
            \Log::error('User edit failed: ' . $e->getMessage());

            return response()->json([
                'status' => false,
                'message' => __('Failed to retrieve user. Please try again.')
            ], 500);
        }
    }



    public function editProfile()
    {

        $userId = auth()->id();

        if (!auth()->user()->can('user.edit')) {
            return response()->json([
                'success' => false,
                'message' => __('User does not have the right permissions.')
            ], 403);
        }

        try {

            $user = User::findOrFail($userId);
            $data['title'] = 'Edit Profile';
            $data['roles'] = Role::where('id', '!=', 1)->get();
            // $data['roles'] = Role::get();


            return view('admin.user.edit-profile', compact('user', 'data'));
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'status' => false,
                'message' => __('User not found.')
            ], 404);
        } catch (\Exception $e) {
            Log::error('User edit failed: ' . $e->getMessage());

            return response()->json([
                'status' => false,
                'message' => __('Failed to retrieve user. Please try again.')
            ], 500);
        }
    }



    public function show($id)
    {
        abort_if(!auth()->user()->can('user.show-profile'), 403, __('User does not have the right permissions.'));

        try {
            $userId = decrypt($id);
            $user = User::with('roles')->findOrFail($userId);
            $data = [
                'title' => __('Profile'),
                'create_title' => __('Profile'),
            ];
            return view('admin.user.profile', compact('user', 'data')); // Pass the user to the view
        } catch (\Exception $e) {

            Log::error('User profile retrieval failed: ' . $e->getMessage());
            return back()->with('error', __('Failed to retrieve user profile. Please try again.'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        if (!auth()->user()->can('user.edit')) {
            return response()->json([
                'success' => false,
                'message' => __('User does not have the right permissions.')
            ], 403);
        }

        $user = User::findOrFail($id);

        $messages = [
            'id_proof.max'        => 'The ID proof must not be greater than 5 MB.',
            'profile_image.max'   => 'The profile image must not be greater than 5 MB.',
            'id_proof.mimes'      => 'The ID proof must be a file of type: jpg, jpeg, png.',
            'profile_image.mimes' => 'The profile image must be a file of type: jpg, jpeg, png.',
        ];

        $validatedData = $request->validate([
            'name'            => 'required|string|max:255',
            'email' => 'required|email|regex:/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/|unique:users,email,' . $user->id . ',id,deleted_at,NULL',
            'mobile'          => 'nullable|string|max:15',
            'password'          => 'nullable|string',
            'address'         => 'nullable|string',
            'id_proof'        => 'nullable|file|mimes:jpg,jpeg,png|max:5120',
            'profile_image'   => 'nullable|file|mimes:jpg,jpeg,png|max:5120',
        ], $messages);

        try {

            if ($request->filled('password')) {
                $validatedData['password'] = bcrypt($validatedData['password']);
            } else {
                unset($validatedData['password']);
            }


            if ($request->hasFile('id_proof')) {
                $uploadedFileName = uploadFiles($request, 'id_proof', 'user_docs');
                $validatedData['id_proof'] = $uploadedFileName;
                if (!empty($user->id_proof)) {
                    deleteFiles($user->id_proof);
                }
            }

            if ($request->hasFile('profile_image')) {
                $uploadedFileName = uploadFiles($request, 'profile_image', 'user_docs');
                $validatedData['profile_image'] = $uploadedFileName;
                if (!empty($user->profile_image)) {
                    deleteFiles($user->profile_image);
                }
            }

            $user->update($validatedData);


            return response()->json([
                'success' => true,
                'message' => __('User updated successfully.'),
            ]);
        } catch (\Exception $e) {

            Log::error('User update failed: ' . $e->getMessage());
            return response()->json([
                'status' => false,
                'message' => __('Failed to retrieve user. Please try again.')
            ], 500);
        }
    }



    public function changeStatus(Request $request)
    {
        if (!auth()->user()->can('user.status')) {
            return response()->json([
                'success' => false,
                'message' => __('User does not have the right permissions.')
            ], 403);
        }

        try {
            $userId = decrypt($request->input('id'));
            $newStatus = $request->input('status') === 'active' ? 'inactive' : 'active';

            $user = User::findOrFail($userId);
            $user->status = $newStatus;
            $user->save();

            return response()->json([
                'message' => 'User status updated successfully.',
                'newStatus' => $newStatus,
                'icon' => $newStatus === 'active' ? 'fa-user-slash' : 'fa-user-check',
                'title' => $newStatus === 'active' ? 'Make Inactive' : 'Make Active',
                'class' => $newStatus === 'active' ? 'text-danger' : 'text-success',
            ]);
        } catch (\Exception $e) {
            \Log::error('User status update failed: ' . $e->getMessage());

            return response()->json([
                'status' => false,
                'message' => __('Failed to update user status. Please try again.')
            ], 500);
        }
    }


    public function destroy($id)
    {

        if (!auth()->user()->can('user.delete')) {
            return response()->json([
                'success' => false,
                'message' => __('User does not have the right permissions.')
            ], 403);
        }

        try {

            DB::beginTransaction();
            $user = User::findOrFail(decrypt($id));
            $deleted = $user->delete();

            if ($deleted) {
                deleteFiles($user->id_proof);
                deleteFiles($user->profile_image);
            }

            DB::commit();
            return response()->json([
                'message' => 'User deleted successfully.',

            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('User deletion failed: ' . $e->getMessage());
            return response()->json([
                'status' => false,
                'message' => __('Failed to delete user. Please try again.')
            ], 500);
        }
    }
}
