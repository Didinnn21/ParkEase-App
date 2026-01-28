<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegistrasiController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboard;
use App\Http\Controllers\User\DashboardController as UserDashboard;
use App\Http\Controllers\Petugas\DashboardController as PetugasDashboard;
use App\Http\Controllers\Admin\UserController;
// 1. IMPORT CONTROLLER LOKASI
use App\Http\Controllers\Admin\LocationController; // <--- TAMBAHAN BARU

// Halaman Utama
Route::get('/', function () {
    return redirect()->route('login');
});

// Auth Routes
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'authenticate'])->name('login.post');
Route::get('/register', [RegistrasiController::class, 'index'])->name('register');
Route::post('/register', [RegistrasiController::class, 'store'])->name('register.post');

// Logout (POST untuk keamanan)
Route::post('/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('/login');
})->name('logout');

// Group Admin
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboard::class, 'index'])->name('dashboard');
    Route::get('/history', [App\Http\Controllers\Admin\HistoryController::class, 'index'])->name('history.index');

    // 2. RUTE KELOLA LOKASI (RESOURCE)
    // Ini akan otomatis buat route index, store, update, destroy
    Route::resource('locations', LocationController::class); // <--- TAMBAHAN BARU

    // Rute Manajemen Pengguna
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::post('/users', [UserController::class, 'store'])->name('users.store');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
});

// Group Petugas
Route::prefix('petugas')->name('petugas.')->group(function () {
    Route::get('/dashboard', [PetugasDashboard::class, 'index'])->name('dashboard');
    Route::post('/update-slot', [PetugasDashboard::class, 'updateSlot'])->name('update-slot');
});

// Group User
Route::prefix('user')->name('user.')->group(function () {
    Route::get('/dashboard', [UserDashboard::class, 'index'])->name('dashboard');
    Route::get('/history', [UserDashboard::class, 'history'])->name('history');
    Route::get('/notifications', function() { return view('user.notifications'); })->name('notifications');
    Route::get('/profile', function() { return view('user.profile'); })->name('profile');

    // Edit Profil
    Route::get('/profile/edit', [UserDashboard::class, 'editProfile'])->name('profile.edit');
    Route::put('/profile/update', [UserDashboard::class, 'updateProfile'])->name('profile.update');

    // Ganti Password
    Route::get('/profile/password', [UserDashboard::class, 'editPassword'])->name('profile.password');
    Route::put('/profile/password/update', [UserDashboard::class, 'updatePassword'])->name('profile.password.update');

});

