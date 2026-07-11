<?php

namespace App\Repositories\Interfaces;

use App\DTOs\Role\CreateRoleDTO;
use App\DTOs\Role\UpdateRoleDTO;

interface RoleRepositoryInterface
{
    public function getAll();
    public function getAllTrashed();
    public function findById(int $id);
    public function create(CreateRoleDTO $dto);
    public function update(UpdateRoleDTO $dto);
    public function delete(int $id);
    public function restore(int $id);
}