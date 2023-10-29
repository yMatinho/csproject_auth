<?php

namespace App\Modules\Auth\Resource;

use Framework\Response\JsonResource;

class TokenResource extends JsonResource
{

    public function __construct()
    {
    }

    public function exportFromArray(array $data): array
    {
        return [
            "accessToken"=>$data["accessToken"]
        ];
    }
}
