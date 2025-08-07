@extends('layouts.app') 

@section('content')
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-2xl font-bold mb-6">Edit Data Karyawan: {{ $karyawan->nama }}</h1>

        <form action="{{ route('karyawan.update', $karyawan->id) }}" method="POST" enctype="multipart/form-data" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
            @csrf
            @method('PUT') {{-- Penting untuk metode UPDATE --}}

            {{-- NIK --}}
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="nik">
                    NIK
                </label>
                <input type="text" name="nik" id="nik" value="{{ old('nik', $karyawan->nik) }}"
                       class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('nik') border-red-500 @enderror" required>
                @error('nik')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>

            {{-- Nama --}}
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="nama">
                    Nama Karyawan
                </label>
                <input type="text" name="nama" id="nama" value="{{ old('nama', $karyawan->nama) }}"
                       class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('nama') border-red-500 @enderror" required>
                @error('nama')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>

            {{-- Email --}}
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="email">
                    Email
                </label>
                <input type="email" name="email" id="email" value="{{ old('email', $karyawan->email) }}"
                       class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('email') border-red-500 @enderror" required>
                @error('email')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>

            {{-- Photo --}}
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="photo">
                    Foto
                </label>
                @if ($karyawan->photo)
                    <div class="mb-2">
                        <img src="{{ asset('storage/' . $karyawan->photo) }}" alt="Current Photo" class="h-20 w-20 object-cover rounded">
                        <span class="text-gray-600 text-xs">Foto saat ini</span>
                    </div>
                @endif
                <input type="file" name="photo" id="photo"
                       class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('photo') border-red-500 @enderror">
                @error('photo')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>

            {{-- Phone --}}
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="phone">
                    Nomor Telepon
                </label>
                <input type="text" name="phone" id="phone" value="{{ old('phone', $karyawan->phone) }}"
                       class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('phone') border-red-500 @enderror" required>
                @error('phone')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>

            {{-- Alamat --}}
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="alamat">
                    Alamat
                </label>
                <textarea name="alamat" id="alamat" rows="3"
                          class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('alamat') border-red-500 @enderror" required>{{ old('alamat', $karyawan->alamat) }}</textarea>
                @error('alamat')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>

            {{-- Dept (Departemen) - Contoh dengan Select dropdown --}}
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="dept">
                    Departemen
                </label>
                <select name="dept" id="dept"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('dept') border-red-500 @enderror" required>
                    <option value="">Pilih Departemen</option>
                    <option value="Engineer" {{ old('dept', $karyawan->dept) == 'Engineer' ? 'selected' : '' }}>Engineer</option>
                    <option value="Marketing" {{ old('dept', $karyawan->dept) == 'Marketing' ? 'selected' : '' }}>Marketing</option>
                    <option value="Finance" {{ old('dept', $karyawan->dept) == 'Finance' ? 'selected' : '' }}>Finance</option>
                    <option value="Product" {{ old('dept', $karyawan->dept) == 'Product' ? 'selected' : '' }}>Product</option>
                    {{-- Tambahkan departemen lain jika ada --}}
                </select>
                @error('dept')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>

            {{-- Role (Peran) - Contoh dengan Select dropdown --}}
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="role">
                    Role
                </label>
                <select name="role" id="role"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('role') border-red-500 @enderror" required>
                    <option value="">Pilih Role</option>
                    <option value="Staff" {{ old('role', $karyawan->role) == 'Staff' ? 'selected' : '' }}>Staff</option>
                    <option value="Manager" {{ old('role', $karyawan->role) == 'Manager' ? 'selected' : '' }}>Manager</option>
                    <option value="Admin" {{ old('role', $karyawan->role) == 'Admin' ? 'selected' : '' }}>Admin</option>
                    {{-- Tambahkan role lain jika ada --}}
                </select>
                @error('role')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>

            {{-- Join Date --}}
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="join_date">
                    Tanggal Bergabung
                </label>
                {{-- Perhatikan format tanggal: Carbon::parse()->format('d/m/Y') untuk tampilan --}}
                <input type="text" name="join_date" id="join_date"
                       value="{{ old('join_date', \Carbon\Carbon::parse($karyawan->join_date)->format('d/m/Y')) }}"
                       class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('join_date') border-red-500 @enderror"
                       placeholder="DD/MM/YYYY" required>
                @error('join_date')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>

            {{-- Status dan Status Colour tidak diedit langsung di form ini biasanya --}}
            {{-- Tapi jika perlu, Anda bisa menambahkannya di sini juga --}}
            {{-- Contoh jika Status bisa diedit --}}
            {{--
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="status">
                    Status
                </label>
                <select name="status" id="status"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('status') border-red-500 @enderror" required>
                    <option value="aktif" {{ old('status', $karyawan->status) == 'aktif' ? 'selected' : '' }}>Aktif</option>
                    <option value="on leave" {{ old('status', $karyawan->status) == 'on leave' ? 'selected' : '' }}>Cuti</option>
                    <option value="terminated" {{ old('status', $karyawan->status) == 'terminated' ? 'selected' : '' }}>Terminasi</option>
                </select>
                @error('status')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>
            --}}


            <div class="flex items-center justify-between">
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    Perbarui Karyawan
                </button>
                <a href="{{ route('karyawan.index') }}" class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800">
                    Batal
                </a>
            </div>
        </form>
    </div>
@endsection