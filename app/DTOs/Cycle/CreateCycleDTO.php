<?php

namespace App\DTOs\Cycle;

class CreateCycleDTO
{
    public string $start_date;
    public string $end_date;

    public function __construct(
        public readonly array $data
    ) {
        $this->start_date = $data['start_date'];
        $this->end_date = $data['end_date'];
    }
}
