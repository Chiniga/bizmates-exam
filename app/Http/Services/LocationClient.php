<?php

namespace App\Http\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;

class LocationClient implements LocationContract {
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
            'near'          => $city,
            'limit'         => 5,
            'client_id'     => config('app.foursquare_client_id'),
            'client_secret' => config('app.foursquare_secret')
            /* 'categoryId'    => Config::get('app.foursquare_'),
            'v'             => config::get('app.foursquare_'), */
        ]);

        try {
            $response = $this->guzzle->request('GET', config('app.foursquare_url') . '?' . $params);
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