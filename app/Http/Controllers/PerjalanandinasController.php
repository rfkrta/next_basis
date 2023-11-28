<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\DinasRequest;
use App\Models\Dinas;
use App\Models\Karyawan;
use App\Models\Mitra;
use App\Models\Regency;
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
    public function index()
    {
        $dinas_baru = Dinas::join('mitras', 'mitras.id', '=', 'dinas.id_mitras')
                    ->select('dinas.*', 'mitras.nama_mitra', 'mitras.komisi_dinas')
                    ->get();

        $dinas_baru = Dinas::join('karyawans', 'karyawans.id', '=', 'dinas.id_anggota1')
                    ->select('dinas.*', 'karyawans.nama')
                    ->get();

        $dinas_baru = Dinas::join('regencies', 'regencies.id', '=', 'dinas.kota_keberangkatan')
                    ->select('dinas.*', 'regencies.name')
                    ->get();

        $mitra = Mitra::all();
        $karyawan = Karyawan::all();
        $regency = Regency::all();
        //Logika untuk menampilkan halaman dashboard
        return view('admin.perjalanandinas.index', compact('regency', 'karyawan', 'mitra', 'dinas_baru'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $mitra = Mitra::all();
        $karyawan = Karyawan::all();
        $karyawan1 = Karyawan::all();
        $karyawan2 = Karyawan::all();
        $karyawan3 = Karyawan::all();
        $regency = Regency::all();
        // $regency = Regency::where('name', 'LIKE', '%CIANJUR%')->first();
        return view('admin.perjalanandinas.create', compact('regency', 'mitra', 'karyawan', 'karyawan1', 'karyawan2', 'karyawan3'));
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DinasRequest $request)
    {
        $data = $request->all();

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
            'mitra', 'regency', 'karyawan', 'karyawan1', 'karyawan2', 'karyawan3'
        ])->findOrFail($id);

        return view('admin.perjalanandinas.detail', compact('item'));
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
            'mitra', 'regency', 'karyawan', 'karyawan1'
        ])->findOrFail($id);
        $mitra = Mitra::all();
        $karyawan = Karyawan::all();
        $karyawan1 = Karyawan::all();
        $regencies = Regency::all();

        return view('admin.perjalanandinas.edit', compact('regencies', 'item', 'mitra', 'karyawan', 'karyawan1'));
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