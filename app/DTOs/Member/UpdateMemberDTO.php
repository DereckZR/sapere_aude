<?php

namespace App\DTOs\Member;

class UpdateMemberDTO
{
    public int $id;
    public string $document_number;
    public string $first_name;
    public string $last_name;
    public string $career;
    public string $phone_number;
    public string $birth_date;

    public function __construct(
        public readonly array $data
    ) {
        $this->id = $data['id'];
        $this->document_number = $data['document_number'];
        $this->first_name = $data['first_name'];
        $this->last_name = $data['last_name'];
        $this->career = $data['career'];
        $this->phone_number = $data['phone_number'];
        $this->birth_date = $data['birth_date'];
    }
}
