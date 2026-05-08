<?php

namespace App\DTOs\Member;

class UpdateMemberDTO
{
    public int $id;

    public function __construct(
        public readonly array $data
    ) {
        $this->id = $data['id'];
    }
}