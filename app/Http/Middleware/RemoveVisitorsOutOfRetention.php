<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Cache;

class RemoveVisitorsOutOfRetention
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (config('app.supervisor') === false) {
            Cache::remember('manual-visitor-remove', now()->secondsUntilEndOfDay(), function() {
                Artisan::call('visitors:remove-old');
            });
        }
        return $next($request);
    }
}
