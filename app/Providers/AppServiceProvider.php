<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\WeatherClient;
use App\Services\LocationClient;
use App\Contracts\ApiContract;

class AppServiceProvider extends ServiceProvider {

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register() {
        $this->app->bind(ApiContract::class, function($app) {
            if(request()->has('weather')) {
                return new WeatherClient();
            }

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
