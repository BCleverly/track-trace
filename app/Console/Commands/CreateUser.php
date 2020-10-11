<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class CreateUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:create {name? : The name of the user} {email? : The email of the user} {password? : The password they want}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a user account';

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
            $name = $this->ask('What is the users name?');
        }

        if ($this->argument('email') === null) {
            $email = $this->ask('What is the users email?');
        }

        if ($this->argument('password') === null) {
            $password = $this->secret('What is the users password?');
        }

        $user = User::factory()->create([
            'name' => $this->argument('name') ?? $name,
            'email' => $this->argument('name') ?? $email,
            'password' => Hash::make($this->argument('name') ?? $password),
        ]);

        if ($user !== null) {
            $this->info('User created!');
        } else {
            $this->error('Something went wrong...!');
        }

        return 0;
    }
}
