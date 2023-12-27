<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Inventaris extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'inventaris';

    protected $fillable = [
        'Kode',
        'Nama_Barang',
        'Jumlah',
        'Kategori',
        'Tanggal_Diperoleh',
        // Kolom-kolom lainnya
    ];

    public function kategoriInventaris()
    {
        return $this->belongsTo(KategoriInventaris::class, 'Kategori', 'id', 'nama_inv');
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($inventaris) {
            // Cek apakah kode barang sudah ada
            $latestCode = self::latest('id')->value('Kode');

            // Jika sudah ada, ambil angka, tambahkan 1, dan format ulang sebagai kode barang baru
            if ($latestCode) {
                $nextNumber = intval(substr($latestCode, -3)) + 1;
                $newCode = 'INV-' . str_pad($nextNumber, 3, '0', STR_PAD_LEFT);
            } else {
                // Jika belum ada, gunakan INV-001 sebagai kode barang awal
                $newCode = 'INV-001';
            }

            // Setel kode barang pada model Inventaris
            $inventaris->Kode = $newCode;
        });
    }
}
