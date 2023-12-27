<?php

namespace Database\Seeders;

use App\Models\BiayaRealisasi;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BiayaRealisasiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        // Sample data for biaya_realisasi
        BiayaRealisasi::create([
            'perjalanan_dinas_id' => 1,
            'biaya_hotel' => 500,
            'keterangan_hotel' => 'Hotel expenses for perjalanan dinas 1',
            'biaya_transportasi' => 200,
            'keterangan_transportasi' => 'Transportation expenses for perjalanan dinas 1',
            'biaya_konsumsi' => 100,
            'keterangan_konsumsi' => 'Food expenses for perjalanan dinas 1',
            'biaya_lain' => 50,
            'keterangan_lain' => 'Other expenses for perjalanan dinas 1',
        ]);
    }
}
