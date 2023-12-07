<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Karyawan extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'nama', 'id_positions', 'nip', 'gaji_posisi',
        'tanggal_mulai', 'tanggal_selesai', 'status', 'jmlCuti'
    ];

    protected $hidden = [
        //
    ];

    public function position()
    {
        return $this->belongsTo(Position::class, 'id_positions', 'id','nama_posisi','gaji_posisi');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id','name');
    }

    
}
