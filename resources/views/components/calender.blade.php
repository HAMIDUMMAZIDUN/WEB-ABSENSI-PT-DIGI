@props(['date'])

@php
    // Menggunakan Carbon untuk manipulasi tanggal (sudah ada di Laravel)
    // Pastikan locale diatur ke 'id' di AppServiceProvider untuk 'translatedFormat'
    // App::setLocale('id');
    $carbonDate = \Carbon\Carbon::parse($date);
    $monthName = $carbonDate->translatedFormat('F'); // Format nama bulan sesuai locale (e.g., Juli)
    $year = $carbonDate->year;
    $daysInMonth = $carbonDate->daysInMonth;
    $firstDayOfMonth = $carbonDate->copy()->firstOfMonth()->dayOfWeek; // 0=Minggu, 1=Senin, ...
    
    // Cek apakah bulan dan tahun yang ditampilkan sama dengan bulan dan tahun saat ini
    $isCurrentMonthAndYear = now()->isSameMonth($carbonDate, true);
    $today = now()->day;

    // Nama hari dalam Bahasa Indonesia
    $dayNames = ['Min', 'Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab'];
@endphp

{{-- 
  Elemen pembungkus sudah memiliki 'dark:bg-gray-800' yang akan diaktifkan 
  oleh kelas 'dark' pada elemen HTML atau BODY.
--}}
<div class="bg-white dark:bg-gray-800 p-4 rounded-xl shadow">
    <div class="flex justify-between items-center mb-4">
        {{-- Judul bulan dan tahun, sudah memiliki 'dark:text-white' --}}
        <h4 class="font-bold text-lg text-gray-900 dark:text-white">{{ $monthName }} {{ $year }}</h4>
        
        {{-- Tombol navigasi bulan --}}
        <div class="text-gray-600 dark:text-gray-400">
            {{-- Tombol ini bisa dihubungkan dengan Livewire/Alpine.js untuk navigasi bulan --}}
            <button class="p-1 rounded-full hover:bg-gray-200 dark:hover:bg-gray-700" aria-label="Bulan Sebelumnya">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
            </button>
            <button class="p-1 rounded-full hover:bg-gray-200 dark:hover:bg-gray-700" aria-label="Bulan Berikutnya">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
            </button>
        </div>
    </div>
    <div class="grid grid-cols-7 gap-2 text-center text-sm">
        {{-- Render nama hari dengan warna yang sesuai untuk mode gelap --}}
        @foreach ($dayNames as $day)
            <div class="font-semibold text-gray-500 dark:text-gray-400">{{ $day }}</div>
        @endforeach
        
        {{-- Render sel kosong sebelum hari pertama --}}
        @for ($i = 0; $i < $firstDayOfMonth; $i++)
            <div></div>
        @endfor

        {{-- Render semua hari dalam sebulan --}}
        @for ($day = 1; $day <= $daysInMonth; $day++)
            @php
                // Tentukan apakah hari ini adalah tanggal sekarang
                $isToday = ($day == $today) && $isCurrentMonthAndYear;
            @endphp
            <div @class([
                    'flex items-center justify-center h-8 w-8 rounded-full',
                    // Kelas untuk menandai hari ini (sudah kontras untuk kedua mode)
                    'bg-green-500 text-white' => $isToday, 
                    // Kelas untuk hari biasa, dengan warna teks yang sesuai untuk mode gelap
                    'text-gray-700 dark:text-gray-200 hover:bg-gray-200 dark:hover:bg-gray-700 cursor-pointer' => !$isToday,
                ])>
                {{ $day }}
            </div>
        @endfor
    </div>
</div>
