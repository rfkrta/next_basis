<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CutiRequest;
use App\Models\Cuti;
use App\Models\Karyawan;
use App\Models\Kategori;
use Illuminate\Http\Request;

class CutiController extends Controller
{
    public function index(Request $request)
    {
        $cuti_baru = Cuti::where('cutis.user_id', $request->id_user)->get();

        if ($cuti_baru->isEmpty()) {
            return response()->json([
                'message' => 'Tidak ada data cuti untuk pengguna ini.',
                'data' => null,
            ]);
        } else {
            return response()->json([
                'data' => $cuti_baru
            ]);
        }
    }

    public function updateToDiterima($id)
    {
        $pengajuanCuti = Cuti::findOrFail($id);

        $pengajuanCuti->update([
            'status' => 'diterima',
        ]);

        return response()->json(['message' => 'Pengajuan cuti diterima.']);
    }

    public function updateToDitolak($id)
    {
        $pengajuanCuti = Cuti::findOrFail($id);

        $pengajuanCuti->update([
            'status' => 'ditolak',
        ]);

        return response()->json(['message' => 'Pengajuan cuti ditolak.']);
    }

    public function create()
    {
        $karyawan = Karyawan::all();
        $kategori = Kategori::all();

        return response()->json([
            'karyawan' => $karyawan,
            'kategori' => $kategori
        ]);
    }

    public function store(CutiRequest $request)
    {
        $data = $request->validated();
        // Menerima data dari request
        $data = $request->only(['user_id', 'id_kategori', 'keterangan', 'status','tanggal_mulai', 'tanggal_selesai']);

        // Operasi Create pada Model Cuti
        $cuti_baru = Cuti::create($data);

        // Berikan respons terhadap hasil create
        return response()->json([
            'message' => 'Data cuti berhasil dibuat.',
            'data' => $cuti_baru,
        ]);
    }

    public function show($id)
    {
        try {
            $item = Cuti::with(['karyawan', 'kategori'])->findOrFail($id);

            return response()->json(['cuti' => $item]);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['message' => 'Cuti not found'], 404);
        }
    }

    // Other methods like edit, update, destroy can be implemented as needed for your API requirements
    // ...
}
