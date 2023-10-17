<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PengajuancutiController extends Controller
{
    public function index()
    {
        // Logika untuk menampilkan halaman dashboard
        return view('admin.pengajuancuti.index');
    }
}
