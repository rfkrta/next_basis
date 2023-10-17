<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventaris extends Model
{
    use HasFactory;

    protected $table = 'inventaris';

    protected $fillable = [
        'id',
        'Kode',
        'Nama_Barang',
        'Jumlah',
        'Kategori',
        'Tanggal_Diperoleh',
        // Kolom-kolom lainnya
    ];
}
