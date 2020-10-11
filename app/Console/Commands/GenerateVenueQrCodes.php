<?php

namespace App\Console\Commands;

use App\Models\Venue;
use BaconQrCode\Renderer\Image\SvgImageBackEnd;
use BaconQrCode\Renderer\ImageRenderer;
use BaconQrCode\Renderer\RendererStyle\RendererStyle;
use BaconQrCode\Writer;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class GenerateVenueQrCodes extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'venue:generate-qr';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generates the QR codes for all venues';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->venues = Venue::all();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
//        if (!is_dir(storage_path('app/public/venues'))) {
//            try {
//                Storage::makeDirectory(storage_path('app/public/venues'));
//            } catch (\Exception $e) {
//                $this->info($e->getMessage());
//            }
//        }
        $bar = $this->output->createProgressBar($this->venues->count());
        $bar->start();
        $this->venues->each(
            function ($venue) use ($bar) {
                $renderer = new ImageRenderer(
                    new RendererStyle(400),
                    new SvgImageBackEnd()
                );
                $writer = new Writer($renderer);
                $writer->writeFile(route('index.venue', $venue), storage_path('app/public/venues/' . $venue->slug . '.svg'));
                $bar->advance();
            }
        );
        $bar->finish();
        return 0;
    }
}
