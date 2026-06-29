<?php

namespace App\DTOs\User;

class CreateUserDTO
{
    public function __construct(
        public readonly array $data
    ) {}
}