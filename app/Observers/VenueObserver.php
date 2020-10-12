<?php

namespace App\Observers;

use App\Models\Venue;
use BaconQrCode\Renderer\Image\SvgImageBackEnd;
use BaconQrCode\Renderer\ImageRenderer;
use BaconQrCode\Renderer\RendererStyle\RendererStyle;
use BaconQrCode\Writer;

class VenueObserver
{
    /**
     * Handle the venue "created" event.
     *
     * @param  \App\Models\Venue  $venue
     * @return void
     */
    public function created(Venue $venue)
    {
        $renderer = new ImageRenderer(
            new RendererStyle(400),
            new SvgImageBackEnd()
        );
        $writer = new Writer($renderer);
        $writer->writeFile(route('index.venue', $venue), storage_path('app/public/venues/'.$venue->slug.'.svg'));
    }

    /**
     * Handle the venue "updated" event.
     *
     * @param  \App\Models\Venue  $venue
     * @return void
     */
    public function updated(Venue $venue)
    {
        //
    }

    /**
     * Handle the venue "deleted" event.
     *
     * @param  \App\Models\Venue  $venue
     * @return void
     */
    public function deleted(Venue $venue)
    {
        //
    }

    /**
     * Handle the venue "restored" event.
     *
     * @param  \App\Models\Venue  $venue
     * @return void
     */
    public function restored(Venue $venue)
    {
        //
    }

    /**
     * Handle the venue "force deleted" event.
     *
     * @param  \App\Models\Venue  $venue
     * @return void
     */
    public function forceDeleted(Venue $venue)
    {
        //
    }
}
