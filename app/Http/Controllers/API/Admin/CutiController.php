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
    public function index()
    {
        $cuti_baru = Cuti::with(['karyawan', 'kategori'])->get();
        $karyawan = Karyawan::all();
        $kategori = Kategori::all();

        return response()->json([
            // 'cuti_baru' => $cuti_baru,
            'karyawan' => $karyawan,
            'kategori' => $kategori
        ]);
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

        $cuti = Cuti::create($data);

        return response()->json(['message' => 'Pengajuan cuti berhasil dibuat.', 'cuti' => $cuti], 201);
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
