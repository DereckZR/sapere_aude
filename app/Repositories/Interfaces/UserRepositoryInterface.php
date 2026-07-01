<?php

namespace App\Repositories\Interfaces;

use App\DTOs\User\UpdateUserDTO;

interface UserRepositoryInterface
{
    public function getAll();
    public function getAllForList();
    public function getAllTrashed();
    public function getAllTrashedForList();
    public function findById(int $id);
    public function existsBy(string $column, mixed $value): bool;
    public function create(array $dto);
    public function update(UpdateUserDTO $dto);
    public function delete(int $id);
    public function restore(int $id);
}
