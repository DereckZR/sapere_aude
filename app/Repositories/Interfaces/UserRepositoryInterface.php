<?php

namespace App\Repositories\Interfaces;

use App\DTOs\User\CreateUserDTO;
use App\DTOs\User\UpdateUserDTO;

interface UserRepositoryInterface
{
    public function getAll();
    public function getAllTrashed();
    public function findById(int $id);
    public function create(CreateUserDTO $dto);
    public function update(UpdateUserDTO $dto);
    public function delete(int $id);
    public function restore(int $id);
}