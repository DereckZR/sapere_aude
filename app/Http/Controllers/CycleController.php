<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\CycleService;
use App\DTOs\Cycle\CreateCycleDTO;
use App\DTOs\Cycle\UpdateCycleDTO;

class CycleController extends Controller
{
    public function __construct(protected CycleService $service) {}

    public function index()
    {
        return view('cycles.index');
    }

    public function getAll()
    {
        return response()->json($this->service->getAll());
    }

    public function findById(int $id)
    {
        return response()->json($this->service->findById($id));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
        ], [
            'start_date.required' => 'La fecha de inicio es obligatoria.',
            'start_date.date' => 'La fecha de inicio debe ser una fecha válida.',
            'end_date.required' => 'La fecha de cierre es obligatoria.',
            'end_date.date' => 'La fecha de cierre debe ser una fecha válida.',
            'end_date.after' => 'La fecha de cierre debe ser posterior a la fecha de inicio.',
        ]);
        $dto = new CreateCycleDTO($data);
        return response()->json($this->service->create($dto));
    }

    public function update(Request $request, int $id)
    {
        $data = $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
        ], [
            'start_date.required' => 'La fecha de inicio es obligatoria.',
            'start_date.date' => 'La fecha de inicio debe ser una fecha válida.',
            'end_date.required' => 'La fecha de cierre es obligatoria.',
            'end_date.date' => 'La fecha de cierre debe ser una fecha válida.',
            'end_date.after' => 'La fecha de cierre debe ser posterior a la fecha de inicio.',
        ]);
        $data['id'] = $id;
        $dto = new UpdateCycleDTO($data);
        return response()->json($this->service->update($dto));
    }

    public function destroy(int $id)
    {
        // Implement destroy method if needed
    }
}
