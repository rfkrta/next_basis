<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BiayaPerbandingan extends Model
{
    use HasFactory;
    protected $table = 'biaya_perbandingans';
    protected $fillable = [
        'perjalanan_dinas_id',
        'biaya_perbandingan_hotel',
        'keterangan_perbandingan_hotel',
        'biaya_perbandingan_transportasi',
        'keterangan_perbandingan_transportasi',
        'biaya_perbandingan_konsumsi',
        'keterangan_perbandingan_konsumsi',
        'biaya_perbandingan_lain',
        'keterangan_perbandingan_lain',
        // ... add other columns as needed ...
    ];
    

    // Jika perlu relasi, tambahkan di sini, contoh:
    public function perjalananDinas()
    {
        return $this->belongsTo(Dinas::class, 'perjalanan_dinas_id');
    }
}
