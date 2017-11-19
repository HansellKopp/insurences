<?php

namespace App\Providers;

use App\User;
use App\Mail\UserCreated;
use App\Mail\UserEmailChanged;
Use Illuminate\Support\Facades\Mail;
Use Illuminate\Support\Facades\Schema;
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
        /** 
        * to prevent migrations errors
        */
       Schema::defaultStringLength(191);

        /**
         * event to send a email when new user is created
         */
        User::created(function($user) {
            Mail::to($user)->send(new UserCreated($user));
        });

        /**
         * event to send a email when new user changed his email 
         */
        User::updated(function($user) {
            if ($user->isDirty('email')) {
                Mail::to($user)->send(new UserEmailChanged($user));
            }
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
