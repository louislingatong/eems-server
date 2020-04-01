<?php

namespace App\Providers;

use Illuminate\Support\Facades\Validator;
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
        Validator::extend(
            'validResetPasswordToken',
            'App\Rules\ValidResetPasswordTokenRule@passes',
            'The :attribute is invalid.');
        Validator::extend(
            'validEnum',
            'App\Rules\ValidEnumRule@passes',
            'The selected :attribute is invalid.');
    }
}
