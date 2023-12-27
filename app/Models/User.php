<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\DB;

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
        'tanggal_mulai', 'tanggal_selesai', 'status', 'id_positions', 'gaji_posisi', 'mitra_tertuju', 'komisi_terkumpul',
        'gaji_bulanan'
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

    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id');
    }

    public function position()
    {
        return $this->belongsTo(Position::class, 'id_positions');
    }

    public function getFormattedGajiAttribute()
    {
        return $this->position->formatted_gaji_posisi ?? '';
    }

    public function komisiDinas()
    {
        return $this->hasMany(KomisiDinas::class);
    }

    // Metode untuk menghitung gaji bulanan untuk bulan sebelumnya
    public function hitungGajiBulanSebelumnya()
    {
        $bulanSebelumnya = now()->subMonth();

        // Mengambil format bulan dan tahun dari tanggal sebelumnya
        // $bulanTahun = $bulanSebelumnya->format('Y-m-d');
        $bulanTahunAwal = $bulanSebelumnya->firstOfMonth()->format('Y-m-d');
        $bulanTahunAkhir = $bulanSebelumnya->lastOfMonth()->format('Y-m-d');

        // Hitung jumlah absensi untuk bulan dan tahun tertentu
        $jumlahAbsensi = $this->hitungJumlahAbsensi($bulanTahunAwal, $bulanTahunAkhir);

        // Gaji pokok perbulan
        $gajiPokokPerBulan = $this->gaji_posisi / 25;

        // Komisi dinas per bulan
        $komisiDinas = $this->hitungKomisiDinas($bulanTahunAwal, $bulanTahunAkhir);

        // Hitung total gaji
        $gajiTotal = $gajiPokokPerBulan * $jumlahAbsensi + $komisiDinas;

        // Simpan histori gaji ke dalam tabel gaji
        $this->simpanHistoriGaji($bulanTahunAwal, $bulanTahunAkhir, $jumlahAbsensi, $komisiDinas, $gajiTotal);

        // Simpan gaji total ke dalam kolom gaji_bulanan pada tabel user
        $this->update(['gaji_bulanan' => $gajiTotal]);

        return $gajiTotal;
    }

    // Metode untuk menyimpan histori gaji ke dalam tabel gaji
    protected function simpanHistoriGaji($bulanTahunAwal, $bulanTahunAkhir, $totalAbsensi, $komisiDinas, $gajiTotal)
    {
        $this->gaji()->create([
            'bulan_tahun' => $bulanTahunAwal, $bulanTahunAkhir,
            'total_absensi' => $totalAbsensi,
            'komisi_dinas' => $komisiDinas,
            'gaji' => $gajiTotal,
        ]);
    }

    protected function hitungJumlahAbsensi($bulanTahunAwal, $bulanTahunAkhir)
    {
        return Absensi::where('user_id', $this->id)
            ->whereBetween('tanggal', [$bulanTahunAwal, $bulanTahunAkhir])
            ->where('status', 'hadir') // Ubah 'status' sesuai dengan kolom status pada tabel absensi
            ->count();
    }

    protected function hitungKomisiDinas($bulanTahunAwal, $bulanTahunAkhir)
    {
        return DB::table('komisi_dinas')
            ->where('users_id', $this->id)
            ->whereBetween('tanggal_selesai', [$bulanTahunAwal, $bulanTahunAkhir])
            ->sum('komisi_dinas');
    }

    public function gaji()
    {
        return $this->hasMany(Gaji::class);
    }
}
