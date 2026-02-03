<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

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
        // 1. Cek apakah user punya foto di database (kolom 'avatar')
        if ($this->avatar) {
            // Pastikan path-nya mengarah ke folder storage/avatars
            return asset('storage/avatars/' . $this->avatar);
        }

        // 2. Jika tidak ada foto, pakai layanan UI Avatars (Inisial Nama)
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
