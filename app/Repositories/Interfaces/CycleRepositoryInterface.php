<?php

namespace App\Repositories\Interfaces;

use App\DTOs\Cycle\CreateCycleDTO;
use App\DTOs\Cycle\UpdateCycleDTO;

interface CycleRepositoryInterface
{
    public function getAll();
    public function getAllTrashed();
    public function findById(int $id);
    public function create(CreateCycleDTO $dto);
    public function update(UpdateCycleDTO $dto);
    public function delete(int $id);
    public function restore(int $id);
}
