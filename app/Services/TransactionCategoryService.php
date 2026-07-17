<?php

namespace App\Services;

use App\DTOs\TransactionCategory\CreateTransactionCategoryDTO;
use App\DTOs\TransactionCategory\UpdateTransactionCategoryDTO;
use App\Repositories\Interfaces\TransactionCategoryRepositoryInterface;
use Illuminate\Validation\ValidationException;

class TransactionCategoryService
{
    public function __construct(protected TransactionCategoryRepositoryInterface $repository) {}

    public function getAll()
    {
        return $this->repository->getAll();
    }

    public function getAllForSelect()
    {
        $transactionCategories = $this->repository->getAll();
        if ($transactionCategories->isEmpty()) {
            throw ValidationException::withMessages([
                'transactionCategories' => 'No hay categorías de transacción disponibles. Por favor, cree una categoría antes de realizar transacciones.'
            ]);
        }

        return $transactionCategories->map(function ($category) {
            return [
                'id' => $category->id,
                'text' => $category->name,
            ];
        });
    }

    public function getAllTrashed()
    {
        return  $this->repository->getAllTrashed();
    }

    public function findById(int $id)
    {
        return $this->repository->findById($id);
    }

    public function create(CreateTransactionCategoryDTO $dto)
    {
        return $this->repository->create($dto);
    }

    public function update(UpdateTransactionCategoryDTO $dto)
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
