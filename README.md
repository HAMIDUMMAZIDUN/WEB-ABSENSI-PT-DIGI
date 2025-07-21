Absensi Karyawan Berbasis Web

Sebuah aplikasi web modern yang dibangun dengan Laravel untuk mengelola kehadiran karyawan secara efisien.


https://img.shields.io/badge/Laravel-11.x-FF2D20?style=for-the-badge&logo=laravel" alt="Laravel Version">
https://img.shields.io/badge/PHP-8.2%2B-blue?style=for-the-badge&logo=php" alt="PHP Version">
https://img.shields.io/badge/MySQL-8.0-orange?style=for-the-badge&logo=mysql" alt="MySQL Version">
https://img.shields.io/badge/License-MIT-green?style=for-the-badge" alt="License">

📜 Daftar Isi
Tentang Proyek

✨ Fitur Utama

📸 Tampilan Aplikasi

🛠️ Teknologi yang Digunakan

🚀 Panduan Instalasi

📂 Struktur Folder

🤝 Kontribusi

📝 Lisensi

🎯 Tentang Proyek
Proyek Absensi Karyawan ini dibuat untuk mengatasi tantangan dalam pencatatan kehadiran manual yang memakan waktu dan rentan terhadap kesalahan. Dibangun di atas framework Laravel, aplikasi ini menyediakan platform yang kuat dan aman bagi admin untuk mengelola data karyawan dan bagi karyawan untuk melakukan absensi secara digital.

✨ Fitur Utama
✅ Dasbor Admin: Tampilan ringkas untuk memantau aktivitas absensi terkini.

✅ Manajemen Karyawan (CRUD): Tambah, Lihat, Edit, dan Hapus data karyawan dengan mudah.

✅ Absensi Real-time: Karyawan dapat mencatat jam masuk dan jam pulang.

✅ Validasi Absensi: Sistem mencegah karyawan melakukan absensi lebih dari satu kali pada hari yang sama.

✅ Laporan Kehadiran: Hasilkan dan cetak laporan absensi harian maupun bulanan.

✅ Desain Responsif: Antarmuka yang dapat menyesuaikan diri dengan layar desktop, tablet, maupun seluler.

📸 Tampilan Aplikasi
Letakkan screenshot aplikasi Anda di sini untuk memberikan gambaran visual kepada pengunjung.

Contoh Tampilan Dasbor Admin:
(Ganti gambar placeholder di atas dengan screenshot aplikasi Anda)

🛠️ Teknologi yang Digunakan
Proyek ini dibangun menggunakan tumpukan teknologi modern:

Backend:

Laravel Framework

PHP

Frontend:

HTML5, CSS3, JavaScript

Blade,Tailwind/Bootstrap

Database:

MySQL / MariaDB

Manajemen Dependensi:

Composer

🚀 Panduan Instalasi
Ikuti langkah-langkah berikut untuk menjalankan aplikasi ini di lingkungan lokal Anda.

Prasyarat
Pastikan Anda sudah menginstal perangkat lunak berikut:

PHP (sesuai versi yang dibutuhkan Laravel)

Composer

Database (MySQL/MariaDB)

Node.js & NPM (jika menggunakan asset bundling seperti Vite)

Langkah-langkah Instalasi
Clone Repositori

Bash

git clone https://github.com/username-anda/nama-repositori.git
cd nama-repositori
Instal Dependensi PHP

Bash

composer install
Buat File Environment
Salin file .env.example menjadi .env.

Bash

cp .env.example .env
Generate Application Key

Bash

php artisan key:generate
Konfigurasi Database
Buka file .env dan sesuaikan konfigurasi database Anda.

Cuplikan kode

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=magang
DB_USERNAME=root
DB_PASSWORD=
Pastikan Anda sudah membuat database db_absensi di MySQL.

Jalankan Migrasi & Seeder
Perintah ini akan membuat semua tabel yang dibutuhkan dan mengisi data awal (jika seeder ada).

Bash

php artisan migrate --seed
(Jika Anda tidak memiliki seeder, jalankan php artisan migrate saja)

Jalankan Aplikasi
Gunakan server pengembangan bawaan Laravel.

Bash

php artisan serve
Aplikasi sekarang akan berjalan di http://127.0.0.1:8000.

📂 Struktur Folder
Proyek ini mengikuti struktur direktori standar Laravel. Berikut adalah beberapa folder kunci:

/absensi-karyawan
├── app/
│   ├── Http/
│   │   └── Controllers/
│   └── Models/
├── config/
├── database/
│   ├── migrations/
│   └── seeders/
├── public/
├── resources/
│   └── views/
├── routes/
│   └── web.php
├── .env
└── composer.json
🤝 Kontribusi
Kontribusi dari Anda akan sangat kami hargai! Jika Anda ingin berkontribusi, silakan ikuti langkah-langkah berikut:

Fork repositori ini.

Buat Branch baru (git checkout -b fitur/FiturBaru).

Lakukan Commit terhadap perubahan Anda (git commit -m 'Menambahkan FiturBaru').

Push ke Branch tersebut (git push origin fitur/FiturBaru).

Buka Pull Request.

📝 Lisensi
Proyek ini dilisensikan di bawah Lisensi MIT. Lihat file LICENSE untuk detail lebih lanjut.


Dibuat dengan ❤️ dan Laravel.
