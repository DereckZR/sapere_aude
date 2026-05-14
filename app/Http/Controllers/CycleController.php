<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\CycleService;
use App\DTOs\Cycle\CreateCycleDTO;
use App\DTOs\Cycle\UpdateCycleDTO;
use App\Http\Requests\cycle\StoreCycleRequest;
use App\Http\Requests\cycle\UpdateCycleRequest;

class CycleController extends Controller
{
    public function __construct(protected CycleService $service) {}

    public function index()
    {
        return view('admin.cycles.index');
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

    public function store(StoreCycleRequest $request)
    {
        $data = $request->validated();
        $dto = new CreateCycleDTO($data);
        return response()->json($this->service->create($dto));
    }

    public function update(UpdateCycleRequest $request, int $id)
    {
        $data = $request->validated();
        $data['id'] = $id;
        $dto = new UpdateCycleDTO($data);
        return response()->json($this->service->update($dto));
    }

    public function delete(int $id)
    {
        $this->service->delete($id);
        return response()->json(['message' => 'Cycle deleted successfully.']);
    }

    public function restore(int $id)
    {
        $this->service->restore($id);
        return response()->json(['message' => 'Cycle restored successfully.']);
    }
}
