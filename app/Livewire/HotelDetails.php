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

    public $step = 1;
    public ?Room $selectedRoom = null;
    public $totalNights = 0;
    public $totalPrice = 0;

    protected $rules = [
        'checkInDate' => 'required|date|after_or_equal:today',
        'checkOutDate' => 'required|date|after:checkInDate'
    ];

    public function mount($hotelId)
    {
        $this->hotel = Hotel::with('rooms')->findOrFail($hotelId);
    }

    /**
     * Tahap 1: Pilih kamar dan isi tanggal
     */
    public function bookRoom($roomId)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $this->validate();

        $this->selectedRoom = Room::findOrFail($roomId);

        // Hitung jumlah malam dan total harga
        $checkIn = Carbon::parse($this->checkInDate);
        $checkOut = Carbon::parse($this->checkOutDate);
        $this->totalNights = max($checkOut->diffInDays($checkIn), 1);

        $this->totalPrice = $this->selectedRoom->price_per_night * $this->totalNights;

        $this->step = 2;
    }

    /**
     * Tahap 2: Konfirmasi dan simpan pemesanan
     */
    public function confirmBooking()
    {
        if (!$this->selectedRoom || $this->totalPrice <= 0) {
            session()->flash('error', 'Data tidak valid. Silakan periksa kembali.');
            return;
        }

        Booking::create([
            'user_id' => Auth::id(),
            'room_id' => $this->selectedRoom->id,
            'check_in_date' => $this->checkInDate,
            'check_out_date' => $this->checkOutDate,
            'total_price' => $this->totalPrice,
            'status' => 'success',
        ]);

        // Redirect langsung ke halaman my-bookings
        return $this->redirect('/my-bookings', navigate: true);
    }

    public function render()
    {
        return view('livewire.hotel-details');
    }
}
