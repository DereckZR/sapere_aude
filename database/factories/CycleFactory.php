<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CycleFactory extends Factory
{
    public function definition(): array
    {
        return [
            'start_date' => fake()->date(),
            'end_date' => fake()->date(),
        ];
    }
}
