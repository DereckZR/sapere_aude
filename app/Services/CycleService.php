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
            $cycle->actions = [
                view('components.table-button', [
                    'type' => 'primary',
                    'action' => TableButtonAction::EDIT,
                    'id' => $cycle->id,
                    'label' => 'Editar',
                ])->render(),
                view('components.table-button', [
                    'type' => 'danger',
                    'action' => TableButtonAction::DELETE,
                    'id' => $cycle->id,
                    'label' => 'Eliminar',
                ])->render()
            ];
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
}
