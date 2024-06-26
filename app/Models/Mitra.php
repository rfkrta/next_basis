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
        'komisi_dinas', 'status'
    ];

    protected $hidden = [
        //
    ];

    public function regency()
    {
        return $this->belongsTo(Regency::class, 'kota'); // Adjust 'kota' with your foreign key column name
    }


    public function province()
    {
        return $this->belongsTo(Province::class, 'provinsi');
    }


    public function district()
    {
        return $this->belongsTo(District::class, 'kecamatan');
    }

    public function village()
    {
        return $this->belongsTo(Village::class, 'kelurahan');
    }
}
