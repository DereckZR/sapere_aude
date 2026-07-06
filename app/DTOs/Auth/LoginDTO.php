<?php

namespace App\DTOs\Auth;

class LoginDTO
{
    public string $username;
    public string $password;

    public function __construct(
        public readonly array $data
    ) {
        $this->username = $data['username'];
        $this->password = $data['password'];
    }
}
