<?php

namespace App\Modules\Auth\Service;

use App\Core\JWT\JWT;
use App\Core\JWT\JWTFactory;
use App\Modules\User\UserAPIFacade;

class AuthService
{
    private UserAPIFacade $userAPIFacade;
    private JWTFactory $jwtFactory;
    public function __construct()
    {
        $this->userAPIFacade = new UserAPIFacade();
        $this->jwtFactory = new JWTFactory();
    }

    public function login(string $login, string $password): JWT {
        $response = $this->userAPIFacade->findByCredentials($login, $password);

        return $this->jwtFactory->makeFromUser($response->getUser());
    }
}
