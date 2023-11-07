<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Dinas extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'id_mitras', 'kota', 'komisi',
        'tanggal_mulai', 'tanggal_selesai', 'id_anggota1',
        'id_anggota2', 'pic_perusahaan', 'jabatan_pic'
    ];

    protected $hidden = [
        //
    ];

    public function mitra() {
        return $this->belongsTo(Mitra::class, 'id_nama_mitra', 'id');
    }

    public function karyawan() {
        return $this->belongsTo(Karyawan::class, 'id_anggota1', 'id_anggota2', 'id');
    }
}
