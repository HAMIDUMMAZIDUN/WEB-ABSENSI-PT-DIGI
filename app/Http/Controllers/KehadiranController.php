<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KehadiranController extends Controller
{
    public function create()
    {
        // Show the form or interface for scanning attendance
        return view('kehadiran.scan');
    }

    public function store(Request $request)
    {
        // Process the scanned attendance data
        // Example:
        // $employeeId = $request->input('employee_id');
        // Attendance::create(['employee_id' => $employeeId, 'date' => now(), 'status' => 'hadir']);
        return redirect()->route('dashboard')->with('success', 'Kehadiran berhasil dicatat!');
    }
}