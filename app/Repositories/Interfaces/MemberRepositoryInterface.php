<?php

namespace App\Repositories\Interfaces;

use App\DTOs\Member\CreateMemberDTO;
use App\DTOs\Member\UpdateMemberDTO;

interface MemberRepositoryInterface
{
    public function getAll();
    public function getAllTrashed();
    public function findById(int $id);
    public function create(CreateMemberDTO $dto);
    public function update(UpdateMemberDTO $dto);
    public function delete(int $id);
    public function restore(int $id);
}