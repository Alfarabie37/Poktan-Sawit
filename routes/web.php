<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PetaniController;
use App\Http\Controllers\LahanController;
use App\Http\Controllers\PanenController;
use App\Http\Controllers\PupukController;

// Halaman Login (hanya bisa diakses jika belum login)
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
});

// Halaman Sistem Utama (wajib login)
Route::middleware('auth')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('petani', PetaniController::class);
    Route::resource('lahan', LahanController::class);
    Route::resource('panen', PanenController::class);
    Route::resource('pupuk', PupukController::class);
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});