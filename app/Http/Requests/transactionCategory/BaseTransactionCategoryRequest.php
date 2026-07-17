<?php

namespace App\Http\Requests\transactionCategory;

use Illuminate\Foundation\Http\FormRequest;

class BaseTransactionCategoryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'string',
                'max:255',
            ],
            'description' => [
                'nullable',
                'string',
                'max:1000'
            ],
            'type' => [
                'required',
                'in:in,out',
            ],
        ];
    }

    public function messages(): array
    {
        return [
            '*.required' => 'Este campo es obligatorio.',
            '*.string' => 'Este campo debe ser una cadena de texto.',
            '*.max' => 'El valor ingresado debe ser máximo :max.',

            'type.in' => 'El tipo de movimiento debe ser "ingreso" o "egreso".',
        ];
    }
}
