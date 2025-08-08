<x-app-layout>
    <div class="space-y-8">
        {{-- Header Halaman --}}
        <div>
            <h1 class="text-3xl font-bold text-gray-800">Keterangan Kehadiran</h1>
        </div>

        {{-- Filter dan Tombol Aksi --}}
        <div class="flex flex-wrap items-center gap-4">
            {{-- Form untuk Filter dan Pencarian --}}
            <form method="GET" action="{{ route('keterangan.kehadiran') }}" class="flex flex-wrap items-center gap-4">
                {{-- Filter Bagian --}}
                <div class="relative">
                    <select name="bagian" class="appearance-none w-full sm:w-48 bg-white border border-gray-300 text-gray-700 py-2 px-4 pr-8 rounded-lg focus:outline-none focus:bg-white focus:border-emerald-500">
                        <option value="">Semua Bagian</option>
                        @foreach ($daftarBagian as $bagian)
                            <option value="{{ $bagian }}" @if(request('bagian') == $bagian) selected @endif>{{ $bagian }}</option>
                        @endforeach
                    </select>
                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                    </div>
                </div>
                {{-- Search Nama --}}
                <div class="relative">
                    <input type="text" name="search" placeholder="Cari Nama Karyawan..." value="{{ request('search') }}" class="w-full sm:w-64 bg-white border border-gray-300 text-gray-700 py-2 px-4 rounded-lg focus:outline-none focus:bg-white focus:border-emerald-500">
                </div>
                {{-- Tombol Cari --}}
                <button type="submit" class="bg-emerald-500 hover:bg-emerald-600 text-white font-bold py-2 px-6 rounded-lg transition-colors">
                    Cari
                </button>
            </form>
            {{-- Tombol Unduh PDF --}}
            <a href="{{ route('keterangan.kehadiran.pdf', request()->query()) }}" class="bg-gray-700 hover:bg-gray-800 text-white font-bold py-2 px-6 rounded-lg transition-colors">
                Unduh PDF
            </a>
        </div>

        {{-- Kartu Ringkasan Status --}}
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            <div class="bg-white p-4 rounded-lg shadow-sm flex items-center gap-4">
                <div class="bg-green-100 p-2 rounded-lg"><svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg></div>
                <div><p class="text-gray-500 text-sm">Hadir</p><p class="font-bold text-xl">{{ $counts['hadir'] }}</p></div>
            </div>
            <div class="bg-white p-4 rounded-lg shadow-sm flex items-center gap-4">
                <div class="bg-red-100 p-2 rounded-lg"><svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg></div>
                <div><p class="text-gray-500 text-sm">Alpha</p><p class="font-bold text-xl">{{ $counts['alpha'] }}</p></div>
            </div>
            <div class="bg-white p-4 rounded-lg shadow-sm flex items-center gap-4">
                <div class="bg-orange-100 p-2 rounded-lg"><svg class="w-6 h-6 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg></div>
                <div><p class="text-gray-500 text-sm">Terlambat</p><p class="font-bold text-xl">{{ $counts['terlambat'] }}</p></div>
            </div>
            <div class="bg-white p-4 rounded-lg shadow-sm flex items-center gap-4">
                <div class="bg-blue-100 p-2 rounded-lg"><svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg></div>
                <div><p class="text-gray-500 text-sm">Izin</p><p class="font-bold text-xl">{{ $counts['izin'] }}</p></div>
            </div>
        </div>

        {{-- Tabel Data Kehadiran --}}
        <div class="bg-white rounded-2xl shadow-sm p-6 overflow-x-auto">
            <table class="w-full text-sm text-left text-gray-500">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                    <tr>
                        <th scope="col" class="py-3 px-6 w-12 text-center">No.</th>
                        <th scope="col" class="py-3 px-6">Karyawan</th>
                        <th scope="col" class="py-3 px-6">Bagian</th>
                        <th scope="col" class="py-3 px-6">Tanggal</th>
                        <th scope="col" class="py-3 px-6">Waktu Masuk</th>
                        <th scope="col" class="py-3 px-6">Waktu Pulang</th>
                        <th scope="col" class="py-3 px-6">Status</th>
                        <th scope="col" class="py-3 px-6">Keterangan</th>
                        <th scope="col" class="py-3 px-6 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($dataKehadiran as $item)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="py-4 px-6 font-medium text-gray-900 text-center">{{ $loop->iteration }}</td>
                        <td class="py-4 px-6">
                            <div class="flex items-center space-x-3">
                                <img class="w-10 h-10 rounded-full object-cover" src="{{ $item->foto ?? 'https://i.pravatar.cc/150?u=' . $item->email }}" alt="Avatar">
                                <div>
                                    <div class="font-semibold text-gray-900">{{ $item->nama_karyawan }}</div>
                                    <div class="text-xs text-gray-500">{{ $item->email }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="py-4 px-6">
                            @php
                                $deptColors = [
                                    'IT' => 'bg-red-500', 'Finance' => 'bg-blue-500', 'HRD' => 'bg-green-500',
                                    'Marketing' => 'bg-orange-500', 'Sales' => 'bg-purple-500', 'Engineer' => 'bg-red-500',
                                    'Product' => 'bg-indigo-500',
                                ];
                                $bgColor = $deptColors[$item->bagian] ?? 'bg-gray-400';
                            @endphp
                            <span class="px-3 py-1 text-white text-xs font-semibold rounded-full {{ $bgColor }}">
                                {{ $item->bagian }}
                            </span>
                        </td>
                        <td class="py-4 px-6 font-medium text-gray-800">{{ now()->format('d/m/Y') }}</td>
                        <td class="py-4 px-6 font-medium text-gray-800">{{ $item->waktu_masuk }}</td>
                        <td class="py-4 px-6 font-medium text-gray-800">{{ $item->waktu_pulang }}</td>
                        <td class="py-4 px-6">
                            @php
                                $statusClass = [
                                    'Hadir' => 'bg-green-100 text-green-800', 'Alpha' => 'bg-red-100 text-red-800',
                                    'Terlambat' => 'bg-orange-100 text-orange-800', 'Izin' => 'bg-blue-100 text-blue-800',
                                ][$item->status_kehadiran] ?? 'bg-gray-100 text-gray-800';
                            @endphp
                            <span class="px-2 py-1 font-semibold leading-tight text-xs rounded-full {{ $statusClass }}">
                                {{ $item->status_kehadiran }}
                            </span>
                        </td>
                        <td class="py-4 px-6 font-medium text-gray-800">{{ $item->keterangan_text }}</td>
                        <td class="py-4 px-6">
                            <div class="flex items-center justify-center gap-2">
                                {{-- Tombol Edit --}}
                                <button class="edit-button text-gray-400 hover:text-emerald-500"
                                    data-id="{{ $item->id }}"
                                    data-nama="{{ $item->nama_karyawan }}"
                                    data-email="{{ $item->email }}"
                                    data-bagian="{{ $item->bagian }}">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                                </button>
                                {{-- Form Hapus --}}
                                <form action="{{ route('karyawan.destroy', $item->id) }}" method="POST" class="delete-form">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-gray-400 hover:text-red-500">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="9" class="text-center py-4 text-gray-500">Tidak ada data yang cocok dengan filter Anda.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal untuk Edit Karyawan -->
    <div id="edit-modal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50 p-4">
        <div class="bg-white rounded-2xl shadow-2xl w-full max-w-lg transform transition-all duration-300 scale-95 opacity-0" id="edit-modal-content">
            <form id="edit-form" method="POST" action="">
                @csrf
                @method('PATCH')
                <!-- Header Modal -->
                <div class="flex justify-between items-center p-4 border-b">
                    <h3 class="text-xl font-bold text-gray-800">Edit Data Karyawan</h3>
                    <button type="button" id="close-edit-modal-button" class="text-gray-400 hover:text-gray-600">&times;</button>
                </div>
                <!-- Body Modal -->
                <div class="p-6 space-y-4">
                    <div>
                        <label for="edit-nama" class="block text-sm font-medium text-gray-700">Nama Karyawan</label>
                        <input type="text" id="edit-nama" name="nama_karyawan" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-emerald-500 focus:border-emerald-500">
                    </div>
                    <div>
                        <label for="edit-email" class="block text-sm font-medium text-gray-700">Email</label>
                        <input type="email" id="edit-email" name="email" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-emerald-500 focus:border-emerald-500">
                    </div>
                    <div>
                        <label for="edit-bagian" class="block text-sm font-medium text-gray-700">Bagian</label>
                        <select id="edit-bagian" name="bagian" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-emerald-500 focus:border-emerald-500">
                            @foreach ($daftarBagian as $bagian)
                                <option value="{{ $bagian }}">{{ $bagian }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <!-- Footer Modal -->
                <div class="px-6 py-4 bg-gray-50 text-right rounded-b-2xl">
                    <button type="submit" class="bg-emerald-500 hover:bg-emerald-600 text-white font-bold py-2 px-6 rounded-lg transition-colors">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- Skrip dipindahkan dari @push untuk memastikan selalu dimuat --}}
    <!-- Sertakan SweetAlert2 -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Logika untuk Modal Edit
            const editModal = document.getElementById('edit-modal');
            const editModalContent = document.getElementById('edit-modal-content');
            const closeEditModalButton = document.getElementById('close-edit-modal-button');
            const editForm = document.getElementById('edit-form');
            const editButtons = document.querySelectorAll('.edit-button');

            function openEditModal() {
                editModal.classList.remove('hidden');
                setTimeout(() => {
                    editModalContent.classList.remove('scale-95', 'opacity-0');
                    editModalContent.classList.add('scale-100', 'opacity-100');
                }, 50);
            }

            function closeEditModal() {
                editModalContent.classList.add('scale-95', 'opacity-0');
                setTimeout(() => {
                    editModal.classList.add('hidden');
                }, 300);
            }

            editButtons.forEach(button => {
                button.addEventListener('click', function () {
                    const data = this.dataset;
                    // Set action URL form
                    editForm.action = `/karyawan/${data.id}`;
                    // Isi form dengan data dari baris yang diklik
                    document.getElementById('edit-nama').value = data.nama;
                    document.getElementById('edit-email').value = data.email;
                    document.getElementById('edit-bagian').value = data.bagian;
                    openEditModal();
                });
            });

            closeEditModalButton.addEventListener('click', closeEditModal);
            editModal.addEventListener('click', function(event) {
                if (event.target === editModal) {
                    closeEditModal();
                }
            });

            // Logika untuk Konfirmasi Hapus dengan SweetAlert
            const deleteForms = document.querySelectorAll('.delete-form');
            deleteForms.forEach(form => {
                form.addEventListener('submit', function (event) {
                    event.preventDefault(); // Mencegah form submit secara langsung
                    Swal.fire({
                        title: 'Apakah Anda yakin?',
                        text: "Data yang dihapus tidak dapat dikembalikan!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#10B981', // Emerald 500
                        cancelButtonColor: '#6B7280',  // Gray 500
                        confirmButtonText: 'Ya, hapus!',
                        cancelButtonText: 'Batal'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit(); // Jika dikonfirmasi, lanjutkan submit form
                        }
                    })
                });
            });
        });
    </script>
</x-app-layout>
