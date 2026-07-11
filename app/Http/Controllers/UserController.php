<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\UserService;
use App\DTOs\User\CreateUserDTO;
use App\DTOs\User\UpdateUserDTO;
use App\Http\Requests\user\StoreUserRequest;
use App\Http\Requests\user\UpdateUserRequest;

class UserController extends Controller
{
    public function __construct(protected UserService $service) {}

    public function index()
    {
        return view("admin.users.index");
    }

    public function getAll()
    {
        return response()->json($this->service->getAll());
    }

    public function getAllTrashed()
    {
        return response()->json($this->service->getAllTrashed());
    }

    public function findById(int $id)
    {
        return response()->json($this->service->findById($id));
    }

    public function generateUsername(int $id)
    {
        return response()->json($this->service->findById($id));
    }

    public function store(StoreUserRequest $request)
    {
        $data = $request->validated();
        $dto = new CreateUserDTO($data);
        return response()->json($this->service->create($dto));
    }

    public function update(UpdateUserRequest $request, int $id)
    {
        $data = $request->validated();
        $data['id'] = $id;
        $dto = new UpdateUserDTO($data);
        return response()->json($this->service->update($dto));
    }

    public function delete(int $id)
    {
        $this->service->delete($id);
        return response()->json(['message' => 'User deleted successfully.']);
    }

    public function restore(int $id)
    {
        $this->service->restore($id);
        return response()->json(['message' => 'User restored successfully.']);
    }
}
