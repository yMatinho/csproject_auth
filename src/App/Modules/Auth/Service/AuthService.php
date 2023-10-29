<?php

namespace App\Modules\Auth\Service;

use App\Core\JWT\JWT;
use App\Core\JWT\JWTFactory;
use App\Core\JWT\JWTValidationStrategy;
use App\Modules\User\UserAPIFacade;

class AuthService
{
    private UserAPIFacade $userAPIFacade;
    private JWTFactory $jwtFactory;
    private JWTValidationStrategy $jwtValidationStrategy;
    public function __construct()
    {
        $this->userAPIFacade = new UserAPIFacade();
        $this->jwtFactory = new JWTFactory();
        $this->jwtValidationStrategy = new JWTValidationStrategy();
    }

    public function login(string $login, string $password): JWT
    {
        $response = $this->userAPIFacade->findByCredentials($login, $password);

        return $this->jwtFactory->makeFromUser($response->getUser());
    }

    public function validate(string $accessToken): bool
    {
        return $this->jwtValidationStrategy->validate(
            $this->jwtFactory->makeFromAccessToken($accessToken)
        );
    }
}
