<?php

namespace App\DTOs\TransactionCategory;

use App\Enums\MovementType;

class UpdateTransactionCategoryDTO
{
    public int $id;
    public ?string $name;
    public ?string $description;

    public function __construct(
        public readonly array $data
    ) {
        $this->id = $data['id'];
        $this->name = $data['name'];
        $this->description = $data['description'] ?? null;
    }
}
