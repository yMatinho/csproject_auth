<?php

namespace App\Modules\Auth\Resource;

use Framework\Response\JsonResource;

class ValidationResource extends JsonResource
{

    public function __construct()
    {
    }

    public function exportFromArray(array $data): array
    {
        return [
            "message"=>"Authorized"
        ];
    }
}
