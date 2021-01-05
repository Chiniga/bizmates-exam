<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Http\Services\WeatherClient;
use App\Http\Services\WeatherContract;
use App\Http\Services\LocationClient;
use App\Http\Services\LocationContract;

class AppServiceProvider extends ServiceProvider {

    public $bindings = [
        WeatherContract::class  => WeatherClient::class,
        LocationContract::class => LocationClient::class
    ];

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register() {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot() {
        //
    }
}
