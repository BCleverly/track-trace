<?php

namespace App\Http\Controllers;

use App\Http\Requests\LogoUploadRequest;
use App\Models\Venue;
use App\Models\Visitor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;

class DashboardController extends Controller
{
    public function index()
    {
        $totalVisitors = Cache::remember(
            'totalVisitors',
            60,
            function () {
                return Visitor::where('created_at', '>=', now()->startOfDay())->where(
                    'created_at',
                    '<=',
                    now()->endOfDay()
                )->count();
            }
        );
        $popularVenue = Cache::remember(
            'popularVenue',
            60,
            function () {
                return Venue::withCount('visitors')
                    ->orderBy('visitors_count', 'desc')
                    ->first();
            }
        );
        return view('dashboard', compact('totalVisitors', 'popularVenue'));
    }

    public function uploadLogo(LogoUploadRequest $request)
    {
        $request->file('logo')->storePubliclyAs('public', 'logo.' . $request->file('logo')->getClientOriginalExtension());
        return response()->redirectToRoute('dashboard.index')->with('status', 'Logo uploaded.');
    }

    public function deleteLogo(Request $request)
    {
        $status = Storage::disk('public')->delete('logo.png');
        return response()->redirectToRoute('dashboard.index')->with('status', 'Logo deleted.');
    }
}
