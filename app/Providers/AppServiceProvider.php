<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Http\Services\WeatherClient;
use App\Http\Services\WeatherContract;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(WeatherContract::class, function ($app) {
            return new WeatherClient();
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
