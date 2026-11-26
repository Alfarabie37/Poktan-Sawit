<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PetaniController;
use App\Http\Controllers\LahanController;
use App\Http\Controllers\PanenController;
use App\Http\Controllers\PupukController;

// Halaman Autentikasi
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.post');
});

// Halaman Sistem Utama (Wajib Login)
Route::middleware('auth')->group(function () {
    // Route Role Pengurus (Pengguna)
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('petani', PetaniController::class);
    Route::resource('lahan', LahanController::class);
    Route::resource('panen', PanenController::class);
    Route::resource('pupuk', PupukController::class);
    Route::get('/laporan', [DashboardController::class, 'index'])->name('laporan.index');

    // Route Role Super Admin
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'adminIndex'])->name('dashboard');
        Route::get('/verifikasi', [DashboardController::class, 'adminIndex'])->name('verifikasi');
        Route::get('/kelompok', [DashboardController::class, 'adminIndex'])->name('kelompok');
        Route::get('/pengguna', [DashboardController::class, 'adminIndex'])->name('pengguna');
        Route::get('/laporan', [DashboardController::class, 'adminIndex'])->name('laporan');
    });

    // Logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});
