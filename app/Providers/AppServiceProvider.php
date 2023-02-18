<?php

namespace App\Providers;

use App\Events\UserRegistered;
use App\User;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        User::created(function ($user) {
            $token = $user->verificationToken()->create([
                'token' => bin2hex(random_bytes(32))
            ]);

            event(new UserRegistered($user));
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
