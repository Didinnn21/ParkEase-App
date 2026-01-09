<?php

use Illuminate\Support\Facades\Route;

// Import Controller dengan Namespace yang Benar
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegistrasiController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboard;
use App\Http\Controllers\User\DashboardController as UserDashboard;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Halaman Utama
Route::get('/', function () {
    return view('welcome');
});

// --- BAGIAN AUTHENTICATION ---
Route::get('/login', [LoginController::class, 'index'])->name('login');

Route::get('/register', [RegistrasiController::class, 'index'])->name('register');
Route::post('/register', [RegistrasiController::class, 'store'])->name('register.post');

// Rute Logout
Route::post('/logout', function () {
    auth()->logout();
    return redirect('/login');
})->name('logout');


// --- BAGIAN DASHBOARD USER (PENGGUNA) ---
Route::group(['prefix' => 'user'], function () {
    Route::get('/dashboard', [UserDashboard::class, 'index'])->name('user.dashboard');
});


// --- BAGIAN DASHBOARD ADMIN ---
Route::group(['prefix' => 'admin'], function () {
    Route::get('/dashboard', [AdminDashboard::class, 'index'])->name('admin.dashboard');
});
