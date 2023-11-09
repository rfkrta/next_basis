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
        DB::table('users')->truncate();
        DB::table('users')->insert([
            'name' => 'Admin',
            'email' => 'admin@next.com',
            'password' => bcrypt('admin'),
            'nik' => '1651241854645',
            'nip' => '68541653165',
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
            'status' => 'Active',
        ]);

        DB::table('users')->insert([
            'name' => 'Rafi',
            'email' => 'rafi@next.com',
            'password' => bcrypt('admin'),
            'nik' => '123123',
            'nip' => '2131',
            'kota' => 'surabaya',
            'alamat' => 'Kutisari Indah Utara 2/37',
            'agama' => 'Islam',
            'tanggal_lahir' => '1998-06-07',
            'no_hp' => '111',
            'jenis_kelamin' => 'Pria',
            // 'role_id' => 1,
            // 'idMaritalStatus' => 1,
            // 'idTaxStatus' => 1,
            // 'idEmployeeGroup' => 1,
            'status' => 'Active',
        ]);
    }
}
