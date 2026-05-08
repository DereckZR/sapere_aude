<?php

namespace App\DTOs\Member;

class CreateMemberDTO
{
    public string $first_name;
    public string $last_name;
    public string $career;
    public string $phone_number;
    public string $birth_date;
    public int $admission_cycle_id;
    public int $last_active_cycle_id;

    public function __construct(
        public readonly array $data
    ) {
        $this->first_name = $data['first_name'];
        $this->last_name = $data['last_name'];
        $this->career = $data['career'];
        $this->phone_number = $data['phone_number'];
        $this->birth_date = $data['birth_date'];
        $this->admission_cycle_id = $data['admission_cycle_id'];
        $this->last_active_cycle_id = $data['last_active_cycle_id'];
    }
}
