<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MasterKaryawan;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class KaryawanController extends Controller
{
    /**
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
            'photo'       => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $dataToStore = $validatedData;

        // Simpan foto di local public
        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('photos/karyawan'), $fileName);
            $dataToStore['photo'] = 'photos/karyawan/' . $fileName;
        }

        switch ($validatedData['dept']) {
            case 'Engineer': $dataToStore['dept_colour'] = '#EF4444'; break; // Tailwind's red-500
            case 'Marketing': $dataToStore['dept_colour'] = '#22C55E'; break; // Tailwind's green-500
            case 'Finance': $dataToStore['dept_colour'] = '#A855F7'; break; // Tailwind's purple-500
            case 'Product': $dataToStore['dept_colour'] = '#6366F1'; break; // Tailwind's indigo-500
            default: $dataToStore['dept_colour'] = '#6B7280'; // Tailwind's gray-500
        }
        $dataToStore['status'] = 'aktif';
        $dataToStore['status_colour'] = 'green';
        $dataToStore['join_date'] = Carbon::createFromFormat('d/m/Y', $validatedData['join_date'])->format('Y-m-d');

        MasterKaryawan::create($dataToStore);

        return redirect()->route('karyawan.index')->with('success', 'Data karyawan berhasil ditambahkan!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MasterKaryawan $karyawan)
    {
        return view('karyawan.edit', compact('karyawan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, MasterKaryawan $karyawan)
    {
        $validatedData = $request->validate([
            'nik' => ['required', 'string', 'max:255', Rule::unique('master_karyawan')->ignore($karyawan->id)],
            'nama' => 'required|string|max:255',
            'email' => ['required', 'email', 'max:255', Rule::unique('master_karyawan')->ignore($karyawan->id)],
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'phone' => 'required|string|max:255',
            'alamat' => 'required|string',
            'dept' => 'required|string',
            'role' => 'required|string',
            'join_date' => 'required|date_format:d/m/Y',
        ]);
        
        $dataToUpdate = $validatedData;

        // Proses foto baru
        if ($request->hasFile('photo')) {
            // Hapus foto lama dari public folder jika ada
            if ($karyawan->photo && file_exists(public_path($karyawan->photo))) {
                unlink(public_path($karyawan->photo));
            }
            
            // Simpan foto baru di public folder
            $file = $request->file('photo');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('photos/karyawan'), $fileName);
            $dataToUpdate['photo'] = 'photos/karyawan/' . $fileName;
        }

        // Handle department color
        switch ($validatedData['dept']) {
            case 'Engineer': $dataToUpdate['dept_colour'] = '#EF4444'; break;
            case 'Marketing': $dataToUpdate['dept_colour'] = '#22C55E'; break;
            case 'Finance': $dataToUpdate['dept_colour'] = '#A855F7'; break;
            case 'Product': $dataToUpdate['dept_colour'] = '#6366F1'; break;
            default: $dataToUpdate['dept_colour'] = '#6B7280';
        }

        // Format tanggal
        $dataToUpdate['join_date'] = Carbon::createFromFormat('d/m/Y', $validatedData['join_date'])->format('Y-m-d');
        
        $karyawan->update($dataToUpdate);

        return redirect()->route('karyawan.index')->with('success', 'Data karyawan berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MasterKaryawan $karyawan)
    {
        try {
            // Hapus foto dari public folder jika ada
            if ($karyawan->photo && file_exists(public_path($karyawan->photo))) {
                unlink(public_path($karyawan->photo));
            }
            $karyawan->delete();
            return redirect()->route('karyawan.index')->with('success', 'Data karyawan berhasil dihapus!');
        } catch (\Exception $e) {
            return redirect()->route('karyawan.index')->with('error', 'Gagal menghapus data karyawan: ' . $e->getMessage());
        }
    }
}