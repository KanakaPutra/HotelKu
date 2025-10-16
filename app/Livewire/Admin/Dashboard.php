<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Booking;
use App\Models\Hotel;
use App\Models\Room;
use Carbon\Carbon;

class Dashboard extends Component
{
    // Properti ini akan diisi nanti saat data selesai dimuat
    public $totalPendapatan = 0;
    public $totalPesanan = 0;
    public $totalHotel = 0;
    public $totalKamar = 0;
    public $kamarTerisiHariIni = 0;
    public $kamarTersediaHariIni = 0;
    public $pesananTerbaru = [];

    /**
     * Metode 'load' ini hanya akan berjalan SETELAH placeholder ditampilkan.
     * Semua query berat dan lambat ditaruh di sini.
     */
    public function loadDashboardData()
    {
        // Statistik Sederhana
        $this->totalPendapatan = Booking::sum('total_price');
        $this->totalPesanan = Booking::count();
        $this->totalHotel = Hotel::count();
        $this->totalKamar = Room::count();

        // Statistik Kompleks (berdasarkan tanggal hari ini)
        $today = Carbon::today();
        $this->kamarTerisiHariIni = Booking::where('check_in_date', '<=', $today)
                                          ->where('check_out_date', '>', $today)
                                          ->count();
        
        $this->kamarTersediaHariIni = $this->totalKamar - $this->kamarTerisiHariIni;

        // Data untuk tabel
        $this->pesananTerbaru = Booking::with('user', 'room.hotel')->latest()->take(5)->get();
    }

    /**
     * Metode ini akan menampilkan kerangka (skeleton) selagi
     * metode 'loadDashboardData' berjalan di latar belakang.
     */
    public function placeholder()
    {
        return view('livewire.admin.dashboard-placeholder');
    }

    public function render()
    {
        return view('livewire.admin.dashboard');
    }
}