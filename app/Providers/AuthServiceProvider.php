<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Auth\GenericUser;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AuthServiceProvider extends ServiceProvider
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
     * Boot the authentication services for the application.
     *
     * @return void
     */
    public function boot()
    {
        $this->app['auth']->viaRequest('web', function ($request) {
            return Auth::user();
        });

        Auth::provider('storage', function ($app, array $config) {
            return new FileUserProvider();
        });
    }
}
