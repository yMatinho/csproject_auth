<?php

namespace App\Modules\User;

use App\Modules\User\DTO\Response\FindByCredentialsResponse;
use Framework\Singleton\Router\HttpDefaultCodes;

class UserAPIFacade
{
    public function __construct()
    {
    }

    public function findByCredentials(string $login, string $password): FindByCredentialsResponse
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, "http://users_api/user?id=5");
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $data = curl_exec($curl);
        $response = json_decode($data);
        $statusCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        if ($statusCode != HttpDefaultCodes::SUCCESS || $response == null)
            throw new \Exception(isset($response["error"]) ? $response["error"] : $response);

        return FindByCredentialsResponse::fromJson($response);
    }
}
