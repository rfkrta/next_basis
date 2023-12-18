<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Absensi extends Model
{
    use HasFactory;

    protected $fillable = [
       'tanggal', 'waktu_mulai', 'waktu_selesai', 'file_img', 'lokasi', 'user_id', 'kategoriabsen_id'
    ];

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
    
}
