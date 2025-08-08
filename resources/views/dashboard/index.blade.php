<x-app-layout>
    <div class="space-y-8">
        {{-- Bagian Atas: Ilustrasi & Status Absensi --}}
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

            {{-- Kolom Kiri: Ilustrasi --}}
            <div class="lg:col-span-2 bg-green-500/20 rounded-2xl p-6 flex items-center justify-center min-h-[260px]">
                <div class="text-center">
                    {{-- Ganti dengan path gambar Anda --}}
                    <img src="images/animedashboard.png" alt="Ilustrasi Absensi Karyawan" class="max-w-xs mx-auto -mb-4">
                </div>
            </div>

            {{-- Kolom Kanan: Waktu & Slider Absensi --}}
            <div class="space-y-6">
                
                {{-- Kartu Waktu & Tanggal --}}
                <div class="bg-white p-6 rounded-2xl shadow-lg shadow-gray-200/50 flex flex-col items-center text-center">
                    <p id="date-display" class="font-semibold text-gray-500 tracking-wide">Memuat tanggal...</p>
                    <p id="time-display" class="text-5xl font-bold text-gray-800 my-2">00:00:00</p>
                    <button class="mt-4 w-full bg-emerald-500 text-white font-bold py-3 px-4 rounded-xl hover:bg-emerald-600 transition-all duration-300 shadow-md shadow-emerald-500/30 hover:shadow-lg hover:shadow-emerald-500/40 focus:outline-none focus:ring-2 focus:ring-emerald-400 focus:ring-offset-2">
                        Lihat Data Kehadiran
                    </button>
                </div>

                <!-- Kartu Slider Absensi Karyawan dengan Splide.js -->
                <div id="absensi-slider" class="splide bg-gradient-to-br from-emerald-500 to-green-600 text-white rounded-2xl shadow-lg shadow-emerald-500/40 overflow-hidden relative">
                    <div class="splide__track">
                        <ul class="splide__list" style="display: flex;">
                            @if(isset($karyawanWithAbsensi) && !$karyawanWithAbsensi->isEmpty())
                                @foreach($karyawanWithAbsensi as $karyawan)
                                <li class="splide__slide">
                                    <div class="p-6">
                                        <h3 class="font-bold text-xl mb-3">Jam Masuk & Pulang</h3>
                                        <div class="space-y-1 min-h-[90px]">
                                            <p class="font-semibold text-lg truncate" title="{{ $karyawan->nama_karyawan }}">{{ $karyawan->nama_karyawan }}</p>
                                            <p class="text-sm text-white/90">Sudah absen masuk pukul <strong>{{ $karyawan->jam_masuk_str }}</strong></p>
                                            @if($karyawan->jam_pulang_str)
                                                <p class="text-sm text-white/90">Sudah absen pulang pukul <strong>{{ $karyawan->jam_pulang_str }}</strong></p>
                                            @else
                                                <p class="text-sm text-white/90">Belum Absen pulang</p>
                                            @endif
                                        </div>
                                        <div class="mt-5">
                                            <span class="text-xs font-medium text-white/80">Durasi kerja saat ini</span>
                                            <div class="w-full bg-white/30 rounded-full h-2 mt-1.5">
                                                <div class="bg-white h-2 rounded-full transition-all duration-500" style="width: {{ round($karyawan->durasi_persen) }}%"></div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                @endforeach
                            @else
                                <li class="splide__slide">
                                    <div class="p-6 text-center flex items-center justify-center min-h-[218px]">
                                        <div>
                                            <p class="font-semibold text-lg">Data absensi tidak ditemukan.</p>
                                            <p class="text-sm text-white/90 mt-1">Variabel belum dikirim dari controller.</p>
                                        </div>
                                    </div>
                                </li>
                            @endif
                        </ul>
                    </div>
                    @if(isset($karyawanWithAbsensi) && $karyawanWithAbsensi->count() > 1)
                    <div class="splide__arrows">
                        <button class="splide__arrow splide__arrow--prev absolute top-1/2 -translate-y-1/2 left-2 bg-white/20 hover:bg-white/40 disabled:opacity-50 transition-all p-2 rounded-full focus:outline-none">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" /></svg>
                        </button>
                        <button class="splide__arrow splide__arrow--next absolute top-1/2 -translate-y-1/2 right-2 bg-white/20 hover:bg-white/40 disabled:opacity-50 transition-all p-2 rounded-full focus:outline-none">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" /></svg>
                        </button>
                    </div>
                    @endif
                </div>
            </div>
        </div>

        {{-- Bagian Bawah: Tabel Karyawan dengan Slider --}}
        <div>
            <h3 class="text-xl font-bold text-gray-800 mb-4">Daftar Kehadiran Karyawan Hari Ini</h3>
            <div id="tabel-karyawan-slider" class="splide relative">
                <div class="splide__track">
                    <ul class="splide__list">
                        
                        {{-- Mengelompokkan data karyawan per 10 orang --}}
                        @forelse (($karyawanWithAbsensi ?? collect())->chunk(10) as $chunk)
                        <li class="splide__slide">
                            <div class="bg-white rounded-2xl shadow-sm p-6 overflow-x-auto">
                                <table class="w-full text-sm text-left text-gray-500">
                                    <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                                        <tr>
                                            <th scope="col" class="py-3 px-6 w-12 text-center">No.</th>
                                            <th scope="col" class="py-3 px-6">Karyawan</th>
                                            <th scope="col" class="py-3 px-6">Jabatan</th>
                                            <th scope="col" class="py-3 px-6">Tanggal</th>
                                            <th scope="col" class="py-3 px-6">Waktu Masuk</th>
                                            <th scope="col" class="py-3 px-6">Waktu Pulang</th>
                                            <th scope="col" class="py-3 px-6">Detail</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($chunk as $item)
                                        <tr class="@if($loop->odd) bg-white @else bg-emerald-50 @endif border-b hover:bg-emerald-100 transition-colors duration-200">
                                            <td class="py-4 px-6 font-medium text-gray-900 text-center">
                                                {{ ($loop->parent->index * 10) + $loop->iteration }}
                                            </td>
                                            <td class="py-4 px-6">
                                                <div class="flex items-center space-x-3">
                                                    <img class="w-10 h-10 rounded-full object-cover" src="{{ $item->foto ?? 'https://i.pravatar.cc/150?u=' . $item->email }}" alt="Avatar">
                                                    <div>
                                                        <div class="font-semibold text-gray-900">{{ $item->nama_karyawan }}</div>
                                                        <div class="text-xs text-gray-500">{{ $item->email }}</div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="py-4 px-6 font-medium text-gray-800">{{ $item->bagian }}</td>
                                            <td class="py-4 px-6 font-medium text-gray-800">{{ now()->format('d/m/Y') }}</td>
                                            <td class="py-4 px-6 font-medium text-gray-800">{{ $item->jam_masuk_str ?? '--:--' }}</td>
                                            <td class="py-4 px-6 font-medium text-gray-800">{{ $item->jam_pulang_str ?? '--:--' }}</td>
                                            <td class="py-4 px-6">
                                                {{-- Tombol Detail Diperbarui dengan data attributes --}}
                                                <button class="detail-button bg-green-100 text-green-700 text-xs font-bold py-2 px-4 rounded-lg hover:bg-green-200"
                                                    data-nama="{{ $item->nama_karyawan }}"
                                                    data-email="{{ $item->email }}"
                                                    data-foto="{{ $item->foto ?? 'https://i.pravatar.cc/150?u=' . $item->email }}"
                                                    data-nik="{{ $item->nik }}"
                                                    data-jabatan="{{ $item->bagian }}"
                                                    data-role="{{ $item->role }}"
                                                    data-status="{{ $item->status }}"
                                                    data-bergabung="{{ \Carbon\Carbon::parse($item->tanggal_bergabung)->isoFormat('D MMMM YYYY') }}"
                                                    data-kontak="{{ $item->kontak }}"
                                                    data-alamat="{{ $item->alamat }}">
                                                    Lihat
                                                </button>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </li>
                        @empty
                        <li class="splide__slide">
                            <div class="bg-white rounded-2xl shadow-sm p-6 text-center">
                                <p class="text-gray-500">Tidak ada data kehadiran untuk ditampilkan.</p>
                            </div>
                        </li>
                        @endforelse
                    </ul>
                </div>
                
                @if(isset($karyawanWithAbsensi) && $karyawanWithAbsensi->count() > 10)
                <div class="splide__arrows">
                    <button class="splide__arrow splide__arrow--prev absolute top-1/2 -translate-y-1/2 -left-4 bg-white shadow-md rounded-full p-2 focus:outline-none z-10">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" /></svg>
                    </button>
                    <button class="splide__arrow splide__arrow--next absolute top-1/2 -translate-y-1/2 -right-4 bg-white shadow-md rounded-full p-2 focus:outline-none z-10">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>
                    </button>
                </div>
                @endif
            </div>
        </div>
    </div>

    <!-- ================================================== -->
    <!--          MODAL DETAIL KARYAWAN DITAMBAHKAN         -->
    <!-- ================================================== -->
    <div id="detail-modal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50 p-4">
        <div class="bg-white rounded-2xl shadow-2xl w-full max-w-2xl transform transition-all duration-300 scale-95 opacity-0" id="modal-content">
            <!-- Header Modal -->
            <div class="flex justify-between items-center p-4 border-b">
                <h3 class="text-xl font-bold text-gray-800">Detail Karyawan</h3>
                <button id="close-modal-button" class="text-gray-400 hover:text-gray-600">&times;</button>
            </div>

            <!-- Body Modal -->
            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <!-- Kolom Foto -->
                    <div class="md:col-span-1 flex flex-col items-center text-center">
                        <img id="modal-foto" src="" alt="Foto Karyawan" class="w-32 h-32 rounded-full object-cover border-4 border-emerald-200 shadow-md">
                        <h4 id="modal-nama" class="mt-4 text-xl font-bold text-gray-900">Nama Karyawan</h4>
                        <p id="modal-email" class="text-sm text-gray-500">email@karyawan.com</p>
                    </div>

                    <!-- Kolom Detail Data -->
                    <div class="md:col-span-2 grid grid-cols-2 gap-x-6 gap-y-4 text-sm">
                        <div>
                            <p class="text-gray-500 font-semibold">NIK</p>
                            <p id="modal-nik" class="text-gray-800 font-medium">1234567890</p>
                        </div>
                        <div>
                            <p class="text-gray-500 font-semibold">Jabatan</p>
                            <p id="modal-jabatan" class="text-gray-800 font-medium">Jabatan Karyawan</p>
                        </div>
                        <div>
                            <p class="text-gray-500 font-semibold">Role</p>
                            <p id="modal-role" class="text-gray-800 font-medium capitalize">Role</p>
                        </div>
                        <div>
                            <p class="text-gray-500 font-semibold">Status</p>
                            <p id="modal-status" class="text-gray-800 font-medium capitalize">Status</p>
                        </div>
                        <div>
                            <p class="text-gray-500 font-semibold">Tanggal Bergabung</p>
                            <p id="modal-bergabung" class="text-gray-800 font-medium">01 Januari 2025</p>
                        </div>
                        <div>
                            <p class="text-gray-500 font-semibold">Kontak</p>
                            <p id="modal-kontak" class="text-gray-800 font-medium">08123456789</p>
                        </div>
                        <div class="col-span-2">
                            <p class="text-gray-500 font-semibold">Alamat</p>
                            <p id="modal-alamat" class="text-gray-800 font-medium">Alamat lengkap karyawan.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- 1. Sertakan library Splide.js dari CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/css/splide.min.css">
    <script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/js/splide.min.js"></script>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        
        // Fungsi untuk memperbarui jam & tanggal
        function updateLiveClock() {
            const timeEl = document.getElementById('time-display');
            const dateEl = document.getElementById('date-display');
            if (!timeEl || !dateEl) return;

            const now = new Date();
            const timeString = now.toLocaleTimeString('en-GB');
            const dateOptions = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
            const dateString = now.toLocaleDateString('id-ID', dateOptions);

            timeEl.textContent = timeString;
            dateEl.textContent = dateString;
        }
        setInterval(updateLiveClock, 1000);
        updateLiveClock();

        // Inisialisasi slider absensi
        var absensiSlider = document.getElementById('absensi-slider');
        if (absensiSlider && absensiSlider.querySelectorAll('.splide__slide').length > 1) {
            new Splide(absensiSlider, { type: 'loop', perPage: 1, pagination: false, arrows: true }).mount();
        }

        // Inisialisasi slider tabel karyawan
        var tabelSlider = document.getElementById('tabel-karyawan-slider');
        if (tabelSlider && tabelSlider.querySelectorAll('.splide__slide').length > 1) {
            new Splide(tabelSlider, { type: 'slide', perPage: 1, pagination: false, arrows: true, drag: true }).mount();
        }

        // ===================================
        // Logika untuk Modal Detail Karyawan
        // ===================================
        const modal = document.getElementById('detail-modal');
        const modalContent = document.getElementById('modal-content');
        const closeModalButton = document.getElementById('close-modal-button');
        const detailButtons = document.querySelectorAll('.detail-button');

        function openModal() {
            modal.classList.remove('hidden');
            setTimeout(() => {
                modalContent.classList.remove('scale-95', 'opacity-0');
                modalContent.classList.add('scale-100', 'opacity-100');
            }, 50); // Small delay for transition
        }

        function closeModal() {
            modalContent.classList.add('scale-95', 'opacity-0');
            modalContent.classList.remove('scale-100', 'opacity-100');
            setTimeout(() => {
                modal.classList.add('hidden');
            }, 300); // Match transition duration
        }

        detailButtons.forEach(button => {
            button.addEventListener('click', function() {
                const data = this.dataset;
                
                // Mengisi data ke dalam modal
                document.getElementById('modal-foto').src = data.foto;
                document.getElementById('modal-nama').textContent = data.nama;
                document.getElementById('modal-email').textContent = data.email;
                document.getElementById('modal-nik').textContent = data.nik;
                document.getElementById('modal-jabatan').textContent = data.jabatan;
                document.getElementById('modal-role').textContent = data.role;
                document.getElementById('modal-status').textContent = data.status;
                document.getElementById('modal-bergabung').textContent = data.bergabung;
                document.getElementById('modal-kontak').textContent = data.kontak;
                document.getElementById('modal-alamat').textContent = data.alamat;

                openModal();
            });
        });

        // Event listener untuk menutup modal
        closeModalButton.addEventListener('click', closeModal);
        modal.addEventListener('click', function(event) {
            if (event.target === modal) {
                closeModal();
            }
        });
    });
    </script>

</x-app-layout>
