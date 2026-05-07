<?php

namespace App\Services;

use App\DTOs\Cycle\CreateCycleDTO;
use App\DTOs\Cycle\UpdateCycleDTO;
use App\Repositories\Interfaces\CycleRepositoryInterface;

class CycleService
{
    public function __construct(
        protected CycleRepositoryInterface $repository,
        protected TableActionService $tableActionService
    ) {}

    public function getAll()
    {
        $cycles = $this->repository->getAll();
        $cycles->each(function ($cycle) {
            $cycle->actions = $this->renderActions($cycle->id);
        });
        return $cycles;
    }

    public function getAllTrashed()
    {
        $cycles = $this->repository->getAllTrashed();
        $cycles->each(function ($cycle) {
            $cycle->actions = $this->renderActions($cycle->id, $cycle->trashed());
        });
        return $cycles;
    }

    public function findById(int $id)
    {
        return $this->repository->findById($id);
    }

    public function create(CreateCycleDTO $dto)
    {
        return $this->repository->create($dto);
    }

    public function update(UpdateCycleDTO $dto)
    {
        return $this->repository->update($dto);
    }

    public function delete(int $id)
    {
        $this->repository->delete($id);
    }

    public function restore(int $id)
    {
        $this->repository->restore($id);
    }

    public function renderActions(int $id, bool $trashed = false)
    {
        $actions = [];

        if ($trashed) {
            $actions[] = $this->tableActionService->restore(
                $id,
                route('cycles.restore', ['id' => $id])
            );
        } else {
            $actions[] = $this->tableActionService->edit(
                $id,
                route('cycles.findById', ['id' => $id])
            );
            $actions[] = $this->tableActionService->delete(
                $id,
                route('cycles.delete', ['id' => $id])
            );
        }
        return $actions;
    }
}
