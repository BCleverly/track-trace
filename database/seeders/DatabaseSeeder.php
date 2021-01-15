<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Venue;
use App\Models\Visitor;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        if (app()->environment('local')) {
            $this->command->info('Creating test user...');
            User::factory()->create(
                [
                    'name' => 'Test user',
                    'email' => 'example@example.dev',
                    'password' => Hash::make('password'),
                ]
            );

            $this->command->info('Creating test venue with visitors...');
            $venue = Venue::factory()->create(
                [
                    'name' => 'Some pub',
                    'active' => true,
                ]
            );

            $datetime = (new Carbon())->subMinutes(30 * 10);
            Visitor::factory(20)->create(
                [
                    'venue_id' => $venue->id
                ]
            )->each(
                function ($visitor, $key) use ($datetime) {
                    $visitor->update(
                        [
                            'created_at' => $datetime->addMinutes(30 * $key),
                            'duration_of_stay' => 120
                        ]
                    );
                }
            );

            $this->command->info('Seeding random data');
            Venue::factory(5)->hasVisitors(50)->create();
        }
    }
}
