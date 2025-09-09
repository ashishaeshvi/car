<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\AllCity;
use App\Models\AllState;
use App\Models\Candidate;
use App\Models\FeDocument;
use App\Models\RaDocument;
use App\Models\UserPassport;

class AdminController extends Controller
{
    public function adminDashboard()
    {
        $authUser = auth()->user();
        $authId = $authUser->id;
        $userRole = $authUser->role_id;
        $isAdmin = $userRole === 1;

        // Common user-based filter closure
        $filterByUser = fn($query) => $query->where('user_id', $authId);
        $filterByAddedBy = fn($query) => $query->where('added_by', $authId);

        $data = [
            'staff_counts' => User::where('role_id', 2)
                ->when(!$isAdmin, $filterByAddedBy)
                ->whereNull('deleted_at')
                ->count(),

            'fe_stamp_counts' => FeDocument::where('type', 'stamp')
                ->whereNull('deleted_at')
                ->when(!$isAdmin, $filterByUser)
                ->count(),

            'fe_sign_counts' => FeDocument::where('type', 'sign')
                ->whereNull('deleted_at')
                ->when(!$isAdmin, $filterByUser)
                ->count(),

            'ra_counts' => RaDocument::whereNull('deleted_at')
                ->when(!$isAdmin, $filterByUser)
                ->count(),

            'document_upload_panel_counts' => UserPassport::whereNull('deleted_at')
                ->when(!$isAdmin, $filterByUser)
                ->count(),

            'offline_online_staff_counts' => Candidate::whereNull('deleted_at')
                ->when(!$isAdmin, $filterByUser)
                ->count(),

            'user_counts' => User::where('role_id', 3)
                ->whereNull('deleted_at')
                ->when(!$isAdmin, $filterByAddedBy)
                ->count(),
        ];

        return view('admin.dashboard.dashboard', $data);
    }

    public function ViewChangePassword()
    {
        abort_if(!auth()->user()->can('change-password.edit'), 403, __('User does not have the right permissions.'));
        $data['title'] = 'Change Password';
        return view('admin.change-password', $data);
    }

    public function changePassword(Request $request)
    {
        abort_if(!auth()->user()->can('change-password.edit'), 403, __('User does not have the right permissions.'));

        $validatedData = $request->validate([
            'old_password' => 'required|string',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = Auth::user();
        if (Hash::check($validatedData['old_password'], $user->password)) {
            // Update the password
            $user->password = Hash::make($validatedData['password']);
            $user->save();
            return redirect()->route('change-password')->with('success', __('Password updated successfully!'));
        } else {
            return redirect()->route('change-password')->with('error', __('The provided password does not match your current password.'));
        }
    }


    public function getStateDropdown($country_id)
    {
        $data = AllState::where('country_id', $country_id)->OrderBy('name', 'asc')->get();
        return response()->json(['data' => $data]);
    }

    public function getCityDropdown($state_id)
    {
        $data = AllCity::where('state_id', $state_id)->OrderBy('name', 'asc')->get();
        return response()->json(['data' => $data]);
    }
}
