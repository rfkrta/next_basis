<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\DinasRequest;
use App\Models\Dinas;
use App\Models\Karyawan;
use App\Models\Mitra;
use App\Models\Regency;
use App\Models\User;
use App\Models\BiayaDinas;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Carbon\Carbon;

class PerjalanandinasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // $dinas_baru = Dinas::join('mitras', 'mitras.id', '=', 'dinas.id_mitras')
        //     ->select('dinas.*', 'mitras.nama_mitra', 'mitras.komisi_dinas')
        //     ->get();

        // $dinas_baru = Dinas::join('users', 'users.id', '=', 'dinas.id_anggota1')
        //     ->select('dinas.*', 'users.name')
        //     ->get();

        // $dinas_baru = Dinas::join('regencies', 'regencies.id', '=', 'dinas.kota_keberangkatan')
        //     ->select('dinas.*', 'regencies.name')
        //     ->get();

        // $mitra = Mitra::all();
        // $user = User::all();
        // $regency = Regency::all();
        // //Logika untuk menampilkan halaman dashboard
        // return view('admin.perjalanandinas.index', compact('regency', 'user', 'mitra', 'dinas_baru'));

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

        $status = $request->input('status'); // Get the 'status' parameter from the request

        $dinas = Dinas::with('mitra', 'user', 'user1', 'user2', 'user3','regency', 'biayaDinas', 'komisiDinas'); // Eager load relationships 'user' and 'kategori'
    
        // Filter Dinas based on 'status' parameter
        if ($status === 'Selesai' || $status === 'Berjalan' || $status === 'Tertunda') {
            $dinas->where('status', $status);
        }
    
        $dinas = $dinas->get();

        return view('admin.perjalanandinas.index', compact('regency', 'user', 'mitra', 'dinas_mitra', 'dinas_user', 'dinas_regency', 'dinas', 'status'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $mitra = Mitra::all();
        $user = User::all();
        $user1 = User::all();
        $user2 = User::all();
        $user3 = User::all();
        $regency = Regency::all();
        // $regency = Regency::where('name', 'LIKE', '%CIANJUR%')->first();
        return view('admin.perjalanandinas.create', compact('regency', 'mitra', 'user', 'user1', 'user2', 'user3'));
    }

    public function getKaryawanOptions()
    {
        $karyawanOptions = Karyawan::pluck('nama', 'id')->toArray();

        return response()->json($karyawanOptions);
    }

    public function getPosisiById($id)
    {
        // Find the position by ID
        $mitra = Mitra::find($id);

        if (!$mitra) {
            // Handle if the position ID is not found
            return response()->json(['error' => 'Mitra not found'], 404);
        }

        // Retrieve the gaji posisi value for the position
        $komisi = $mitra->komisi_dinas;
        $picMitra = $mitra->nama_PIC_perusahaan;
        $jabatanPic = $mitra->jabatan_PIC;

        // Return the gaji posisi as a JSON response
        return response()->json(['komisi_dinas' => $komisi]);
        return response()->json(['nama_PIC_perusahaan' => $picMitra]);
        return response()->json(['jabatan_PIC' => $jabatanPic]);
    }

    public function getPosisiById1($id)
    {
        // Find the position by ID
        $mitra = Mitra::find($id);

        if (!$mitra) {
            // Handle if the position ID is not found
            return response()->json(['error' => 'Mitra not found'], 404);
        }

        // Retrieve the gaji posisi value for the position
        // $komisi = $mitra->komisi_dinas;
        $picMitra = $mitra->nama_PIC_perusahaan;
        // $jabatanPic = $mitra->jabatan_PIC;

        // Return the gaji posisi as a JSON response
        // return response()->json(['komisi_dinas' => $komisi]);
        return response()->json(['nama_PIC_perusahaan' => $picMitra]);
        // return response()->json(['jabatan_PIC' => $jabatanPic]);
    }

    public function getPosisiById2($id)
    {
        // Find the position by ID
        $mitra = Mitra::find($id);

        if (!$mitra) {
            // Handle if the position ID is not found
            return response()->json(['error' => 'Mitra not found'], 404);
        }

        // Retrieve the gaji posisi value for the position
        // $komisi = $mitra->komisi_dinas;
        // $picMitra = $mitra->nama_PIC_perusahaan;
        $jabatanPic = $mitra->jabatan_PIC;

        // Return the gaji posisi as a JSON response
        // return response()->json(['komisi_dinas' => $komisi]);
        // return response()->json(['nama_PIC_perusahaan' => $picMitra]);
        return response()->json(['jabatan_PIC' => $jabatanPic]);
    }

    public function updateToDiterima($id)
    {
        $perjalananDinas = Dinas::findOrFail($id);

        // Update the status to 'diterima'
        $perjalananDinas->update([
            'status' => 'Diterima',
        ]);

        $perjalananDinas->updateStatus(); // Panggil metode untuk memperbarui status

        return redirect()->route('admin.perjalanandinas.index')->with('success', 'Perjalanan Dinas diterima');
    }

    public function updateToDitolak($id)
    {
        $perjalananDinas = Dinas::findOrFail($id);

        // Update the status to 'ditolak'
        $perjalananDinas->update([
            'status' => 'Ditolak',
        ]);

        return redirect()->route('admin.perjalanandinas.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DinasRequest $request)
    {
        $data = $request->all();
        // dd($data);
        Dinas::create($data);
        return redirect()->route('admin.perjalanandinas.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $item = Dinas::with([
            'mitra', 'regency', 'user', 'user1', 'user2', 'user3', 'biayaDinas'
        ])->findOrFail($id);

        $biayaDinas = BiayaDinas::all();

        return view('admin.perjalanandinas.detail', compact('item', 'biayaDinas'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = Dinas::with([
            'mitra', 'regency', 'user', 'user1'
        ])->findOrFail($id);
        $mitra = Mitra::all();
        $biayaDinas = BiayaDinas::where('perjalanan_dinas_id', $id)->first();

        return view('admin.perjalanandinas.edit', compact('item', 'mitra', 'biayaDinas'));
    }

    public function updateBiaya(Request $request, $id)
    {
        // Validasi request sesuai kebutuhan
        $request->validate([
            'perjalanan_dinas_id' => 'max:255',
            'biaya_hotel' => 'required|max:255',
            'keterangan_hotel' => 'required|max:255',
            'biaya_transportasi' => 'required|max:255',
            'keterangan_transportasi' => 'required|max:255',
            'biaya_konsumsi' => 'required|max:255',
            'keterangan_konsumsi' => 'required|max:255',
            'biaya_lain' => 'required|max:255',
            'keterangan_lain' => 'required|max:255',
        ]);

        // Simpan biaya ke dalam tabel biaya_dinas
        BiayaDinas::create([
            'perjalanan_dinas_id' => $id,
            'biaya_hotel' => $request->biaya_hotel,
            'keterangan_hotel' => $request->keterangan_hotel,
            'biaya_transportasi' => $request->biaya_transportasi,
            'keterangan_transportasi' => $request->keterangan_transportasi,
            'biaya_konsumsi' => $request->biaya_konsumsi,
            'keterangan_konsumsi' => $request->keterangan_konsumsi,
            'biaya_lain' => $request->biaya_lain,
            'keterangan_lain' => $request->keterangan_lain,
        ]);

        return redirect()->route('admin.perjalanandinas.index')->with('success', 'Biaya perjalanan dinas berhasil disimpan');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->all();
        $item = Dinas::findOrFail($id);
        $item->update($data);

        return redirect()->route('admin.perjalanandinas.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
