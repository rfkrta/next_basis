<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\KaryawanRequest;
use App\Models\Karyawan;
use App\Models\Position;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Carbon\Carbon;

class KaryawanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kry_baru = Karyawan::join('positions', 'positions.id', '=', 'karyawans.id_positions')
                    ->select('karyawans.*', 'positions.nama_posisi', 'positions.gaji_posisi')
                    ->get();

        $position = Position::all();
        //Logika untuk menampilkan halaman dashboard
        return view('admin.karyawan.index', compact('position', 'kry_baru'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $position = Position::all();
        return view('admin.karyawan.create', compact('position'));
    }

    public function ajax(Request $request) {
        $id_positions['id_positions'] = $request->id_positions;
        $ajax_position = Position::where('id', $id_positions)->get();

        return view('admin.karyawan.ajax', compact('ajax_position'));   
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(KaryawanRequest $request)
    {
        $data = $request->all();

        Karyawan::create($data);
        return redirect()->route('admin.karyawan.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $item = Karyawan::findOrFail($id);
        $position = Position::all();

        return view('admin.karyawan.detail', [
            'item' => $item,
            'position' => $position
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
        $item = Karyawan::findOrFail($id);
        $position = Position::all();

        return view('admin.karyawan.edit', [
            'item' => $item,
            'position' => $position
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(KaryawanRequest $request, $id)
    {
        $data = $request->all();
        $item = Karyawan::findOrFail($id);
        $item->update($data);

        return redirect()->route('admin.karyawan.index');
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
// {
//     public function index()
//     {
//         // Logika untuk menampilkan halaman dashboard
//         return view('admin.karyawan.index');
//     }
// }
