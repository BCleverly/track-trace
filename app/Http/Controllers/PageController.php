<?php

namespace App\Http\Controllers;

use App\Models\Venue;
use BaconQrCode\Renderer\Image\SvgImageBackEnd;
use BaconQrCode\Renderer\ImageRenderer;
use BaconQrCode\Renderer\RendererStyle\RendererStyle;
use BaconQrCode\Writer;

class PageController extends Controller
{
    public function index(Venue $venue = null)
    {
        if (is_file(storage_path('app/public/qrcode.svg')) === false) {
            $this->generateQrCode(config('app.url'), storage_path('app/public/qrcode.svg'));
        }

        /**
         * If the venue is disabled throw a 404
         */
        abort_if($venue && !$venue->active, 404);

        $venues = Venue::active()->get();

        $qrCodePath = $venue !== null ? storage_path('app/public/venues/'.$venue->slug.'.svg') : storage_path(
            'app/public/qrcode.svg'
        );

        $qrPublicPath = $venue !== null ? asset('storage/venues/'.$venue->slug.'.svg') : asset('storage/qrcode.svg');

        return view('welcome', compact('venues', 'venue', 'qrCodePath', 'qrPublicPath'));
    }

    private function generateQrCode($content = '', $filename = 'qrcode.svg')
    {
        $renderer = new ImageRenderer(
            new RendererStyle(400),
            new SvgImageBackEnd()
        );
        $writer = new Writer($renderer);
        $writer->writeFile($content, $filename);
    }
}
