<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Attendance;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AttendanceController extends Controller
{
    // Menampilkan halaman Scan
    public function scanPage()
    {
        return view('pages.attendance.scan');
    }

    // Merekam scan dari RFID reader (dipanggil via AJAX)
    public function record(Request $request)
    {
        $request->validate(['rfid_uid' => 'required']);

        $employee = Employee::where('rfid_uid', $request->rfid_uid)->first();

        // Jika kartu tidak terdaftar
        if (!$employee) {
            return response()->json(['status' => 'error', 'message' => 'Kartu RFID tidak terdaftar!'], 404);
        }

        // Cek status terakhir karyawan hari ini untuk menentukan "Masuk" atau "Pulang"
        $todayAttendance = Attendance::where('employee_id', $employee->id)
                                ->whereDate('scan_time', Carbon::today())
                                ->latest()
                                ->first();

        $status = 'Masuk';
        if ($todayAttendance && $todayAttendance->status == 'Masuk') {
            $status = 'Pulang';
        }

        // Simpan data absensi
        $attendance = Attendance::create([
            'employee_id' => $employee->id,
            'scan_time' => now(),
            'status' => $status,
        ]);

        // Kirim balik data karyawan untuk ditampilkan di UI
        return response()->json([
            'status' => 'success',
            'message' => "Absensi {$status} berhasil!",
            'data' => [
                'name' => $employee->name,
                'photo' => $employee->photo_path ? Storage::url($employee->photo_path) : '/default-avatar.png',
                'time' => $attendance->scan_time->format('H:i:s'),
            ]
        ]);
    }

    // Menampilkan halaman history absensi
    public function history(Request $request)
    {
        $attendances = Attendance::with('employee') // Eager loading
                                ->latest()
                                ->paginate(20);

        return view('pages.attendance.history', compact('attendances'));
    }
}
