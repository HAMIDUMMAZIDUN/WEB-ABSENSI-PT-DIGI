<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\AbsensiController;
use App\Http\Controllers\KehadiranController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\DashboardController; 
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KeteranganKehadiranController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Rute publik untuk halaman utama
Route::get('/', [WelcomeController::class, 'index'])->name('welcome');
Route::get('/keterangan-kehadiran', [KeteranganKehadiranController::class, 'index'])->name('keterangan.kehadiran');
Route::get('/keterangan-kehadiran/pdf', [KeteranganKehadiranController::class, 'downloadPDF'])->name('keterangan.kehadiran.pdf');

// Grup rute ini memerlukan pengguna untuk login (terotentikasi)
Route::middleware(['auth', 'verified'])->group(function () {

    // RUTE DASHBOARD (DIPERBAIKI)
    // Sebelumnya: Route::get('/dashboard', function () { return view('dashboard.index'); });
    // Sekarang: Menggunakan DashboardController untuk mengirim data
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // RUTE KARYAWAN
    Route::resource('karyawan', KaryawanController::class);

    // RUTE REKAP ABSENSI
    Route::get('/rekap-absensi', [AbsensiController::class, 'index'])->name('rekap.absensi');

    // RUTE SCAN KEHADIRAN
    Route::get('/scan-kehadiran', [KehadiranController::class, 'create'])->name('scan.kehadiran');
    Route::post('/scan-kehadiran', [KehadiranController::class, 'store'])->name('scan.kehadiran.store');

    // Rute untuk mengelola profil pengguna
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    //Rute untuk Setting
    Route::get('/settings', [SettingController::class, 'index'])->name('settings.index');
});

// Memuat rute otentikasi bawaan Laravel (login, register, dll.)
require __DIR__.'/auth.php';
