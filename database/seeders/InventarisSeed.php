<?php

namespace Database\Seeders;

use App\Models\Inventaris;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InventarisSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        // Dummy data for kendaraan
        Inventaris::create([
            'Kode' => 'KEND001',
            'Nama_Barang' => 'Kendaraan 1',
            'Jumlah' => 20,
            'Kategori' => 'Kendaraan',
            'Tanggal_Diperoleh' => now(),
        ]);

        // Dummy data for gedung
        Inventaris::create([
            'Kode' => 'GED001',
            'Nama_Barang' => 'Gedung 1',
            'Jumlah' => 20,
            'Kategori' => 'Gedung',
            'Tanggal_Diperoleh' => now(),
        ]);

        // Dummy data for komputer
        Inventaris::create([
            'Kode' => 'KOM001',
            'Nama_Barang' => 'Komputer 1',
            'Jumlah' => 20,
            'Kategori' => 'Komputer',
            'Tanggal_Diperoleh' => now(),
        ]);
    }
}
