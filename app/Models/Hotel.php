<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    // SESUAIKAN DENGAN NAMA KOLOM DI DATABASE ANDA
    protected $fillable = [
        'name',
        'description',
        'address',      // Diubah dari 'location'
        'image_path',   // Diubah dari 'image'
    ];

    /**
     * Relasi ke model Room. Satu hotel bisa punya banyak kamar.
     */
    public function rooms()
    {
        return $this->hasMany(Room::class);
    }
}