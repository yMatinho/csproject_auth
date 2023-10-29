<?php

namespace App\Modules\Auth\DTO\Request;

use Framework\Request\Request;

class ValidateRequest
{

    public function __construct(
        private string $accessToken,
        private ?string $scope,
    ) {
    }

    public static function fromRequest(Request $data): ValidateRequest
    {
        return new ValidateRequest(
            $data->accessToken,
            $data->scope
        );
    }
    
    public function getAccessToken(): string
    {
        return $this->accessToken;
    }

    public function getScope(): ?string
    {
        return $this->scope;
    }
}
