<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\Controller;
use App\Models\Absensi;
use Illuminate\Http\Request;

class AbsenController extends Controller
{
    public function index()
    {
        $absensi = Absensi::all();
        return response()->json(['data' => $absensi]);
    }

    public function create()
    {
        // Tidak diperlukan dalam API controller
    }

    public function store(Request $request, $user_id)
    {
        // Validasi request
        $validatedData = $request->validate([
            'kategori_absen' => 'required',
            'tanggal' => 'required|date',
            'waktu_mulai' => 'required|date_format:H:i',
            'waktu_selesai' => 'required|date_format:H:i',
        ]);
    
        // Membuat objek Absensi dan menyimpan data dari request ke dalamnya
        $absensi = new Absensi();
        $absensi->user_id = $user_id; // Menyimpan user_id dari permintaan
        $absensi->kategoriabsen_id = $validatedData['kategori_absen'];
        $absensi->tanggal = $validatedData['tanggal'];
        $absensi->waktu_mulai = date('H:i', strtotime($validatedData['waktu_mulai']));
        $absensi->waktu_selesai = date('H:i', strtotime($validatedData['waktu_selesai']));
    
        // Lakukan penanganan untuk file gambar jika diunggah (jika diperlukan)
        if ($request->hasFile('file_img')) {
            $file = $request->file('file_img');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('images', $fileName);
            $absensi->file_img = $filePath;
        }
    
        // Simpan data absensi ke dalam database
        $absensi->save();
    
        // Mengembalikan respons JSON
        return response()->json(['message' => 'Absensi berhasil disimpan', 'data' => $absensi]);
    }

    public function show($id)
    {
        $absensi = Absensi::find($id);
        if (!$absensi) {
            return response()->json(['message' => 'Absensi not found'], 404);
        }
        return response()->json(['data' => $absensi]);
    }

    public function getAbsensiByUserId($user_id)
    {
        try {
            $absensi = Absensi::where('user_id', $user_id)->get();

            if ($absensi->isEmpty()) {
                return response()->json(['message' => 'No Absensi found for the given User ID'], 404);
            }

            return response()->json(['data' => $absensi]);
        } catch (\Exception $exception) {
            return response()->json(['message' => 'Failed to fetch Absensi'], 500);
        }
    }

    public function edit($id)
    {
        // Tidak diperlukan dalam API controller
    }

    public function update(Request $request, $id)
    {
        // Logika untuk mengupdate data
    }

    public function destroy($id)
    {
        // Logika untuk menghapus data
    }
}
