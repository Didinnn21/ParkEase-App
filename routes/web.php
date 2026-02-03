<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegistrasiController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboard;
use App\Http\Controllers\User\DashboardController as UserDashboard;
use App\Http\Controllers\Petugas\DashboardController as PetugasDashboard;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\LocationController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Halaman Utama -> Redirect ke Login
Route::get('/', function () {
    return redirect()->route('login');
});

// --- AUTHENTICATION ---
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'authenticate'])->name('login.post');
Route::get('/register', [RegistrasiController::class, 'index'])->name('register');
Route::post('/register', [RegistrasiController::class, 'store'])->name('register.post');

// Logout
Route::post('/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('/login');
})->name('logout');


// --- GROUP ADMIN (Wajib Login) ---
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboard::class, 'index'])->name('dashboard');
    Route::get('/history', [App\Http\Controllers\Admin\HistoryController::class, 'index'])->name('history.index');

    // Kelola Lokasi
    Route::resource('locations', LocationController::class);

    // Manajemen User
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::post('/users', [UserController::class, 'store'])->name('users.store');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
});


// --- GROUP PETUGAS (Wajib Login) ---
Route::middleware(['auth'])->prefix('petugas')->name('petugas.')->group(function () {
    Route::get('/dashboard', [PetugasDashboard::class, 'index'])->name('dashboard');
    Route::post('/update-slot', [PetugasDashboard::class, 'updateSlot'])->name('update-slot');
});


// --- GROUP USER (Dashboard & Menu User) ---
Route::middleware(['auth'])->prefix('user')->name('user.')->group(function () {
    Route::get('/dashboard', [UserDashboard::class, 'index'])->name('dashboard');
    Route::get('/history', [UserDashboard::class, 'history'])->name('history');
    Route::get('/notifications', function () {
        return view('user.notifications');
    })->name('notifications');

    // Halaman Profil Utama (Overview) - Masih pakai nama 'user.profile' agar controller tidak error
    Route::get('/profile', function () {
        return view('user.profile');
    })->name('profile');
});


// --- GLOBAL PROFILE ROUTES (Bisa diakses Admin, Petugas, User) ---
// Rute ini diletakkan di luar grup prefix agar namanya menjadi 'profile.edit' (bukan 'user.profile.edit')
Route::middleware(['auth'])->group(function () {

    // Edit Profil
    Route::get('/profile/edit', [UserDashboard::class, 'editProfile'])->name('profile.edit');
    Route::put('/profile/update', [UserDashboard::class, 'updateProfile'])->name('profile.update');

    // Ganti Password
    Route::get('/profile/password', [UserDashboard::class, 'editPassword'])->name('profile.password');
    Route::put('/profile/password/update', [UserDashboard::class, 'updatePassword'])->name('profile.password.update');
});
