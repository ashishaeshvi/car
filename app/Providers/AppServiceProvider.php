<?php

namespace App\Providers;

use Exception;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Spatie\Permission\Models\Permission;
use App\Services\DocumentService;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(DocumentService::class, function ($app) {
            return new DocumentService();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        try{
            Schema::defaultStringLength(191);
        if (Schema::hasTable('permissions')) {
            Permission::all()->each(function ($permission) {
                Gate::define($permission->name, function ($user) use ($permission) {
                    return $user->hasPermissionTo($permission->name);
                });
            });
        }
        }catch(Exception $e){

        }
        

    }
}
