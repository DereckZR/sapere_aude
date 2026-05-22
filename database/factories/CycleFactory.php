<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CycleFactory extends Factory
{
    public function definition(): array
    {
        return [
            'start_date' => fake()->dateTimeBetween(
                '-1 years',
                'now'
            )->format('Y-m-d'),
            'end_date' => fake()->dateTimeBetween(
                'now',
                '+1 years'
            )->format('Y-m-d'),
        ];
    }
}
