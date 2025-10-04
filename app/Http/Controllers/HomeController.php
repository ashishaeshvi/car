<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\Models\AdsBanner;
use App\Models\Banner;
use App\Models\Blog;

class HomeController extends Controller
{


    public function index()
    {
        // Get active banners
        $banner = Banner::where('status', 'active')->latest()->first();
        $blogs = Blog::where('status', 'active')->latest()->get();
        // Get active ads banners
        $positions = ['home_top', 'home_left', 'home_right'];

        $adsBanners = [];
        foreach ($positions as $pos) {
            $adsBanners[$pos] = AdsBanner::where('status', 'active')
                ->where('position', $pos)
                ->latest()
                ->first();
        }

        // Pass data to view
        return view('front.home', compact('banner', 'adsBanners', 'blogs'));
    }

    public function ForgotPass()
    {
        return view('auth.passwords.email');
    }

    public function news()
    {
        $blogs = Blog::where('status', 'active')->orderBy('created_at', 'desc')->get();
        return view('front.blogs', compact('blogs'));
    }


    public function newsDetail($slugUri)
    {

        // Try to find the blog by slug_uri
        $blog = Blog::where('slug_uri', $slugUri)->first();


        $recentBlogs = Blog::where('id', '!=', $blog->id)->where('status', 'active')->orderBy('created_at', 'desc')->take(5)->get();
        // If blog not found, redirect to homepage (or any page)
        if (! $blog) {
            return redirect()->route('home')->with('error', 'Blog not found.');
        }

        // If found, show blog detail
        return view('front.blog-detail', compact('blog', 'recentBlogs'));
    }



    public function ForgotPasswordSend(Request $request)
    {
        $email = $request->email;
        $user = DB::table('users')->where('email', $email)->first();

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'This email is not registered with us. Please check and try again!'
            ], 404);
        }

        // Check if user is inactive or deleted
        if ($user->status !== 'active') {
            return response()->json([
                'success' => false,
                'message' => 'Your account is inactive. Please contact support!'
            ], 403);
        }

        if (!is_null($user->deleted_at)) {
            return response()->json([
                'success' => false,
                'message' => 'Your account has been deleted. Please contact support!'
            ], 403);
        }

        $newPassword = mt_rand(111111, 999999);

        $updateStatus = DB::table('users')->where('email', $email)->update([
            'password' => Hash::make($newPassword)
        ]);

        if (!$updateStatus) {
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong. Please try again!'
            ], 500);
        }

        $redirectUrl =  'login';

        // Set email config dynamically
        $mailData = [
            'password'         => $newPassword,
            'email'            => $user->email,
            'name'             => $user->name,
            'MAIL_FROM_NAME'   => config('mail.from.name'),
            'redirectUrl'      => $redirectUrl,
            'website_settings' => DB::table('website_settings')->first(),
        ];

        try {
            Mail::send('emails.send_code', $mailData, function ($message) use ($user) {
                $message->to($user->email)
                    ->subject(config('mail.from.name') . ': Forgot Password')
                    ->from(config('mail.from.address'), config('mail.from.name'));
            });

            return response()->json([
                'success' => true,
                'message' => 'Your new password has been sent to your registered email!',
                'redirect' => url($redirectUrl),
            ]);
        } catch (\Exception $e) {
            Log::error('Mail sending failed: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to send email. Please try again later!',
            ], 500);
        }
    }
}
