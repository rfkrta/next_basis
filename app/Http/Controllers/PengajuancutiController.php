<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CutiRequest;
use App\Models\Cuti;
use App\Models\Karyawan;
use App\Models\Kategori;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class PengajuancutiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $cuti_baru = Cuti::join('users', 'users.id', '=', 'cutis.user_id')
            ->select('cutis.*', 'users.id', 'users.name')
            ->get();

        $cuti_baru = Cuti::join('kategoris', 'kategoris.id', '=', 'cutis.id_kategori')
            ->select('cutis.*', 'kategoris.nama_kategori')
            ->get();

        $users = User::all();
        $kategori = Kategori::all();
        $status = $request->input('status'); // Get the 'status' parameter from the request

        $cuti = Cuti::with('user', 'kategori'); // Eager load relationships 'user' and 'kategori'
    
        // Filter Cutis based on 'status' parameter
        if ($status === 'diterima' || $status === 'ditolak' || $status === 'tertunda') {
            $cuti->where('status', $status);
        }
    
        $cutis = $cuti->paginate(10); // Retrieve filtered cutis

        $search = strtolower($request->input('search', ''));

        // Gunakan query builder atau model sesuai dengan kebutuhan Anda
        $cuti1 = Cuti::whereRaw('LOWER(user_id) LIKE ?', ["%$search%"])->paginate(10);
    
<<<<<<< Updated upstream
        return view('admin.pengajuancuti.index', compact('kategori', 'users', 'cuti_baru','cutis','status'));
=======
        return view('admin.pengajuancuti.index', compact('kategori', 'users', 'cuti_baru','cutis','status', 'search', 'cuti1', 'cuti'));
>>>>>>> Stashed changes
    }
    
    public function updateToDiterima($id)
    {
        $pengajuanCuti = Cuti::findOrFail($id);

        // Update the status to 'diterima'
        $pengajuanCuti->update([
            'status' => 'diterima',
        ]);

        // Calculate the number of days for the cuti
        $startDate = $pengajuanCuti->tanggal_mulai;
        $endDate = $pengajuanCuti->tanggal_selesai;

        // Calculate the difference in days between the start and end dates
        $diffInDays = strtotime($endDate) - strtotime($startDate);
        $numDays = round($diffInDays / (60 * 60 * 24)); // Convert seconds to days and round

        $user = $pengajuanCuti->user;
        if ($user) {
            // Deduct the number of days for cuti from jmlCuti
            $user->jmlCuti -= $numDays;
            $user->save();
        } else {
            // Handle the case where the associated user is not found
            // This could be a scenario that needs further investigation or error handling
        }
        return redirect()->route('admin.pengajuancuti.index')->with('success', 'Pengajuan cuti diterima');
    }

    public function updateToDitolak($id)
    {
        $pengajuanCuti = Cuti::findOrFail($id);

        // Update the status to 'ditolak'
        $pengajuanCuti->update([
            'status' => 'ditolak',
        ]);

        return redirect()->route('admin.pengajuancuti.index');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::all();
        $kategori = Kategori::all();
        return view('admin.pengajuancuti.create', compact('kategori', 'users'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validasi request
        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
            'id_kategori' => 'required',
            'keterangan' => 'required',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date',
            'file_surat' => 'nullable|mimes:pdf|max:2048',
        ]);

        // Jika validasi gagal, kembalikan respons dengan pesan error
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Temukan user
        $user = User::find($request->user_id);

        // Periksa apakah user ditemukan
        if (!$user) {
            return redirect()->back()->withErrors(['error' => 'User tidak ditemukan']);
        }

        // Periksa apakah user memiliki cukup cuti
        if ($user->jmlCuti <= 0) {
            return redirect()->back()->withErrors(['error' => 'Jumlah cuti tidak mencukupi']);
        }

        // Inisialisasi $fileName
        $fileName = null;

        // Simpan file di folder storage/app/public/surat
        if ($request->hasFile('file_surat')) {
            $file = $request->file('file_surat');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('public/surat', $fileName);
        }
        $user->save();

        // Buat instance Cuti
        $cuti = Cuti::create(array_merge(
            $validator->validated(),
            ['file_surat' => $fileName]
        ));

        // Kembalikan respons berhasil
        return redirect()->route('admin.pengajuancuti.index')->with('success', 'Pengajuan cuti berhasil diajukan');
    }





    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // $item = Cuti::findOrFail($id);
        $item = Cuti::with([
            'user', 'kategori'
        ])->findOrFail($id);

        return view('admin.pengajuancuti.detail', [
            'item' => $item
        ]);
    }

    public function searchByName(Request $request)
    {
        $status = $request->input('status'); // Get the 'status' parameter from the request

        $cuti = Cuti::with('user', 'kategori'); // Eager load relationships 'user' and 'kategori'
    
        // Filter Cutis based on 'status' parameter
        if ($status === 'diterima' || $status === 'ditolak' || $status === 'tertunda') {
            $cuti->where('status', $status);
        }
    
        $cuti = $cuti->paginate(10); // Retrieve filtered cutis
        $search = strtolower($request->input('search', ''));

        // Gunakan query builder atau model sesuai dengan kebutuhan Anda
        $cutis = Cuti::whereRaw('LOWER(user_id) LIKE ?', ["%$search%"])->paginate(10);

        return view('admin.pengajuancuti.index', compact('cutis', 'search', 'status'))
                ->with('noData', $cutis->isEmpty());
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
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
