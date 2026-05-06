<?php

namespace App\Repositories;

use App\Models\Cycle;
use App\DTOs\Cycle\CreateCycleDTO;
use App\DTOs\Cycle\UpdateCycleDTO;
use App\Repositories\Interfaces\CycleRepositoryInterface;
use Override;

class CycleRepository implements CycleRepositoryInterface
{
    public function getAll()
    {
        return Cycle::all();
    }

    public function findById(int $id)
    {
        return Cycle::findOrFail($id);
    }

    public function create(CreateCycleDTO $dto)
    {
        return Cycle::create((array) $dto);
    }

    public function update(UpdateCycleDTO $dto)
    {
        $item = Cycle::findOrFail($dto->id);
        $item->update((array) $dto);
        return $item;
    }
}
