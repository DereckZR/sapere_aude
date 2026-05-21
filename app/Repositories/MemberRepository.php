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
        $newMember = Member::create((array) $dto);

        if ($dto->cycle_id !== null) {
            $newMember->cycles()->attach($dto->cycle_id);
        }

        return $newMember;
    }

    public function update(UpdateMemberDTO $dto)
    {
        $member = Member::findOrFail($dto->id);
        $member->update((array) $dto);
        return $member;
    }

    public function delete(int $id)
    {
        $member = Member::findOrFail($id);
        $member->delete();
    }

    public function restore(int $id)
    {
        $member = Member::withTrashed()->findOrFail($id);
        $member->restore();
    }
}
