<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CutiRequest;
use App\Models\Cuti;
use App\Models\Karyawan;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;

class PengajuancutiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cuti_baru = Cuti::join('karyawans', 'karyawans.id', '=', 'cutis.id_nama')
            ->select('cutis.*', 'karyawans.nama')
            ->get();

        $cuti_baru = Cuti::join('kategoris', 'kategoris.id', '=', 'cutis.id_kategori')
            ->select('cutis.*', 'kategoris.nama_kategori')
            ->get();

        $data = Cuti::paginate(10);
        $karyawan = Karyawan::all();
        $kategori = Kategori::all();
        //Logika untuk menampilkan halaman dashboard
        return view('admin.pengajuancuti.index', compact('kategori', 'karyawan', 'cuti_baru', 'data'));
        // $items = Cuti::all();

        // return view('admin.pengajuancuti.index', [
        //     'items' => $items
        // ]);
    }
    public function updateToDiterima($id)
    {
        $pengajuanCuti = Cuti::findOrFail($id);

        // Update the status to 'diterima'
        $pengajuanCuti->update([
            'status' => 'diterima',
        ]);

        // Kurangi jumlah cuti pada pengguna terkait
        $karyawan = Karyawan::find($pengajuanCuti->id_nama);
        $karyawan->jmlCuti -= 1;
        $karyawan->save();

        // Redirect to a specific route or return a response
        return redirect()->route('admin.pengajuancuti.index')->with('success', 'Pengajuan cuti diterima');
    }
    public function updateToDitolak($id)
    {
        $pengajuanCuti = Cuti::findOrFail($id);

        // Update the status to 'ditolak'
        $pengajuanCuti->update([
            'status' => 'ditolak',
        ]);

        return redirect()->route('admin.pengajuancuti.index');
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $karyawan = Karyawan::all();
        $kategori = Kategori::all();
        return view('admin.pengajuancuti.create', compact('kategori', 'karyawan'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CutiRequest $request)
    {
        $data = $request->all();

        Cuti::create($data);
        return redirect()->route('admin.pengajuancuti.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // $item = Cuti::findOrFail($id);
        $item = Cuti::with([
            'karyawan', 'kategori'
        ])->findOrFail($id);

        return view('admin.pengajuancuti.detail', [
            'item' => $item
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
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
