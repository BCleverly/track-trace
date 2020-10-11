<?php

namespace App\Http\Controllers;

use App\Http\Requests\VenueStoreRequest;
use App\Http\Requests\VenueUpdateRequest;
use App\Models\Venue;
use App\Models\Visitor;
use Carbon\Carbon;
use Illuminate\Http\Request;

class VenueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $venues = Venue::paginate(25);
        return view('venue.index', compact('venues'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('venue.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param VenueStoreRequest $request
     * @return void
     */
    public function store(VenueStoreRequest $request)
    {
        $venue = Venue::create(
            [
                'name' => $request->get('name'),
                'active' => $request->has('active') ?? false
            ]
        );

        return response()->redirectToRoute('dashboard.venue.index')->with('status', 'Venue created.');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Venue $venue
     * @return \Illuminate\Http\Response
     */
    public function show(Venue $venue)
    {
        $visitorDays = Visitor::select('*')
            ->where('venue_id', $venue->id)
            ->orderBy('created_at', 'desc')
            ->get()
            ->groupBy(
                function ($date) {
                    return Carbon::parse($date->created_at)->format('l dS M Y'); // grouping by years
                }
            );
        $visitorsToday = Visitor::todayCount();
        return response()->view('venue.show', compact('venue', 'visitorDays', 'visitorsToday'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Venue $venue
     * @return \Illuminate\Http\Response
     */
    public function edit(Venue $venue)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Venue $venue
     * @return \Illuminate\Http\Response
     */
    public function update(VenueUpdateRequest $request, Venue $venue)
    {
        return response()->redirectToRoute('dashboard.venue.index')->with('status', 'Venue updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Venue $venue
     * @return \Illuminate\Http\Response
     */
    public function destroy(Venue $venue)
    {
        $venue->delete();
        return response()->redirectToRoute('dashboard.venue.index')->with('status', 'Venue deleted.');
    }
}
