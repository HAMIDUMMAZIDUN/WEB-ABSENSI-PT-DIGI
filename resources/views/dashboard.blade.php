<x-app-layout>
    {{-- Script untuk Alpine.js, penting untuk interaktivitas. Atribut 'defer' memastikan skrip dieksekusi setelah dokumen di-parse. --}}
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        // Pastikan Tailwind menggunakan mode kelas untuk tema gelap
        tailwind.config = {
            darkMode: 'class',
        }
    </script>

    {{-- 
        Container utama dengan data Alpine.js untuk mengelola tema.
        x-data="themeManager" akan menginisialisasi logika tema.
        :class="{ 'dark': isDarkMode }" akan menambahkan kelas 'dark' ke elemen ini saat isDarkMode true.
    --}}
    <div x-data="themeManager" x-init="$watch('isDarkMode', val => localStorage.setItem('darkMode', val))" :class="{ 'dark': isDarkMode }" class="flex h-screen bg-gray-100 dark:bg-gray-900 font-sans">

        <aside class="w-64 flex-shrink-0 hidden sm:block">
            <div class="flex flex-col h-full p-4 bg-white dark:bg-gray-800 border-r dark:border-gray-700">
                <div class="px-4 py-2 mb-4">
                    <h1 class="text-2xl font-bold text-gray-800 dark:text-white">Travelingo</h1>
                </div>

                <nav class="flex-grow space-y-2">
                    <a href="#" class="flex items-center px-4 py-3 text-white bg-green-500 rounded-lg">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                        <span class="ml-3 font-semibold">Dashboard</span>
                    </a>
                    <a href="#" class="flex items-center px-4 py-3 text-gray-600 dark:text-gray-400 hover:bg-gray-200 dark:hover:bg-gray-700 rounded-lg">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 00-2-2H5z"></path></svg>
                        <span class="ml-3">Tiket</span>
                    </a>
                    <a href="#" class="flex items-center px-4 py-3 text-gray-600 dark:text-gray-400 hover:bg-gray-200 dark:hover:bg-gray-700 rounded-lg">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
                        <span class="ml-3">Favorit</span>
                    </a>
                </nav>

                <div class="mt-auto">
                    <div class="p-4 bg-green-100 dark:bg-green-800/50 rounded-lg relative mb-4">
                        <div class="absolute -top-4 left-1/2 -translate-x-1/2 bg-green-200 p-2 rounded-full">
                            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v13m0-13V6a2 2 0 112 2h-2zm0 0V5.5A2.5 2.5 0 109.5 8H12zm-7 4h14M5 12a2 2 0 110-4h14a2 2 0 110 4H5z"></path></svg>
                        </div>
                        <h3 class="text-lg font-bold text-green-800 dark:text-green-200 mt-4">Diskon 50%</h3>
                        <p class="text-sm text-green-700 dark:text-green-300 mt-1">Jangan lewatkan diskon di hari tertentu.</p>
                    </div>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <a href="{{ route('logout') }}"
                           onclick="event.preventDefault(); this.closest('form').submit();"
                           class="flex items-center px-4 py-3 text-gray-600 dark:text-gray-400 hover:bg-gray-200 dark:hover:bg-gray-700 rounded-lg">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                            <span class="ml-3">Keluar</span>
                        </a>
                    </form>
                </div>
            </div>
        </aside>

        <main class="flex-1 p-6 overflow-y-auto">
            <div class="flex items-center justify-between mb-8">
                <div>
                    <h2 class="text-3xl font-bold text-gray-900 dark:text-white">Halo, {{ Auth::user()->name ?? 'Pengguna' }} 👋</h2>
                    
                    <p class="text-gray-600 dark:text-gray-400">Selamat datang kembali dan jelajahi dunia</p>
                </div>                  
                <div class="flex items-center">
                    <button @click="toggleTheme" 
                            class="p-2 rounded-full text-gray-500 dark:text-gray-400 hover:bg-gray-200 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 dark:focus:ring-offset-gray-900"
                            aria-label="Toggle Dark Mode">
                        <svg x-show="!isDarkMode" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path>
                        </svg>
                        <svg x-show="isDarkMode" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m8.66-12.66l-.7.7M5.04 18.96l-.7.7M21 12h-1M4 12H3m15.66-8.66l-.7-.7M5.04 5.04l-.7-.7"></path><path d="M12 18a6 6 0 100-12 6 6 0 000 12z"></path>
                        </svg>
                    </button>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
                <div class="relative rounded-2xl overflow-hidden h-80">
                    <img src="https://placehold.co/400x600/8B5CF6/FFFFFF?text=Mendaki+Gunung" class="w-full h-full object-cover" alt="[Gambar dari Mendaki Gunung]">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent"></div>
                    <div class="absolute bottom-0 left-0 p-4 text-white"><h3 class="text-xl font-bold">Mendaki Gunung</h3><p class="text-sm">Gunung Hijau</p></div>
                </div>
                <div class="relative rounded-2xl overflow-hidden h-80">
                    <img src="https://placehold.co/400x600/10B981/FFFFFF?text=Berkemah" class="w-full h-full object-cover" alt="[Gambar dari Berkemah]">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent"></div>
                    <div class="absolute bottom-0 left-0 p-4 text-white"><h3 class="text-xl font-bold">Berkemah Malam</h3><p class="text-sm">Danau Petir</p></div>
                </div>
                 <div class="relative rounded-2xl overflow-hidden h-80">
                    <img src="https://placehold.co/400x600/3B82F6/FFFFFF?text=Pemandangan" class="w-full h-full object-cover" alt="[Gambar dari Pemandangan Indah]">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent"></div>
                    <div class="absolute bottom-0 left-0 p-4 text-white"><h3 class="text-xl font-bold">Pemandangan Indah</h3><p class="text-sm">Gunung Hijau</p></div>
                </div>
            </div>

            <div>
                <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-4">Tujuan Terbaik 🚀</h3>
                
                <div class="space-y-4">
                    <div class="bg-white dark:bg-gray-800 p-4 rounded-lg flex items-center justify-between">
                        <div class="flex items-center">
                            <img src="https://placehold.co/80x80/A7F3D0/1F2937?text=Hutan" class="w-20 h-20 rounded-lg object-cover" alt="[Gambar dari Hutan]">
                            <div class="ml-4">
                                <h4 class="font-bold text-lg text-gray-900 dark:text-white">Hutan Kayu Hijau</h4>
                                <p class="text-sm text-gray-600 dark:text-gray-400">Tawangmangu</p>
                            </div>
                        </div>
                        <div class="text-lg font-bold text-gray-900 dark:text-white">Rp 999k</div>
                    </div>

                    </div>
            </div>
        </main>

        <aside class="w-80 flex-shrink-0 hidden lg:block">
            <div class="h-full p-6">
                <div class="bg-white dark:bg-gray-800 p-4 rounded-xl shadow mb-6" x-data="calendar">
                    <div class="flex justify-between items-center mb-4">
                        <h4 class="font-bold text-lg text-gray-900 dark:text-white" x-text="`${monthName} ${year}`"></h4>
                        
                        <div class="text-gray-600 dark:text-gray-400">
                            <button @click="changeMonth(-1)" class="p-1 rounded-full hover:bg-gray-200 dark:hover:bg-gray-700" aria-label="Bulan Sebelumnya">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                            </button>
                            <button @click="changeMonth(1)" class="p-1 rounded-full hover:bg-gray-200 dark:hover:bg-gray-700" aria-label="Bulan Berikutnya">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                            </button>
                        </div>
                    </div>
                    <div class="grid grid-cols-7 gap-2 text-center text-sm">
                        <template x-for="day in dayNames" :key="day">
                            <div class="font-semibold text-gray-500 dark:text-gray-400" x-text="day"></div>
                        </template>
                        
                        <template x-for="blankday in blankDays">
                            <div></div>
                        </template>
                        
                        <template x-for="day in daysInMonth" :key="day">
                            <div x-text="day" 
                                 class="flex items-center justify-center h-8 w-8 rounded-full"
                                 :class="{
                                     'bg-green-500 text-white': isToday(day), 
                                     'text-gray-700 dark:text-gray-200 hover:bg-gray-200 dark:hover:bg-gray-700 cursor-pointer': !isToday(day)
                                 }">
                            </div>
                        </template>
                    </div>
                </div>

                <div class="mb-6">
                    <h4 class="font-bold text-lg text-gray-900 dark:text-white mb-4">Jadwal Saya</h4>
                    
                    </div>

                <div class="bg-blue-500 text-white p-6 rounded-2xl text-center relative overflow-hidden">
                    <img src="https://placehold.co/100x100/FFFFFF/3B82F6?text=Jelajah" class="w-24 h-24 rounded-full object-cover mx-auto mb-4 border-4 border-white" alt="[Gambar dari Jelajah]">
                    <h4 class="text-xl font-bold">Ayo Jelajahi Keindahan</h4>
                    <p class="text-sm text-blue-200 mt-2 mb-4">Dapatkan penawaran & berita spesial</p>
                    <a href="#" class="bg-white text-blue-500 font-bold py-2 px-6 rounded-lg hover:bg-gray-100 transition-colors">Gabung Sekarang</a>
                </div>
            </div>
        </aside>
    </div>

    <script>
        // Menambahkan event listener untuk 'alpine:init'.
        // Kode di dalam ini akan berjalan setelah Alpine.js siap.
        document.addEventListener('alpine:init', () => {
            // Mendaftarkan 'themeManager' sebagai komponen data Alpine.
            Alpine.data('themeManager', () => ({
                // Cek localStorage untuk tema yang tersimpan, jika tidak ada, gunakan preferensi sistem.
                isDarkMode: localStorage.getItem('darkMode') === 'true' || 
                            (localStorage.getItem('darkMode') === null && window.matchMedia('(prefers-color-scheme: dark)').matches),
                
                // Fungsi untuk mengganti tema
                toggleTheme() {
                    this.isDarkMode = !this.isDarkMode;
                    // Menyimpan ke localStorage sekarang ditangani oleh x-init/$watch di tag div utama
                }
            }));

            // Mendaftarkan 'calendar' sebagai komponen data Alpine.
            Alpine.data('calendar', () => ({
                currentDate: new Date(),
                dayNames: ['Min', 'Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab'],
                monthName: '', 
                year: '', 
                daysInMonth: [], 
                blankDays: [],
                init() { 
                    this.updateCalendar(); 
                },
                updateCalendar() {
                    const date = this.currentDate;
                    const year = date.getFullYear();
                    const month = date.getMonth();
                    this.year = year;
                    this.monthName = new Intl.DateTimeFormat('id-ID', { month: 'long' }).format(date);
                    const firstDayOfMonth = new Date(year, month, 1).getDay();
                    const totalDaysInMonth = new Date(year, month + 1, 0).getDate();
                    this.blankDays = Array.from({ length: firstDayOfMonth });
                    this.daysInMonth = Array.from({ length: totalDaysInMonth }, (_, i) => i + 1);
                },
                isToday(day) {
                    const today = new Date();
                    const d = new Date(this.year, this.currentDate.getMonth(), day);
                    return today.toDateString() === d.toDateString();
                },
                changeMonth(monthOffset) {
                    this.currentDate.setMonth(this.currentDate.getMonth() + monthOffset);
                    this.updateCalendar();
                }
            }));
        });
    </script>
</x-app-layout>