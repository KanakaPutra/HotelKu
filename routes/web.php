<?php

use Illuminate\Support\Facades\Route;
use App\Models\Hotel;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\RoomController;
use App\Http\Controllers\BookingController; // ✅ TAMBAHAN PENTING

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// === HALAMAN UTAMA (UMUM) ===
Route::get('/', fn() => view('welcome'))->name('landing');

Route::get('/hotels', fn() => view('hotels'))->name('home');
Route::get('/hotels/{hotel}', fn(Hotel $hotel) => view('hotel-details', ['hotelId' => $hotel->id]))->name('hotels.show');


// === RUTE UNTUK PENGGUNA LOGIN ===
Route::middleware('auth')->group(function () {
    Route::get('/my-bookings', [BookingController::class, 'myBookings'])->name('bookings.index');
    Route::view('/dashboard', 'dashboard')->name('dashboard');
    Route::view('/profile', 'profile')->name('profile');
});


// === RUTE KHUSUS ADMIN (VERSI BARU & BERSIH) ===
Route::middleware(['auth', 'admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::redirect('/action', '/admin/dashboard', 301);
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

        Route::resource('hotels', AdminController::class)->except(['show']);
        Route::resource('hotels.rooms', RoomController::class)->except(['show']);
    });


// === RUTE AUTENTIKASI ===
require __DIR__ . '/auth.php';
