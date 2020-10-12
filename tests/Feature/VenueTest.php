<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Venue;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class VenueTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testCanSeeVenue()
    {
        $this->actingAs($this->user)->get(route('dashboard.venue.index'))->assertStatus(200);
    }

    public function testCanSeeCreate()
    {
        $this->actingAs($this->user)->get(route('dashboard.venue.create'))->assertStatus(200);
    }

    public function testCanSeeEdit()
    {
        $venue = Venue::factory()->create();
        $this->actingAs($this->user)->get(route('dashboard.venue.edit', $venue))->assertStatus(200);
    }

    public function testCanCreateVenue()
    {
        $this->actingAs($this->user)->post(
            route('dashboard.venue.store'),
            [
                'name' => $this->faker->company
            ]
        )->assertStatus(302);

        $this->actingAs($this->user)->post(
            route('dashboard.venue.store'),
            [
                'name' => $this->faker->company,
                'active' => $this->faker->boolean
            ]
        )->assertStatus(302);
    }

    public function testCanUpdateVenueName()
    {
        $venue = Venue::factory()->create();
        $this->actingAs($this->user)->patch(
            route('dashboard.venue.update', $venue),
            [
                'name' => 'new name'
            ]
        )->assertStatus(302);

        $this->assertDatabaseHas(
            'venues',
            [
                'id' => $venue->id,
                'name' => 'new name'
            ]
        );
    }
}
