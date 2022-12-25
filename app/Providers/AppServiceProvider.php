<?php

namespace App\Providers;

use Illuminate\Contracts\Auth\Guard;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Schema;
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
    public function boot(Guard $auth)
    {
        Schema::defaultStringLength(191);

        // Share logged in user through all views
        View::composer('*', function ($view) use ($auth) {
            $view->with('authUser', $auth->user()->load('role'));
        });

        // Bootstrap pagination
        Paginator::useBootstrap();
    }
}
