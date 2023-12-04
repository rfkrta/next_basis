<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\KaryawanRequest;
use App\Models\Karyawan;
use App\Models\Position;
use App\Models\User;
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
    public function index(Request $request)
    {
        $filter = $request->input('filter'); // Get the filter parameter from the URL

        // Start building the query to fetch employees with their positions
        $kry_baru = Karyawan::join('positions', 'positions.id', '=', 'karyawans.id_positions')
            ->select('karyawans.*', 'positions.nama_posisi', 'positions.gaji_posisi');

        // Apply status filter if provided in the URL
        if ($filter === 'Aktif') {
            $kry_baru = $kry_baru->where('karyawans.status', 'Aktif');
        } elseif ($filter === 'Tidak Aktif') {
            $kry_baru = $kry_baru->where('karyawans.status', 'Tidak Aktif');
        }

        // Get the filtered employees along with their associated positions
        $kry_baru = $kry_baru->get();

        // Fetch all positions
        $position = Position::all('positions.id');

        // Return the view with the filtered employees and positions
        return view('admin.karyawan.index', compact('position', 'kry_baru', 'filter'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $position = Position::all();
        $users = User::all();
        return view('admin.karyawan.create', compact('position', 'users'));
    }

    public function getGajiPosisiById($id)
    {
        // Find the position by ID
        $position = Position::find($id);

        if (!$position) {
            // Handle if the position ID is not found
            return response()->json(['error' => 'Position not found'], 404);
        }

        // Retrieve the gaji posisi value for the position
        $gajiPosisi = $position->gaji_posisi;

        // Return the gaji posisi as a JSON response
        return response()->json(['gaji_posisi' => $gajiPosisi]);
    }


    public function getNIPByName($name)
    {
        // Cari pengguna (user) berdasarkan nama
        $user = User::where('name', $name)->first();

        if (!$user) {
            // Handle jika pengguna tidak ditemukan berdasarkan nama
            return response()->json(['error' => 'User not found'], 404);
        }

        // Mengambil NIP dari pengguna (user)
        $nip = $user->nip;

        // Mengembalikan NIP sebagai respons JSON
        return response()->json(['nip' => $nip]);
    }





    public function ajax(Request $request)
    {
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
        $data = Karyawan::create($request->all());

        // Karyawan::create($data);
        return redirect()->route('admin.karyawan.index')->with('success');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $item = Karyawan::with([
            'position'
        ])->findOrFail($id);

        return view('admin.karyawan.detail', compact('item'));
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
