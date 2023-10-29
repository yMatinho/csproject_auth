<?php

namespace App\Modules\User;

use App\Modules\User\DTO\Response\FindByCredentialsResponse;
use Framework\Http\HttpRequestFacade;
use Framework\Singleton\Router\HttpDefaultCodes;
use Framework\Singleton\Router\HttpMethods;

class UserAPIFacade
{
    private HttpRequestFacade $httpRequestFacade;
    public function __construct()
    {
        $this->httpRequestFacade = new HttpRequestFacade();
    }

    public function findByCredentials(string $login, string $password): FindByCredentialsResponse
    {
        $response = $this->httpRequestFacade->request(HttpMethods::POST, USER_SERVICE_URL."user/findByCredentials", [
            "login"=> $login,
            "password"=> $password
        ]);

        return FindByCredentialsResponse::fromJson($response);
    }
}
