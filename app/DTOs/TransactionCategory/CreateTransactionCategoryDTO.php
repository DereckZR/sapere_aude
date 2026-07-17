<?php

namespace App\DTOs\TransactionCategory;

use App\Enums\MovementType;

class CreateTransactionCategoryDTO
{
    public string $name;
    public ?string $description;
    public MovementType $type;

    public function __construct(
        public readonly array $data
    ) {
        $this->name = $data['name'];
        $this->description = $data['description'] ?? null;
        $this->type = MovementType::from($data['type']);
    }
}
