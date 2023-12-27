<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class HitungGajiBulanan implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // Ambil semua pengguna dan hitung gaji bulanan untuk masing-masing
        $users = \App\Models\User::all();

        foreach ($users as $user) {
            // Lakukan perhitungan gaji untuk bulan sebelumnya
            $gajiBulanSebelumnya = $user->hitungGajiBulanSebelumnya();

            // Simpan gaji bulanan
            $user->gaji_bulanan = $gajiBulanSebelumnya;
            $user->save();
        }
    }
}
