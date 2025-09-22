<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Jenssegers\Agent\Agent;

class LoginController extends Controller
{
    protected $redirectTo = '/';

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function adminlogin(Request $request)
    {
        // Validate the request
        $credentials = $request->validate([
            'email' => 'required|email|exists:users,email|regex:/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/',
            'password' => 'required',
        ]);

        if (!Auth::attempt($credentials)) {
            return response()->json([
                'error' => 'invalid',
                'message' => 'Invalid email or password.',
            ]);
        }

        $user = Auth::user();

        // Device/Browser info
        $agent = new Agent();
        $agent->setUserAgent($request->userAgent());

        $browser  = $agent->browser();
        $version  = $agent->version($browser);
        $platform = $agent->platform();
        $device   = $agent->device() ?: 'Unknown Device';

        // 🔹 Log activity
        activity()
            ->causedBy($user)
            ->withProperties([
                'ip'       => $request->ip(),
                'browser'  => $browser . ' ' . $version,
                'platform' => $platform,
                'device'   => $device,
            ])
            ->event('login')
            ->log('User logged in');

        return match ($user->status) {
            'active' => response()->json([
                'success' => true,
                'message' => 'Login successful.',
            ]),
            'inactive' => $this->logoutWithError('deactivate', 'Your account is deactivated.'),
            'pending'  => $this->logoutWithError('pending', 'Your account is not verified.'),
            'trashed'  => $this->logoutWithError('trashed', 'Your account has been deleted.'),
            default => $this->logoutWithError('unknown', 'Unknown account status.'),
        };
    }

    protected function logoutWithError($error, $message)
    {
        Auth::logout();
        return response()->json([
            'error' => $error,
            'message' => $message,
        ]);
    }

    public function logout(Request $request)
    {
        $user = Auth::user();

        if ($user) {
            $agent = new Agent();
            $agent->setUserAgent($request->userAgent());

            $browser  = $agent->browser();
            $version  = $agent->version($browser);
            $platform = $agent->platform();
            $device   = $agent->device() ?: 'Unknown Device';

            activity()
                ->causedBy($user)
                ->withProperties([
                    'ip'       => $request->ip(),
                    'browser'  => $browser . ' ' . $version,
                    'platform' => $platform,
                    'device'   => $device,
                ])
                ->event('logout')
                ->log('User logged out');
        }

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }
}
