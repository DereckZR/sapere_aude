<?php

namespace App\Http\Requests\transactionCategory;

class UpdateTransactionCategoryRequest extends BaseTransactionCategoryRequest
{
    public function rules(): array
    {
        $rules = parent::rules();

        $rules['type'] = [
            'nulleable',
        ];

        return $rules;
    }
}
