<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CreateVenueCommandTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testNoArguments()
    {
        $this->artisan('venue:create')
            ->expectsQuestion('What is the Venue name?', 'A pub')
            ->expectsOutput('Venue created!')
            ->assertExitCode(0);
    }

    public function testWithNameArgument()
    {
        $this->artisan('venue:create "A pub"')
            ->expectsOutput('Venue created!')
            ->assertExitCode(0);

        $this->assertDatabaseHas('venues', [
            'name' => 'A pub',
            'active' => false,
        ]);
    }

    public function testWithActiveFlag()
    {
        $this->artisan('venue:create "A pub" y')
            ->expectsOutput('Venue created!')
            ->assertExitCode(0);

        $this->assertDatabaseHas('venues', [
            'name' => 'A pub',
            'active' => true,
        ]);
    }
}
