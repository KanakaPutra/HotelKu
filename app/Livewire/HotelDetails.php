<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Hotel;
use App\Models\Room;
use App\Models\Booking;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class HotelDetails extends Component
{
    public Hotel $hotel;
    public $checkInDate;
    public $checkOutDate;

    // Alur pemesanan
    public $step = 1; // 1 = Pilihan kamar, 2 = Konfirmasi & Pembayaran
    public ?Room $selectedRoom = null;
    public $totalNights = 0;
    public $totalPrice = 0;
    public $selectedPaymentMethod = 'bank_transfer'; // default

    protected $rules = [
        'checkInDate' => 'required|date|after_or_equal:today',
        'checkOutDate' => 'required|date|after:checkInDate'
    ];

    public function mount($hotelId)
    {
        $this->hotel = Hotel::with('rooms')->findOrFail($hotelId);
    }

    /**
     * Langkah 1: Pilih kamar dan isi tanggal
     */
    public function bookRoom(Room $room)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $this->validate();

        $this->selectedRoom = $room;

        // Hitung jumlah malam & total harga
        $checkIn = Carbon::parse($this->checkInDate);
        $checkOut = Carbon::parse($this->checkOutDate);
        $this->totalNights = max($checkOut->diffInDays($checkIn), 1); // minimal 1 malam
        $this->totalPrice = $this->selectedRoom->price_per_night * $this->totalNights;

        // Pindah ke tahap 2 (konfirmasi)
        $this->step = 2;
    }

    /**
     * Langkah 2: Konfirmasi dan simpan pemesanan
     */
    public function confirmBooking()
    {
        if (!$this->selectedRoom || $this->totalNights <= 0 || !Auth::check()) {
            session()->flash('error', 'Terjadi kesalahan. Silakan coba lagi.');
            return;
        }

        // Simpan ke database
        Booking::create([
            'user_id' => Auth::id(),
            'room_id' => $this->selectedRoom->id,
            'check_in_date' => $this->checkInDate,
            'check_out_date' => $this->checkOutDate,
            'total_price' => $this->totalPrice,
            'payment_method' => $this->selectedPaymentMethod,
            'status' => 'success', // langsung success
        ]);

        // Langsung redirect tanpa jeda
        return $this->redirect('/my-bookings', navigate: true);
    }

    public function render()
    {
        return view('livewire.hotel-details');
    }
}
