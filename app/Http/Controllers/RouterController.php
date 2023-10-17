<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RouterController extends Controller
{
    public function index()
    {
        // Logika untuk menampilkan halaman dashboard
        return view('admin.dataperusahaan.router.index');
    }
}
