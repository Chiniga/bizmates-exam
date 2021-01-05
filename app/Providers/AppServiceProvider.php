<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\WeatherClient;
use App\Services\LocationClient;
use App\Contracts\WeatherContract;
use App\Contracts\LocationContract;

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
