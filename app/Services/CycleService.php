<?php

namespace App\Services;

use App\DTOs\Cycle\CreateCycleDTO;
use App\DTOs\Cycle\UpdateCycleDTO;
use App\Repositories\Interfaces\CycleRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Validation\ValidationException;

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
        $ciclo = $this->repository->findTrashedById($id);

        $this->validateCycleDates(
            $ciclo->start_date,
            $ciclo->end_date,
            $id
        );

        $this->repository->restore($id);
    }

    public function getAllForSelect()
    {
        return $this->repository->getAll()->map(function ($cycle) {
            $startDateFormatted = Carbon::parse($cycle->start_date)->format('d/m/Y');
            $endDateFormatted = Carbon::parse($cycle->end_date)->format('d/m/Y');
            return [
                'id' => $cycle->id,
                'text' => $startDateFormatted . ' - ' . $endDateFormatted,
            ];
        });
    }

    protected function renderActions(int $id, bool $trashed = false)
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

    public function validateCycleDates(string $startDate, string $endDate, ?int $excludeId = null): void
    {
        $start = Carbon::parse($startDate);
        $end = Carbon::parse($endDate);

        $duration = $start->diffInDays($end);

        if ($duration < 7) {
            throw ValidationException::withMessages([
                'end_date' => 'El ciclo debe tener una duración mínima de 7 días.'
            ]);
        }

        $hasOverlap = $this->repository->hasDateOverlap(
            $startDate,
            $endDate,
            $excludeId
        );

        if ($hasOverlap) {
            throw ValidationException::withMessages([
                'start_date' => 'Ya existe un ciclo en ese rango de fechas.'
            ]);
        }
    }
}
