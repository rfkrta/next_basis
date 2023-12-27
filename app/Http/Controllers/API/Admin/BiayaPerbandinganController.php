<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\Controller;
use App\Models\BiayaDinas;
use App\Models\BiayaEstimasi;
use App\Models\BiayaPerbandingan;
use App\Models\BiayaRealisasi;
use Illuminate\Http\Response;
use Illuminate\Http\Request;

class BiayaPerbandinganController extends Controller
{
    // ... other methods ...

    /**
     * Store differences between biaya estimasi and biaya realisasi in the BiayaPerbandingan table.
     *
     * @param  int  $perjalananDinasId
     * @return \Illuminate\Http\Response
     */
    public function storePerbandinganDifferences($perjalananDinasId)
    {
        // Get the latest biaya_dinas for the perjalanan dinas
        $biayaDinas = BiayaDinas::where('perjalanan_dinas_id', $perjalananDinasId)->latest()->first();

        // Get the latest biaya_realisasi for the perjalanan dinas
        $biayaRealisasi = BiayaRealisasi::where('perjalanan_dinas_id', $perjalananDinasId)->latest()->first();

        // Check if either biaya_dinas or biaya_realisasi is not found
        if (!$biayaDinas || !$biayaRealisasi) {
            $response = [
                'message' => 'BiayaDinas or BiayaRealisasi not found',
                'perjalanan_dinas_id' => $perjalananDinasId,
                'biaya_dinas' => $biayaDinas,
                'biaya_realisasi' => $biayaRealisasi,
            ];

            return response()->json($response, Response::HTTP_NOT_FOUND);
        }

        // Calculate the differences
        $biayaHotelDifference = $biayaDinas->biaya_hotel - $biayaRealisasi->biaya_hotel;
        $keteranganHotel = $biayaDinas->keterangan_hotel;

        $biayaTransportasiDifference = $biayaDinas->biaya_transportasi - $biayaRealisasi->biaya_transportasi;
        $keteranganTransportasi = $biayaDinas->keterangan_transportasi;

        $biayaKonsumsiDifference = $biayaDinas->biaya_konsumsi - $biayaRealisasi->biaya_konsumsi;
        $keteranganKonsumsi = $biayaDinas->keterangan_konsumsi;

        $biayaLainDifference = $biayaDinas->biaya_lain - $biayaRealisasi->biaya_lain;
        $keteranganLain = $biayaDinas->keterangan_lain;

        // Create a new BiayaPerbandingan record
        $comparison = BiayaPerbandingan::create([
            'perjalanan_dinas_id' => $perjalananDinasId,
            'biaya_perbandingan_hotel' => $biayaHotelDifference,
            'keterangan_perbandingan_hotel' => $keteranganHotel,
            'biaya_perbandingan_transportasi' => $biayaTransportasiDifference,
            'keterangan_perbandingan_transportasi' => $keteranganTransportasi,
            'biaya_perbandingan_konsumsi' => $biayaKonsumsiDifference,
            'keterangan_perbandingan_konsumsi' => $keteranganKonsumsi,
            'biaya_perbandingan_lain' => $biayaLainDifference,
            'keterangan_perbandingan_lain' => $keteranganLain,
            // ... add other columns and differences as needed ...
        ]);

        return response()->json(['data' => $comparison], Response::HTTP_CREATED);
    }

    public function getBiayaPerbandingan($perjalananDinasId)
    {
        $biayaPerbandingan = BiayaPerbandingan::where('perjalanan_dinas_id', $perjalananDinasId)->latest()->first();

        // Check if biayaPerbandingan is not found
        if (!$biayaPerbandingan) {
            $response = [
                'message' => 'BiayaPerbandingan not found',
                'perjalanan_dinas_id' => $perjalananDinasId,
            ];

            return response()->json($response, Response::HTTP_NOT_FOUND);
        }

        return response()->json(['data' => $biayaPerbandingan], Response::HTTP_OK);
    }


    public function getBiayaDinas($perjalananDinasId)
    {
        $biayaDinas = BiayaDinas::where('perjalanan_dinas_id', $perjalananDinasId)->latest()->first();

        if (!$biayaDinas) {
            return response()->json(['message' => 'BiayaDinas not found'], Response::HTTP_NOT_FOUND);
        }

        return response()->json(['data' => $biayaDinas], Response::HTTP_OK);
    }
    /**
     * Get the comparison data for a specific perjalanan_dinas_id.
     *
     * @param  int  $perjalananDinasId
     * @return \Illuminate\Http\Response
     */
    public function getComparison($perjalananDinasId)
    {
        $comparison = BiayaPerbandingan::where('perjalanan_dinas_id', $perjalananDinasId)->latest()->first();

        if (!$comparison) {
            return response()->json(['message' => 'Comparison not found'], 404);
        }

        return response()->json(['data' => $comparison], 200);
    }
}
