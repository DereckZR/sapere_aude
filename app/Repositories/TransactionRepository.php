<?php

namespace App\Repositories;

use App\Models\Transaction;
use App\DTOs\Transaction\CreateTransactionDTO;
use App\DTOs\Transaction\UpdateTransactionDTO;
use App\Repositories\Interfaces\TransactionRepositoryInterface;
use Override;

class TransactionRepository implements TransactionRepositoryInterface
{
    public function getAll()
    {
        return Transaction::with([
            'transactionCategory',
            'responsibleMember',
            'cycle'
        ])->get();
    }

    public function getAllTrashed()
    {
        return Transaction::withTrashed()->get();
    }

    public function getLatest(int $size)
    {
        return Transaction::with([
            'transactionCategory',
            'responsibleMember',
            'cycle'
        ])
            ->orderBy('created_at', 'desc')
            ->take($size)
            ->get();
    }

    public function findById(int $id)
    {
        return Transaction::findOrFail($id);
    }

    public function create(CreateTransactionDTO $dto)
    {
        return Transaction::create((array) $dto);
    }

    public function update(UpdateTransactionDTO $dto)
    {
        $item = Transaction::findOrFail($dto->id);
        $item->update((array) $dto);
        return $item;
    }

    public function delete(int $id)
    {
        $item = Transaction::findOrFail($id);
        $item->delete();
    }

    public function restore(int $id)
    {
        $item = Transaction::withTrashed()->findOrFail($id);
        $item->restore();
    }
}
