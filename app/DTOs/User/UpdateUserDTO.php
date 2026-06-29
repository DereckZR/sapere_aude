<?php

namespace App\DTOs\User;

class UpdateUserDTO
{
    public int $id;

    public function __construct(
        public readonly array $data
    ) {
        $this->id = $data['id'];
    }
}