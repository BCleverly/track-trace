<?php

namespace App\Http\Livewire\Visitor;

use App\Models\Venue;
use App\Models\Visitor;
use Carbon\Carbon;
use Livewire\Component;

class Export extends Component
{
    public $visitDate = '';

    public $visitors = [];

    public $visitor;

    public $venues;

    public $venue;

    public $exportType = 'csv';

    public $exportTypes = [
        'csv',
        'json',
        'xml'
    ];

    protected $listeners = [
        'getVisitors',
        'getSeedList'
    ];

    public $seedList = [];

    public function mount()
    {
        $this->visitDate = now()->format('d-m-y');
        $this->getVenues();
    }

    public function render()
    {
        return view('livewire.visitor.export');
    }

    /**
     * Gets visitors based on provided venue and date
     *
     * @return $this
     */
    public function getVisitors()
    {

        $date = Carbon::createFromFormat('d-m-y', $this->visitDate);

        $this->visitors = Visitor::where(
            [
                ['created_at', '>=', $date->setTime(0, 0, 0)->format('Y-m-d H:i:s')],
                ['created_at', '<=', $date->endOfDay()],
                ['venue_id', $this->venue ?? 0]
            ]
        )->get();

        return $this;
    }

    public function getSeedList()
    {
        $visitor = Visitor::find($this->visitor);
        $venue = Venue::find($this->venue);
        $date = new Carbon($visitor->created_at);

        $this->seedList = Visitor::where(
            [
                ['created_at', '>=', $visitor->created_at],
                ['created_at', '<=', $date->addMinutes($visitor->duration_of_stay)],
                ['venue_id', $venue->id],
                ['id', '!=', $visitor->id]
            ]
        )->get();

    }

    /**
     * Populates all venues
     *
     * @return $this
     */
    public function getVenues()
    {
        $this->venues = Venue::all();
        return $this;
    }

    public function exportList()
    {
        dump('hello world');
    }
}
