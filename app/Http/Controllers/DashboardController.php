<?php

namespace App\Http\Controllers;
// app/Http/Controllers/DashboardController.php

use App\Models\MasterKaryawan; // Pastikan Anda memiliki model ini
use Illuminate\Http\Request;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // Ambil semua data karyawan
        $semuaKaryawan = MasterKaryawan::all();

        // Tambahkan data absensi dummy untuk demonstrasi
        // Di aplikasi nyata, Anda akan mengambil data ini dari tabel absensi
        $karyawanWithAbsensi = $semuaKaryawan->map(function ($karyawan) {
            // Waktu masuk acak antara jam 7 dan 8 pagi
            $jamMasuk = Carbon::createFromTime(rand(7, 8), rand(0, 59));
            $karyawan->jam_masuk_str = $jamMasuk->format('H:i');

            // 50% kemungkinan karyawan sudah pulang
            if (rand(0, 1) == 1) {
                $karyawan->jam_pulang_str = Carbon::createFromTime(rand(16, 17), rand(0, 59))->format('H:i');
                $karyawan->durasi_persen = 100; // Sudah selesai
            } else {
                $karyawan->jam_pulang_str = null; // Belum pulang
                // Hitung persentase durasi kerja dari jam masuk sampai sekarang (asumsi 8 jam kerja)
                $totalMenitKerja = 8 * 60;
                $menitTelahBekerja = now()->diffInMinutes($jamMasuk);
                $karyawan->durasi_persen = min(100, ($menitTelahBekerja / $totalMenitKerja) * 100);
            }
            return $karyawan;
        });

        // Kirim data ke view
        return view('dashboard.index', ['karyawanWithAbsensi' => $karyawanWithAbsensi]);
    }
}