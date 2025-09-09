<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{


     public function index()
    {      
        return view('home');
    }

    public function ForgotPass()
    {
        return view('auth.passwords.email');
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

        $redirectUrl =  'login' ;

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
