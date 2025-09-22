<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\FeDocumentController;
use App\Http\Controllers\Admin\WebsiteSettingController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\DealerController;
use App\Http\Controllers\Admin\CarController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\BannerController;
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
        'dealers' => DealerController::class,       
        'cars' => CarController::class,   
        'blog' => BlogController::class,
        'brand' => BrandController::class,  
        'banner' => BannerController::class,  
        
        
    ]);
    Route::get('/user/{id}/edit', [UserController::class, 'edit'])->name('user.edit');
    Route::get('/edit-profile', [UserController::class, 'editProfile'])->name('user.editProfile');
    Route::get('/user/profile/{id}', [UserController::class, 'show'])->name('user-profile.show');
    //User
    Route::post('user/status', [UserController::class, 'changeStatus'])->name('user.status');

    //cars
    Route::post('cars/store-or-update/{id?}', [CarController::class, 'storeOrUpdate'])->name('cars.storeOrUpdate');
    Route::post('cars/status', [CarController::class, 'changeStatus'])->name('cars.status');
    
    //Brand
    Route::get('/brand/{id}/edit', [BrandController::class, 'edit'])->name('brand.edit');
    Route::post('brand/status', [BrandController::class, 'changeStatus'])->name('brand.status');

    //dealers
    Route::post('dealers/store-or-update/{id?}', [DealerController::class, 'storeOrUpdate'])->name('dealers.storeOrUpdate');
    Route::post('dealers/status', [DealerController::class, 'changeStatus'])->name('dealers.status');
    


    //Banner
    Route::post('banner/status', [BannerController::class, 'changeStatus'])->name('banner.status');




    // Change Password
    Route::post('/change-password', [AdminController::class, 'changePassword'])->name('change-password');
    Route::get('/change-password', [AdminController::class, 'ViewChangePassword'])->name('user.change-password');

    //Get State
    Route::get('get-state-dropdown/{country_id}', [AdminController::class, 'getStateDropdown']);
    Route::get('get-city-dropdown/{state_id}', [AdminController::class, 'getCityDropdown']);

    Route::post('/setting/update', [WebsiteSettingController::class, 'updatesetting'])->name('updatesetting');
    Route::get('/setting', [WebsiteSettingController::class, 'ViewWebsiteSettingPage'])->name('setting');

    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
   
   

Route::get('/seo-link',[BlogController::class, 'seolink']);  
Route::post('blog/status', [BlogController::class, 'changeStatus'])->name('blog.status');
    

    Route::get('/log-activity', [WebsiteSettingController::class, 'logActivity'])->name('log-activity');
    Route::get('/log-error', [WebsiteSettingController::class, 'showLogsPage'])->name('log-error');

   

});
