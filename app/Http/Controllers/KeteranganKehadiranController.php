<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MasterKaryawan;
use Carbon\Carbon;
use PDF; // <-- Import facade PDF

class KeteranganKehadiranController extends Controller
{
    /**
     * Menampilkan halaman keterangan kehadiran dengan filter.
     */
    public function index(Request $request)
    {
        // Ambil input dari filter
        $filterBagian = $request->query('bagian');
        $searchQuery = $request->query('search');

        // Mulai query ke database
        $karyawanQuery = MasterKaryawan::query();

        // Terapkan filter jika ada
        if ($filterBagian) {
            $karyawanQuery->where('bagian', $filterBagian);
        }

        if ($searchQuery) {
            $karyawanQuery->where('nama_karyawan', 'like', '%' . $searchQuery . '%');
        }

        // Ambil data karyawan yang sudah difilter
        $semuaKaryawan = $karyawanQuery->get();

        // Ambil daftar unik 'bagian' untuk dropdown filter
        $daftarBagian = MasterKaryawan::select('bagian')->distinct()->pluck('bagian');

        // Menambahkan data absensi dummy (logika ini tetap sama)
        $dataKehadiran = $this->tambahkanDataAbsensi($semuaKaryawan);

        // Menghitung jumlah untuk setiap status
        $counts = [
            'hadir' => $dataKehadiran->where('status_kehadiran', 'Hadir')->count(),
            'alpha' => $dataKehadiran->where('status_kehadiran', 'Alpha')->count(),
            'terlambat' => $dataKehadiran->where('status_kehadiran', 'Terlambat')->count(),
            'izin' => $dataKehadiran->where('status_kehadiran', 'Izin')->count(),
        ];

        // Kirim semua data yang diperlukan ke view
        return view('keterangan-kehadiran.index', [
            'dataKehadiran' => $dataKehadiran,
            'counts' => $counts,
            'daftarBagian' => $daftarBagian,
            'filterBagian' => $filterBagian, // Kirim kembali nilai filter untuk ditampilkan
            'searchQuery' => $searchQuery,   // Kirim kembali nilai search untuk ditampilkan
        ]);
    }

    /**
     * Membuat dan mengunduh laporan PDF.
     */
    public function downloadPDF(Request $request)
    {
        // Logika filter dan pencarian sama persis dengan method index
        $filterBagian = $request->query('bagian');
        $searchQuery = $request->query('search');

        $karyawanQuery = MasterKaryawan::query();

        if ($filterBagian) {
            $karyawanQuery->where('bagian', $filterBagian);
        }
        if ($searchQuery) {
            $karyawanQuery->where('nama_karyawan', 'like', '%' . $searchQuery . '%');
        }

        $semuaKaryawan = $karyawanQuery->get();
        $dataKehadiran = $this->tambahkanDataAbsensi($semuaKaryawan);
        
        // Data untuk dikirim ke view PDF
        $data = [
            'dataKehadiran' => $dataKehadiran,
            'tanggal' => Carbon::now()->isoFormat('D MMMM YYYY'),
            'filterBagian' => $filterBagian,
            'searchQuery' => $searchQuery,
        ];

        // Membuat PDF dari view 'keterangan-kehadiran.pdf'
        $pdf = PDF::loadView('keterangan-kehadiran.pdf', $data);
        
        // Mengatur nama file dan mengunduh
        return $pdf->download('laporan-kehadiran-' . date('Y-m-d') . '.pdf');
    }

    /**
     * Helper function untuk menambahkan data absensi dummy.
     */
    private function tambahkanDataAbsensi($collection)
    {
        $statuses = ['Hadir', 'Alpha', 'Terlambat', 'Izin'];
        $keteranganIzin = ['Sakit', 'Acara Keluarga'];

        return $collection->map(function ($karyawan) use ($statuses, $keteranganIzin) {
            $status = $statuses[array_rand($statuses)];
            $karyawan->status_kehadiran = $status;
            $karyawan->keterangan_text = '-';

            if ($status === 'Hadir' || $status === 'Terlambat') {
                $karyawan->waktu_masuk = Carbon::createFromTime(rand(7, 9), rand(0, 59))->format('H:i');
                $karyawan->waktu_pulang = Carbon::createFromTime(rand(16, 17), rand(0, 59))->format('H:i');
            } else {
                $karyawan->waktu_masuk = '-';
                $karyawan->waktu_pulang = '-';
            }

            if ($status === 'Izin') {
                $karyawan->keterangan_text = $keteranganIzin[array_rand($keteranganIzin)];
            }
            
            return $karyawan;
        });
    }
}
