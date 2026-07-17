<?php

namespace App\Http\Requests\transactionCategory;

use Illuminate\Validation\Rule;

class UpdateTransactionCategoryRequest extends BaseTransactionCategoryRequest
{
    public function rules(): array
    {
        $rules = parent::rules();
        $transactionCategoryId = $this->route('id');

        $uniqueTransactionCategoryName = Rule::unique('transaction_categories', 'name');

        if ($transactionCategoryId !== null) {
            $uniqueTransactionCategoryName->ignore($transactionCategoryId);
        }

        $rules['name'] = [
            'required',
            'string',
            'max:255',
            $uniqueTransactionCategoryName,
        ];

        $rules['type'] = [
            'nullable',
        ];

        return $rules;
    }
}
