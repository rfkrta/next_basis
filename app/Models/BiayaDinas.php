<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BiayaDinas extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'biaya_dinas';
    protected $fillable = [
        'perjalanan_dinas_id',
        'biaya_hotel',
        'keterangan_hotel',
        'biaya_transportasi',
        'keterangan_transportasi',
        'biaya_konsumsi',
        'keterangan_konsumsi',
        'biaya_lain',
        'keterangan_lain',
    ];

    public function perjalananDinas()
    {
        return $this->belongsTo(Dinas::class, 'perjalanan_dinas_id');
    }
    public function realisasi()
    {
        return $this->belongsTo(BiayaRealisasi::class, 'perjalanan_dinas_id');
    }
}
