<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MasterKaryawan;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule; // Add this for unique validation on update

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

        // Pesan sukses untuk SweetAlert
        return redirect()->route('karyawan.index')->with('success', 'Data karyawan berhasil ditambahkan!');
    }

    /**
     * Show the form for editing the specified resource.
     * Route will automatically inject MasterKaryawan instance based on ID.
     */
    public function edit(MasterKaryawan $karyawan) // Using Route Model Binding
    {
        return view('karyawan.edit', compact('karyawan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, MasterKaryawan $karyawan) // Using Route Model Binding
    {
        $validatedData = $request->validate([
            'nama'        => 'required|string|max:255',
            'email'       => [
                                'required',
                                'email',
                                Rule::unique('master_karyawan')->ignore($karyawan->id), // Ignore current record's email
                             ],
            'nik'         => [
                                'required',
                                'digits:16',
                                Rule::unique('master_karyawan')->ignore($karyawan->id), // Ignore current record's NIK
                             ],
            'phone'       => 'required|string|max:20',
            'alamat'      => 'required|string',
            'dept'        => 'required|string',
            'role'        => 'required|string',
            'join_date'   => 'required|date_format:d/m/Y',
            'photo'       => 'sometimes|image|mimes:jpeg,png,jpg|max:2048', // photo is optional on update
        ]);

        $dataToUpdate = $validatedData;

        // Handle photo upload/update
        if ($request->hasFile('photo')) {
            // Delete old photo if exists
            if ($karyawan->photo) {
                Storage::disk('public')->delete($karyawan->photo);
            }
            $file = $request->file('photo');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('photos', $fileName, 'public');
            $dataToUpdate['photo'] = $filePath;
        } else {
            // If no new photo uploaded, retain existing one if photo field is not provided
            if (!isset($dataToUpdate['photo']) && $karyawan->photo) {
                 $dataToUpdate['photo'] = $karyawan->photo;
            }
        }


        // Re-calculate dept_colour based on new dept (if dept changed)
        switch ($dataToUpdate['dept']) {
            case 'Engineer': $dataToUpdate['dept_colour'] = '#EF4444'; break;
            case 'Marketing': $dataToUpdate['dept_colour'] = '#22C55E'; break;
            case 'Finance': $dataToUpdate['dept_colour'] = '#A855F7'; break;
            case 'Product': $dataToUpdate['dept_colour'] = '#6366F1'; break;
            default: $dataToUpdate['dept_colour'] = '#6B7280';
        }

        $dataToUpdate['status'] = 'aktif'; // Or get from request if form allows
        $dataToUpdate['status_colour'] = 'green'; // Or get from request if form allows

        $dataToUpdate['join_date'] = Carbon::createFromFormat('d/m/Y', $validatedData['join_date'])->format('Y-m-d');

        $karyawan->update($dataToUpdate);

        // Pesan sukses untuk SweetAlert
        return redirect()->route('karyawan.index')->with('success', 'Data karyawan berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MasterKaryawan $karyawan) // Using Route Model Binding
    {
        try {
            // Delete photo from storage if exists
            if ($karyawan->photo) {
                Storage::disk('public')->delete($karyawan->photo);
            }

            $karyawan->delete();

            // Pesan sukses untuk SweetAlert
            return redirect()->route('karyawan.index')->with('success', 'Data karyawan berhasil dihapus!');
        } catch (\Exception $e) {
            // Pesan error untuk SweetAlert
            return redirect()->route('karyawan.index')->with('error', 'Gagal menghapus data karyawan: ' . $e->getMessage());
        }
    }
}