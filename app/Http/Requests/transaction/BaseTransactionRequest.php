<?php

namespace App\Http\Requests\transaction;

use Illuminate\Foundation\Http\FormRequest;

class BaseTransactionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'description' => [
                'nullable',
                'string',
                'max:1000'
            ],
            'amount' => [
                'required',
                'numeric',
                'min:1'
            ],
            'transaction_date' => [
                'required',
                'date',
            ],
            'is_cash' => [
                'required',
                'boolean',
            ],
            'transaction_category_id' => [
                'required',
                'integer',
                'exists:transaction_categories,id'
            ],
            'responsible_member_id' => [
                'required',
                'integer',
                'exists:members,id'
            ],
        ];
    }

    public function messages(): array
    {
        return [
            '*.required' => 'Este campo es obligatorio.',
            '*.string' => 'Este campo debe ser una cadena de texto.',
            '*.integer' => 'Este campo debe ser un número entero.',
            '*.numeric' => 'Este campo debe ser un número.',
            '*.min' => 'El valor ingresado debe ser mínimo :min.',
            '*.max' => 'El valor ingresado debe tener máximo :max caracteres.',

            'type.in' =>
            'El tipo de movimiento debe ser "ingreso" o "egreso".',

            'transaction_category_id.exists' =>
            'La categoría de movimiento seleccionada no existe.',

            'responsible_member_id.exists' =>
            'El miembro responsable seleccionado no existe.',

            'is_cash.boolean' =>
            'El valor de este campo debe ser si o no.',
        ];
    }
}
