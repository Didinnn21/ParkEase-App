<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParkingLocation extends Model
{
    use HasFactory;

    /**
     * Daftar kolom yang boleh diisi secara massal (Mass Assignment).
     * Pastikan semua field yang ada di Controller ada di sini.
     */
    protected $fillable = [
        'name',
        'address',
        'category',
        'total_slots',
        'available_slots',
        'status',
        'latitude',
        'longitude',
        'price_per_hour',
        'region',
    ];

    /**
     * Scope untuk mencari lokasi terdekat menggunakan Rumus Haversine.
     * Digunakan pada User Dashboard saat filter "Terdekat" aktif.
     * * @param $query
     * @param $lat Latitude Pengguna
     * @param $long Longitude Pengguna
     * @param $radius Radius pencarian dalam KM (Default 10km)
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
