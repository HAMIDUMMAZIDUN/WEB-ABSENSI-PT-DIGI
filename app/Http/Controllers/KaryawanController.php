<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MasterKaryawan;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;

class KaryawanController extends Controller
{
    /**
     * PERBAIKAN: Method index() ditambahkan kembali.
     * Menampilkan daftar karyawan dengan fitur pencarian dan paginasi AJAX.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $query = MasterKaryawan::query();
        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('nama', 'like', '%' . $search . '%')
                  ->orWhere('nik', 'like', '%' . $search . '%')
                  ->orWhere('email', 'like', '%' . $search . '%')
                  ->orWhere('dept', 'like', '%' . $search . '%');
            });
        }
        $employees = $query->paginate(8);
        if ($request->ajax()) {
            return view('karyawan.karyawan-table', ['employees' => $employees])->render();
        }
        $totalEmployees = MasterKaryawan::count();
        return view('karyawan.index', [
            'employees' => $employees,
            'totalEmployees' => $totalEmployees,
            'search' => $search
        ]);
    }

    public function create()
    {
        return view('karyawan.create');
    }


    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama'        => 'required|string|max:255',
            'email'       => 'required|email|unique:master_karyawan,email',
            'nik'         => 'required|digits:16|unique:master_karyawan,nik',
            'phone'       => 'required|string|max:20',
            'alamat'      => 'required|string',
            'dept'        => 'required|string',
            'role'        => 'required|string',
            'join_date'   => 'required|date_format:d/m/Y',
            'photo'       => 'sometimes|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $dataToStore = $validatedData;
        
        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('photos', $fileName, 'public');
            $dataToStore['photo'] = $filePath;
        }

        switch ($validatedData['dept']) {
            case 'Engineer': $dataToStore['dept_colour'] = 'bg-red-500'; break;
            case 'Marketing': $dataToStore['dept_colour'] = 'bg-green-500'; break;
            case 'Finance': $dataToStore['dept_colour'] = 'bg-purple-500'; break;
            case 'Product': $dataToStore['dept_colour'] = 'bg-indigo-500'; break;
            default: $dataToStore['dept_colour'] = 'bg-gray-500';
        }
        $dataToStore['status'] = 'aktif';
        $dataToStore['status_colour'] = 'green';
        $dataToStore['join_date'] = Carbon::createFromFormat('d/m/Y', $validatedData['join_date'])->format('Y-m-d');

        MasterKaryawan::create($dataToStore);

        return redirect()->route('karyawan.index')->with('success', 'Data karyawan berhasil ditambahkan!');
    }
}
