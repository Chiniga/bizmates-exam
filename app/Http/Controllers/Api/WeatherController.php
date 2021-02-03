<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Contracts\ApiContract;
use App\Helpers\ApiHelper;

class WeatherController extends Controller {

    use ApiHelper;

    public function index($location, ApiContract $apiContract) {
        $result = $apiContract->request($location);

        if($result['statusCode'] !== Response::HTTP_OK) {
            return $this->respondWithError($result['content']);
        }

        return $this->respondWithSuccess('success', $result);
    }
}
