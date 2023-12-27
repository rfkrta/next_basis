<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\InventarisRequest;
use App\Models\KategoriInventaris;
use Illuminate\Support\Str;
use Carbon\Carbon;
use App\Models\Inventaris; // Import model Inventaris
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class InventarisController extends Controller
{
    public function index(Request $request)
    {
        // Mengambil semua data inventaris dari model
        $inventaris = Inventaris::all();

        $inventarisBaru = Inventaris::join('kategori_inventaris', 'kategori_inventaris.id', '=', 'inventaris.Kategori')
                    ->select('inventaris.*', 'kategori_inventaris.nama_inv')
                    ->get();

        $kategoriInventaris = KategoriInventaris::all();
        $inventarisWith = Inventaris::with('kategoriInventaris');
        $kategori = $request->input('Kategori'); // Get the 'status' parameter from the request
        // Filter Cutis based on 'status' parameter
<<<<<<< Updated upstream
        if ($kategori === 'Gedung' || $kategori === 'Kendaraan') {
            $inventarisWith->where('Kategori', $kategori);
        }
    
        $inventarisWith = $inventarisWith->get(); // Retrieve filtered cutis
        // Kirim data inventaris ke tampilan Blade
        return view('admin.dataperusahaan.inventaris.index', compact('inventaris', 'inventarisBaru', 'kategoriInventaris', 'inventarisWith', 'kategori'));
=======
        if ($kategori === 1 || $kategori === 2) {
            $inventarisWith->where('Kategori', $kategori);
        }
    
        $inventarisWith = $inventarisWith->paginate(10);

        $search = strtolower($request->input('search', ''));

        // Gunakan query builder atau model sesuai dengan kebutuhan Anda
        $inventarisWithh = Inventaris::whereRaw('LOWER(Nama_Barang) LIKE ?', ["%$search%"])->paginate(10);

        // Kirim data inventaris ke tampilan Blade
        return view('admin.dataperusahaan.inventaris.index', compact('inventaris', 'inventarisBaru', 'kategoriInventaris', 'inventarisWith', 'kategori', 'inventarisWithh', 'search'));
>>>>>>> Stashed changes
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Ambil kode barang untuk ditampilkan pada form create
        $latestCode = Inventaris::latest('id')->value('Kode');

        // Jika sudah ada, ambil angka, tambahkan 1, dan format ulang sebagai kode barang baru
        if ($latestCode) {
            $nextNumber = intval(substr($latestCode, -3)) + 1;
            $newCode = 'INV-' . str_pad($nextNumber, 3, '0', STR_PAD_LEFT);
        } else {
            // Jika belum ada, gunakan INV-001 sebagai kode barang awal
            $newCode = 'INV-001';
        }

        $kategoriInventaris = KategoriInventaris::all();
        return view('admin.dataperusahaan.inventaris.create', ['Kode' => $newCode], compact('kategoriInventaris'));
    }

    public function store(InventarisRequest $request)
    {
        $data = $request->all();
        // dd($data);
        Inventaris::create($data);
        return redirect()->route('admin.dataperusahaan.inventaris.index');
    }

    public function show($id)
    {
        // $item = Cuti::findOrFail($id);
        $item = Inventaris::with([
            'kategoriInventaris'
        ])->findOrFail($id);

        return view('admin.dataperusahaan.inventaris.detail', compact('item'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = Inventaris::with([
            'kategoriInventaris'
        ])->findOrFail($id);
        $kategoriInventaris = KategoriInventaris::all();

        return view('admin.dataperusahaan.inventaris.edit', compact('kategoriInventaris', 'item'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(InventarisRequest $request, $id)
    {
        $data = $request->all();
        $item = Inventaris::findOrFail($id);
        $item->update($data);

        return redirect()->route('admin.dataperusahaan.inventaris.index');
<<<<<<< Updated upstream
=======
    }

    public function searchByName(Request $request)
    {
        $inventarisWithh = Inventaris::with('kategoriInventaris');
        $kategori = $request->input('Kategori'); // Get the 'status' parameter from the request
        // Filter Cutis based on 'status' parameter
        if ($kategori === 'Gedung' || $kategori === 'Kendaraan') {
            $inventarisWith->where('Kategori', $kategori);
        }
    
        $inventarisWithh = $inventarisWithh->paginate(10);
        $search = strtolower($request->input('search', ''));

        // Gunakan query builder atau model sesuai dengan kebutuhan Anda
        $inventarisWith = Inventaris::whereRaw('LOWER(Nama_Barang) LIKE ?', ["%$search%"])->paginate(10);

        return view('admin.dataperusahaan.inventaris.index', compact('inventarisWith', 'search', 'kategori'))
                ->with('noData', $inventarisWith->isEmpty());
>>>>>>> Stashed changes
    }
}
