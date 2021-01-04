<?php

namespace App\Helpers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Exception;

trait ApiHelper {
    /**
     * @var int
     */
    protected $statusCode = Response::HTTP_OK;

    /**
     * @param $message
     * @param $errors
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function respondWithError($message = '', $errors = []) {
        return $this->respond([
            'errors'        => $errors,
            'error_message' => $message,
            'status'        => false
        ]);
    }

    /**
     * @param $message
     * @param $data
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function respondWithSuccess($message = '', $data = []) {
        return $this->respond([
            'data'    => $data,
            'message' => $message,
            'status'  => true
        ]);
    }


    /**
     * @param string|array $data
     * @param array $headers
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function respond($data, array $headers = []) {
        if (empty($data['errors'])) {
            unset($data['errors']);
        }
        if (empty($data['data'])) {
            unset($data['data']);
        }

        return new JsonResponse($data, $this->getStatusCode(), $headers);
    }

    /**
     * @return int
     */
    public function getStatusCode() {
        return $this->statusCode;
    }

    /**
     * @param $statusCode
     *
     * @return $this
     */
    public function setStatusCode($statusCode) {
        $this->statusCode = $statusCode;
        return $this;
    }
}