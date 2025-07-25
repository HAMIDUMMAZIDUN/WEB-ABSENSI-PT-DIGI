<x-app-layout>
    {{-- Header Konten --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-10">
        <div>
        @php
        //Mengatur zona waktu server ke Waktu Indonesia Barat
        date_default_timezone_set('Asia/Jakarta');
        $jam = (int)date('H');
            @endphp
            <h2 class="text-3xl font-bold text-gray-900">
                Selamat
                @if ($jam >= 4 && $jam < 11)
                    Pagi,
                @elseif ($jam >= 11 && $jam < 15)
                    Siang,
                @elseif ($jam >= 15 && $jam < 19)
                    Sore,
                @else
                    Malam,
                @endif
            {{ Auth::user()->username }}
        </h2>
        <p class="text-gray-500 mt-1">Semoga Hari ini dan seterusnya diberi kelancaran untuk bekerja</p>
        </div>
        <div class="relative mt-4 sm:mt-0">
            <input type="text" placeholder="Cari Karyawan" class="w-full sm:w-64 pl-10 pr-4 py-3 border border-gray-200 bg-white rounded-full focus:outline-none focus:ring-2 focus:ring-green-500">
            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
            </div>
        </div>
    </div>

    {{-- Kartu Destinasi Utama --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-10">
        <div class="relative rounded-3xl overflow-hidden h-96">
            <img src="https://placehold.co/400x600/A7F3D0/1F2937?text=Mount+Climbing" class="w-full h-full object-cover" alt="[Gambar dari Mount Climbing]">
            <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
            <div class="absolute bottom-0 left-0 p-6 text-white">
                <h3 class="text-2xl font-bold">Mount climbing</h3>
                <p class="text-sm">Green Mountain</p>
            </div>
        </div>
        <div class="relative rounded-3xl overflow-hidden h-96">
            <img src="https://placehold.co/400x600/C4B5FD/1F2937?text=Night+Camping" class="w-full h-full object-cover" alt="[Gambar dari Night Camping]">
            <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
            <div class="absolute bottom-0 left-0 p-6 text-white">
                <h3 class="text-2xl font-bold">Night camping</h3>
                <p class="text-sm">Lightning lake</p>
            </div>
        </div>
        <div class="relative rounded-3xl overflow-hidden h-96">
            <img src="https://placehold.co/400x600/6EE7B7/1F2937?text=Mount+Climbing" class="w-full h-full object-cover" alt="[Gambar dari Mount Climbing]">
            <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
            <div class="absolute bottom-0 left-0 p-6 text-white">
                <h3 class="text-2xl font-bold">Mount climbing</h3>
                <p class="text-sm">Green Mountain</p>
            </div>
        </div>
    </div>

    {{-- Destinasi Terbaik & Promo --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <div class="lg:col-span-2">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-2xl font-bold text-gray-900">Best Destination 🚀</h3>
                <button class="flex items-center space-x-2 text-gray-500 hover:text-gray-900">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6V4m0 2v2m0-2h2m-2 0H8m4 6v2m0-2v-2m0 2h2m-2 0H8m4-6v2m0-2v-2m0 2h2m-2 0H8m4 6h2m-2 0H8m4-6V4m0 2v2m0-2h2m-2 0H8m4 6v2m0-2v-2m0 2h2m-2 0H8m4-6v2m0-2v-2m0 2h2m-2 0H8"></path></svg>
                    <span>Filters</span>
                </button>
            </div>
            <div class="space-y-4">
                <div class="bg-white p-4 rounded-2xl shadow-sm flex items-center space-x-4">
                    <img src="https://placehold.co/80x80/A7F3D0/1F2937?text=T" alt="[Gambar dari Green wood forest]" class="w-20 h-20 rounded-lg object-cover">
                    <div class="flex-grow">
                        <p class="font-bold text-lg text-gray-800">Green wood forest</p>
                        <p class="text-sm text-gray-500">Tawangmangu</p>
                    </div>
                    <div class="text-right">
                        <p class="font-bold text-lg text-gray-800">₹999</p>
                        <p class="text-sm text-gray-500">/night</p>
                    </div>
                </div>
                <div class="bg-white p-4 rounded-2xl shadow-sm flex items-center space-x-4">
                    <img src="https://placehold.co/80x80/6EE7B7/1F2937?text=C" alt="[Gambar dari Green Forest Camp]" class="w-20 h-20 rounded-lg object-cover">
                    <div class="flex-grow">
                        <p class="font-bold text-lg text-gray-800">Green Forest Camp</p>
                        <p class="text-sm text-gray-500">Chennai</p>
                    </div>
                     <div class="text-right">
                        <p class="font-bold text-lg text-gray-800">₹999</p>
                        <p class="text-sm text-gray-500">/night</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="bg-blue-100 p-8 rounded-3xl text-center flex flex-col items-center justify-center">
            <img src="https://placehold.co/128x128/3B82F6/FFFFFF?text=Explorer" alt="[Gambar dari Explorer]" class="w-32 h-32 rounded-full object-cover mb-4 border-4 border-white">
            <h4 class="text-2xl font-bold text-gray-900">Let's Explore the beauty</h4>
            <p class="text-gray-600 mt-2 mb-6">Get special offers & news</p>
            <a href="#" class="w-full bg-green-500 text-white font-bold py-3 px-6 rounded-xl hover:bg-green-600 transition-colors">Join Now</a>
        </div>
    </div>
</x-app-layout>
