<?php

namespace App\DTOs\User;

class CreateUserDTO
{
    public int $member_id;
    public int $role_id;
    public string $password;

    public function __construct(
        public readonly array $data
    ) {
        $this->member_id = $data['member_id'];
        $this->role_id = $data['role_id'];
        $this->password = $data['password'];
    }
}
