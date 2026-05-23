<?php

namespace App\Http\Requests\member;

use Illuminate\Validation\Rule;

class UpdateMemberRequest extends BaseMemberRequest
{
    public function rules(): array
    {
        $rules = parent::rules();
        $memberId = $this->route('id');

        $uniqueDocumentNumber = Rule::unique('members', 'document_number');

        if ($memberId !== null) {
            $uniqueDocumentNumber->ignore($memberId);
        }

        $rules['document_number'] = [
            'required',
            'string',
            'size:7',
            $uniqueDocumentNumber,
        ];

        return $rules;
    }
}
