<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\DinasRequest;
use App\Models\Dinas;
use App\Models\Karyawan;
use App\Models\Mitra;
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

        $mitra = Mitra::all();
        $karyawan = Karyawan::all();
        //Logika untuk menampilkan halaman dashboard
        return view('admin.perjalanandinas.index', compact('karyawan', 'mitra', 'dinas_baru'));
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
        return view('admin.perjalanandinas.create', compact('mitra', 'karyawan'));
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
        //
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