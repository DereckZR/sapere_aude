<?php

namespace App\DTOs\Cycle;

class UpdateCycleDTO
{
    public int $id;
    public ?string $start_date;
    public ?string $end_date;

    public function __construct(
        public readonly array $data
    ) {
        $this->id = $data['id'];
        $this->start_date = $data['start_date'] ?? null;
        $this->end_date = $data['end_date'] ?? null;
    }
}
