<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Blade;
use Carbon\Carbon;


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
        Schema::defaultStringLength(191);
        Blade::component('layouts.back.components.card', 'card');
        Blade::component('layouts.back.components.alert', 'alert');

        // config(['app.locale' => 'id']);
        // \Carbon\Carbon::setLocale('id');
        // date_default_timezone_set('Asia/Jakarta');
    }
}