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
        // Akun Admin
        User::factory()->create([
            'name' => 'Admin ParkEase',
            'email' => 'admin@parkease.com',
            'password' => bcrypt('modol1234'),
            'role' => 'admin',
        ]);

        // Akun User (Pengguna Umum)
        User::factory()->create([
            'name' => 'User Biasa',
            'email' => 'user@email.com',
            'password' => bcrypt('password123'),
            'role' => 'user',
        ]);
    }
}
