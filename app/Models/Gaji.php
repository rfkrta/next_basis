<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
<<<<<<< Updated upstream
=======
use Illuminate\Database\Eloquent\SoftDeletes;
>>>>>>> Stashed changes

class Gaji extends Model
{
    use HasFactory;
<<<<<<< Updated upstream
    protected $table = 'gaji'; // Tentukan nama tabel jika berbeda

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function position()
    {
        return $this->belongsTo(Position::class, 'position_id');
    }

    public function absensi()
    {
        return $this->belongsTo(Absensi::class, 'absensi_id');
=======
    use SoftDeletes;

    protected $table = 'gajis';
    protected $fillable = ['user_id', 'bulan_tahun', 'total_absensi', 'komisi_dinas', 'gaji'];

    protected $hidden = [
        //
    ];

    // Relasi dengan tabel user
    public function user()
    {
        return $this->belongsTo(User::class);
>>>>>>> Stashed changes
    }
}
