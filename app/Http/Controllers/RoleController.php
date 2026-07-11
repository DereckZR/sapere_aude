<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\RoleService;
use App\DTOs\Role\CreateRoleDTO;
use App\DTOs\Role\UpdateRoleDTO;

class RoleController extends Controller
{
    public function __construct(protected RoleService $service) {}

    public function index()
    {
        // Implement index method if needed
    }

    public function getAll()
    {
        return response()->json($this->service->getAll());
    }

    public function getAllTrashed()
    {
        return response()->json($this->service->getAllTrashed());
    }

    public function getAllForSelect()
    {
        return response()->json($this->service->getAllForSelect());
    }

    public function findById(int $id)
    {
        return response()->json($this->service->findById($id));
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $dto = new CreateRoleDTO($data);
        return response()->json($this->service->create($dto));
    }

    public function update(Request $request, int $id)
    {
        $data = $request->all();
        $data['id'] = $id;
        $dto = new UpdateRoleDTO($data);
        return response()->json($this->service->update($dto));
    }

    public function delete(int $id)
    {
        $this->service->delete($id);
        return response()->json(['message' => 'Role deleted successfully.']);
    }

    public function restore(int $id)
    {
        $this->service->restore($id);
        return response()->json(['message' => 'Role restored successfully.']);
    }
}
