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
            // 'role_id' => 1,
            // 'idMaritalStatus' => 1,
            // 'idTaxStatus' => 1,
            // 'idEmployeeGroup' => 1,
            // 'status' => 'Active',
        ]);

        // DB::table('karyawans')->insert([
        //     'user_id' => 1,
        //     'nama' => 'rafi',
        //     'id_positions' => 1,
        //     'nip' => 1235555123123,
        //     'gaji_posisi' => 1000000000,
        //     'tanggal_mulai' => '1998-06-07',
        //     'tanggal_selesai' => '1998-06-09',
        // ]);

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
