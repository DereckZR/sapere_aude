<?php

namespace App\Repositories;

use App\Models\TransactionCategory;
use App\DTOs\TransactionCategory\CreateTransactionCategoryDTO;
use App\DTOs\TransactionCategory\UpdateTransactionCategoryDTO;
use App\Repositories\Interfaces\TransactionCategoryRepositoryInterface;

class TransactionCategoryRepository implements TransactionCategoryRepositoryInterface
{
    public function getAll()
    {
        return TransactionCategory::all();
    }

    public function getAllTrashed()
    {
        return TransactionCategory::withTrashed()->get();
    }

    public function findById(int $id)
    {
        return TransactionCategory::findOrFail($id);
    }

    public function create(CreateTransactionCategoryDTO $dto)
    {
        return TransactionCategory::create((array) $dto);
    }

    public function update(UpdateTransactionCategoryDTO $dto)
    {
        $item = TransactionCategory::findOrFail($dto->id);
        if ($item->is_protected) {
            throw new \Exception('Cannot update a protected transaction category.');
        }
        $item->update((array) $dto);
        return $item;
    }

    public function delete(int $id)
    {
        $item = TransactionCategory::findOrFail($id);
        if ($item->is_protected) {
            throw new \Exception('Cannot delete a protected transaction category.');
        }
        $item->delete();
    }

    public function restore(int $id)
    {
        $item = TransactionCategory::withTrashed()->findOrFail($id);
        $item->restore();
    }
}
