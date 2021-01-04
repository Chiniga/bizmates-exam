<?php

namespace App\Http\Services;

interface LocationContract
{
    public function request($city);
}