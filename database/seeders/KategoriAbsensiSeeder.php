<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KategoriAbsensiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        // Tambahkan data ke dalam tabel kategori_absensis
        DB::table('kategori_absensis')->insert([
            ['nama_kategori' => 'Absen Dinas'],
            ['nama_kategori' => 'Absen Kantor'],
            // ['nama_kategori' => 'Kategori C'],
            // Tambahkan data lainnya sesuai kebutuhan
        ]);
    }
}
