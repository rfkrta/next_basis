<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;
    protected $table = 'roles'; // Ganti 'roles' dengan nama tabel yang benar jika berbeda

    
    public function users()
    {
        return $this->hasMany(User::class);
    }
}
