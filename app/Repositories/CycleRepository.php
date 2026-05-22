<?php

namespace App\Repositories;

use App\Models\Cycle;
use App\DTOs\Cycle\CreateCycleDTO;
use App\DTOs\Cycle\UpdateCycleDTO;
use App\Repositories\Interfaces\CycleRepositoryInterface;
use Override;

class CycleRepository implements CycleRepositoryInterface
{

    public function getAll()
    {
        return Cycle::orderBy('start_date', 'asc')->get();
    }

    public function getAllTrashed()
    {
        return Cycle::withTrashed()->orderBy('start_date', 'asc')->get();
    }

    public function findById(int $id)
    {
        return Cycle::findOrFail($id);
    }

    public function findTrashedById(int $id)
    {
        return Cycle::onlyTrashed()->findOrFail($id);
    }

    public function create(CreateCycleDTO $dto)
    {
        $cycle = Cycle::create((array) $dto);
        $this->reorderCycleNumber();
        return $cycle;
    }

    public function update(UpdateCycleDTO $dto)
    {
        $cycle = Cycle::findOrFail($dto->id);
        $cycle->update((array) $dto);
        $this->reorderCycleNumber();
        return $cycle;
    }

    public function delete(int $id)
    {
        $cycle = Cycle::findOrFail($id);
        $cycle->cycle_number = null;
        $cycle->save();
        $cycle->delete();
        $this->reorderCycleNumber();
    }

    public function restore(int $id)
    {
        $cycle = Cycle::withTrashed()->findOrFail($id);
        $cycle->restore();
        $this->reorderCycleNumber();
    }

    public function hasDateOverlap(string $startDate, string $endDate, ?int $excludeId = null): bool
    {
        return Cycle::query()->where(function ($query) use ($startDate, $endDate, $excludeId) {
            $query
                ->whereBetween('start_date', [$startDate, $endDate])
                ->orWhereBetween('end_date', [$startDate, $endDate])
                ->orWhere(function ($query) use ($startDate, $endDate) {
                    $query
                        ->where('start_date', '<=', $startDate)
                        ->where('end_date', '>=', $endDate);
                });
        })
            ->when($excludeId, function ($query) use ($excludeId) {
                $query->where('id', '!=', $excludeId);
            })
            ->orWhere('start_date', $endDate)
            ->orWhere('end_date', $startDate)
            ->exists();
    }

    private function reorderCycleNumber(): void
    {
        $cycles = Cycle::orderBy('start_date', 'asc')->get();
        foreach ($cycles as $index => $cycle) {
            $cycle->cycle_number = $index + 1;
            $cycle->save();
        }
    }
}
