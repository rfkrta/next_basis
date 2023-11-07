<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Mitra extends Model
{
    use SoftDeletes;
    use HasFactory;

    protected $fillable = [
        'nama_mitra', 'provinsi', 'kota', 'kecamatan', 'kelurahan', 'kode_pos',
        'alamat_lengkap', 'nama_PIC_perusahaan', 'jabatan_PIC', 'nomer_telepon_PIC',
        'komisi_dinas'
    ];

    protected $hidden = [
        //
    ];
}
