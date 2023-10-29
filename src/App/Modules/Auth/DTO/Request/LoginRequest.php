<?php

namespace App\Modules\Auth\DTO\Request;

use Framework\Request\Request;

class LoginRequest
{

    public function __construct(
        private string $login,
        private string $password,
    ) {
    }

    public static function fromRequest(Request $data): LoginRequest
    {
        return new LoginRequest(
            $data->login,
            $data->password
        );
    }
    public function getLogin(): string
    {
        return $this->login;
    }
    public function getPassword(): string
    {
        return $this->password;
    }
}
