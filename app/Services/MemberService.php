<?php

namespace App\Services;

use App\DTOs\Member\CreateMemberDTO;
use App\DTOs\Member\UpdateMemberDTO;
use App\Repositories\Interfaces\MemberRepositoryInterface;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use RuntimeException;

class MemberService
{
    public function __construct(
        protected MemberRepositoryInterface $memberRepository,
        protected UserRepositoryInterface $userRepository,
    ) {}

    public function getAll()
    {
        $members = $this->memberRepository->getAll();
        return $members;
    }

    public function getAllTrashed()
    {
        $members = $this->memberRepository->getAllTrashed();
        return $members;
    }

    public function getAllForSelect()
    {
        $members = $this->memberRepository->getAll();

        if ($members->isEmpty()) {
            throw ValidationException::withMessages(['members' => 'No hay miembros disponibles. Por favor, agregué un miembro antes de registrar un usuario.']);
        }

        return $members->map(function ($member, $_) {
            $text = "$member->first_name $member->last_name - $member->document_number";

            return [
                'id' => $member->id,
                'text' => $text
            ];
        });
    }

    public function findById(int $id)
    {
        return $this->memberRepository->findById($id);
    }

    public function create(CreateMemberDTO $dto)
    {
        return $this->memberRepository->create($dto);
    }

    public function update(UpdateMemberDTO $dto)
    {
        return $this->memberRepository->update($dto);
    }

    public function delete(int $id)
    {
        $authUserId = Auth::id();
        $member = $this->memberRepository->findById($id);

        if ($member->user && $member->user->id === $authUserId) {
            throw new RuntimeException('No es posible eliminar al registro de miembro relacionado con TU usuario.');
        }

        return DB::transaction(function () use ($member) {
            if ($member->user) {
                $this->userRepository->delete($member->user->id);
            }

            $this->memberRepository->delete($member->id);
        });
    }

    public function restore(int $id)
    {
        return $this->memberRepository->restore($id);
    }
}
