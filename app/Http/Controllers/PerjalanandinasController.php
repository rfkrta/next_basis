<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PerjalanandinasController extends Controller
{
    public function index()
    {
        // Logika untuk menampilkan halaman dashboard
        return view('admin.perjalanandinas.index');
    }
}
