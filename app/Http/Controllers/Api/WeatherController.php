<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Services\WeatherContract;
use App\Helpers\ApiHelper;

class WeatherController extends Controller {

    use ApiHelper;

    public function index($location, WeatherContract $weatherContract) {
        $result = $weatherContract->request($location);

        if($result['statusCode'] !== Response::HTTP_OK) {
            return $this->respondWithError($result['content']);
        }

        return $this->respondWithSuccess('success', $result);
    }
}
