<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Http\Services\WeatherClient;
use App\Http\Services\WeatherContract;
use App\Http\Services\LocationClient;
use App\Http\Services\LocationContract;

class AppServiceProvider extends ServiceProvider {
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register() {
        $this->app->singleton(WeatherContract::class, function ($app) {
            return new WeatherClient();
        });
        $this->app->singleton(LocationContract::class, function ($app) {
            return new LocationClient();
        });
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
