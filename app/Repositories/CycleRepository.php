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
        return Cycle::create((array) $dto);
    }

    public function update(UpdateCycleDTO $dto)
    {
        $item = Cycle::findOrFail($dto->id);
        $item->update((array) $dto);
        return $item;
    }

    public function delete(int $id)
    {
        $item = Cycle::findOrFail($id);
        $item->delete();
    }

    public function restore(int $id)
    {
        $item = Cycle::withTrashed()->findOrFail($id);
        $item->restore();
    }

    public function hasDateOverlap(string $startDate, string $endDate, ?int $excludeId = null): bool
    {
        return Cycle::where(function ($query) use ($startDate, $endDate, $excludeId) {
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
}
