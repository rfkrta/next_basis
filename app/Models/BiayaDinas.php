<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BiayaDinas extends Model
{
    use SoftDeletes;
    use HasFactory;

    protected $fillable = [
        'perjalanan_dinas_id', 'biaya_hotel', 'keterangan_hotel', 'biaya_transportasi',
        'keterangan_transportasi', 'biaya_konsumsi', 'keterangan_konsumsi', 'biaya_lain',
        'keterangan_lain'
        // Kolom-kolom lainnya sesuai kebutuhan
    ];

    protected $hidden = [
        //
    ];

    public function perjalananDinas()
    {
        return $this->belongsTo(Dinas::class);
    }
}
