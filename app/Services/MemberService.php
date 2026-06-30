<?php

namespace App\Services;

use App\DTOs\Member\CreateMemberDTO;
use App\DTOs\Member\UpdateMemberDTO;
use App\Repositories\Interfaces\MemberRepositoryInterface;
use Illuminate\Validation\ValidationException;

class MemberService
{
    public function __construct(
        protected MemberRepositoryInterface $repository,
        protected TableActionService $tableActionService
    ) {}

    public function getAll()
    {
        $members = $this->repository->getAll();
        $members->each(function ($member) {
            $member->actions = $this->tableActionService->renderActions(
                $member->id,
                'members',
                false,
                true
            );
        });
        return $members;
    }

    public function getAllTrashed()
    {
        $members = $this->repository->getAllTrashed();
        $members->each(function ($member) {
            $member->actions = $this->tableActionService->renderActions(
                $member->id,
                'members',
                $member->trashed(),
                true
            );
        });
        return $members;
    }

    public function getAllForSelect()
    {
        $members = $this->repository->getAll();

        if ($members->isEmpty()) {
            throw ValidationException::withMessages(['members' => 'No hay miembros disponibles. Por favor, agregué un miembro antes de registrar un usuario.']);
        }

        return $members->map(function ($member, $_) {
            $text = "$member->document_number - $member->first_name $member->last_name";

            return [
                'id' => $member->id,
                'text' => $text
            ];
        });
    }

    public function findById(int $id)
    {
        return $this->repository->findById($id);
    }

    public function create(CreateMemberDTO $dto)
    {
        return $this->repository->create($dto);
    }

    public function update(UpdateMemberDTO $dto)
    {
        return $this->repository->update($dto);
    }

    public function delete(int $id)
    {
        return $this->repository->delete($id);
    }

    public function restore(int $id)
    {
        return $this->repository->restore($id);
    }
}
