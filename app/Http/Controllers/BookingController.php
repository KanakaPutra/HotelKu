<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Room;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    /**
     * Menampilkan form booking
     */
    public function create($room_id)
    {
        $room = Room::findOrFail($room_id);
        return view('bookings.create', compact('room'));
    }

    /**
     * Simpan pesanan booking
     */
    public function store(Request $request)
    {
        $request->validate([
            'room_id' => 'required|exists:rooms,id',
            'check_in_date' => 'required|date',
            'check_out_date' => 'required|date|after_or_equal:check_in_date',
            'total_price' => 'required|numeric',
        ]);

        Booking::create([
            'user_id' => Auth::id(),
            'room_id' => $request->room_id,
            'check_in_date' => $request->check_in_date,
            'check_out_date' => $request->check_out_date,
            'total_price' => $request->total_price,
            'payment_method' => $request->payment_method ?? null,
            'status' => 'pending',
        ]);

        return redirect()->route('bookings.index')->with('success', 'Booking berhasil dibuat dan menunggu konfirmasi.');
    }

    /**
     * Menampilkan riwayat booking user yang sedang login
     */
    public function myBookings()
    {
        $bookings = Booking::where('user_id', Auth::id())
                    ->with('room', 'room.hotel')
                    ->latest()
                    ->get();

        return view('my-bookings', compact('bookings'));
    }

    /**
     * ADMIN - Menampilkan semua booking (opsional)
     */
    public function index()
    {
        // Jika ini khusus admin, pastikan pakai middleware admin di route
        $bookings = Booking::with('user', 'room', 'room.hotel')->latest()->get();
        return view('admin.bookings.index', compact('bookings'));
    }

    /**
     * ADMIN - Update status booking (opsional)
     */
    public function updateStatus(Request $request, $id)
    {
        $booking = Booking::findOrFail($id);
        $booking->status = $request->status;
        $booking->save();

        return back()->with('success', 'Status booking berhasil diperbarui.');
    }
}
