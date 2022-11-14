<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        $this->app->bind(
            // package controller
            \Backpack\PermissionManager\app\Http\Controllers\UserCrudController::class,
            // your controller
            \App\Http\Controllers\Admin\UserCrudController::class
        );     
    }
}
