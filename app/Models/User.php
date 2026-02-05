<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;
class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'parking_location_id',
        'avatar', // <--- WAJIB DITAMBAHKAN (Agar foto profil bisa disimpan)
        'profile_photo_path',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Aksesor untuk URL Foto Profil (Otomatis)
     * Cara panggil di Blade: {{ Auth::user()->photo_url }}
     */
    public function getPhotoUrlAttribute()
{
    // Jika ada foto di database DAN file aslinya ada di storage
    if ($this->profile_photo_path && Storage::disk('public')->exists($this->profile_photo_path)) {
        return asset('storage/' . $this->profile_photo_path);
    }

    // Fallback ke avatar inisial jika tidak ada foto
    return 'https://ui-avatars.com/api/?name=' . urlencode($this->name) . '&color=7F9CF5&background=EBF4FF';
}

    /**
     * Relasi: Seorang petugas boleh mempunyai banyak sejarah update slot.
     */
    public function parkingHistories()
    {
        return $this->hasMany(ParkingHistory::class);
    }

    /**
     * Relasi: Petugas ditugaskan di satu lokasi parkir.
     */
    public function location()
    {
        return $this->belongsTo(ParkingLocation::class, 'parking_location_id');
    }
}
