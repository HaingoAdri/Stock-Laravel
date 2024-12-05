<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Services\Auth\JwtGuard;
use Illuminate\Support\Facades\Auth;

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
        // $this->registerPolicies();
 
        // Auth::extend('jwt', function ($app, $name, array $config) {
        //     // Return an instance of Illuminate\Contracts\Auth\Guard...
 
        //     return new JwtGuard(Auth::createUserProvider($config['provider']));
        // });
    }
}
