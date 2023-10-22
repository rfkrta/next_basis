<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cuti extends Model
{
    use SoftDeletes;
    use HasFactory;

    protected $fillable = [
        'nama', 'kategori', 'keterangan',
        'tanggal_mulai', 'tanggal_selesai'
    ];

    protected $hidden = [
        //
    ];
}
