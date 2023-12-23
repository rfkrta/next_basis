<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Absensi extends Model
{
    use HasFactory;


    // protected $fillable = [
    //    'tanggal', 'waktu_mulai', 'waktu_selesai', 'file_img', 'lokasi', 'user_id', 'kategoriabsen_id'
    // ];

    protected $casts = [
        'lokasi' => 'array',
    ];

    // Relasi ke model KategoriAbsensi
    public function kategoriAbsensi()
    {
        return $this->belongsTo(KategoriAbsensi::class, 'kategoriabsen_id');
    }

    // Relasi ke model User
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    use SoftDeletes;

    protected $fillable = [
        'kategoriabsen_id', 'user_id', 'tanggal', 'waktu_selesai', 'waktu_mulai', 'file_img',
        'lokasi', 'status'
    ];

    protected $hidden = [
        //
    ];

    // public function user()
    // {
    //     return $this->belongsTo(User::class);
    // }

}
