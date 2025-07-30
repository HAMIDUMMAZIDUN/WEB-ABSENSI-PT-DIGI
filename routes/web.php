<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\KaryawanController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Rute publik untuk halaman utama
Route::get('/', [WelcomeController::class, 'index'])->name('welcome');

// Grup rute ini memerlukan pengguna untuk login (terotentikasi)
Route::middleware(['auth', 'verified'])->group(function () {
    
    // RUTE DASHBOARD
    Route::get('/dashboard', function () {
        return view('dashboard.index'); 
    })->name('dashboard');
        
    // RUTE KARYAWAN (SUDAH DIPERBAIKI)
    // Ini akan otomatis membuat route:
    // - karyawan.index (GET /karyawan)
    // - karyawan.create (GET /karyawan/create)
    // - karyawan.store (POST /karyawan)
    // - dan lainnya...
   Route::resource('karyawan', KaryawanController::class);
    
    // Rute untuk mengelola profil pengguna
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Memuat rute otentikasi bawaan Laravel (login, register, dll.)
require __DIR__.'/auth.php';