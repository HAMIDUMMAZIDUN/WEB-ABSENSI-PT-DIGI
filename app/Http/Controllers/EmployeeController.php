<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EmployeeController extends Controller
{
    // Menampilkan halaman daftar karyawan (Master Data)
    public function index()
    {
        $employees = Employee::latest()->paginate(10);
        return view('pages.employees.index', compact('employees'));
    }

    // Menampilkan form tambah karyawan
    public function create()
    {
        return view('pages.employees.create');
    }

    // Menyimpan karyawan baru ke database
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'nip' => 'required|string|unique:employees,nip',
            'position' => 'required|string',
            'department' => 'required|string',
            'rfid_uid' => 'required|string|unique:employees,rfid_uid',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $path = null;
        if ($request->hasFile('photo')) {
            // Simpan foto ke public/storage/photos
            $path = $request->file('photo')->store('photos', 'public');
        }

        Employee::create([
            'name' => $request->name,
            'nip' => $request->nip,
            'position' => $request->position,
            'department' => $request->department,
            'rfid_uid' => $request->rfid_uid,
            'photo_path' => $path,
        ]);

        return redirect()->route('employees.index')->with('success', 'Karyawan berhasil ditambahkan.');
    }
}
