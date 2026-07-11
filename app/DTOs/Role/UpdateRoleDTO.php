<?php

namespace App\DTOs\Role;

class UpdateRoleDTO
{
    public int $id;

    public function __construct(
        public readonly array $data
    ) {
        $this->id = $data['id'];
    }
}