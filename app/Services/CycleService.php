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
        protected TableActionService $tableActionService,
        protected OrdinalNamesService $ordinalNamesService
    ) {}

    public function getAll()
    {
        $cycles = $this->repository->getAll();
        $cycles->each(function ($cycle) {
            $cycle->actions = $this->tableActionService->renderActions($cycle->id, 'cycles');
        });
        return $cycles;
    }

    public function getAllTrashed()
    {
        $cycles = $this->repository->getAllTrashed();
        $cycles->each(function ($cycle) {
            $cycle->actions = $this->tableActionService->renderActions($cycle->id, 'cycles', $cycle->trashed());
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

        $hasOverlap = $this->hasDateOverlap(
            $ciclo->start_date,
            $ciclo->end_date,
            $id
        );

        if ($hasOverlap) {
            throw ValidationException::withMessages([
                'start_date' => 'Ya existe un ciclo en ese rango de fechas.'
            ]);
        }

        $this->repository->restore($id);
    }

    public function getAllForSelect()
    {
        $cycles = $this->repository->getAll();

        if ($cycles->isEmpty()) {
            throw ValidationException::withMessages([
                'cycles' => 'No hay ciclos disponibles. Por favor, cree un ciclo antes de agregar miembros.'
            ]);
        }

        return $cycles->map(function ($cycle, $index) {
            $startDateFormatted = Carbon::parse($cycle->start_date)->format('d/m/Y');
            $endDateFormatted = Carbon::parse($cycle->end_date)->format('d/m/Y');
            $text = $this->ordinalNamesService->getOrdinalName($index + 1) . ' ciclo: ' . $startDateFormatted . ' - ' . $endDateFormatted;
            return [
                'id' => $cycle->id,
                'text' => $text,
            ];
        });
    }

    public function hasDateOverlap(string $startDate, string $endDate, ?int $excludeId = null): bool
    {
        return $this->repository->hasDateOverlap(
            $startDate,
            $endDate,
            $excludeId
        );
    }
}
