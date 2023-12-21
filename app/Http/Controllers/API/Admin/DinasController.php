<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\DinasRequest;
use App\Models\Dinas;
use App\Models\Mitra;
use App\Models\Regency;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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

    public function show($id)
    {
        $item = Dinas::with([
            'mitra', 'regency', 'user', 'user1', 'user2', 'user3'
        ])->findOrFail($id);

        return response()->json(['item' => $item]);
    }

    public function store(Request $request, $user_id)
    {
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();
        $item = Dinas::findOrFail($id);
        $item->update($data);

        return response()->json(['message' => 'Dinas updated successfully']);
    }

    public function destroy($id)
    {
        $item = Dinas::findOrFail($id);
        $item->delete();

        return response()->json(['message' => 'Dinas deleted successfully']);
    }
}
