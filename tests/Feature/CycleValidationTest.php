<?php

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Cycle;

class CycleValidationTest extends TestCase
{
    use RefreshDatabase;

    public function test_start_date_cannot_be_after_end_date(): void
    {
        $cycle = Cycle::factory()->create([
            'start_date' => '2025-01-01',
            'end_date' => '2024-01-01',
        ])->toArray();

        $response = $this->post('/cycles', $cycle);

        $response->assertSessionHasErrors([
            'end_date'
        ]);
    }

    public function test_start_date_can_be_before_end_date(): void
    {
        $cycle = Cycle::factory()->create([
            'start_date' => '2024-01-01',
            'end_date' => '2025-01-01',
        ])->toArray();

        $response = $this->post('/cycles', $cycle);

        $response->assertSessionDoesntHaveErrors();
    }

    public function test_start_date_cannot_be_equal_to_end_date(): void
    {
        $cycle = Cycle::factory()->create([
            'start_date' => '2024-01-01',
            'end_date' => '2024-01-01',
        ])->toArray();

        $response = $this->post('/cycles', $cycle);

        $response->assertSessionHasErrors([
            'end_date'
        ]);
    }
}
