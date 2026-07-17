<?php

namespace App\Services;

use App\DTOs\Transaction\CreateTransactionDTO;
use App\DTOs\Transaction\UpdateTransactionDTO;
use App\Repositories\Interfaces\TransactionRepositoryInterface;

class TransactionService
{
    public function __construct(protected TransactionRepositoryInterface $repository) {}

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

    public function create(CreateTransactionDTO $dto)
    {
        return $this->repository->create($dto);
    }

    public function update(UpdateTransactionDTO $dto)
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