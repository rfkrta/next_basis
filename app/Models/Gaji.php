<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Gaji extends Model
{
    use HasFactory;
    use SoftDeletes;


    protected $table = 'gajis';
    protected $fillable = ['user_id', 'bulan_tahun', 'total_absensi', 'komisi_dinas', 'gaji'];

    protected $hidden = [
        //
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function position()
    {
        return $this->belongsTo(Position::class, 'position_id');
    }

    public function absensi()
    {
        return $this->belongsTo(Absensi::class, 'absensi_id');
    }
    // Relasi dengan tabel user
    // public function user()
    // {
    //     return $this->belongsTo(User::class);
    // }
}

