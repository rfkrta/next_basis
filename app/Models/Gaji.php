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

    // Relasi dengan tabel user
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
