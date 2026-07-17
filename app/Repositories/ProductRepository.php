<?php

namespace App\Repositories;

use App\Models\Product;
use App\DTOs\Product\CreateProductDTO;
use App\DTOs\Product\UpdateProductDTO;
use App\Repositories\Interfaces\ProductRepositoryInterface;

class ProductRepository implements ProductRepositoryInterface
{
    public function getAll()
    {
        return Product::all();
    }

    public function getAllTrashed()
    {
        return Product::withTrashed()->get();
    }

    public function findById(int $id)
    {
        return Product::findOrFail($id);
    }

    public function create(CreateProductDTO $dto)
    {
        return Product::create((array) $dto);
    }

    public function update(UpdateProductDTO $dto)
    {
        $item = Product::findOrFail($dto->id);
        $item->update((array) $dto);
        return $item;
    }

    public function delete(int $id)
    {
        $item = Product::findOrFail($id);
        $item->delete();
    }

    public function restore(int $id)
    {
        $item = Product::withTrashed()->findOrFail($id);
        $item->restore();
    }
}