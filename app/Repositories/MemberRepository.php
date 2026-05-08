<?php

namespace App\Repositories;

use App\Models\Member;
use App\DTOs\Member\CreateMemberDTO;
use App\DTOs\Member\UpdateMemberDTO;
use App\Repositories\Interfaces\MemberRepositoryInterface;

class MemberRepository implements MemberRepositoryInterface
{
    public function getAll()
    {
        return Member::all();
    }

    public function getAllTrashed()
    {
        return Member::withTrashed()->get();
    }

    public function findById(int $id)
    {
        return Member::findOrFail($id);
    }

    public function create(CreateMemberDTO $dto)
    {
        return Member::create((array) $dto);
    }

    public function update(UpdateMemberDTO $dto)
    {
        $item = Member::findOrFail($dto->id);
        $item->update((array) $dto);
        return $item;
    }

    public function delete(int $id)
    {
        $item = Member::findOrFail($id);
        $item->delete();
    }

    public function restore(int $id)
    {
        $item = Member::withTrashed()->findOrFail($id);
        $item->restore();
    }
}