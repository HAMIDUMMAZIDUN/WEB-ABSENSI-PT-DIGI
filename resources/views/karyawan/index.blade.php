<x-app-layout>
    {{-- Header Halaman (Tidak diubah, diasumsikan sudah sesuai) --}}
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

    {{-- Container Utama untuk Konten --}}
<div class="bg-white rounded-lg shadow-sm">

    {{-- Header Card dengan Search Form - Menggunakan Sticky --}}
    <div class="sticky top-0 z-20 bg-white border-b border-gray-200 rounded-t-lg">
        <div class="flex items-center justify-between p-6">
            <div class="flex items-center space-x-4">
                <div class="p-3 bg-green-100 rounded-lg">
                   <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.653-.125-1.274-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.653.125-1.274.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                </div>
                <h3 class="text-xl font-semibold text-gray-800">Total Karyawan : {{ $totalEmployees }} Orang</h3>
            </div>
            
            <form action="{{ route('karyawan.index') }}" method="GET" id="searchForm">
                <div class="relative">
                    <input type="text" name="search" id="searchInput" placeholder="Cari..."
                        class="w-64 pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                        value="{{ $search ?? '' }}">
                    
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <svg class="w-5 h-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path></svg>
                    </div>
                </div>
            </form>
        </div>
    </div>

    {{-- Tabel Data --}}       
    <div id="karyawan-data-container" class="overflow-x-auto">
        {{-- Tampilkan pesan loading, awalnya disembunyikan --}}
        <div id="loading-indicator" style="display: none;" class="text-center p-8">
            <p class="text-gray-500">Mencari...</p>
        </div>
        
        {{-- Muat tabel untuk pertama kali menggunakan @include --}}
        {{-- Perhatikan: Saya asumsikan file ini berisi <table>...</table> --}}
        @include('karyawan.karyawan-table', ['employees' => $employees])
    </div>
    
    {{-- Tombol Tambah Data dan Paginasi --}}
    <div class="flex justify-between items-center p-6 bg-white rounded-b-lg">
        {{-- Paginasi --}}
        <div class="flex-grow">
            {{ $employees->links() }}
        </div>

        {{-- Tombol Tambah Data --}}
        <div class="flex justify-end">
            <a href="{{ route('karyawan.create') }}" class="flex items-center px-6 py-3 space-x-2 font-semibold text-white bg-blue-600 rounded-lg shadow-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                <span>Tambah Data</span>
            </a>
        </div>
    </div>
            <script>
            document.addEventListener('DOMContentLoaded', function () {
        const searchInput = document.getElementById('searchInput');
        const tableContainer = document.getElementById('karyawan-data-container');
        const loadingIndicator = document.getElementById('loading-indicator');
        let debounceTimer;

        // Fungsi untuk mengambil data menggunakan Fetch API
        function fetchData(url) {
            // Tampilkan loading indicator dan sembunyikan tabel yang ada
            loadingIndicator.style.display = 'block';
            // Sembunyikan konten lama agar tidak flicker
            tableContainer.querySelector('.overflow-x-auto').style.display = 'none';
            tableContainer.querySelector('.flex.items-center.justify-between').style.display = 'none';

            fetch(url, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest' // Header penting agar Laravel tahu ini AJAX
                }
            })
            .then(response => response.text())
            .then(html => {
                // Ganti seluruh isi container dengan HTML baru dari server
                tableContainer.innerHTML = html;
            })
            .catch(error => {
                console.error('Error fetching data:', error);
                // Jika error, tampilkan kembali konten lama (atau pesan error)
                loadingIndicator.style.display = 'none';
                tableContainer.querySelector('.overflow-x-auto').style.display = 'block';
                tableContainer.querySelector('.flex.items-center.justify-between').style.display = 'block';
            });
        }

        // Event listener untuk input pencarian
        searchInput.addEventListener('keyup', function () {
            clearTimeout(debounceTimer);
            const query = this.value;
            // Buat URL dengan parameter pencarian
            const url = `{{ route('karyawan.index') }}?search=${query}`;

            debounceTimer = setTimeout(() => {
                fetchData(url);
            }, 500);
        });


        tableContainer.addEventListener('click', function(event) {
            // Cek apakah yang diklik adalah link di dalam elemen paginasi
            if (event.target.tagName === 'A' && event.target.closest('.pagination')) {
                event.preventDefault(); // Mencegah link berpindah halaman
                const url = event.target.href;
                if (url) {
                    fetchData(url);
                }
            }
        });
    });
        </script>
</x-app-layout>