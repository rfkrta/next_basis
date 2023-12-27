<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\BiayaPerbandingan;
use Illuminate\Http\Request;
use App\Models\BiayaRealisasi;
use Illuminate\Http\Response;

class BiayaRealisasiController extends Controller
{
    //
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $biayaRealisasi = BiayaRealisasi::all();

        return response()->json(['data' => $biayaRealisasi], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $userId)
    {
        $request->validate([
            'biaya_hotel' => 'nullable|integer',
            'keterangan_hotel' => 'required|string',
            'biaya_transportasi' => 'nullable|integer',
            'keterangan_transportasi' => 'required|string',
            'biaya_konsumsi' => 'nullable|integer',
            'keterangan_konsumsi' => 'required|string',
            'biaya_lain' => 'nullable|integer',
            'keterangan_lain' => 'required|string',
        ]);

        $biayaRealisasiData = $request->all();
        $biayaRealisasiData['user_id'] = $userId;

        $biayaRealisasi = BiayaRealisasi::create($biayaRealisasiData);

        return response()->json(['data' => $biayaRealisasi], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $biayaRealisasi = BiayaRealisasi::find($id);

        if (!$biayaRealisasi) {
            return response()->json(['message' => 'Biaya Realisasi not found'], 404);
        }

        return response()->json(['data' => $biayaRealisasi], 200);
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
        $biayaRealisasi = BiayaRealisasi::find($id);

        if (!$biayaRealisasi) {
            return response()->json(['message' => 'Biaya Realisasi not found'], 404);
        }

        $biayaRealisasi->update($request->all());

        return response()->json(['data' => $biayaRealisasi], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $biayaRealisasi = BiayaRealisasi::find($id);

        if (!$biayaRealisasi) {
            return response()->json(['message' => 'Biaya Realisasi not found'], 404);
        }

        $biayaRealisasi->delete();

        return response()->json(['message' => 'Biaya Realisasi deleted successfully'], 200);
    }
}
