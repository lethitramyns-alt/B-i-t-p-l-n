<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use App\Models\Destination;
use Illuminate\Http\Request;

class FavoriteController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $favorites = auth()->user()->favoriteDestinations()
            ->with(['region', 'destinationType'])
            ->paginate(12);

        return view('favorites.index', compact('favorites'));
    }

    public function toggle(Request $request, $destinationId)
    {
        $destination = Destination::findOrFail($destinationId);
        $userId = auth()->id();

        $existing = Favorite::where('user_id', $userId)
            ->where('destination_id', $destinationId)
            ->first();

        if ($existing) {
            $existing->delete();
            $isFavorited = false;
            $message = 'Đã xóa khỏi danh sách yêu thích.';
        } else {
            Favorite::create([
                'user_id' => $userId,
                'destination_id' => $destinationId,
            ]);
            $isFavorited = true;
            $message = 'Đã lưu vào danh sách yêu thích!';
        }

        if ($request->expectsJson()) {
            return response()->json([
                'favorited' => $isFavorited,
                'message' => $message,
                'count' => $destination->favorites()->count(),
            ]);
        }

        return back()->with('success', $message);
    }
}
