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
        'id_mitras', 'kota_keberangkatan', 'komisi_dinas',
        'tanggal_mulai', 'tanggal_selesai', 'id_anggota1',
        'id_anggota2', 'id_anggota3', 'id_anggota4', 'nama_PIC_perusahaan', 'jabatan_PIC'
    ];

    protected $hidden = [
        //
    ];

    public function mitra() {
        return $this->belongsTo(Mitra::class, 'id_mitras', 'id');
    }

    public function karyawan() {
        return $this->belongsTo(Karyawan::class, 'id_anggota1', 'id');
    }

    public function karyawan1() {
        return $this->belongsTo(Karyawan::class, 'id_anggota2', 'id');
    }

    public function regency()
    {
        return $this->belongsTo(Regency::class, 'kota_keberangkatan'); // Adjust 'kota' with your foreign key column name
    }
}
