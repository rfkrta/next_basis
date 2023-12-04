<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use NumberFormatter;

class Position extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'nama_posisi', 'gaji_posisi'
    ];

    protected $hidden = [
        //
    ];
    

    public function getFormattedSalaryAttribute()
    {
        return 'Rp ' . number_format($this->gaji_posisi, 0, ',', '.');
    }
}
