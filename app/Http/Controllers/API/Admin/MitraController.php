<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\Controller;
use App\Models\Mitra;


class MitraController extends Controller
{
    public function getMitra()
    {
        try {
            // Memuat data Mitra dengan relasi kota_keberangkatan dan provinsi
            $mitra = Mitra::with('regency', 'province', 'district', 'village')->get();

            if ($mitra->isEmpty()) {
                return response()->json(['message' => 'No Mitra found'], 404);
            }

            // Menyiapkan respons JSON dengan nama kota dan provinsi berdasarkan relasi
            $mitraWithCityAndProvince = $mitra->map(function ($item) {
                return [
                    'mitra_id' => $item->id,
                    'nama_mitra' => $item->nama_mitra,
                    'provinsi' => $item->province->name ?? 'Unknown', // Mendapatkan nama provinsi
                    'nama_kota' => $item->regency->name ?? 'Unknown', // Mendapatkan nama kota
                    'kecamatan' => $item->district->name ?? 'Unknown',
                    'kelurahan' => $item->village->name ?? 'Unknown',
                    'id_kota' => $item ->regency->id,
                    // Sisipkan kolom lain yang diperlukan di sini
                    'alamat_lengkap' => $item->alamat_lengkap,
                    'nama_PIC_perusahaan' => $item->nama_PIC_perusahaan,
                    'jabatan_PIC' => $item->jabatan_PIC,
                    'nomer_telepon_PIC' => $item->nomer_telepon_PIC,
                    'komisi_dinas' => $item->komisi_dinas,
                    'created_at' => $item->created_at,
                    'deleted_at' => $item->deleted_at,
                    'updated_at' => $item->updated_at,
                    'status' => $item->status,
                    'kode_pos' => $item->kode_pos,
                    // 'data' => $item
                ];
            });

            return response()->json(['data' => $mitraWithCityAndProvince]);
        } catch (\Exception $exception) {
            return response()->json(['message' => 'Failed to fetch Mitra'], 500);
        }
    }
}
