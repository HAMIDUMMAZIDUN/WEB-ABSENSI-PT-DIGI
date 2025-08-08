<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'PT.DIGI TEKNO INDONESIA') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    },
                },
            },
        }
    </script>
</head>
<body class="font-sans antialiased">
    <div class="flex h-screen bg-gray-50 text-gray-800">

        <!-- Sidebar Kiri -->
        <aside class="w-64 flex-shrink-0 flex flex-col bg-white p-4">
            <div class="px-4 py-2 mb-8">
                <h1 class="text-2xl font-bold text-gray-900">PT.DIGI TEKNO INDONESIA</h1>
            </div>

            <nav class="flex-grow space-y-2">
                <a href="{{ route('dashboard') }}" class="flex items-center px-4 py-3 rounded-xl {{ request()->routeIs('dashboard') ? 'bg-green-500 text-white shadow-lg' : 'text-gray-500 hover:bg-gray-100' }}">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                    <span class="ml-3 font-semibold">Dashboard</span>
                </a>
                <a href="{{ route('karyawan.index') }}"  class="flex items-center px-4 py-3 rounded-xl {{ request()->routeIs('karyawan.index') ? 'bg-green-500 text-white shadow-lg' : 'text-gray-500 hover:bg-gray-100' }}">
                     <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 00-2-2H5z"></path></svg>
                    <span class="ml-3 font-semibold">Karyawan</span>
                </a>
                <a href="{{ route('rekap.absensi') }}" class="flex items-center px-4 py-3 rounded-xl {{ request()->routeIs('Rekap Absensi') ? 'bg-green-500 text-white shadow-lg' : 'text-gray-500 hover:bg-gray-100' }}">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                    <span class="ml-3 font-semibold">Rekap Absensi</span>
                </a>
                <a href="{{ route('scan.kehadiran') }}"  class="flex items-center px-4 py-3 rounded-xl {{ request()->routeIs('Scan Kehadiran') ? 'bg-green-500 text-white shadow-lg' : 'text-gray-500 hover:bg-gray-100' }}">
                     <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 00-2-2H5z"></path></svg>
                    <span class="ml-3 font-semibold">Scan Kehadiran</span>
                </a>
                <a href="#" class="flex items-center px-4 py-3 rounded-xl {{ request()->routeIs('ssetting') ? 'bg-green-500 text-white shadow-lg' : 'text-gray-500 hover:bg-gray-100' }}">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                    <span class="ml-3 font-semibold">Setting</span>
                </a>
            </nav>

            <div class="mt-auto">
                <div class="p-4 bg-green-50 rounded-xl relative">
                    <div class="absolute -top-4 left-1/2 -translate-x-1/2 bg-orange-200 p-3 rounded-full">
                        <svg class="w-6 h-6 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v13m0-13V6a2 2 0 112 2h-2zm0 0V5.5A2.5 2.5 0 109.5 8H12zm-7 4h14M5 12a2 2 0 110-4h14a2 2 0 110 4H5z"></path></svg>
                    </div>
                    <h3 class="text-lg font-bold text-gray-800 mt-6">50% Discount</h3>
                    <p class="text-sm text-gray-500 mt-1">Get a discount on certain days and destinations.</p>
                </div>
                <form method="POST" action="{{ route('logout') }}" class="mt-4">
                    @csrf
                    <a href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();" class="flex items-center w-full px-4 py-3 text-gray-500 hover:bg-gray-100 rounded-xl">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                        <span class="ml-3 font-semibold">Log out</span>
                    </a>
                </form>
            </div>
        </aside>

        <!-- Konten Utama -->
        <main class="flex-1 p-6 lg:p-10 overflow-y-auto">
            {{ $slot }}
        </main>

        <!-- Sidebar Kanan -->
        <aside class="w-80 flex-shrink-0 hidden lg:block p-6">
            <div class="flex items-center justify-end space-x-4 mb-10">
                <button class="p-2 rounded-full hover:bg-gray-100">
                    <svg class="w-6 h-6 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path></svg>
                </button>
                <div class="flex items-center space-x-3">
                    <div class="text-right">
                        <p class="font-semibold text-gray-900">{{ Auth::user()->username }}</p>
                        <p class="text-sm text-gray-500">{{ Auth::user()->name }}</p>
                    </div>
                    <img src="/images/hamidun1.jpg" alt="Foto Hamidun" class="w-12 h-12 rounded-full">
                </div>
            </div>

            <div x-data="calendar" class="bg-white p-4 rounded-2xl shadow-sm">
                <div class="flex justify-between items-center mb-4">
                    <h4 class="font-bold text-lg text-gray-900" x-text="`${monthName} ${year}`"></h4>
                    <div class="text-gray-500">
                        <button @click="changeMonth(-1)" class="p-1 rounded-full hover:bg-gray-100"><svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd"></path></svg></button>
                        <button @click="changeMonth(1)" class="p-1 rounded-full hover:bg-gray-100"><svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg></button>
                    </div>
                </div>
                <div class="grid grid-cols-7 gap-1 text-center text-sm">
                    <template x-for="day in dayNames"><div class="font-semibold text-gray-400" x-text="day"></div></template>
                    <template x-for="blankday in blankDays"><div></div></template>
                    <template x-for="day in daysInMonth">
                        <div x-text="day" class="p-1.5 rounded-full cursor-pointer" :class="{'bg-green-500 text-white font-bold': isToday(day), 'text-gray-700 hover:bg-gray-100': !isToday(day)}"></div>
                    </template>
                </div>
            </div>

           
        </aside>
    </div>

    <script>
       document.addEventListener('alpine:init', () => {
    Alpine.data('calendar', () => ({
        // currentDate diubah untuk mengambil tanggal hari ini secara otomatis
        currentDate: new Date(),
        dayNames: ['Min', 'Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab'], // Disesuaikan ke B. Indonesia
        monthName: '',
        year: '',
        daysInMonth: [],
        blankDays: [],
        init() {
            this.updateCalendar();
        },
        updateCalendar() {
            const date = this.currentDate;
            this.year = date.getFullYear();
            this.monthName = new Intl.DateTimeFormat('id-ID', { month: 'long' }).format(date); // Disesuaikan ke B. Indonesia
            const firstDayOfMonth = new Date(this.year, date.getMonth(), 1).getDay();
            const totalDaysInMonth = new Date(this.year, date.getMonth() + 1, 0).getDate();
            this.blankDays = Array.from({ length: firstDayOfMonth });
            this.daysInMonth = Array.from({ length: totalDaysInMonth }, (_, i) => i + 1);
        },
        // Logika isToday diubah total
        isToday(day) {
            const today = new Date();
            // Fungsi ini akan mengembalikan 'true' hanya jika hari, bulan, dan tahun yang ditampilkan sama dengan hari ini.
            return day === today.getDate() &&
                   this.currentDate.getMonth() === today.getMonth() &&
                   this.year === today.getFullYear();
        },
        changeMonth(monthOffset) {
            const newDate = new Date(this.currentDate);
            // setDate(1) untuk menghindari bug saat pindah bulan (misal: dari 31 Jan ke Feb)
            newDate.setDate(1);
            newDate.setMonth(newDate.getMonth() + monthOffset);
            this.currentDate = newDate;
            this.updateCalendar();
        }
    }));
});
    </script>
</body>
</html>
