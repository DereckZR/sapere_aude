<?php

namespace App\Services;

use App\DTOs\Product\CreateProductDTO;
use App\DTOs\Product\UpdateProductDTO;
use App\Repositories\Interfaces\ProductRepositoryInterface;

class ProductService
{
    public function __construct(protected ProductRepositoryInterface $repository) {}

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
        return $this->repository->create($dto);
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