<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\Controller;
use App\Models\Regency;
use Illuminate\Http\Request;

class RegencyController extends Controller
{
    //
    public function search(Request $request)
    {
        $query = $request->input('query');

        $result = Regency::where('name', 'like', "%$query%")
            ->orWhere('id', 'like', "%$query%")
            ->orWhereHas('province', function ($q) use ($query) {
                $q->where('name', 'like', "%$query%");
            })
            ->get();

        return response()->json(['data' => $result]);
    }

    public function getByName(Request $request)
    {
        $name = $request->input('name');

        $result = Regency::where('name', $name)->get();

        return response()->json(['data' => $result]);
    }
    public function getByFirstName(Request $request)
    {
        $name = $request->input('name');

        $result = Regency::where('name', 'like', "$name%")->get();

        return response()->json(['data' => $result]);
    }
    public function searchByName(Request $request)
    {
        $name = $request->input('name');

        $result = Regency::where('name', 'like', "%$name%")->get();

        return response()->json(['data' => $result]);
    }
}
