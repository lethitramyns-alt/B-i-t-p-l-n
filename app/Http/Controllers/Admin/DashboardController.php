<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Destination;
use App\Models\Region;
use App\Models\DestinationType;
use App\Models\User;
use App\Models\Favorite;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'destinations'  => Destination::count(),
            'regions'       => Region::count(),
            'types'         => DestinationType::count(),
            'users'         => User::where('role', 'user')->count(),
            'favorites'     => Favorite::count(),
            'featured'      => Destination::where('is_featured', true)->count(),
        ];

        // Top 5 điểm đến phổ biến nhất
        $topDestinations = Destination::with('region')
            ->orderBy('popularity', 'desc')
            ->take(5)
            ->get();

        // Thống kê theo khu vực
        $regionStats = Region::withCount('destinations')
            ->orderBy('destinations_count', 'desc')
            ->get();

        // Thống kê theo loại hình
        $typeStats = DestinationType::withCount('destinations')->get();

        // Top yêu thích
        $mostFavorited = Destination::withCount('favorites')
            ->orderBy('favorites_count', 'desc')
            ->take(5)
            ->get();

        // Người dùng mới nhất
        $recentUsers = User::where('role', 'user')
            ->latest()
            ->take(5)
            ->get();

        return view('admin.dashboard', compact(
            'stats', 'topDestinations', 'regionStats', 'typeStats', 'mostFavorited', 'recentUsers'
        ));
    }
}
