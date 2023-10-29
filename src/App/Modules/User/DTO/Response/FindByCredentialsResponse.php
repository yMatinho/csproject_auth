<?php

namespace App\Modules\User\DTO\Response;

use App\Modules\User\DTO\User;

class FindByCredentialsResponse
{
    public function __construct(
        private bool $status,
        private User $user
    ) {
    }

    public static function fromJson(object $data): FindByCredentialsResponse
    {
        return new FindByCredentialsResponse($data->status, User::fromJson($data->user));
    }

    public function getStatus(): bool
    {
        return $this->status;
    }

    public function getUser(): User
    {
        return $this->user;
    }
}
