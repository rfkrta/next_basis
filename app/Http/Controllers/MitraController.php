<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\MitraRequest;
use App\Models\Mitra;
use App\Models\Province;
use App\Models\Regency;
use App\Models\District;
use App\Models\Village;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class MitraController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $items = Mitra::join('regencies', 'regencies.id', '=', 'mitras.kota')
            ->select('mitras.*', 'regencies.province_id', 'regencies.name')
            ->get();
        
        $items = Mitra::with('regency.province')->get();
            
        // $items = Mitra::with([
        //     'province', 'regency', 'district', 'village'
        // ])->get();
        // $item = Mitra::all();
        // $regencies = Regency::all();

        $status = $request->input('status'); // Get the 'status' parameter from the request

        $mitra = Mitra::with('regency', 'province', 'district', 'village'); // Eager load relationships 'user' and 'kategori'
    
        // Filter mitra based on 'status' parameter
        if ($status === 'Aktif' || $status === 'Tidak Aktif') {
            $mitra->where('status', $status);
        }
    
        $mitra = $mitra->get();

        // Logika untuk menampilkan halaman dashboard
        return view('admin.mitra.index', compact('items', 'mitra', 'status'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Get semua data
        $provinces = Province::all();
        $regencies = Regency::all();
        $districts = District::all();
        $villages = Village::all();

        // Cari berdasarkan nama
        // $provinces = Province::where('name', 'JAWA BARAT')->first();
        // $regencies = Regency::where('name', 'LIKE', '%CIANJUR%')->first();
        // $districts = District::where('name', 'LIKE', 'BANDUNG%')->get();
        // $villages = Village::where('name', 'BOJONGHERANG')->first();

        return view('admin.mitra.create', compact('provinces'));
    }
    public function getkota(Request $request)
    {
        $id_provinsi = $request->id_provinsi;

        $kota = Regency::where('province_id', $id_provinsi)->get();

        $option = "<option>Pilih Kabupaten / Kota...</option>";

        foreach ($kota as $kota) {
            $option .= "<option value='$kota->id'>$kota->name</option>";
        }

        echo $option;
    }
    public function getkecamatan(Request $request)
    {
        $id_kota = $request->id_kota;

        $kecamatan = District::where('regency_id', $id_kota)->get();

        $option = "<option>Pilih Kecamatan...</option>";

        foreach ($kecamatan as $kecamatan) {
            $option .= "<option value='$kecamatan->id'>$kecamatan->name</option>";
        }

        echo $option;
    }
    public function getkelurahan(Request $request)
    {
        $id_kecamatan = $request->id_kecamatan;

        $kelurahan = Village::where('district_id', $id_kecamatan)->get();

        $option = "<option>Pilih Kelurahan / Desa...</option>";

        foreach ($kelurahan as $kelurahan) {
            $option .= "<option value='$kelurahan->id'>$kelurahan->name</option>";
        }

        echo $option;
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MitraRequest $request)
    {
        $data = $request->all();

        Mitra::create($data);
        return redirect()->route('admin.mitra.index');
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $item = Mitra::with([
            'province', 'regency', 'district', 'village'
        ])->findOrFail($id);

        return view('admin.mitra.detail', compact('item'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = Mitra::with([
            'province', 'regency', 'district', 'village'
        ])->findOrFail($id);
        $provinces = Province::all();
        $regencies = Regency::all();
        $districts = District::all();
        $villages = Village::all();

        return view('admin.mitra.edit', compact('provinces', 'item'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(MitraRequest $request, $id)
    {
        $data = $request->all();
        $item = Mitra::findOrFail($id);
        $item->update($data);

        return redirect()->route('admin.mitra.index');
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
