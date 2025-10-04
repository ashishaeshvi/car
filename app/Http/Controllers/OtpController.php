<?php

namespace App\Http\Controllers;

use App\Models\Otp;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OtpController extends Controller
{
    // Send OTP
    public function sendOtp(Request $request)
    {
        $request->validate(['contact_number' => 'required|digits:10']);

        // Generate 6 digit OTP
        $otpCode = rand(100000, 999999);

        // Store OTP
        $otp = Otp::create([
            'contact_number' => $request->contact_number,
            'otp_code' => $otpCode,
            'expires_at' => now()->addMinutes(5), // expires in 5 mins
        ]);

        // Send via SMS (use Twilio, MSG91, etc.)
        // For demo: \Log::info("OTP for {$request->contact_number}: {$otpCode}");

        return response()->json(['message' => 'OTP sent successfully.']);
    }

    // Resend OTP
    public function resendOtp(Request $request)
    {
        $request->validate(['contact_number' => 'required|digits:10']);

        // Delete old unused OTPs
        Otp::where('contact_number', $request->contact_number)
            ->where('is_used', false)
            ->delete();

        return $this->sendOtp($request);
    }

    // Verify OTP
    public function verifyOtp(Request $request)
    {
        $request->validate([
            'contact_number' => 'required|digits:10',
            'otp_code' => 'required|digits:6',
        ]);

        $otp = Otp::where('contact_number', $request->contact_number)
            ->where('otp_code', $request->otp_code)
            ->where('is_used', false)
            ->first();

        if (!$otp) {
            return response()->json(['message' => 'Invalid OTP'], 422);
        }

        if ($otp->isExpired()) {
            return response()->json(['message' => 'OTP expired'], 422);
        }

        // Mark OTP as used
        $otp->update(['is_used' => true]);

        // Create/Login user
        $user = User::firstOrCreate(
            ['email' => $request->contact_number.'@carkemaalik.com'],
            ['name' => 'User '.$request->contact_number, 'password' => bcrypt('secret')]
        );

        Auth::login($user);

        return response()->json(['message' => 'Login successful']);
    }
}
