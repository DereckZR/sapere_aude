<?php

namespace App\DTOs\User;

class UpdateUserDTO
{
    public int $id;
    public int $role_id;

    public function __construct(
        public readonly array $data
    ) {
        $this->id = $data['id'];
        $this->role_id = $data['role_id'];
    }
}