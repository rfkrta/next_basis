<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\Controller;
use App\Models\BiayaDinas;
use Illuminate\Http\Request;

class BiayaDinasController extends Controller
{
    public function index()
    {
        $biayaDinas = BiayaDinas::all();

        return response()->json(['data' => $biayaDinas], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'field1' => 'required',
            'field2' => 'required',
            // Add validation rules for other fields
        ]);

        $biayaDinas = BiayaDinas::create($request->all());

        return response()->json(['data' => $biayaDinas], 201);
    }

    public function getBiayaDinasByPerjalananDinasId($perjalanan_dinas_id)
    {
        $biayaDinas = BiayaDinas::where('perjalanan_dinas_id', $perjalanan_dinas_id)->get();

        return response()->json(['data' => $biayaDinas], 200);
    }

    // Implement other methods such as show, update, destroy, as needed.
    // Example:

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $biayaDinas = BiayaDinas::find($id);

        if (!$biayaDinas) {
            return response()->json(['message' => 'Biaya Dinas not found'], 404);
        }

        return response()->json(['data' => $biayaDinas], 200);
    }

    // Add other methods for update and destroy as needed.

}
