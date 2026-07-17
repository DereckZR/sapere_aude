<?php

namespace App\DTOs\InventoryMovement;

use App\Enums\MovementType;

class UpdateInventoryMovementDTO
{
    public int $id;
    public MovementType $type;
    public int $quantity;
    public string $reason;
    public ?string $reason_details;
    public string $movement_date;
    public int $product_id;
    public ?int $transaction_id;

    public function __construct(
        public readonly array $data
    ) {
        $this->id = $data['id'];
        $this->type = MovementType::from($data['type']);
        $this->quantity = $data['quantity'];
        $this->reason = $data['reason'];
        $this->reason_details = $data['reason_details'] ?? null;
        $this->movement_date = $data['movement_date'];
        $this->product_id = $data['product_id'];
        $this->transaction_id = $data['transaction_id'] ?? null;
    }
}
