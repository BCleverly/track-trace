<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Models\Venue;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class CreateVenue extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'venue:create {name? : Name of the Venue} {active=n : Is the venue active or not - false by default}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creates a venue';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        if ($this->argument('name') === null) {
            $name = $this->ask('What is the Venue name?');
        }

        $venue = Venue::factory()->create(
            [
                'name' => $this->argument('name') ?? $name,
                'active' => strtolower($this->argument('active')) === 'y',
            ]
        );

        if ($venue !== null) {
            $this->info('Venue created!');
        } else {
            $this->error('Something went wrong...!');
        }

        return 0;
    }
}
