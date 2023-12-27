<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Absensi extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'kategoriabsen_id', 'user_id', 'tanggal', 'waktu_selesai', 'waktu_mulai', 'file_img',
        'lokasi', 'status'
    ];

    protected $hidden = [
        //
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
