<?php

namespace App\Services\Base\Client\Dto;

readonly class ClientDto
{
    public function __construct(
        private string $first_name,
        private string $email,
        private ?string $last_name = null,
        private ?string $phone = null,
        private ?string $password = null,
        private bool $active = false
    ) {

    }

    /**
     * @return string
     */
    public function getFirstName(): string
    {
        return $this->first_name;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @return null|string
     */
    public function getLastName(): ?string
    {
        return $this->last_name;
    }

    /**
     * @return null|string
     */
    public function getPhone(): ?string
    {
        return $this->phone;
    }

    /**
     * @return null|string
     */
    public function getPassword(): ?string
    {
        return $this->password;
    }

    /**
     * @return bool
     */
    public function isActive(): bool
    {
        return $this->active;
    }
}
