<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cuti extends Model
{
    use SoftDeletes;
    use HasFactory;

    protected $fillable = [
        'id_nama', 'id_kategori', 'keterangan',
        'tanggal_mulai', 'tanggal_selesai', 'status'
    ];
    

    protected $hidden = [
        //
    ];

    public function karyawan() {
        return $this->belongsTo(Karyawan::class, 'id_nama', 'id');
    }

    public function kategori() {
        return $this->belongsTo(Kategori::class, 'id_kategori', 'id');
    }
}
