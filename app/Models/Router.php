<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Router extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'routers';

    protected $fillable = [
        'kode_router', 'nama_router'
    ];


    protected $hidden = [
        //
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($router) {
            // Cek apakah kode barang sudah ada
            $latestCode = self::latest('id')->value('kode_router');

            // Jika sudah ada, ambil angka, tambahkan 1, dan format ulang sebagai kode barang baru
            if ($latestCode) {
                $nextNumber = intval(substr($latestCode, -3)) + 1;
                $newCode = 'RTR-' . str_pad($nextNumber, 3, '0', STR_PAD_LEFT);
            } else {
                // Jika belum ada, gunakan INV-001 sebagai kode barang awal
                $newCode = 'RTR-001';
            }

            // Setel kode barang pada model Inventaris
            $router->kode_router = $newCode;
        });
    }
}
