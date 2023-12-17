<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriAbsensi extends Model
{
    use HasFactory;
    protected $fillable = [
        'nama_kategori'
    ];


    public function absensis()
    {
        return $this->hasMany(Absensi::class, 'kategoriabsen_id');
    }
}
