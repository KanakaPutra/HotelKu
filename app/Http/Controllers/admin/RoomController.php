<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Hotel;
use App\Models\Room;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    /**
     * Menampilkan daftar kamar untuk hotel tertentu.
     */
    public function index(Hotel $hotel)
    {
        // Ambil kamar yang hanya dimiliki oleh hotel yang sedang dipilih
        $rooms = $hotel->rooms()->latest()->paginate(10);
        return view('admin.rooms.index', compact('hotel', 'rooms'));
    }

    /**
     * Menampilkan form untuk membuat kamar baru.
     */
    public function create(Hotel $hotel)
    {
        return view('admin.rooms.create', compact('hotel'));
    }

    /**
     * Menyimpan kamar baru ke database.
     */
    public function store(Request $request, Hotel $hotel)
    {
        $validated = $request->validate([
            'type' => 'required|string|max:255',
            'description' => 'required|string',
            'price_per_night' => 'required|numeric|min:0',
        ]);

        // Buat kamar baru yang berelasi dengan hotel ini
        $hotel->rooms()->create($validated);

        return redirect()->route('admin.hotels.rooms.index', $hotel)->with('success', 'Kamar berhasil ditambahkan.');
    }

    /**
     * Menampilkan form untuk mengedit kamar.
     */
    public function edit(Hotel $hotel, Room $room)
    {
        return view('admin.rooms.edit', compact('hotel', 'room'));
    }

    /**
     * Memperbarui data kamar di database.
     */
    public function update(Request $request, Hotel $hotel, Room $room)
    {
        $validated = $request->validate([
            'type' => 'required|string|max:255',
            'description' => 'required|string',
            'price_per_night' => 'required|numeric|min:0',
        ]);

        $room->update($validated);

        return redirect()->route('admin.hotels.rooms.index', $hotel)->with('success', 'Kamar berhasil diperbarui.');
    }

    /**
     * Menghapus kamar dari database.
     */
    public function destroy(Hotel $hotel, Room $room)
    {
        $room->delete();
        return redirect()->route('admin.hotels.rooms.index', $hotel)->with('success', 'Kamar berhasil dihapus.');
    }
}