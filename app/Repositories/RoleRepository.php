<?php

namespace App\Repositories;

use App\Models\Role;
use App\DTOs\Role\CreateRoleDTO;
use App\DTOs\Role\UpdateRoleDTO;
use App\Repositories\Interfaces\RoleRepositoryInterface;

class RoleRepository implements RoleRepositoryInterface
{
    public function getAll()
    {
        return Role::all();
    }

    public function getAllTrashed()
    {
        return Role::withTrashed()->get();
    }

    public function findById(int $id)
    {
        return Role::findOrFail($id);
    }

    public function create(CreateRoleDTO $dto)
    {
        return Role::create((array) $dto);
    }

    public function update(UpdateRoleDTO $dto)
    {
        $item = Role::findOrFail($dto->id);
        $item->update((array) $dto);
        return $item;
    }

    public function delete(int $id)
    {
        $item = Role::findOrFail($id);
        $item->delete();
    }

    public function restore(int $id)
    {
        $item = Role::withTrashed()->findOrFail($id);
        $item->restore();
    }
}