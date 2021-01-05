<?php

namespace App\Services;

use App\Contracts\WeatherContract;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;

class WeatherClient implements WeatherContract {
    /**
     * @var Client
     */
    protected $guzzle;

    /**
     * WeatherClient constructor
     */
    public function __construct() {
        $this->guzzle = new Client();
    }

    /**
     * @param string $city
     * @return array
     */
    public function request($city) {
        $params = http_build_query([
            'q'     => $city,
            'appid' => config('app.weather_api_key')
        ]);

        try {
            $response = $this->guzzle->request('GET', config('app.weather_url') . '?' . $params);
            $statusCode = $response->getStatusCode();
            $content = json_decode($response->getBody()->getContents(), true);
        } catch (ClientException $exception) {
            $statusCode = $exception->getCode();
            $content = $exception->getMessage();
        }

        return [
            'statusCode' => $statusCode,
            'content'    => $content
        ];
    }
}