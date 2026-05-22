<?php

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Cycle;
use App\Models\Member;

class MemberValidationTest extends TestCase
{
    use RefreshDatabase;

    public function test_create_member_with_null_required_fields(): void
    {
        $response = $this->post('/members', [
            'document_number' => null,
            'first_name' => null,
            'last_name' => null,
            'career' => null,
            'phone_number' => null,
            'birth_date' => null,
        ]);

        $response->assertSessionHasErrors([
            'document_number',
            'first_name',
            'last_name',
            'career',
            'phone_number',
            'birth_date',
        ]);
    }

    public function test_create_member_with_existing_document_number(): void
    {
        Member::factory()->create([
            'document_number' => '9100777',
        ]);

        $memberData = Member::factory()->make([
            'document_number' => '9100777',
        ])->toArray();

        $response = $this->post('/members', $memberData);

        $response->assertSessionHasErrors([
            'document_number'
        ]);
    }

    public function test_create_member_with_cycle_id(): void
    {
        $cycle = Cycle::factory()->create();

        $memberData = Member::factory()->make()->toArray();

        $memberData['cycle_id'] = $cycle->id;

        $response = $this->post('/members', $memberData);

        $response->assertSessionHasNoErrors();

        $this->assertDatabaseHas('members', [
            'document_number' => $memberData['document_number'],
        ]);

        $member = Member::query()->where('document_number', $memberData['document_number'])->first();

        $this->assertDatabaseHas('cycle_members', [
            'cycle_id' => $cycle->id,
            'member_id' => $member->id,
        ]);
    }
}
