<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParkingLocation extends Model
{
    use HasFactory;

    // Pastikan SEMUA kolom ini ada
    protected $fillable = [
        'name',
        'address',
        'category',      // <--- WAJIB ADA
        'total_slots',
        'available_slots',
        'status',
        'latitude',
        'longitude',     
        'price_per_hour',
        'region'
    ];


}
