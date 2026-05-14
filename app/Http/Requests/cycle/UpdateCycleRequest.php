<?php

namespace App\Http\Requests\cycle;

class UpdateCycleRequest extends BaseCycleRequest
{
    protected function getCycleId(): ?int
    {
        return (int) $this->route('id');
    }
}
