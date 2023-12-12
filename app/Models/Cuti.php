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
<<<<<<< Updated upstream
        'id_nama', 'id_kategori', 'keterangan',
        'tanggal_mulai', 'tanggal_selesai', 'status'
=======
        'user_id', 'id_kategori', 'keterangan',
        'tanggal_mulai', 'tanggal_selesai', 'status', 'id_user'
>>>>>>> Stashed changes
    ];


    protected $hidden = [
        //
    ];

    // public function karyawan()
    // {
    //     return $this->belongsTo(Karyawan::class, 'id_nama', 'id');
    // }

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'id_kategori', 'id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'id_nama', 'id', 'name');
    }
}
