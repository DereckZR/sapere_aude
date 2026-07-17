<?php

namespace App\Repositories\Interfaces;

use App\DTOs\TransactionCategory\CreateTransactionCategoryDTO;
use App\DTOs\TransactionCategory\UpdateTransactionCategoryDTO;

interface TransactionCategoryRepositoryInterface
{
    public function getAll();
    public function getAllTrashed();
    public function findById(int $id);
    public function create(CreateTransactionCategoryDTO $dto);
    public function update(UpdateTransactionCategoryDTO $dto);
    public function delete(int $id);
    public function restore(int $id);
}