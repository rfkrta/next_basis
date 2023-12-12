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

class PengajuancutiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cuti_baru = Cuti::join('users', 'users.id', '=', 'cutis.user_id')
            ->select('cutis.*', 'users.name')
            ->get();

        $cuti_baru = Cuti::join('kategoris', 'kategoris.id', '=', 'cutis.id_kategori')
            ->select('cutis.*', 'kategoris.nama_kategori')
            ->get();

        $karyawan = User::all();
        $kategori = Kategori::all();
        //Logika untuk menampilkan halaman dashboard
        return view('admin.pengajuancuti.index', compact('kategori', 'karyawan', 'cuti_baru', 'data'));
        // $items = Cuti::all();

        // return view('admin.pengajuancuti.index', [
        //     'items' => $items
        // ]);
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
        // Validate the request
        $validatedData = $request->validate([
            'user_id' => 'required', // Update with your validation rules
            'id_kategori' => 'required', // Update with your validation rules
            'keterangan' => 'required', // Update with your validation rules
            'tanggal_mulai' => 'required|date', // Update with your validation rules
            'tanggal_selesai' => 'required|date', // Update with your validation rules
            'file_surat' => 'required|file|mimes:pdf|max:2048', // Validation for file upload
        ]);

        // Store file in storage/app/public/surat folder
        if ($request->hasFile('file_surat')) {
            $file = $request->file('file_surat');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('public/surat', $fileName);
        }
        $user->save();

        // Create Cuti instance
        $cuti = Cuti::create(array_merge(
            $validatedData,
            ['file_surat' => $fileName] // Save the file name in the database
        ));

        // Redirect to the index page after successful creation
        return redirect()->route('admin.pengajuancuti.index');
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
