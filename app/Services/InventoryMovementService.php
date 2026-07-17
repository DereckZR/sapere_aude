<?php

namespace App\Services;

use App\DTOs\InventoryMovement\CreateInventoryMovementDTO;
use App\DTOs\InventoryMovement\UpdateInventoryMovementDTO;
use App\Repositories\Interfaces\InventoryMovementRepositoryInterface;

class InventoryMovementService
{
    public function __construct(protected InventoryMovementRepositoryInterface $repository) {}

    public function getAll()
    {
        return $this->repository->getAll();
    }

    public function getAllTrashed()
    {
        return  $this->repository->getAllTrashed();
    }

    public function findById(int $id)
    {
        return $this->repository->findById($id);
    }

    public function create(CreateInventoryMovementDTO $dto)
    {
        return $this->repository->create($dto);
    }

    public function update(UpdateInventoryMovementDTO $dto)
    {
        return $this->repository->update($dto);
    }

    public function delete(int $id)
    {
        return $this->repository->delete($id);
    }

    public function restore(int $id)
    {
        return $this->repository->restore($id);
    }
}
