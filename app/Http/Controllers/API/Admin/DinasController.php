<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\DinasRequest;
use App\Models\Dinas;
use App\Models\Karyawan;
use App\Models\Mitra;
use Illuminate\Http\Request;

class DinasController extends Controller
{
    public function index()
    {
        $dinas_baru = Dinas::join('mitras', 'mitras.id', '=', 'dinas.id_mitras')
            ->select('dinas.*', 'mitras.nama_mitra', 'mitras.komisi_dinas')
            ->get();

        $dinas_baru = Dinas::join('karyawans', 'karyawans.id', '=', 'dinas.id_anggota1')
            ->select('dinas.*', 'karyawans.nama')
            ->get();

        $mitra = Mitra::all();
        $karyawan = Karyawan::all();

        return response()->json([
            'karyawan' => $karyawan,
            'mitra' => $mitra,
            'dinas_baru' => $dinas_baru
        ]);
    }

    public function create()
    {
        $mitra = Mitra::all();
        $karyawan = Karyawan::all();

        return response()->json([
            'mitra' => $mitra,
            'karyawan' => $karyawan
        ]);
    }

    public function store(DinasRequest $request)
    {
        $data = $request->all();
        Dinas::create($data);

        return response()->json(['message' => 'Dinas created successfully'], 201);
    }

    public function show($id)
    {
        $dinas = Dinas::find($id);

        if (!$dinas) {
            return response()->json(['message' => 'Dinas not found'], 404);
        }

        return response()->json(['dinas' => $dinas]);
    }

    public function update(Request $request, $id)
    {
        $dinas = Dinas::find($id);

        if (!$dinas) {
            return response()->json(['message' => 'Dinas not found'], 404);
        }

        $dinas->update($request->all());

        return response()->json(['message' => 'Dinas updated successfully']);
    }

    public function destroy($id)
    {
        $dinas = Dinas::find($id);

        if (!$dinas) {
            return response()->json(['message' => 'Dinas not found'], 404);
        }

        $dinas->delete();

        return response()->json(['message' => 'Dinas deleted successfully']);
    }
}
