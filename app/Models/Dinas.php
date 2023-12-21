<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Dinas extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'id_mitras', 'kota_keberangkatan', 'komisi_dinas',
        'tanggal_mulai', 'tanggal_selesai', 'id_anggota1',
        'id_anggota2', 'id_anggota3', 'id_anggota4', 'nama_PIC_perusahaan', 'jabatan_PIC', 'status', 'jumlah_anggota'
    ];

    protected $hidden = [
        //
    ];

    public function mitra()
    {
        return $this->belongsTo(Mitra::class, 'id_mitras', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_anggota1', 'id', 'nama');
    }

    public function user1()
    {
        return $this->belongsTo(User::class, 'id_anggota2', 'id', 'nama');
    }

    public function user2()
    {
        return $this->belongsTo(User::class, 'id_anggota3', 'id', 'nama')->withDefault();
    }

    public function user3()
    {
        return $this->belongsTo(User::class, 'id_anggota4', 'id', 'nama')->withDefault();
    }

    public function regency()
    {
        return $this->belongsTo(Regency::class, 'kota_keberangkatan', 'id', 'name'); // Adjust 'kota' with your foreign key column name
    }

    public function biayaDinas() {
        return $this->belongsTo(BiayaDinas::class, 'id', 'perjalanan_dinas_id');
    }

    public function updateStatus()
    {
        $now = now()->toDateString();

        if ($this->tanggal_selesai < $now) {
            $this->status = 'Selesai';
            $this->hitungKomisi(); // Hitung komisi jika perjalanan selesai
        } elseif ($this->tanggal_mulai <= $now) {
            $this->status = 'Berjalan';
        } else {
            $this->status = 'Pending';
        }

        $this->save();
    }

    protected static function boot()
    {
        parent::boot();

        // Hitung jumlah anggota saat menyimpan perjalanan dinas
        static::saving(function ($perjalananDinas) {
            $perjalananDinas->jumlah_anggota = $perjalananDinas->hitungJumlahAnggota();
        });

    }

    // Metode untuk menghitung komisi
    public function hitungKomisi()
    {
        //
        $user = $this->user;
        $mitraTujuan = $this->id_mitras;

        // Periksa apakah mitra tersebut sudah pernah dituju sebelumnya
        if ($user->mitra_tertuju !== $mitraTujuan) {
<<<<<<< Updated upstream
<<<<<<< Updated upstream
            $komisi = $this->komisi_dinas;
            $biayaPerAnggota = $this->komisi_dinas / $this->hitungJumlahAnggota();
            // Logika penghitungan komisi sesuai kebutuhan
            
            // $totalBiaya = $this->komisi_dinas; 
            // $persentaseKomisi = 0.1; 
            // $komisi = $totalBiaya * $persentaseKomisi;

            // Simpan informasi komisi dalam tabel komisi_dinas
            // $komisiDinas = new KomisiDinas([
            //     'users_id' => $user->id,
            //     'id_mitras' => $mitraTujuan,
            //     'tanggal_mulai' => $this->tanggal_mulai,
            //     'tanggal_selesai' => $this->tanggal_selesai,
            //     'komisi_dinas' => $komisi,
            // ]);

            // $komisiDinas->save();

            // $this->komisiDinas()->create([
            //     'users_id' => $this->id_anggota1,
            //     'id_mitras' => $mitraTujuan,
            //     'tanggal_mulai' => $this->tanggal_mulai,
            //     'tanggal_selesai' => $this->tanggal_selesai,
            //     'komisi_dinas' => $biayaPerAnggota,
            // ]);

            // $this->komisiDinas()->create([
            //     'users_id' => $this->id_anggota2,
            //     'id_mitras' => $mitraTujuan,
            //     'tanggal_mulai' => $this->tanggal_mulai,
            //     'tanggal_selesai' => $this->tanggal_selesai,
            //     'komisi_dinas' => $biayaPerAnggota,
            // ]);

            // $this->komisiDinas()->create([
            //     'users_id' => $this->id_anggota3,
            //     'id_mitras' => $mitraTujuan,
            //     'tanggal_mulai' => $this->tanggal_mulai,
            //     'tanggal_selesai' => $this->tanggal_selesai,
            //     'komisi_dinas' => $biayaPerAnggota,
            // ]);

            // $this->komisiDinas()->create([
            //     'users_id' => $this->id_anggota4,
            //     'id_mitras' => $mitraTujuan,
            //     'tanggal_mulai' => $this->tanggal_mulai,
            //     'tanggal_selesai' => $this->tanggal_selesai,
            //     'komisi_dinas' => $biayaPerAnggota,
            // ]);

            // Ambil anggota yang terlibat
            $anggotaTim = [
                $this->id_anggota1,
                $this->id_anggota2,
                $this->id_anggota3,
                $this->id_anggota4,
            ];

            // Filter anggota yang memiliki nilai (tidak NULL)
            $anggotaTim = array_filter($anggotaTim, function ($anggota) {
                return !is_null($anggota);
            });

            // Simpan informasi komisi untuk setiap anggota tim
            foreach ($anggotaTim as $userId) {
                $this->simpanKomisiAnggota($userId, $biayaPerAnggota, $komisi);
            }

            // Setelah menyimpan komisi, masukkan komisi ke tabel user
            $user->update([
                'komisi_terkumpul' => $user->komisi_terkumpul + $biayaPerAnggota,
                'mitra_tertuju' => $mitraTujuan, // Simpan mitra yang ditujuan oleh user
            ]);
=======
=======
>>>>>>> Stashed changes
            // Periksa apakah mitra sudah pernah dikunjungi
            if (!$this->mitraSudahDikunjungi($mitraTujuan)) {
                $komisi = $this->komisi_dinas;
                $biayaPerAnggota = $this->komisi_dinas;
                // Logika penghitungan komisi sesuai kebutuhan
                
                // $totalBiaya = $this->komisi_dinas; 
                // $persentaseKomisi = 0.1; 
                // $komisi = $totalBiaya * $persentaseKomisi;

                // Simpan informasi komisi dalam tabel komisi_dinas
                // $komisiDinas = new KomisiDinas([
                //     'users_id' => $user->id,
                //     'id_mitras' => $mitraTujuan,
                //     'tanggal_mulai' => $this->tanggal_mulai,
                //     'tanggal_selesai' => $this->tanggal_selesai,
                //     'komisi_dinas' => $komisi,
                // ]);

                // $komisiDinas->save();

                // $this->komisiDinas()->create([
                //     'users_id' => $this->id_anggota1,
                //     'id_mitras' => $mitraTujuan,
                //     'tanggal_mulai' => $this->tanggal_mulai,
                //     'tanggal_selesai' => $this->tanggal_selesai,
                //     'komisi_dinas' => $biayaPerAnggota,
                // ]);

                // $this->komisiDinas()->create([
                //     'users_id' => $this->id_anggota2,
                //     'id_mitras' => $mitraTujuan,
                //     'tanggal_mulai' => $this->tanggal_mulai,
                //     'tanggal_selesai' => $this->tanggal_selesai,
                //     'komisi_dinas' => $biayaPerAnggota,
                // ]);

                // $this->komisiDinas()->create([
                //     'users_id' => $this->id_anggota3,
                //     'id_mitras' => $mitraTujuan,
                //     'tanggal_mulai' => $this->tanggal_mulai,
                //     'tanggal_selesai' => $this->tanggal_selesai,
                //     'komisi_dinas' => $biayaPerAnggota,
                // ]);

                // $this->komisiDinas()->create([
                //     'users_id' => $this->id_anggota4,
                //     'id_mitras' => $mitraTujuan,
                //     'tanggal_mulai' => $this->tanggal_mulai,
                //     'tanggal_selesai' => $this->tanggal_selesai,
                //     'komisi_dinas' => $biayaPerAnggota,
                // ]);

                // Ambil anggota yang terlibat
                $anggotaTim = [
                    $this->id_anggota1,
                    $this->id_anggota2,
                    $this->id_anggota3,
                    $this->id_anggota4,
                ];

                // Filter anggota yang memiliki nilai (tidak NULL)
                $anggotaTim = array_filter($anggotaTim, function ($anggota) {
                    return !is_null($anggota);
                });

                // Simpan informasi komisi untuk setiap anggota tim
                foreach ($anggotaTim as $userId) {
                    $this->simpanKomisiAnggota($userId, $biayaPerAnggota, $komisi);
                }

                // foreach ($anggotaTim as $user) {
                //     $this->simpanKomisiUser($user, $biayaPerAnggota, $mitraTujuan);
                // }

                // Setelah menyimpan komisi, masukkan komisi ke tabel user
                // $user->update([
                //     'komisi_terkumpul' => $user->komisi_terkumpul + $biayaPerAnggota,
                //     'mitra_tertuju' => $mitraTujuan, // Simpan mitra yang ditujuan oleh user
                // ]);
            }
<<<<<<< Updated upstream
>>>>>>> Stashed changes
=======
>>>>>>> Stashed changes
        }
    }

    // Metode untuk menyimpan informasi komisi untuk satu anggota tim
    protected function simpanKomisiAnggota($userId, $biayaPerAnggota, $komisi)
    {
        $this->komisiDinas()->create([
            'users_id' => $userId,
            'id_mitras' => $this->id_mitras,
            'tanggal_mulai' => $this->tanggal_mulai,
            'tanggal_selesai' => $this->tanggal_selesai,
            'komisi_dinas' => $komisi,
        ]);
<<<<<<< Updated upstream
<<<<<<< Updated upstream
    }

=======
=======
>>>>>>> Stashed changes

        // Dapatkan komisi yang sudah ada pada tabel users
        $komisiSudahAda = User::where('id', $userId)->value('komisi_terkumpul');

        // Jumlahkan komisi yang sudah ada dengan komisi baru
        $komisiBaru = $komisiSudahAda + $komisi;

        User::where('id', $userId)->update([
            'komisi_terkumpul' => $komisiBaru,
            'mitra_tertuju' => $this->id_mitras, // Simpan mitra yang ditujuan oleh user
        ]);
    }

    // protected function simpanKomisiUser($user, $biayaPerAnggota, $mitraTujuan)
    // {
    //     $this->User()->update([
    //         'komisi_terkumpul' => $user->komisi_terkumpul + $biayaPerAnggota,
    //         'mitra_tertuju' => $mitraTujuan, // Simpan mitra yang ditujuan oleh user
    //     ]);
    // }


<<<<<<< Updated upstream
>>>>>>> Stashed changes
=======
>>>>>>> Stashed changes
    public function hitungJumlahAnggota()
    {
        return (int)($this->id_anggota1 ? 1 : 0) +
               (int)($this->id_anggota2 ? 1 : 0) +
               (int)($this->id_anggota3 ? 1 : 0) +
               (int)($this->id_anggota4 ? 1 : 0);
    }

<<<<<<< Updated upstream
<<<<<<< Updated upstream
=======
=======
>>>>>>> Stashed changes
    protected function mitraSudahDikunjungi($mitraTujuan)
    {
        // Misalkan ada kolom 'mitra_terkunjungi' pada tabel pengguna (users)
        // return User::where('mitra_tertuju', $mitraTujuan)->exists();
        return KomisiDinas::where('id_mitras', $mitraTujuan)->exists();
    }

<<<<<<< Updated upstream
>>>>>>> Stashed changes
=======
>>>>>>> Stashed changes
    public function komisiDinas()
    {
        return $this->hasMany(KomisiDinas::class);
    }
}
