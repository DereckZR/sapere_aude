<?php

namespace App\DTOs\Transaction;

class CreateTransactionDTO
{
    public ?string $description;
    public float $amount;
    public string $transaction_date;
    public bool $is_cash;
    public int $transaction_category_id;
    public int $responsible_member_id;
    public int $cycle_id;

    public function __construct(
        public readonly array $data
    ) {
        $this->description = $data['description'] ?? null;
        $this->amount = $data['amount'];
        $this->transaction_date = $data['transaction_date'];
        $this->is_cash = $data['is_cash'];
        $this->transaction_category_id = $data['transaction_category_id'];
        $this->responsible_member_id = $data['responsible_member_id'];
        $this->cycle_id = $data['cycle_id'];
    }
}
