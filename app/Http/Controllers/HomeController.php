<?php

namespace App\Http\Controllers;

use App\Models\Destination;
use App\Models\Region;
use App\Models\DestinationType;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $featured = Destination::with(['region', 'destinationType'])
            ->featured()
            ->popular()
            ->take(6)
            ->get();

        $popular = Destination::with(['region', 'destinationType'])
            ->popular()
            ->take(8)
            ->get();

        $regions = Region::withCount('destinations')->take(6)->get();
        $types = DestinationType::withCount('destinations')->get();

        $stats = [
            'destinations' => Destination::count(),
            'regions' => Region::count(),
            'types' => DestinationType::count(),
        ];

        return view('home', compact('featured', 'popular', 'regions', 'types', 'stats'));
    }
}
