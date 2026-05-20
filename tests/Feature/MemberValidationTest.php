<?php

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Cycle;
use App\Models\Member;

class MemberValidationTest extends TestCase
{
    use RefreshDatabase;

    public function test_last_active_cycle_cannot_be_before_admission_cycle(): void
    {
        $admissionCycle = Cycle::factory()->create([
            'start_date' => '2025-01-01',
        ]);

        $lastActiveCycle = Cycle::factory()->create([
            'start_date' => '2024-01-01',
        ]);

        $memberData = Member::factory()->make([
            'admission_cycle_id' => $admissionCycle->id,
            'last_active_cycle_id' => $lastActiveCycle->id,
        ])->toArray();

        $response = $this->post('/members', $memberData);

        $response->assertSessionHasErrors([
            'last_active_cycle_id'
        ]);
    }

    public function test_last_active_cycle_can_be_after_admission_cycle(): void
    {
        $admissionCycle = Cycle::factory()->create([
            'start_date' => '2024-01-01',
        ]);

        $lastActiveCycle = Cycle::factory()->create([
            'start_date' => '2025-01-01',
        ]);

        $memberData = Member::factory()->make([
            'phone_number' => '1234567890',
            'birth_date' => '2000-01-01',
            'admission_cycle_id' => $admissionCycle->id,
            'last_active_cycle_id' => $lastActiveCycle->id,
        ])->toArray();

        $response = $this->post('/members', $memberData);

        $response->assertSessionDoesntHaveErrors();
    }
}
