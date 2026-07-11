<?php

namespace App\DTOs\Role;

class CreateRoleDTO
{
    public function __construct(
        public readonly array $data
    ) {}
}