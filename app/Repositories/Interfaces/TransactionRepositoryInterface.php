<?php

namespace App\Repositories\Interfaces;

use App\DTOs\Transaction\CreateTransactionDTO;
use App\DTOs\Transaction\UpdateTransactionDTO;

interface TransactionRepositoryInterface
{
    public function getAll();
    public function getAllTrashed();
    public function findById(int $id);
    public function getLatest(int $size);
    public function create(CreateTransactionDTO $dto);
    public function update(UpdateTransactionDTO $dto);
    public function delete(int $id);
    public function restore(int $id);
}
