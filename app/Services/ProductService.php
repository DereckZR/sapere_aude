<?php

namespace App\Services;

use App\Enums\MovementType;
use App\DTOs\Product\CreateProductDTO;
use App\DTOs\Product\UpdateProductDTO;
use App\DTOs\InventoryMovement\CreateInventoryMovementDTO;
use App\Repositories\Interfaces\ProductRepositoryInterface;
use Illuminate\Support\Facades\DB;

class ProductService
{
    public function __construct(
        protected ProductRepositoryInterface $repository,
        protected InventoryMovementService $inventoryMovementService
    ) {}

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

    public function create(CreateProductDTO $dto)
    {
        return DB::transaction(function () use ($dto) {
            $product = $this->repository->create($dto);

            $this->createInitialInventoryMovement(
                $product->id,
                $product->stock_quantity
            );

            return $product;
        });
    }

    private function createInitialInventoryMovement(int $productId, int $quantity)
    {
        $movementData = [
            'type' => MovementType::IN->value,
            'quantity' => $quantity,
            'reason' => 'Stock Inicial',
            'movement_date' => now()->toDateString(),
            'product_id' => $productId,
        ];

        $dto = new CreateInventoryMovementDTO($movementData);
        $this->inventoryMovementService->create($dto);
    }

    public function update(UpdateProductDTO $dto)
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
