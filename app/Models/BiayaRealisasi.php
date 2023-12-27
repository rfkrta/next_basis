<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BiayaRealisasi extends Model
{

    use HasFactory;
    use SoftDeletes;

    protected $table = 'biaya_realisasi';

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
    protected $dates = ['deleted_at'];
    public function perjalananDinas()
    {
        return $this->belongsTo(Dinas::class, 'perjalanan_dinas_id');
    }
    // public function estimasi()
    // {
    //     return $this->belongsTo(BiayaDinas::class, 'perjalanan_dinas_id');
    // }

    public function biayaDinas()
    {
        return $this->belongsTo(BiayaDinas::class, 'perjalanan_dinas_id');
    }
}
