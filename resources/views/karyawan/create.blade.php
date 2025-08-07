<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data Karyawan</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-[#F3F4F6]">

    <div class="container mx-auto p-8">
        <div class="flex justify-between items-center mb-6">
            <div>
                <h1 class="text-3xl font-bold text-gray-800">Tambah Data<span class="text-emerald-500">+</span></h1>
                <p class="text-gray-500 mt-1">Menambahkan data karyawan baru</p>
            </div>
            <div class="flex space-x-3">
                <a href="{{ route('karyawan.index') }}" class="px-6 py-2 text-sm font-semibold text-emerald-600 bg-white border border-emerald-500 rounded-lg hover:bg-gray-50">
                    Batalkan
                </a>
                <button type="submit" form="employeeForm" class="px-8 py-2 text-sm font-semibold text-white bg-emerald-500 rounded-lg hover:bg-emerald-600">
                    Simpan
                </button>
            </div>
        </div>

        <div class="bg-white p-8 rounded-lg shadow-sm">
            <form id="employeeForm" method="POST" action="{{ route('karyawan.store') }}">
                @csrf

<div class="bg-white p-8 rounded-lg shadow-sm">
    {{-- PERUBAHAN PENTING: Tambahkan enctype untuk upload file --}}
    <form id="employeeForm" method="POST" action="{{ route('karyawan.store') }}" enctype="multipart/form-data">
        @csrf

        {{-- Bagian Upload Foto --}}
            <div class="flex items-center space-x-6 mb-8">
                <div class="w-24 h-24 bg-gray-200 rounded-full flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                    </svg>
                </div>
                <div>
                    {{-- PERUBAHAN: Ganti tombol dengan input file --}}
                    <label for="photo" class="block text-sm font-medium text-gray-600 mb-1">Foto Profil</label>
                    <input type="file" name="photo" id="photo" class="block w-full text-sm text-gray-500
                        file:mr-4 file:py-2 file:px-4
                        file:rounded-full file:border-0
                        file:text-sm file:font-semibold
                        file:bg-emerald-50 file:text-emerald-700
                        hover:file:bg-emerald-100
                    "/>
                    <p class="text-xs text-gray-500 mt-2">JPG atau PNG, maks 2MB.</p>
                    @error('photo') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

                {{-- Informasi Pribadi --}}
                <fieldset class="mb-8">
                    <legend class="text-xl font-semibold text-gray-700 mb-6">Informasi Pribadi</legend>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-6">
                        <div>
                            <label for="nama" class="block text-sm font-medium text-gray-600 mb-1">Nama Lengkap</label>
                            <input type="text" id="nama" name="nama" value="{{ old('nama') }}" class="w-full border border-gray-300 rounded-md shadow-sm px-3 py-2 focus:outline-none focus:ring-emerald-500 focus:border-emerald-500">
                            @error('nama') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-600 mb-1">Alamat Email</label>
                            <input type="email" id="email" name="email" value="{{ old('email') }}" class="w-full border border-gray-300 rounded-md shadow-sm px-3 py-2 focus:outline-none focus:ring-emerald-500 focus:border-emerald-500">
                            @error('email') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label for="nik" class="block text-sm font-medium text-gray-600 mb-1">NIK</label>
                            <input type="text" id="nik" name="nik" value="{{ old('nik') }}" class="w-full border border-gray-300 rounded-md shadow-sm px-3 py-2 focus:outline-none focus:ring-emerald-500 focus:border-emerald-500">
                            @error('nik') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label for="phone" class="block text-sm font-medium text-gray-600 mb-1">Nomor Handphone</label>
                            <input type="tel" id="phone" name="phone" value="{{ old('phone') }}" class="w-full border border-gray-300 rounded-md shadow-sm px-3 py-2 focus:outline-none focus:ring-emerald-500 focus:border-emerald-500">
                            @error('phone') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>
                    </div>
                </fieldset>
                
                {{-- Informasi Pekerjaan --}}
                <fieldset class="mb-8">
                    <legend class="text-xl font-semibold text-gray-700 mb-6">Informasi Pekerjaan</legend>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-6">
                        <div>
                            <label for="dept" class="block text-sm font-medium text-gray-600 mb-1">Bagian</label>
                            <select id="dept" name="dept" class="w-full border border-gray-300 rounded-md shadow-sm px-3 py-2 focus:outline-none focus:ring-emerald-500 focus:border-emerald-500">
                                <option disabled selected>Pilih Departemen</option>
                                <option value="Engineer" {{ old('dept') == 'Engineer' ? 'selected' : '' }}>Engineer</option>
                                <option value="Marketing" {{ old('dept') == 'Marketing' ? 'selected' : '' }}>Marketing</option>
                                <option value="Finance" {{ old('dept') == 'Finance' ? 'selected' : '' }}>Finance</option>
                                <option value="Product" {{ old('dept') == 'Product' ? 'selected' : '' }}>Product</option>
                            </select>
                            @error('dept') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label for="role" class="block text-sm font-medium text-gray-600 mb-1">Role</label>
                            <input type="text" id="role" name="role" value="{{ old('role') }}" placeholder="Contoh: Sr. Backend Dev" class="w-full border border-gray-300 rounded-md shadow-sm px-3 py-2 focus:outline-none focus:ring-emerald-500 focus:border-emerald-500">
                            @error('role') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label for="join_date" class="block text-sm font-medium text-gray-600 mb-1">Tanggal Bergabung</label>
                            <div class="relative">
                                <input type="text" id="join_date" name="join_date" value="{{ old('join_date') }}" placeholder="DD/MM/YYYY" class="w-full border border-gray-300 rounded-md shadow-sm px-3 py-2 pl-10 focus:outline-none focus:ring-emerald-500 focus:border-emerald-500">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                                      <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </div>
                            @error('join_date') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>
                    </div>
                </fieldset>

                {{-- Alamat --}}
                <fieldset>
                    <legend class="text-xl font-semibold text-gray-700 mb-6">Alamat Lengkap</legend>
                    <div>
                        <label for="alamat" class="block text-sm font-medium text-gray-600 mb-1">Alamat</label>
                        <textarea id="alamat" name="alamat" rows="4" class="w-full border border-gray-300 rounded-md shadow-sm px-3 py-2 focus:outline-none focus:ring-emerald-500 focus:border-emerald-500">{{ old('alamat') }}</textarea>
                        @error('alamat') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                </fieldset>
            </form>
        </div>
    </div>

</body>
</html>
