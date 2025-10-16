<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;
    
    // Tambahkan ini agar bisa diisi secara massal
    protected $fillable = [
        'user_id',
        'room_id',
        'check_in_date',
        'check_out_date',
        'total_price',
        'status',
    ];

    /**
     * TAMBAHKAN FUNGSI-FUNGSI INI
     */

    // Relasi ke model User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi ke model Room
    public function room()
    {
        return $this->belongsTo(Room::class);
    }
}