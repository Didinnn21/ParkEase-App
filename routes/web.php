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
use App\Http\Controllers\ProfileController;

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

    // RUTE BARU: Untuk menyimpan riwayat navigasi
    Route::post('/history/store', [UserDashboard::class, 'storeHistory'])->name('history.store');

    Route::get('/notifications', function () {
        return view('user.notifications');
    })->name('notifications');

    Route::get('/profile', function () {
        return view('user.profile');
    })->name('profile');
});


// --- GLOBAL PROFILE ROUTES ---
Route::middleware(['auth'])->group(function () {
    // Gunakan ProfileController, BUKAN UserDashboard
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');

    // Ganti Password
    Route::get('/profile/password', [ProfileController::class, 'changePassword'])->name('profile.password');
    Route::put('/profile/password', [ProfileController::class, 'updatePassword'])->name('user.profile.password.update');
});
