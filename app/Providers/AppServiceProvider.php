<?php

namespace App\Providers;

use App\Models\Venue;
use App\Observers\VenueObserver;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Venue::observe(VenueObserver::class);
    }
}
