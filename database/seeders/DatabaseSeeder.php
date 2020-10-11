<?php

namespace Database\Seeders;

use App\Models\{User, Venue};
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
            User::factory()->create(
                [
                    'name' => 'Test user',
                    'email' => 'example@example.dev',
                    'password' => Hash::make('password')
                ]
            );

            Venue::factory()->hasVisitors(50)->create(
                [
                    'name' => 'Some pub',
                    'active' => true
                ]
            );

            Venue::factory(50)->hasVisitors(50)->create();
        }
    }
}
