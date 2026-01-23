<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParkingLocation extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'address',
        'region',
        'latitude',
        'longitude',
        'total_slots',
        'available_slots',
        'price_per_hour',
        'status',
    ];

    /**
     * Relasi: Satu lokasi mempunyai banyak sejarah perubahan slot.
     */
    public function histories()
    {
        return $this->hasMany(ParkingHistory::class);
    }

    /**
     * SKPL Requirement 9.6 & 11.c.123: Pencarian Jarak Terdekat (Haversine Formula).
     * Cara guna: ParkingLocation::nearby($userLat, $userLong)->get();
     */
    public function scopeNearby($query, $lat, $long, $radius = 10)
    {
        return $query->select('*')
            ->selectRaw(
                '( 6371 * acos( cos( radians(?) ) * cos( radians( latitude ) )
                * cos( radians( longitude ) - radians(?) ) + sin( radians(?) )
                * sin( radians( latitude ) ) ) ) AS distance',
                [$lat, $long, $lat]
            )
            ->having('distance', '<', $radius)
            ->orderBy('distance');
    }
}
