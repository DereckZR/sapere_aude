<?php

namespace App\Http\Requests\product;

use Illuminate\Validation\Rule;

class UpdateProductRequest extends BaseProductRequest
{
    public function rules(): array
    {
        $rules = parent::rules();
        $productId = $this->route('id');

        $uniqueProductName = Rule::unique('products', 'name');

        if ($productId !== null) {
            $uniqueProductName->ignore($productId);
        }

        $rules['name'] = [
            'required',
            'string',
            'max:255',
            $uniqueProductName,
        ];

        return $rules;
    }
}
