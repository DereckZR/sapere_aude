<?php

namespace App\DTOs\Transaction;

class UpdateTransactionDTO
{
    public int $id;

    public function __construct(
        public readonly array $data
    ) {
        $this->id = $data['id'];
    }
}