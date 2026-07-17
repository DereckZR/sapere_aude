<?php

namespace App\Http\Requests\product;

use Illuminate\Foundation\Http\FormRequest;

class BaseProductRequest extends FormRequest
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
                'unique:products,name'
            ],
            'description' => [
                'nullable',
                'string',
                'max:1000'
            ],
            'price' => [
                'required',
                'numeric',
                'min:0'
            ],
            'stock_quantity' => [
                'required',
                'integer',
                'min:0'
            ],
            'author_comission_percentage' => [
                'required',
                'numeric',
                'min:0',
                'max:100'
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
            '*.max' => 'El valor ingresado debe ser máximo :max.',

            'name.unique' =>
            'El nombre del producto ya está en uso.',
        ];
    }
}
