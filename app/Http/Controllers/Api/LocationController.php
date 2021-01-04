<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Services\LocationContract;
use App\Helpers\ApiHelper;

class LocationController extends Controller
{
    use ApiHelper;

    public function index($location, LocationContract $locationContract) {
        $result = $locationContract->request($location);

        if($result['statusCode'] !== Response::HTTP_OK) {
            return $this->respondWithError($result['content']);
        }

        return $this->respondWithSuccess('success', $result);
    }
}
