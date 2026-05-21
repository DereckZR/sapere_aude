<?php

namespace App\Http\Requests\member;

use Illuminate\Foundation\Http\FormRequest;
use App\Services\CycleService;
use Illuminate\Validation\Validator;

class StoreMemberRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'document_number' => [
                'required',
                'string',
                'max:255',
                'unique:members,document_number'
            ],

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

            'cycle_id' => [
                'sometimes',
                'integer',
                'exists:cycles,id'
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

            'document_number.unique' =>
            'El número de carnet de identidad ya está en uso.',

            'phone_number.regex' =>
            'El número de teléfono no tiene un formato válido.',

            'phone_number.min' =>
            'El número de teléfono debe tener al menos 8 caracteres.',

            'birth_date.after' =>
            'La fecha de nacimiento debe ser posterior a 01-01-1900.',

            'birth_date.before_or_equal' =>
            'Debe tener al menos 12 años de edad.',

            'cycle_id.exists' =>
            'El ciclo de ingreso seleccionado no existe.',
        ];
    }
}
