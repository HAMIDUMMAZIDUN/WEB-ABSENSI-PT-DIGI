<x-app-layout>
    {{-- Header Halaman --}}
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-3xl font-bold text-gray-800">Karyawan 👨‍💼</h2>
                <p class="text-gray-500">Melihat dan mengelola</p>
            </div>
            <div class="flex items-center space-x-4">
                <div class="text-right">
                    <p class="font-semibold text-gray-800">{{ Auth::user()->name }}</p>
                    <p class="text-sm text-gray-500">HRD</p>
                </div>
                <img src="https://i.pravatar.cc/150?u={{ urlencode(Auth::user()->name) }}" alt="Avatar" class="w-12 h-12 rounded-full">
            </div>
        </div>
    </x-slot>

    {{-- Konten Utama (Card Tabel Karyawan) --}}
    <div class="bg-white rounded-xl shadow-sm">
        {{-- Header Card --}}
        <div class="flex items-center justify-between p-6 border-b">
            <div class="flex items-center space-x-4">
                <div class="p-3 bg-green-100 rounded-xl">
                   <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.653-.125-1.274-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.653.125-1.274.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                </div>
                <h3 class="text-xl font-semibold text-gray-800">Total Karyawan : 80 Orang</h3>
            </div>
            <div class="relative">
                <input type="text" placeholder="Cari Karyawan" class="pl-10 pr-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                </div>
            </div>
        </div>

        {{-- Tabel Data --}}
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left text-gray-600">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3">Nama</th>
                        <th scope="col" class="px-6 py-3">NIK</th>
                        <th scope="col" class="px-6 py-3">Nomor HP</th>
                        <th scope="col" class="px-6 py-3">Department</th>
                        <th scope="col" class="px-6 py-3">Jabatan</th>
                        <th scope="col" class="px-6 py-3">Tanggal Bergabung</th>
                        <th scope="col" class="px-6 py-3 text-center">Status</th>
                        <th scope="col" class="px-6 py-3 text-center"></th>
                    </tr>
                </thead>
                <tbody>
                    {{-- Loop data karyawan dari controller --}}
                    @foreach ($employees as $employee)
                    <tr class="bg-white border-b hover:bg-gray-50">
                        <td class="px-6 py-4">
                            <div class="flex items-center space-x-3">
                                <img src="https://i.pravatar.cc/150?u={{ urlencode($employee['name']) }}" alt="Avatar" class="w-10 h-10 rounded-full">
                                <div>
                                    <div class="font-semibold text-gray-800">{{ $employee['name'] }}</div>
                                    <div class="text-xs text-gray-500">{{ $employee['email'] }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4">{{ $employee['nik'] }}</td>
                        <td class="px-6 py-4">{{ $employee['phone'] }}</td>
                        <td class="px-6 py-4">
                            <div class="flex items-center">
                                <span class="w-2.5 h-2.5 {{ $employee['dept_color'] }} rounded-full mr-2"></span>
                                {{ $employee['dept'] }}
                            </div>
                        </td>
                        <td class="px-6 py-4">{{ $employee['role'] }}</td>
                        <td class="px-6 py-4">{{ $employee['join_date'] }}</td>
                        <td class="px-6 py-4 text-center">
                            <span class="px-3 py-1 text-xs rounded-full font-semibold
                                @if($employee['status_color'] == 'green') bg-green-100 text-green-800 @endif
                                @if($employee['status_color'] == 'red') bg-red-100 text-red-800 @endif
                                @if($employee['status_color'] == 'yellow') bg-yellow-100 text-yellow-800 @endif">
                                {{ $employee['status'] }}
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center justify-center space-x-2">
                                <button class="p-2 text-gray-500 rounded-lg hover:bg-gray-200"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg></button>
                                <button class="p-2 text-gray-500 rounded-lg hover:bg-gray-200"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.5L14.732 3.732z"></path></svg></button>
                                <button class="p-2 text-red-500 rounded-lg hover:bg-red-100"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg></button>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{-- Footer Card (Paginasi & Aksi) --}}
        <div class="flex items-center justify-between p-4">
            <span class="text-sm text-gray-600">Menampilkan 1 hingga 8 dari 80 entri</span>
            <div class="flex items-center space-x-4">
                {{-- Kontrol Paginasi --}}
            </div>
        </div>
    </div>
</x-app-layout>
