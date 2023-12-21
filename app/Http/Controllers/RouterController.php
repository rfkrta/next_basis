<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\Admin\RouterRequest;
use App\Models\Router;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;

class RouterController extends Controller
{
    public function index()
    {
        $item = Router::all();
        // Logika untuk menampilkan halaman dashboard
        return view('admin.dataperusahaan.router.index', compact('item'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_router' => 'required',
            // Tambahkan validasi sesuai kebutuhan
        ]);

        // $data = $request->all();

        // Router::create($data);

        Router::create($request->all());

        return redirect()->route('admin.dataperusahaan.router.index')->with('success', 'Router berhasil ditambahkan');
    }
}
