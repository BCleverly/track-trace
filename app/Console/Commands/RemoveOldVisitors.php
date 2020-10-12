<?php

namespace App\Console\Commands;

use App\Models\Visitor;
use Illuminate\Console\Command;

class RemoveOldVisitors extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'visitors:remove-old';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Removes users that are older then the retention period';

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
        $oldVisitors = Visitor::where('created_at', '<=', now()->subDays(config('visitors.retention_period')))->get();
        try {
            $oldVisitors->each->forceDelete();
        } catch (\Exception $e) {
            $this->error('Something went wrong...');
        }
        $this->info('Successfully removed '.$oldVisitors->count().' visitors.');

        return 0;
    }
}
