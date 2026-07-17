<?php

namespace App\Repositories\Interfaces;

use App\DTOs\Product\CreateProductDTO;
use App\DTOs\Product\UpdateProductDTO;

interface ProductRepositoryInterface
{
    public function getAll();
    public function getAllTrashed();
    public function findById(int $id);
    public function create(CreateProductDTO $dto);
    public function update(UpdateProductDTO $dto);
    public function delete(int $id);
    public function restore(int $id);
}