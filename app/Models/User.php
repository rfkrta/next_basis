<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'kota',
        'password',
        'nip',
        'alamat',
        'no_hp',
        'tanggal_lahir',
        'agama',
        'jenis_kelamin',
        'jmlCuti',
        'role_id',
        'tanggal_mulai', 'tanggal_selesai', 'status', 'id_positions', 'gaji_posisi'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function regencies()
    {
        return $this->hasManyThrough(Regency::class, Province::class);
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function position()
    {
        return $this->belongsTo(Position::class, 'id_positions');
    }

    public function getFormattedGajiAttribute()
    {
        return $this->position->formatted_gaji_posisi ?? '';
    }
}
