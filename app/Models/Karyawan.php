<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Karyawan extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'nama', 'id_positions', 'nip', 'gaji',
        'tanggal_mulai', 'tanggal_selesai'
    ];

    protected $hidden = [
        //
    ];

    public function position() {
        return $this->belongsTo(Position::class, 'id_positions', 'id');
    }
}
