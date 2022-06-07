<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Routing\ResponseFactory;
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
    public function boot()
    {
        Paginator::useBootstrap();
        Schema::defaultStringLength(191);
        ResponseFactory::macro('api', function ($data = null, $error = 0, $message = '') {
            return response()->json([
                'data' => $data,
                'error' => $error, //1 or 0
                'message' => $message,
            ]);
        });
    }
}
