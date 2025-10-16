<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;
    
    // Tambahkan ini (jika Anda akan membuat fitur admin untuk kamar)
    protected $fillable = [
        'hotel_id',
        'type',
        'description',
        'price_per_night',
    ];

    /**
     * TAMBAHKAN FUNGSI INI
     * Mendefinisikan relasi inverse one-to-many ke model Hotel.
     */
    public function hotel()
    {
        return $this->belongsTo(Hotel::class);
    }
}