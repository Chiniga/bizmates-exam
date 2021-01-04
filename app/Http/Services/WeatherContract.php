<?php

namespace App\Http\Services;

interface WeatherContract
{
    public function request($city);
}