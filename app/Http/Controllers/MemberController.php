<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\MemberService;
use App\Services\CycleService;
use App\DTOs\Member\CreateMemberDTO;
use App\DTOs\Member\UpdateMemberDTO;

class MemberController extends Controller
{
    public function __construct(
        protected MemberService $service,
        protected CycleService $cycleService
    ) {}

    public function index()
    {
        return view('admin.members.index');
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

    public function store(Request $request)
    {
        $data = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'career' => 'required|string|max:255',
            'phone_number' => [
                'required',
                'regex:/^[0-9+\-\(\)\s]+$/',
                'min:8',
                'max:20'
            ],
            'birth_date' => [
                'required',
                'date',
                'after:1900-01-01',
                'before_or_equal:' . now()->subYears(12)->format('Y-m-d')
            ],
            'admission_cycle_id' => 'required|integer|exists:cycles,id',
            'last_active_cycle_id' => [
                'required',
                'exists:cycles,id',
                'equal_or_after' => function ($attribute, $value, $fail) use ($request) {

                    $admissionCycle = $this->cycleService->findById($request->admission_cycle_id);
                    $lastActiveCycle = $this->cycleService->findById($value);

                    if (
                        $admissionCycle &&
                        $lastActiveCycle &&
                        $lastActiveCycle->start_date < $admissionCycle->start_date
                    ) {
                        $fail('El ciclo de última actividad debe ser igual o posterior al ciclo de ingreso.');
                    }
                },
            ],
        ], [
            'first_name.required' => 'El nombre es obligatorio.',
            'first_name.string' => 'El nombre debe ser una cadena de texto.',
            'first_name.max' => 'El nombre no puede tener más de 255 caracteres.',
            'last_name.required' => 'El apellido es obligatorio.',
            'last_name.string' => 'El apellido debe ser una cadena de texto.',
            'last_name.max' => 'El apellido no puede tener más de 255 caracteres.',
            'career.required' => 'La carrera es obligatoria.',
            'career.string' => 'La carrera debe ser una cadena de texto.',
            'career.max' => 'La carrera no puede tener más de 255 caracteres.',
            'phone_number.required' => 'El número de teléfono es obligatorio.',
            'phone_number.regex' => 'El número de teléfono no tiene un formato válido.',
            'phone_number.min' => 'El número de teléfono debe tener al menos 8 caracteres.',
            'phone_number.max' => 'El número de teléfono no puede tener más de 20 caracteres.',
            'birth_date.required' => 'La fecha de nacimiento es obligatoria.',
            'birth_date.date' => 'La fecha de nacimiento debe ser una fecha válida.',
            'birth_date.after' => 'La fecha de nacimiento debe ser posterior a 01-01-1900.',
            'birth_date.before_or_equal' => 'Debe tener al menos 12 años de edad.',
            'admission_cycle_id.required' => 'El ciclo de ingreso es obligatorio.',
            'admission_cycle_id.exists' => 'El ciclo de ingreso seleccionado no existe.',
            'last_active_cycle_id.required' => 'El ciclo de última actividad es obligatorio.',
            'last_active_cycle_id.exists' => 'El ciclo de última actividad seleccionado no existe.',
            'last_active_cycle_id.equal_or_after' => 'El ciclo de última actividad debe ser igual o posterior al ciclo de ingreso.'
        ]);
        $data['last_active_cycle_id'] = $data['admission_cycle_id'];
        $dto = new CreateMemberDTO($data);
        return response()->json($this->service->create($dto));
    }

    public function update(Request $request, int $id)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:members,email,' . $id,
        ], [
            'name.required' => 'El nombre es obligatorio.',
            'name.string' => 'El nombre debe ser una cadena de texto.',
            'name.max' => 'El nombre no puede tener más de 255 caracteres.',
            'email.required' => 'El correo electrónico es obligatorio.',
            'email.email' => 'El correo electrónico debe ser una dirección de correo válida.',
            'email.unique' => 'El correo electrónico ya está en uso.',
        ]);
        $data['id'] = $id;
        $dto = new UpdateMemberDTO($data);
        return response()->json($this->service->update($dto));
    }

    public function delete(int $id)
    {
        $this->service->delete($id);
        return response()->json(['message' => 'Miembro eliminado correctamente.']);
    }

    public function restore(int $id)
    {
        $this->service->restore($id);
        return response()->json(['message' => 'Miembro restaurado correctamente.']);
    }
}
