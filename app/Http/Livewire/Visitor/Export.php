<?php

namespace App\Http\Livewire\Visitor;

use App\Models\Venue;
use App\Models\Visitor;
use Carbon\Carbon;
use League\Csv\Writer;
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
        'getVisitorList'
    ];

    /**
     * @var mixed
     */
    public $visitorList;

    public function mount()
    {
        $this->visitDate = now()->format('d-m-y');
        $this->getVenues();
        $this->visitorList = collect();
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

    public function getVisitorList()
    {
        $visitor = Visitor::find($this->visitor);
        $venue = Venue::find($this->venue);

        $this->visitorList = Visitor::where(
            [
                ['created_at', '>=', $visitor->created_at],
                ['created_at', '<=', $visitor->created_at->addMinutes($visitor->duration_of_stay)],
                ['venue_id', $venue->id],
                ['id', '!=', $visitor->id]
            ]
        )->with(
            [
                'venue' => function ($query) {
                    $query->select('id', 'name');
                }
            ]
        )->get();

        $pastVisitors = Visitor::where(
            [
                ['created_at', '<=', $visitor->created_at],
                ['venue_id', $venue->id],
                ['id', '!=', $visitor->id],
            ]
        )->with('venue')->get()->filter(
            function ($pastVisitor) use ($visitor) {
                return $pastVisitor->created_at->addMinutes($pastVisitor->duration_of_stay) >= $visitor->created_at;
            }
        );

        $this->visitorList->merge($pastVisitors);
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

    public function export()
    {
        $this->getVisitorList();
        if ($this->exportType === 'csv') {
            return $this->exportAsCsv();
        }
        if ($this->exportType === 'json') {
            return $this->exportAsJson();
        }
    }

    private function exportAsCsv()
    {
        $csv = Writer::createFromString();

        $csv->insertAll(
            $this->visitorList->reduce(
                function ($data, $visitor) {
                    $data[] = [
                        $visitor->email,
                        $visitor->phone,
                        $visitor->postcode,
                        $visitor->created_at,
                        $visitor->venue->name
                    ];
                    return $data;
                },
                [['email', 'phone', 'postcode', 'created_at', 'venue']]
            )
        );

        return response()->streamDownload(
            function () use ($csv) {
                echo (string)$csv;
            },
            'export.csv'
        );
    }

    private function exportAsJson()
    {

        return response()->streamDownload(
            function () {
                echo (string)$this->visitorList->map->only(['email', 'phone', 'postcode', 'created_at', 'venue:name']);
            },
            'export.json'
        );
    }
}
