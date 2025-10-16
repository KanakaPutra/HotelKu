<?php

use Illuminate\Support\Facades\Route;
use App\Models\Hotel;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\RoomController; // Diaktifkan

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// === HALAMAN UTAMA (UMUM) ===
Route::get('/', function () {
    return view('welcome');
})->name('landing');

Route::get('/hotels', fn() => view('hotels'))->name('home');
Route::get('/hotels/{hotel}', fn(Hotel $hotel) => view('hotel-details', ['hotelId' => $hotel->id]))->name('hotels.show');


// === RUTE UNTUK PENGGUNA LOGIN ===
Route::middleware('auth')->group(function () {
    Route::get('/my-bookings', fn() => view('my-bookings'))->name('bookings.index');
    Route::view('/dashboard', 'dashboard')->name('dashboard');
    Route::view('/profile', 'profile')->name('profile');
});


// === RUTE KHUSUS ADMIN (VERSI BARU & BERSIH) ===
Route::middleware(['auth', 'admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        // Redirect dari route lama jika masih ada yang mengakses
        Route::redirect('/action', '/admin/dashboard', 301);

        // Rute Dashboard, menunjuk ke method 'dashboard' di AdminController
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

        // Rute CRUD Hotel, menunjuk ke method-method di AdminController
        Route::resource('hotels', AdminController::class)->except(['show']);

        // Rute untuk CRUD Kamar sekarang sudah aktif
        Route::resource('hotels.rooms', RoomController::class)->except(['show']);
    });


// === RUTE AUTENTIKASI ===
require __DIR__ . '/auth.php';

