<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CutiRequest;
use App\Models\Cuti;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

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

    public function updateByUserIdAndCutiId(Request $request, $user_id, $cuti_id)
    {
        // Validate the request data
        $validator = Validator::make($request->all(), [
            // Define your validation rules for cuti update here
            'id_kategori' => 'required',
            'keterangan' => 'required',
            'tanggal_mulai' => 'required',
            'tanggal_selesai' => 'required'
            // Add other fields and rules as needed
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Find the user by ID
        $user = User::find($user_id);

        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }

        // Find the cuti by ID associated with the user
        $cuti = Cuti::where('id', $cuti_id)->where('user_id', $user_id)->first();

        if (!$cuti) {
            return response()->json(['error' => 'Cuti not found for this user'], 404);
        }

        // Update the cuti with validated data
        $cuti->update($validator->validated());

        // Return a success message or updated cuti data
        return response()->json(['message' => 'Cuti updated successfully', 'data' => $cuti]);
    }

    // public function updateToDiterima($id)
    // {
    //     $pengajuanCuti = Cuti::findOrFail($id);

    //     $pengajuanCuti->update([
    //         'status' => 'diterima',
    //     ]);

    //     return response()->json(['message' => 'Pengajuan cuti diterima.']);
    // }

    // public function updateToDitolak($id)
    // {
    //     $pengajuanCuti = Cuti::findOrFail($id);

    //     $pengajuanCuti->update([
    //         'status' => 'ditolak',
    //     ]);

    //     return response()->json(['message' => 'Pengajuan cuti ditolak.']);
    // }

    // public function create()
    // {
    //     $user = User::all();
    //     $kategori = Kategori::all();

    //     return response()->json([
    //         'user' => $user,
    //         'kategori' => $kategori
    //     ]);
    // }



    public function store(Request $request, $user_id)
    {
        // Validasi request
        $validator = Validator::make($request->all(), [
            'id_kategori' => 'required',
            'keterangan' => 'required',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date',
            'file_surat' => 'nullable|max:2048',
        ]);

        // Jika validasi gagal, kembalikan respons JSON dengan pesan error
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Temukan user
        $user = User::find($user_id);

        // Periksa apakah user ditemukan
        if (!$user) {
            return response()->json(['error' => 'User tidak ditemukan'], 404);
        }

        // Periksa apakah user memiliki cukup cuti
        if ($user->jmlCuti <= 0) {
            return response()->json(['error' => 'Jumlah cuti tidak mencukupi'], 422);
        }

        // Inisialisasi $fileName
        $fileName = null;

        // Simpan file di folder storage/app/public/surat
        if ($request->hasFile('file_surat')) {
            $file = $request->file('file_surat');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('public/surat', $fileName);
        }

        // Kurangi jumlah cuti user dan periksa apakah tidak kurang dari 0
        $user->jmlCuti -= 1;
        if ($user->jmlCuti < 0) {
            return response()->json(['error' => 'Jumlah cuti tidak mencukupi'], 422);
        }
        $user->save();

        // Buat instance Cuti
        $cuti = Cuti::create(array_merge(
            $validator->validated(),
            ['file_surat' => $fileName],
            ['user_id' => $user_id] // Masukkan user_id ke dalam data yang akan disimpan
        ));

        // Kembalikan respons JSON berhasil
        return response()->json(['message' => 'Pengajuan cuti berhasil diajukan'], 201);
    }


    public function getCutiByUserId($userId)
    {
        try {
            $cutiUser = Cuti::where('user_id', $userId)->get();

            if ($cutiUser->isEmpty()) {
                return response()->json([
                    'message' => 'Tidak ada data cuti untuk pengguna ini.',
                    'data' => null,
                ]);
            } else {
                return response()->json([
                    'data' => $cutiUser
                ]);
            }
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'User tidak ditemukan'], 404);
        }
    }

    // Other methods like edit, update, destroy can be implemented as needed for your API requirements
    // ...
}
