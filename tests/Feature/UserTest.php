<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Str;
use Tests\TestCase;

class UserTest extends TestCase
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
    public function testCanSeeIndex()
    {
        $this->actingAs($this->user)->get(route('dashboard.user.index'))->assertStatus(200);
    }

    public function testCanSeeCreate()
    {
        $this->actingAs($this->user)->get(route('dashboard.user.create'))->assertStatus(200);
    }

    public function testCanCreateUser()
    {
        $this->actingAs($this->user)
            ->post(
                route('dashboard.user.store'),
                [
                    'name' => $this->faker->name,
                    'email' => $this->faker->email,
                    'password' => Str::random(12),
                ]
            )
            ->assertStatus(302)
            ->assertSessionHasNoErrors()
            ->assertSessionDoesntHaveErrors(
                [
                    'name',
                    'email',
                    'password',
                ]
            );
    }

    public function testCanNotBeCreatedWithoutRequiredData()
    {
        $this->actingAs($this->user)
            ->post(
                route('dashboard.user.store'),
                [
                    'email' => $this->faker->email,
                    'password' => Str::random(12),
                ]
            )
            ->assertSessionHasErrors('name');

        $this
            ->post(
                route('dashboard.user.store'),
                [
                    'name' => $this->faker->name,
                    'password' => Str::random(12),
                ]
            )
            ->assertSessionHasErrors('email');

        $this
            ->post(
                route('dashboard.user.store'),
                [
                    'name' => $this->faker->name,
                    'email' => $this->faker->email,
                ]
            )
            ->assertSessionHasErrors('password');
    }

    public function testCanBeDeleted()
    {
        $user = User::factory()->create();

        $this->delete(route('dashboard.user.destroy', $user))->assertStatus(302);
    }
}
