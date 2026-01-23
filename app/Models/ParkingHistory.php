<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParkingHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'parking_location_id',
        'user_id',
        'previous_available',
        'new_available',
        'action', // 'increment', 'decrement', 'set_full', dll
        'notes',
    ];

    /**
     * Relasi: Setiap history milik satu Lokasi Parkir.
     */
    public function location()
    {
        return $this->belongsTo(ParkingLocation::class, 'parking_location_id');
    }

    /**
     * Relasi: Setiap history dicatat oleh satu Petugas (User).
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
