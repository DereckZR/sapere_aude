<?php

namespace App\Services;

use App\DTOs\Role\CreateRoleDTO;
use App\DTOs\Role\UpdateRoleDTO;
use App\Repositories\Interfaces\RoleRepositoryInterface;
use Illuminate\Validation\ValidationException;

class RoleService
{
    public function __construct(protected RoleRepositoryInterface $repository) {}

    public function getAll()
    {
        return $this->repository->getAll();
    }

    public function getAllTrashed()
    {
        return  $this->repository->getAllTrashed();
    }

    public function getAllForSelect()
    {
        $roles = $this->repository->getAll();

        if ($roles->isEmpty()) {
            throw ValidationException::withMessages(['roles' => 'No hay roles disponibles']);
        }

        return $roles->map(fn($r, $_) => [
            'id' => $r->id,
            'text' => $r->name
        ]);
    }

    public function findById(int $id)
    {
        return $this->repository->findById($id);
    }

    public function create(CreateRoleDTO $dto)
    {
        return $this->repository->create($dto);
    }

    public function update(UpdateRoleDTO $dto)
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
