<?php

namespace App\Repositories;

use App\Models\InventoryMovement;
use App\DTOs\InventoryMovement\CreateInventoryMovementDTO;
use App\DTOs\InventoryMovement\UpdateInventoryMovementDTO;
use App\Repositories\Interfaces\InventoryMovementRepositoryInterface;

class InventoryMovementRepository implements InventoryMovementRepositoryInterface
{
    public function getAll()
    {
        return InventoryMovement::all();
    }

    public function getAllTrashed()
    {
        return InventoryMovement::withTrashed()->get();
    }

    public function findById(int $id)
    {
        return InventoryMovement::findOrFail($id);
    }

    public function create(CreateInventoryMovementDTO $dto)
    {
        return InventoryMovement::create((array) $dto);
    }

    public function update(UpdateInventoryMovementDTO $dto)
    {
        $item = InventoryMovement::findOrFail($dto->id);
        $item->update((array) $dto);
        return $item;
    }

    public function delete(int $id)
    {
        $item = InventoryMovement::findOrFail($id);
        $item->delete();
    }

    public function restore(int $id)
    {
        $item = InventoryMovement::withTrashed()->findOrFail($id);
        $item->restore();
    }
}