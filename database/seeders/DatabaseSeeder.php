<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Akun Admin
        // firstOrCreate: Cek apakah email 'admin@parkease.com' ada.
        // Jika belum ada, maka buat user dengan data di array kedua.
        User::firstOrCreate(
            ['email' => 'admin@parkease.com'],
            [
                'name' => 'Admin ParkEase',
                'password' => bcrypt('admin1234'),
                'role' => 'admin',
            ]
        );

        // 2. Akun User (Pengguna Umum)
        User::firstOrCreate(
            ['email' => 'user@email.com'],
            [
                'name' => 'User Biasa',
                'password' => bcrypt('password123'),
                'role' => 'user',
            ]
        );

        // 3. Akun Petugas (Tambahan agar Anda bisa tes login Petugas)
        User::firstOrCreate(
            ['email' => 'petugas@email.com'],
            [
                'name' => 'Petugas Lapangan',
                'password' => bcrypt('password'),
                'role' => 'petugas',
            ]
        );
    }
}
