<?php

namespace App\Core\JWT;

class JWT {
    public function __construct(
        private string $accessToken,
        private string $refreshToken='',
    ) {
        
    }

    public function getAccessToken(): string {
        return $this->accessToken;
    }
}