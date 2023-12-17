<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class KomisiDinas extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'users_id', 'id_mitras', 'tanggal_mulai', 'tanggal_selesai',
        'komisi_dinas'
    ];

    protected $hidden = [
        //
    ];
}
