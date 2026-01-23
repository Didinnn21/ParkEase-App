<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ParkingHistory extends Model
{
    use HasFactory;

    /**
     * Nama tabel jika tidak mengikuti konvensi Laravel (plural).
     * Jika di migrasi Anda menggunakan 'parking_histories', baris ini opsional.
     */
    protected $table = 'parking_histories';

    protected $fillable = [
        'parking_location_id',
        'user_id',
        'previous_available',
        'new_available',
        'action', // 'increment', 'decrement', 'set_full'
        'notes',
    ];

    /**
     * Casting data agar Laravel otomatis mengubah string dari DB menjadi tipe data yang tepat.
     */
    protected $casts = [
        'previous_available' => 'integer',
        'new_available' => 'integer',
        'created_at' => 'datetime',
    ];

    /**
     * Relasi: Setiap riwayat tercatat untuk satu Lokasi Parkir.
     */
    public function location(): BelongsTo
    {
        return $this->belongsTo(ParkingLocation::class, 'parking_location_id');
    }

    /**
     * Relasi: Setiap riwayat dicatat oleh satu User (Petugas/Admin).
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
