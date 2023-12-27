<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\Admin\RouterRequest;
use App\Models\Router;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;

class RouterController extends Controller
{
    public function index(Request $request)
    {
        // Ambil kode barang untuk ditampilkan pada form create
        $latestCode = Router::latest('id')->value('kode_router');

        // Jika sudah ada, ambil angka, tambahkan 1, dan format ulang sebagai kode barang baru
        if ($latestCode) {
            $nextNumber = intval(substr($latestCode, -3)) + 1;
            $newCode = 'RTR-' . str_pad($nextNumber, 3, '0', STR_PAD_LEFT);
        } else {
            // Jika belum ada, gunakan INV-001 sebagai kode barang awal
            $newCode = 'RTR-001';
        }

        $items = Router::all();

        $router = Router::paginate(10);

        $search = strtolower($request->input('search', ''));

        // Gunakan query builder atau model sesuai dengan kebutuhan Anda
        $routers = Router::whereRaw('LOWER(nama_router) LIKE ?', ["%$search%"])->paginate(10);
        // Logika untuk menampilkan halaman dashboard
        return view('admin.dataperusahaan.router.index', ['kode_router' => $newCode], compact('search', 'routers', 'items', 'router'));
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

    public function searchByName(Request $request)
    {
        // Ambil kode barang untuk ditampilkan pada form create
        $latestCode = Router::latest('id')->value('kode_router');

        // Jika sudah ada, ambil angka, tambahkan 1, dan format ulang sebagai kode barang baru
        if ($latestCode) {
            $nextNumber = intval(substr($latestCode, -3)) + 1;
            $newCode = 'RTR-' . str_pad($nextNumber, 3, '0', STR_PAD_LEFT);
        } else {
            // Jika belum ada, gunakan INV-001 sebagai kode barang awal
            $newCode = 'RTR-001';
        }

        $search = strtolower($request->input('search', ''));

        // Gunakan query builder atau model sesuai dengan kebutuhan Anda
        $router = Router::whereRaw('LOWER(nama_router) LIKE ?', ["%$search%"])->paginate(10);

        return view('admin.dataperusahaan.router.index',['kode_router' => $newCode], compact('router', 'search'))
                ->with('noData', $router->isEmpty());
    }
}
