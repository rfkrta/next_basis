<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\KategoriAbsensi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AbsensiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $absensi = Absensi::all();
        $absensis = Absensi::all();
        return view('admin.absensi.index', compact('absensis'));
    }

    public function create()
    {
        $users = User::all();
        $absen = Absensi::first();
        $kategori = KategoriAbsensi::all();

        return view('admin.absensi.create', compact('kategori', 'users','absen'));
    }

    public function store(Request $request)
    {
        // Validasi request
        $validatedData = $request->validate([
            'nama' => 'required|exists:users,id',
            'kategori_absen' => 'required',
            'tanggal' => 'required|date',
            'waktu_mulai' => 'required|date_format:H:i',
            'waktu_selesai' => 'required|date_format:H:i',
        ]);

        // Membuat objek Absensi dan menyimpan data dari request ke dalamnya
        $absensi = new Absensi();
        $absensi->user_id = $validatedData['nama']; // Menyimpan user_id dari input nama
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

        // Redirect ke halaman terkait atau lakukan sesuai kebutuhan
        return redirect()->route('admin.absensi.index')->with('success', 'Absensi berhasil disimpan');
    }

    public function show($id)
    {
        $item = Absensi::with(['user', 'kategoriAbsensi'])->findOrFail($id);

        return view('admin.absensi.detail', [
            'item' => $item
        ]);
    }

    // public function countAbsensiPerMonth(Request $request)
    // {
    //     // Mendapatkan tahun dan bulan dari request
    //     $year = $request->input('year', date('Y'));
    //     $month = $request->input('month', date('m'));

    //     // Menghitung jumlah absensi per bulan berdasarkan tahun dan bulan
    //     $absensiCount = Absensi::select(
    //         DB::raw('COUNT(*) as total_absensi')
    //     )
    //     ->whereYear('waktu_mulai', $year)
    //     ->whereMonth('waktu_mulai', $month)
    //     ->get();

    //     return view('admin.absensi.count', compact('absensiCount'));
    // }
    

    public function edit($id)
    {
        $absensi = Absensi::findOrFail($id);
        return view('admin.absensi.edit', compact('absensi'));
    }

    public function update(Request $request, $id)
    {
        // Logika untuk mengupdate data absensi
        // Gunakan $request untuk mengakses data yang dikirimkan
    }

    public function destroy($id)
    {
        // Logika untuk menghapus data absensi
    }
}
