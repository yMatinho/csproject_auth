<?php

namespace Framework\Http;

use Framework\Singleton\Router\HttpDefaultCodes;

class HttpRequestFacade {

    public function request(string $method, string $url, array $body=[]): object {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $body);
        $data = curl_exec($curl);
        $response = json_decode($data);
        $statusCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        if ($statusCode != HttpDefaultCodes::SUCCESS || $response == null)
            throw new \Exception(isset($response->message) ? $response->message : $response);

        return $response;
    }
}