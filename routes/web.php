<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/dashboard', function () {
    return view('dashboard');
});

Route::get('/login', [LoginController::class, 'index'])->name('auth.login');

// Rute untuk Pengguna Umum
Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('/dashboard', [UserDashboard::class, 'index'])->name('user.dashboard');
});

// Rute untuk Admin
Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminDashboard::class, 'index'])->name('admin.dashboard');
});
