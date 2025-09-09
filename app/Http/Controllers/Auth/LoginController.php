<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use function activity;
use Jenssegers\Agent\Agent;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Create a new controller instance.
     *
     * @return RedirectResponse
     */

    public function adminlogin(Request $request)
    {
        // Validate the request
        $credentials = $request->validate([
            'email' => 'required|email|exists:users,email|regex:/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/',           
            'password' => 'required',
        ]);

        // Attempt authentication
        if (!Auth::attempt($credentials)) {
            return response()->json([
                'error' => 'invalid',
                'message' => 'Invalid email or password.',
            ]);
        }

        $user = Auth::user();

        $agent = new Agent();
        $agent->setUserAgent($request->userAgent());

        $browser  = $agent->browser();                     // Chrome
        $version  = $agent->version($browser);             // 139
        $platform = $agent->platform();                    // Android
        $device   = $agent->device() ?: 'Unknown Device';  // Mobile model or "Unknown"

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

    // Helper method for consistent logout + error response
    protected function logoutWithError($error, $message)
    {
        Auth::logout();
        return response()->json([
            'error' => $error,
            'message' => $message,
        ]);
    }

    protected function logout(Request $request)
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
        
        $this->guard()->logout();
        $request->session()->flush();
        $request->session()->regenerate();
        return redirect()->route('login');
    }

    public function showLoginForm()
    {
        return view('auth.login'); // Create this Blade file
    }
}
