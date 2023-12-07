<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\KaryawanRequest;
use App\Models\Karyawan;
use App\Models\Position;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class KaryawanController extends Controller
{
    public function index(Request $request)
    {
        $kry_baru = Karyawan::join('positions', 'positions.id', '=', 'karyawans.id_positions')
        ->select('karyawans.*', 'positions.nama_posisi', 'positions.gaji_posisi')
        ->where('karyawans.user_id', $request->id_user) // Menambahkan klausa where untuk filter berdasarkan ID user
        ->first();

    return response()->json(['data' => $kry_baru]);
    }

    public function StatusFilter(Request $request)
    {
        $filter = $request->input('filter');

        $kry_baru = Karyawan::join('positions', 'positions.id', '=', 'karyawans.id_positions')
            ->select('karyawans.*', 'positions.nama_posisi', 'positions.gaji_posisi');

        if ($filter === 'Aktif') {
            $kry_baru = $kry_baru->where('karyawans.status', 'Aktif')->get();

            if ($kry_baru->isEmpty()) {
                return response()->json([
                    'message' => 'Tidak ada data untuk filter yang diberikan.'
                ], 404);
            }

            return response()->json([
                'data' => $kry_baru
            ]);
        } elseif ($filter === 'Tidak Aktif') {
            $kry_baru = $kry_baru->where('karyawans.status', 'Tidak Aktif')->get();

            if ($kry_baru->isEmpty()) {
                return response()->json([
                    'message' => 'Tidak ada data untuk filter yang diberikan.'
                ], 404);
            }

            return response()->json([
                'data' => $kry_baru
            ]);
        }
    }


    public function create()
    {
        $position = Position::all();
        $users = User::all();

        return response()->json([
            'position' => $position,
            'users' => $users
        ]);
    }

    public function getGajiPosisiById($id)
    {
        $position = Position::find($id);

        if (!$position) {
            return response()->json(['error' => 'Position not found'], 404);
        }

        $gajiPosisi = $position->gaji_posisi;
        $positionName = $position->nama_posisi;

        return response()->json([
            'nama_posisi' => $positionName,
            'gaji_posisi' => $gajiPosisi
        ]);
    }

    public function getNIPByName($name)
    {
        $user = User::where('name', $name)->first();

        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }

        $nip = $user->nip;

        return response()->json(['nip' => $nip]);
    }

    public function getNIPById($id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }

        $nip = $user->nip;

        return response()->json(['nip' => $nip]);
    }


    public function ajax(Request $request)
    {
        $id_positions = $request->id_positions;
        $ajax_position = Position::where('id', $id_positions)->get();

        return response()->json(['ajax_position' => $ajax_position]);
    }

    public function store(KaryawanRequest $request)
    {
        $data = $request->all();
        Karyawan::create($data);

        return response()->json(['message' => 'Karyawan created successfully']);
    }

    public function show($id)
    {
        $item = Karyawan::findOrFail($id);
        $position = Position::all();

        return response()->json(['item' => $item, 'posisi' => $position]);
    }

    public function edit($id)
    {
        try {
            $item = Karyawan::findOrFail($id);
            $position = Position::all();
            return response()->json(['item' => $item], Response::HTTP_OK);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'User not found'], Response::HTTP_NOT_FOUND);
        }
    }

    public function update(KaryawanRequest $request, $id)
    {
        $data = $request->all();
        $item = Karyawan::findOrFail($id);
        $item->update($data);

        return response()->json(['message' => 'Karyawan updated successfully']);
    }

    public function destroy($id)
    {
        // Perform deletion logic here

        return response()->json(['message' => 'Karyawan deleted successfully']);
    }
}
