<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DummyUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // DB::table('users')->truncate();
        DB::table('users')->insert([
            'name' => 'Admin',
            'email' => 'admin@next.com',
            'password' => bcrypt('admin'),
            // 'nik' => '1651241854645',
            'nip' => '6854165316',
            'kota' => 'surabaya',
            'alamat' => 'Kutisari Indah Utara 2/37',
            'agama' => 'Islam',
            'tanggal_lahir' => '1998-06-07',
            'no_hp' => '08510472380',
            'jenis_kelamin' => 'Pria',
            'gaji_posisi' => 5000000,
            'role_id' => 1,
            // 'idMaritalStatus' => 1,
            // 'idTaxStatus' => 1,
            // 'idEmployeeGroup' => 1,
            // 'status' => 'Active',
        ]);
        DB::table('users')->insert([
            'name' => 'John Doe',
            'email' => 'john@next.com',
            'nip' => '1234567890',
            'kota' => 'Jakarta',
            'alamat' => 'Jl. Contoh No. 123',
            // Tambahkan atribut lainnya sesuai kebutuhan
            'role_id' => 3,
            'id_positions' => 3,
            'gaji_posisi' => 5000000,
            'tanggal_mulai' => '2023-01-01',
            'tanggal_selesai' => '2023-12-31',
            'status' => 'Aktif',
            'jmlCuti' => 12,
            'foto_profil' => 'default.jpg',
            'password' => bcrypt('admin'), // Ganti 'password' dengan kata sandi yang diinginkan
            'remember_token' => null,
        ]);

        // DB::table('cutis')->insert([

        //     'user_id' => 1, // Ganti dengan ID pengguna yang diinginkan
        //     'id_kategori' => 1, // Isi dengan nilai untuk kolom id_kategori
        //     'keterangan' => 'sakek', // Isi dengan nilai untuk kolom keterangan
        //     'tanggal_mulai' => '2023-12-31', // Isi dengan nilai untuk kolom tanggal_mulai
        //     'tanggal_selesai' => '2024-01-15', // Isi dengan nilai untuk kolom tanggal_selesai
        //     // Tambahkan nilai lain sesuai kebutuhan

        // ]);
    }
}
