<?php

namespace App\Providers;

use App\Actions\Fortify\AttemptToAuthenticate;
use App\Actions\Fortify\RedirectIfEnableOtp;
use App\Actions\Jetstream\DeleteUser;
use App\Http\Middleware\RedirectIfAuthenticated;
use Illuminate\Http\Request;
use Illuminate\Support\ServiceProvider;
use Laravel\Fortify\Actions\PrepareAuthenticatedSession;
use Laravel\Fortify\Fortify;
use Laravel\Jetstream\Jetstream;

class JetstreamServiceProvider extends ServiceProvider
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
        $this->configurePermissions();

        Jetstream::deleteUsersUsing(DeleteUser::class);

        // Actions while logging must be follow
        Fortify::authenticateThrough(function (Request $request) {
            return array_filter([
                AttemptToAuthenticate::class,
                PrepareAuthenticatedSession::class,
                RedirectIfEnableOtp::class,
                RedirectIfAuthenticated::class
            ]);
        });


    }

    /**
     * Configure the permissions that are available within the application.
     *
     * @return void
     */
    protected function configurePermissions()
    {
        Jetstream::defaultApiTokenPermissions(['read']);

        Jetstream::permissions([
            'create',
            'read',
            'update',
            'delete',
        ]);
    }
}
