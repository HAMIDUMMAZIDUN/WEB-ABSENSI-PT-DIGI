<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash; 
use Faker\Factory as Faker;

class MasterKaryawanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        // Inisialisasi Faker untuk data berbahasa Indonesia
        $faker = Faker::create('id_ID');

        // Array data dummy untuk dimasukkan ke database
        $karyawanData = [];

        // Daftar Bagian/Departemen untuk dipilih secara acak
        $bagian = ['IT', 'HRD', 'Keuangan', 'Marketing', 'Operasional', 'Produksi'];
        $roles = ['karyawan', 'manager', 'hrd'];
        $statuses = ['aktif', 'cuti', 'tidak_aktif'];

        // Loop untuk membuat 30 data karyawan
        for ($i = 1; $i <= 30; $i++) {
            $nama = $faker->name;
            $email = $faker->unique()->safeEmail;

            $karyawanData[] = [
                // Menggunakan layanan Pravatar untuk foto profil unik berdasarkan email
                'foto' => 'https://i.pravatar.cc/150?u=' . $email,
                
                // NIK unik dengan 16 digit angka
                'nik' => $faker->unique()->numerify('################'),
                
                'nama_karyawan' => $nama,
                'email' => $email,
                
                // Memilih bagian, role, dan status secara acak dari array yang sudah didefinisikan
                'bagian' => $faker->randomElement($bagian),
                'role' => $faker->randomElement($roles),
                'status' => $faker->randomElement($statuses),

                // Tanggal bergabung dalam 5 tahun terakhir
                'tanggal_bergabung' => $faker->dateTimeBetween('-5 years', 'now'),
                
                'alamat' => $faker->address,
                'kontak' => $faker->phoneNumber,
                
                // Timestamp untuk created_at dan updated_at
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        // Memasukkan semua data ke dalam tabel 'master_karyawan'
        DB::table('master_karyawan')->insert($karyawanData);
    }
}
