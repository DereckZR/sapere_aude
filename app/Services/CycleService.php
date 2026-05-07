<?php

namespace App\Services;

use App\DTOs\Cycle\CreateCycleDTO;
use App\DTOs\Cycle\UpdateCycleDTO;
use App\Enums\TableButtonAction;
use App\Repositories\Interfaces\CycleRepositoryInterface;

class CycleService
{
    public function __construct(protected CycleRepositoryInterface $repository) {}

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
            if ($cycle->trashed()) {
                $cycle->actions = $this->renderTrashedActions($cycle->id);
            } else {
                $cycle->actions = $this->renderActions($cycle->id);
            }
        });
        return $cycles;
    }

    public function findById(int $id)
    {
        $cycle = $this->repository->findById($id);
        $cycle->actions = $this->renderActions($cycle->id);
        return $cycle;
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

    public function renderActions(int $id)
    {
        return [
            view('components.table-button', [
                'type' => 'primary',
                'action' => TableButtonAction::EDIT,
                'id' => $id,
                'url' => route('cycles.findById', ['id' => $id]),
                'label' => 'Editar',
            ])->render(),
            view('components.table-button', [
                'type' => 'danger',
                'action' => TableButtonAction::DELETE,
                'id' => $id,
                'url' => route('cycles.delete', ['id' => $id]),
                'label' => 'Eliminar',
            ])->render()
        ];
    }

    public function renderTrashedActions(int $id)
    {
        return [
            view('components.table-button', [
                'type' => 'success',
                'action' => TableButtonAction::RESTORE,
                'id' => $id,
                'url' => route('cycles.restore', ['id' => $id]),
                'label' => 'Restaurar',
            ])->render()
        ];
    }
}
