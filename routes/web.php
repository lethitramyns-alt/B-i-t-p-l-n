<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DestinationController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\RegionController;
use App\Http\Controllers\Admin\DestinationTypeController;
use App\Http\Controllers\Admin\DestinationController as AdminDestinationController;
use App\Http\Controllers\Admin\UserController;

// Trang chủ
Route::get('/', [HomeController::class, 'index'])->name('home');

// Điểm đến
Route::get('/diem-den', [DestinationController::class, 'index'])->name('destinations.index');
Route::get('/diem-den/{slug}', [DestinationController::class, 'show'])->name('destinations.show');

// Yêu thích (cần đăng nhập)
Route::middleware('auth')->group(function () {
    Route::get('/yeu-thich', [FavoriteController::class, 'index'])->name('favorites.index');
    Route::post('/yeu-thich/{destination}', [FavoriteController::class, 'toggle'])->name('favorites.toggle');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Auth routes
require __DIR__.'/auth.php';

// Admin routes
Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('regions', RegionController::class)->except(['show']);

    Route::resource('types', DestinationTypeController::class)->except(['show']);

    Route::resource('destinations', AdminDestinationController::class);

    Route::resource('users', UserController::class)->only(['index', 'show', 'update', 'destroy']);
});

// Dashboard người dùng sau đăng nhập
Route::get('/dashboard', function () {
    if (auth()->user()->isAdmin()) {
        return redirect()->route('admin.dashboard');
    }
    return redirect()->route('home');
})->middleware(['auth'])->name('dashboard');
