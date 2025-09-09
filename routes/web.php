<?php

use App\Http\Controllers\Admin\CandidateController;
use App\Http\Controllers\Admin\DownloadController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\RaDocumentController;
use App\Http\Controllers\Admin\FeDocumentController;
use App\Http\Controllers\Admin\WebsiteSettingController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\UserPassportController;
use App\Http\Controllers\Admin\HomeController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\File;

// Cache Clear Route
Route::get('cache-flush', static function () {
    Cache::flush();
    Artisan::call('view:clear');
    Artisan::call('route:clear');
    Artisan::call('config:clear');
    Artisan::call('cache:clear');
    Artisan::call('optimize:clear');

    // mPDF JSON cache clear
    $mpdfCachePath = storage_path('app/mpdf');
    if (File::exists($mpdfCachePath)) {
        File::cleanDirectory($mpdfCachePath);
    }
   return redirect()->back()->with('success', 'Cache cleared successfully!');
});

Route::get('/clear-log', function () {
    $logPath = storage_path('logs/laravel.log');
    if (File::exists($logPath)) {
        file_put_contents($logPath, ''); // truncate file
    }
    return back()->with('success', 'Laravel log cleared successfully!');
})->name('clear.log');


Route::get('/', [HomeController::class, 'index'])->name('index');

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'adminlogin']);

Route::get('/forgot-password', [HomeController::class, 'ForgotPass'])->name('forgot-password');
Route::post('/forgot-password-send', [HomeController::class, 'ForgotPasswordSend']);
Route::middleware(['web','auth'])->group(function () {
    Route::get('dashboard', [AdminController::class, 'adminDashboard'])->name('home');
    Route::resources([
        'roles' => RoleController::class,
        'user' => UserController::class,
        'ra-document' => RaDocumentController::class,
        'fe-document' => FeDocumentController::class,
        'user-passports' => UserPassportController::class,
        'candidate_form' => CandidateController::class
    ]);
    Route::get('/user/{id}/edit', [UserController::class, 'edit'])->name('user.edit');
    Route::get('/edit-profile', [UserController::class, 'editProfile'])->name('user.editProfile');
    Route::get('/user/profile/{id}', [UserController::class, 'show'])->name('user-profile.show');
    //User
    Route::post('user/status', [UserController::class, 'changeStatus'])->name('user.status');

    //Ra-document
    Route::get('/ra-document/{id}/edit', [RaDocumentController::class, 'edit'])->name('ra-document.edit');
    Route::post('ra-document/status', [RaDocumentController::class, 'changeStatus'])->name('ra-document.status');

    //fe-document
    Route::get('/fe-document/{id}/edit', [FeDocumentController::class, 'edit'])->name('fe-document.edit');
    Route::post('fe-document/status', [FeDocumentController::class, 'changeStatus'])->name('fe-document.status');

    //user-passports
    Route::post('user-passports/store-or-update/{id?}', [UserPassportController::class, 'storeOrUpdate'])->name('user_passports.storeOrUpdate');
    Route::post('/check-passport', [UserPassportController::class, 'checkPassport'])->name('check.passport');
    Route::post('/check-fe-details', [UserPassportController::class, 'checkFeDetails'])->name('check.fe.details');

    Route::post('user-passports/status', [UserPassportController::class, 'changeStatus'])->name('user-passports.status');
    Route::post('get_passport_info', [UserPassportController::class, 'getPassportInfo'])->name('get_passport_info');

    // Change Password
    Route::post('/change-password', [AdminController::class, 'changePassword'])->name('change-password');
    Route::get('/change-password', [AdminController::class, 'ViewChangePassword'])->name('user.change-password');

    //Get State
    Route::get('get-state-dropdown/{country_id}', [AdminController::class, 'getStateDropdown']);
    Route::get('get-city-dropdown/{state_id}', [AdminController::class, 'getCityDropdown']);

    Route::post('/setting/update', [WebsiteSettingController::class, 'updatesetting'])->name('updatesetting');
    Route::get('/setting', [WebsiteSettingController::class, 'ViewWebsiteSettingPage'])->name('setting');

    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
    Route::post('candidate_form/status', [CandidateController::class, 'changeStatus'])->name('candidate_form.status');
    Route::get('/admin/download', [DownloadController::class, 'downloadPdf'])->name('download');
    Route::get('/admin/pdf_download/{type}/{id}', [DownloadController::class, 'pdfDownload']);
    Route::get('/log-activity', [WebsiteSettingController::class, 'logActivity'])->name('log-activity');
    Route::get('/log-error', [WebsiteSettingController::class, 'showLogsPage'])->name('log-error');

    Route::get('/uploaded_document/{id}', [CandidateController::class, 'uploadedDocument'])->name('candidate_form.uploaded_document');

});
