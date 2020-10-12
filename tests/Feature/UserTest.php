<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Tests\TestCase;

class UserTest extends TestCase
{
    use WithFaker;

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
    public function testUserCanSeeIndex()
    {
        $this->get(route('dashboard.user.index'))->assertStatus(200);
    }

    public function testUserCanSeeCreate()
    {
        $this->get(route('dashboard.user.create'))->assertStatus(200);
    }

    public function testUserCanCreateUser()
    {
        $this
            ->post(
                route('dashboard.user.store'),
                [
                    'name' => $this->faker->name,
                    'email' => $this->faker->email,
                    'password' => Str::random(12)
                ]
            )
            ->assertStatus(302)
            ->assertSessionHasNoErrors()
            ->assertSessionDoesntHaveErrors(
                [
                    'name',
                    'email',
                    'password'
                ]
            );
    }

    public function testUserCanNotBeCreatedWithoutRequiredData()
    {
        $this
            ->post(
                route('dashboard.user.store'),
                [
                    'email' => $this->faker->email,
                    'password' => Str::random(12)
                ]
            )
            ->assertStatus(204)
            ->assertSessionHasErrors('name');

        $this
            ->post(
                route('dashboard.user.store'),
                [
                    'name' => $this->faker->name,
                    'password' => Str::random(12)
                ]
            )
            ->assertStatus(204)
            ->assertSessionHasErrors('email');

        $this
            ->post(
                route('dashboard.user.store'),
                [
                    'name' => $this->faker->name,
                    'email' => $this->faker->email,
                ]
            )
            ->assertStatus(204)
            ->assertSessionHasErrors('password');
    }
}
