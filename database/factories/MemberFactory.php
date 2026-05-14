<?php

namespace Database\Factories;

use App\Models\Member;
use Illuminate\Database\Eloquent\Factories\Factory;

class MemberFactory extends Factory
{
    public function definition(): array
    {
        return [
            'first_name' => fake()->firstName(),
            'last_name' => fake()->lastName(),
            'career' => fake()->word(),
            'phone_number' => fake()->phoneNumber(),
            'birth_date' => fake()->date(),
            'admission_cycle_id' => null,
            'last_active_cycle_id' => null,
        ];
    }
}
