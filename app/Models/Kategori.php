<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Kategori extends Model
{
    use SoftDeletes;
    use HasFactory;

    protected $fillable = [
        'nama_kategori'
    ];

    protected $hidden = [
        //
    ];
    public function cutis()
    {
        return $this->hasMany(Cuti::class);
    }
}
