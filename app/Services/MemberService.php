<?php

namespace App\Services;

use App\DTOs\Member\CreateMemberDTO;
use App\DTOs\Member\UpdateMemberDTO;
use App\Repositories\Interfaces\MemberRepositoryInterface;

class MemberService
{
    public function __construct(
        protected MemberRepositoryInterface $repository,
        protected TableActionService $tableActionService
    ) {}

    public function getAll()
    {
        return $this->repository->getAll();
    }

    public function getAllTrashed()
    {
        return  $this->repository->getAllTrashed();
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

    public function renderActions(int $id, bool $trashed = false)
    {
        $actions = [];
        $actions[] = $this->tableActionService->show(
            $id,
            route('members.findById', ['id' => $id])
        );

        if ($trashed) {
            $actions[] = $this->tableActionService->restore(
                $id,
                route('members.restore', ['id' => $id])
            );
        } else {
            $actions[] = $this->tableActionService->edit(
                $id,
                route('members.findById', ['id' => $id])
            );
            $actions[] = $this->tableActionService->delete(
                $id,
                route('members.delete', ['id' => $id])
            );
        }
        return $actions;
    }
}
