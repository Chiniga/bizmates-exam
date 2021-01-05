<?php

namespace App\Contracts;

interface WeatherContract
{
    public function request($city);
}