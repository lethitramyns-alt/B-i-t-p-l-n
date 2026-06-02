<?php

namespace App\Http\Controllers;

use App\Models\Destination;
use App\Models\Region;
use App\Models\DestinationType;
use Illuminate\Http\Request;

class DestinationController extends Controller
{
    public function index(Request $request)
    {
        $query = Destination::with(['region', 'destinationType'])->popular();

        if ($request->filled('search')) {
            $query->search($request->search);
        }

        if ($request->filled('region')) {
            $query->where('region_id', $request->region);
        }

        if ($request->filled('type')) {
            $query->where('destination_type_id', $request->type);
        }

        $destinations = $query->paginate(12)->withQueryString();
        $regions = Region::all();
        $types = DestinationType::all();

        return view('destinations.index', compact('destinations', 'regions', 'types'));
    }

    public function show($slug)
    {
        $destination = Destination::with(['region', 'destinationType'])
            ->where('slug', $slug)
            ->firstOrFail();

        // Tăng lượt xem
        $destination->increment('popularity');

        $related = $destination->getRelated(4);

        $isFavorited = false;
        if (auth()->check()) {
            $isFavorited = $destination->isFavoritedBy(auth()->id());
        }

        return view('destinations.show', compact('destination', 'related', 'isFavorited'));
    }
}
