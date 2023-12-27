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

    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'nama_router' => 'required',
    //         // Tambahkan validasi sesuai kebutuhan
    //     ]);

    //     // $data = $request->all();

    //     // Router::create($data);

    //     Router::create($request->all());

    //     return redirect()->route('admin.dataperusahaan.router.index')->with('success', 'Router berhasil ditambahkan');
    // }

    public function store(Request $request)
    {
        // Validasi request, sesuaikan dengan kebutuhan proyek Anda
        $request->validate([
            'nama_router' => 'required|max:255',
        ]);

        // Simpan data router baru ke database
        $router = new Router();
        $router->nama_router = $request->input('nama_router');
        $router->save();

        // Respon sukses
        // return response()->json(['message' => 'Data router berhasil disimpan']);
        // return redirect()->route('admin.dataperusahaan.router.index')->with('success', 'Router berhasil ditambahkan');
        return redirect()->back()->with('success', 'Router berhasil ditambahkan.');
    }

    public function loadRouterData()
    {
        $data = Router::all();

        // Respon data dalam format JSON
        return response()->json($data);
    }

    public function getRouter($id)
    {
        $router = Router::find($id);

        // Respon data dalam format JSON
        return response()->json($router);
    }

    public function update(Request $request, $id)
    {
        // Validasi data yang diterima dari formulir
        $request->validate([
            'nama_router' => 'required|max:255',
        ]);

        // Temukan router berdasarkan ID
        $router = Router::findOrFail($id);

        // Update nilai nama router
        $router->nama_router = $request->nama_router;

        // Simpan perubahan
        $router->save();

        // Redirect ke halaman yang sesuai, atau kirim respons JSON jika digunakan secara AJAX
        return redirect()->back()->with('success', 'Perubahan berhasil disimpan.');
    }

    public function destroy($id)
    {
        // Temukan router berdasarkan ID
        $router = Router::findOrFail($id);

        // Hapus router
        $router->delete();

        // Redirect ke halaman yang sesuai, atau kirim respons JSON jika digunakan secara AJAX
        return redirect()->back()->with('success', 'Router berhasil dihapus.');
    }
}
