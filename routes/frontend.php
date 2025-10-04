<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OtpController;





Route::get('/', [HomeController::class, 'index'])->name('index');


Route::get('/news', [HomeController::class, 'news'])->name('news.index');

// Route to show single blog detail
Route::get('/news/{slug}', [HomeController::class, 'newsDetail'])->name('news.show');





Route::prefix('auth')->group(function () {
    Route::post('/send-otp', [OtpController::class, 'sendOtp'])->name('frontend.send.otp');
    Route::post('/resend-otp', [OtpController::class, 'resendOtp'])->name('frontend.resend.otp');
    Route::post('/verify-otp', [OtpController::class, 'verifyOtp'])->name('frontend.verify.otp');
});


