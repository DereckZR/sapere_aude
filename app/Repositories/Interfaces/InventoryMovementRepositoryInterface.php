<?php

namespace App\Repositories\Interfaces;

use App\DTOs\InventoryMovement\CreateInventoryMovementDTO;
use App\DTOs\InventoryMovement\UpdateInventoryMovementDTO;

interface InventoryMovementRepositoryInterface
{
    public function getAll();
    public function getAllTrashed();
    public function findById(int $id);
    public function create(CreateInventoryMovementDTO $dto);
    public function update(UpdateInventoryMovementDTO $dto);
    public function delete(int $id);
    public function restore(int $id);
}