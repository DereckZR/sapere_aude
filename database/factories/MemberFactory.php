<?php

namespace Database\Factories;

use App\Models\Member;
use Illuminate\Database\Eloquent\Factories\Factory;

class MemberFactory extends Factory
{
    public function definition(): array
    {
        return [
            'document_number' => fake()->unique()->numerify('#######'),
            'first_name' => fake()->firstName(),
            'last_name' => fake()->lastName(),
            'career' => fake()->words(2, true),
            'phone_number' => fake()->numerify('7#######'),
            'birth_date' => fake()->dateTimeBetween(
                '-60 years',
                '-12 years'
            )->format('Y-m-d'),
        ];
    }
}
