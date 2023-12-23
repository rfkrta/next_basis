<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\DinasRequest;
use App\Models\BiayaDinas;
use App\Models\Dinas;
use App\Models\Mitra;
use App\Models\Regency;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class DinasController extends Controller
{
    public function index()
    {
        $dinas_mitra = Dinas::join('mitras', 'mitras.id', '=', 'dinas.id_mitras')
            ->select('dinas.*', 'mitras.nama_mitra', 'mitras.komisi_dinas')
            ->get();

        $dinas_user = Dinas::join('users', 'users.id', '=', 'dinas.id_anggota1')
            ->select('dinas.*', 'users.name')
            ->get();

        $dinas_regency = Dinas::join('regencies', 'regencies.id', '=', 'dinas.kota_keberangkatan')
            ->select('dinas.*', 'regencies.name')
            ->get();

        $mitra = Mitra::all();
        $user = User::all();
        $regency = Regency::all();

        return response()->json([
            'dinas_mitra' => $dinas_mitra,
            'dinas_user' => $dinas_user,
            'dinas_regency' => $dinas_regency,
            'mitra' => $mitra,
            'user' => $user,
            'regency' => $regency,
        ]);
    }

public function getDinasByUserId($user_id)
{
    try {
        $data = Dinas::join('regencies', 'regencies.id', '=', 'dinas.kota_keberangkatan')
            ->join('mitras', 'mitras.id', '=', 'dinas.id_mitras')
            ->select('dinas.*', 'regencies.name as nama_kota', 'mitras.nama_mitra')
            ->where('id_anggota1', $user_id)
            ->orWhere('id_anggota2', $user_id)
            ->orWhere('id_anggota3', $user_id)
            ->orWhere('id_anggota4', $user_id)
            ->get();

        if ($data->isEmpty()) {
            return response()->json(['message' => 'No Dinas found for the given User ID'], 404);
        }

        return response()->json([
            'data' => $data
        ]);
    } catch (\Exception $exception) {
        return response()->json(['message' => 'Failed to fetch Dinas'], 500);
    }
}




    public function show($id)
    {
        $item = Dinas::with([
            'mitra', 'regency', 'user', 'user1', 'user2', 'user3'
        ])->findOrFail($id);

        return response()->json(['item' => $item]);
    }


public function store(DinasRequest $request, $user_id)
{
    $validator = Validator::make($request->all(), [
        // Aturan validasi lainnya di sini
        'berita_acara' => 'nullable|mimes:pdf|max:2048',
        'bukti_surat' => 'nullable|mimes:pdf|max:2048',
    ]);

    if ($validator->fails()) {
        return response()->json(['errors' => $validator->errors()], 422);
    }

    // Ambil data dari request
    $data = $request->all();

    // Simpan file berita acara dan bukti surat ke penyimpanan yang ditentukan
    if ($request->hasFile('berita_acara')) {
        $beritaAcaraPath = $request->file('berita_acara')->store('berita_acara', 'public');
        $data['berita_acara'] = $beritaAcaraPath;
    }

    if ($request->hasFile('bukti_surat')) {
        $buktiSuratPath = $request->file('bukti_surat')->store('bukti_surat', 'public');
        $data['bukti_surat'] = $buktiSuratPath;
    }

    // Simpan data baru ke dalam basis data
    $newDinas = Dinas::create($data);

    // Ambil nama kota dari Regency Model berdasarkan ID kota_keberangkatan
    $namaKota = Regency::where('id', $newDinas->kota_keberangkatan)->value('name');

    // Tambahkan nama kota ke dalam data yang akan direspon
    $newDinas['nama_kota'] = $namaKota;

    // Ambil nama mitra berdasarkan id_mitras
    $mitra = Mitra::find($newDinas->id_mitras);

    if ($mitra) {
        $newDinas['nama_mitra'] = $mitra->nama_mitra;
        // Tambahkan informasi mitra lainnya jika diperlukan
    }

    return response()->json(['message' => 'Dinas created successfully', 'data' => $newDinas]);
}


    public function edit($id)
    {
        try {
            $item = Dinas::with(['mitra', 'regency', 'user', 'user1'])->findOrFail($id);
            $mitra = Mitra::all();
            $biayaDinas = BiayaDinas::where('perjalanan_dinas_id', $id)->first();

            return response()->json([
                'item' => $item,
                'mitra' => $mitra,
                'biayaDinas' => $biayaDinas,
            ]);
        } catch (ModelNotFoundException $exception) {
            return response()->json(['message' => 'Data not found'], 404);
        }
    }

    public function update(Request $request, $id)
    {
        // Lakukan validasi input
        $validator = Validator::make($request->all(), [
            // Tentukan aturan validasi sesuai kebutuhan
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Lakukan operasi update data ke dalam model Dinas
        $data = $request->all();
        $item = Dinas::findOrFail($id);
        $item->update($data);

        return response()->json(['message' => 'Dinas updated successfully']);
    }

    public function destroy($id)
    {
        // Temukan dan hapus data sesuai dengan ID yang diberikan
        $item = Dinas::findOrFail($id);
        $item->delete();

        return response()->json(['message' => 'Dinas deleted successfully']);
    }
}
