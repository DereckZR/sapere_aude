<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Services\CycleService;

class StoreMemberRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'first_name' => [
                'required',
                'string',
                'max:255'
            ],

            'last_name' => [
                'required',
                'string',
                'max:255'
            ],

            'career' => [
                'required',
                'string',
                'max:255'
            ],

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

            'admission_cycle_id' => [
                'required',
                'integer',
                'exists:cycles,id'
            ],

            'last_active_cycle_id' => [
                'required',
                'integer',
                'exists:cycles,id',
            ],
        ];
    }

    public function messages(): array
    {
        return [
            '*.required' => 'Este campo es obligatorio.',
            '*.string' => 'Este campo debe ser una cadena de texto.',
            '*.integer' => 'Este campo debe ser un número entero.',
            '*.max' => 'El valor ingresado excede el límite permitido.',

            'phone_number.regex' =>
            'El número de teléfono no tiene un formato válido.',

            'phone_number.min' =>
            'El número de teléfono debe tener al menos 8 caracteres.',

            'birth_date.after' =>
            'La fecha de nacimiento debe ser posterior a 01-01-1900.',

            'birth_date.before_or_equal' =>
            'Debe tener al menos 12 años de edad.',

            'admission_cycle_id.exists' =>
            'El ciclo de ingreso seleccionado no existe.',

            'last_active_cycle_id.exists' =>
            'El ciclo de última actividad seleccionado no existe.',
        ];
    }

    /**
     * @param mixed $validator
     * @return void
     */
    public function withValidator($validator): void
    {
        $validator->after(function ($validator) {

            $cycleService = app(CycleService::class);

            $admissionCycle = $cycleService->findById(
                $this->admission_cycle_id
            );

            $lastActiveCycle = $cycleService->findById(
                $this->last_active_cycle_id
            );

            if (
                $admissionCycle &&
                $lastActiveCycle &&
                $lastActiveCycle->start_date < $admissionCycle->start_date
            ) {
                $validator->errors()->add(
                    'last_active_cycle_id',
                    'El ciclo de última actividad debe ser igual o posterior al ciclo de ingreso.'
                );
            }
        });
    }
}
