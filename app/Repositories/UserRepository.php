<?php

namespace App\Repositories;

use App\Models\User;
use App\DTOs\User\CreateUserDTO;
use App\DTOs\User\UpdateUserDTO;
use App\Repositories\Interfaces\UserRepositoryInterface;

class UserRepository implements UserRepositoryInterface
{
    public function getAll()
    {
        return User::all();
    }

    public function getAllTrashed()
    {
        return User::withTrashed()->get();
    }

    public function findById(int $id)
    {
        return User::findOrFail($id);
    }

    public function create(CreateUserDTO $dto)
    {
        return User::create((array) $dto);
    }

    public function update(UpdateUserDTO $dto)
    {
        $item = User::findOrFail($dto->id);
        $item->update((array) $dto);
        return $item;
    }

    public function delete(int $id)
    {
        $item = User::findOrFail($id);
        $item->delete();
    }

    public function restore(int $id)
    {
        $item = User::withTrashed()->findOrFail($id);
        $item->restore();
    }
}