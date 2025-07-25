<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\WelcomeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Di sini Anda dapat mendaftarkan rute web untuk aplikasi Anda. Rute-rute
| ini dimuat oleh RouteServiceProvider dan semuanya akan ditetapkan
| ke grup middleware "web".
|
*/

// =========================================================================
// RUTE PUBLIK (Dapat diakses tanpa login)
// =========================================================================

// Rute halaman utama/landing page
Route::get('/', [WelcomeController::class, 'index'])->name('welcome');

// Rute untuk dashboard, yang akan otomatis dilindungi oleh middleware 'auth'
// dari file auth.php jika pengguna belum login.
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


// =========================================================================
// RUTE KHUSUS AUTENTIKASI (Untuk pengguna yang sudah login)
// =========================================================================

// Grup rute ini memerlukan pengguna untuk login terlebih dahulu.
Route::middleware('auth')->group(function () {
    // Rute untuk mengelola profil pengguna
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Tambahkan rute lain yang memerlukan login di sini...
    // Contoh:
    // Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');
});


// =========================================================================
// MEMUAT RUTE OTENTIKASI BAWAAN LARAVEL
// =========================================================================

// File ini berisi semua rute yang diperlukan untuk otentikasi,
// seperti login, logout, register, lupa password, dll.
// Dengan ini, Anda tidak perlu mendefinisikan rute login/logout secara manual.
require __DIR__.'/auth.php';
