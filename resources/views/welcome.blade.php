<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Informasi Kelompok Magang</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

    <!-- Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 dark:bg-gray-900 text-gray-800 dark:text-gray-200 flex flex-col items-center min-h-screen p-6 font-['Instrument_Sans']">

    <div class="w-full max-w-4xl mx-auto bg-white dark:bg-gray-800 shadow-2xl rounded-xl overflow-hidden">
        
        <!-- Header: Ditambahkan tombol Login di sini -->
        <header class="bg-blue-600 dark:bg-blue-800 text-white p-6 flex justify-between items-center shadow-md">
            <div class="text-left">
                <h1 class="text-3xl font-bold">Kelompok Magang Keren</h1>
                <p class="mt-1 opacity-90">Selamat datang di halaman informasi kelompok magang kami!</p>
            </div>
        </header>

        <main class="p-8">
            <!-- Tentang Kami -->
            <section id="tentang-kami" class="mb-10">
                <h2 class="text-2xl font-semibold border-b-2 border-blue-500 pb-2 mb-4">Tentang Kami</h2>
                <p class="text-gray-700 dark:text-gray-300 leading-relaxed">
                    Kami adalah sekelompok mahasiswa yang bersemangat dalam dunia pengembangan perangkat lunak dan sedang menjalani program magang. Proyek kami berfokus pada pengembangan aplikasi web inovatif untuk manajemen absensi karyawan menggunakan teknologi RFID. Kami berdedikasi untuk belajar, berkolaborasi, dan menghasilkan solusi yang berkualitas.
                </p>
            </section>

            <!-- Anggota Tim -->
            <section id="anggota-tim" class="mb-10">
                <h2 class="text-2xl font-semibold border-b-2 border-blue-500 pb-2 mb-4">Anggota Tim</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <!-- Anggota 1 -->
                    <div class="bg-gray-50 dark:bg-gray-700 p-5 rounded-lg text-center shadow-md transition-transform transform hover:scale-105">
                        <img src="{{ asset('images/hamidun1.jpg') }}" onerror="this.onerror=null;this.src='https://placehold.co/128x128/EBF4FF/7F9CF5?text=Foto';" alt="Foto Hamid Abdul Aziz" class="w-32 h-32 rounded-full mx-auto mb-4 border-4 border-white dark:border-gray-600 shadow-lg">
                        <h3 class="text-xl font-bold">HAMID ABDUL AZIZ</h3>
                        <p class="text-gray-600 dark:text-gray-400">Project Manager + Backend Developer
                        </p>
                    </div>

                    <!-- Anggota 2 -->
                    <div class="bg-gray-50 dark:bg-gray-700 p-5 rounded-lg text-center shadow-md transition-transform transform hover:scale-105">
                        <img src="{{ asset('images/hamidun1.jpg') }}" onerror="this.onerror=null;this.src='https://placehold.co/128x128/EBF4FF/7F9CF5?text=Foto';" alt="Foto Mutiara Fatiha" class="w-32 h-32 rounded-full mx-auto mb-4 border-4 border-white dark:border-gray-600 shadow-lg">
                        <h3 class="text-xl font-bold">MUTIARA FATIHA</h3>
                        <p class="text-gray-600 dark:text-gray-400">Frontend Developer</p>
                    </div>

                    <!-- Anggota 3 -->
                    <div class="bg-gray-50 dark:bg-gray-700 p-5 rounded-lg text-center shadow-md transition-transform transform hover:scale-105">
                        <img src="{{ asset('images/hamidun1.jpg') }}" onerror="this.onerror=null;this.src='https://placehold.co/128x128/EBF4FF/7F9CF5?text=Foto';" alt="Foto M.Zaky Afrilliansyah" class="w-32 h-32 rounded-full mx-auto mb-4 border-4 border-white dark:border-gray-600 shadow-lg">
                        <h3 class="text-xl font-bold">M.ZAKY AFRILLIANSYAH</h3>
                        <p class="text-gray-600 dark:text-gray-400">Frontend Developer</p>
                    </div>
                </div>
            </section>

            <!-- Proyek Kami -->
            <section id="proyek">
                <h2 class="text-2xl font-semibold border-b-2 border-blue-500 pb-2 mb-4">Proyek Kami</h2>
                <div class="bg-gray-50 dark:bg-gray-700 p-6 rounded-lg shadow-md">
                    <h3 class="text-xl font-bold mb-2">ABSENSI KARYAWAN RFID</h3>
                    <p class="text-gray-700 dark:text-gray-300 mb-6 leading-relaxed">
                        Aplikasi absensi berbasis web yang menggunakan RFID (Radio-Frequency Identification) adalah sebuah sistem modern untuk mencatat kehadiran secara otomatis. Karyawan atau siswa cukup menempelkan kartu atau tag RFID mereka ke sebuah alat pembaca (RFID reader), dan data kehadiran mereka akan langsung terekam dan tersimpan di database.
                    </p>
                    <!-- Tombol Aksi: Diperbarui -->
                   <div class="mt-6 flex flex-col sm:flex-row gap-4">
                    <a href="https://github.com/HAMIDUMMAZIDUN/WEB-ABSENSI-PT-DIGI.git" target="_blank" rel="noopener noreferrer" class="inline-block bg-gray-800 text-white font-bold py-3 px-6 rounded-lg hover:bg-gray-900 transition-all duration-300 ease-in-out text-center shadow-md transition-transform transform hover:scale-105">
                        Lihat Proyek di GitHub &rarr;
                    </a>
                      <a href="{{ route('login') }}" class="inline-block bg-blue-600 text-white font-bold py-3 px-6 rounded-lg hover:bg-blue-700 transition-all duration-300 ease-in-out text-center shadow-md transition-transform transform hover:scale-105">
                        Login untuk Absensi &rarr;
                     </a>
                    </div>
                </div>
            </section>
        </main>

        <!-- Footer -->
        <footer class="bg-gray-200 dark:bg-gray-800 text-gray-600 dark:text-gray-400 p-4 text-center text-sm border-t border-gray-300 dark:border-gray-700">
            <p>&copy; 2025 Kelompok Magang IF1. All Rights Reserved.</p>
        </footer>
    </div>

</body>
</html>