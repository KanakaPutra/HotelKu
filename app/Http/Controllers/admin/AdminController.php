<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Hotel;
use App\Models\Room;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    /**
     * ==========================================================
     * METODE UNTUK DASHBOARD
     * ==========================================================
     */

    /**
     * Dashboard admin untuk menampilkan ringkasan data sistem.
     */
    public function dashboard()
    {
        // Hitung total pendapatan dari booking yang sudah dikonfirmasi
        $totalRevenue = DB::table('bookings')
            ->join('rooms', 'bookings.room_id', '=', 'rooms.id')
            ->where('bookings.status', 'confirmed')
            ->sum('rooms.price_per_night');

        // Hitung total semua booking
        $totalBookings = Booking::count();

        // Hitung jumlah user/tamu baru dalam 30 hari terakhir (FILTER ROLE DIHAPUS)
        $newGuests = User::whereDate('created_at', '>=', now()->subMonth())->count();

        // Hitung tingkat okupansi kamar (berapa % kamar yang terisi)
        $totalRooms = max(Room::count(), 1); // untuk menghindari pembagian 0
        $occupiedRooms = Booking::where('status', 'confirmed')
            ->whereDate('check_in_date', '<=', now())
            ->whereDate('check_out_date', '>', now())
            ->distinct()
            ->count('room_id');
            
        $occupancyRate = round(($occupiedRooms / $totalRooms) * 100, 2);

        // Ambil 5 booking terbaru
        $recentBookings = Booking::with(['user', 'room.hotel'])
            ->latest()
            ->take(5)
            ->get();

        // Kirim data ke view dashboard admin
        return view('admin.dashboard', compact(
            'totalRevenue',
            'totalBookings',
            'newGuests',
            'occupancyRate',
            'recentBookings'
        ));
    }

    /**
     * ==========================================================
     * METODE UNTUK CRUD HOTEL (SUDAH DIPERBARUI)
     * ==========================================================
     */

    /**
     * Menampilkan daftar semua hotel (Manage Hotels).
     */
    public function index()
    {
        $hotels = Hotel::withCount('rooms')->latest()->paginate(10);
        return view('admin.hotels.index', compact('hotels'));
    }

    /**
     * Menampilkan form untuk membuat hotel baru.
     */
    public function create()
    {
        return view('admin.hotels.create');
    }

    /**
     * Menyimpan hotel baru ke database.
     */
    public function store(Request $request)
    {
        // Validasi disesuaikan dengan nama kolom database Anda
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255', // Diubah dari 'location'
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            // Path gambar disimpan ke 'image_path' sesuai nama kolom DB
            $validated['image_path'] = $request->file('image')->store('hotels', 'public');
        }

        // Hapus key 'image' karena tidak ada di database
        unset($validated['image']);
        
        Hotel::create($validated);

        return redirect()->route('admin.hotels.index')->with('success', 'Hotel berhasil ditambahkan.');
    }

    /**
     * Menampilkan form untuk mengedit hotel.
     */
    public function edit(Hotel $hotel)
    {
        return view('admin.hotels.edit', compact('hotel'));
    }

    /**
     * Memperbarui data hotel di database.
     */
    public function update(Request $request, Hotel $hotel)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255', // Diubah dari 'location'
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            // Hapus gambar lama, periksa 'image_path'
            if ($hotel->image_path) {
                Storage::disk('public')->delete($hotel->image_path);
            }
            // Simpan gambar baru ke 'image_path'
            $validated['image_path'] = $request->file('image')->store('hotels', 'public');
        }

        // Hapus key 'image' sebelum update
        unset($validated['image']);

        $hotel->update($validated);

        return redirect()->route('admin.hotels.index')->with('success', 'Hotel berhasil diperbarui.');
    }

    /**
     * Menghapus hotel dari database.
     */
    public function destroy(Hotel $hotel)
    {
        // Hapus gambar, periksa 'image_path'
        if ($hotel->image_path) {
            Storage::disk('public')->delete($hotel->image_path);
        }
        $hotel->delete();
        return redirect()->route('admin.hotels.index')->with('success', 'Hotel berhasil dihapus.');
    }
}

