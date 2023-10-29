<?php

namespace App\Modules\User\DTO;

class User
{
    public function __construct(
        private int $id,
        private string $username,
        private string $email,
        private string $firstName,
        private string $lastName,
        private string $createdAt,
        private ?string $updatedAt = null,
    ) {
    }

    public static function fromJson(object $data): User
    {
        return new User(
            $data->id,
            $data->username,
            $data->email,
            $data->firstName,
            $data->lastName,
            $data->createdAt,
            $data->updatedAt,
        );
    }

    public function getId(): int {
        return $this->id;
    }

    public function getUsername(): string {
        return $this->username;
    }

    public function getEmail(): string { 
        return $this->email;
    }

    public function getFirstName(): string {
        return $this->firstName;
     }

    public function getLastName(): string {
        return $this->lastName;
    }

    public function getCreatedAt(): string {
        return $this->createdAt;
    }

    public function getUpdatedAt(): ?string {
        return $this->updatedAt;
    }
}
