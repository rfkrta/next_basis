<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inventaris; // Import model Inventaris

class InventarisController extends Controller
{
    public function index()
    {
        // Mengambil semua data inventaris dari model
        $inventaris = Inventaris::all();

        // Kirim data inventaris ke tampilan Blade
        return view('admin.dataperusahaan.inventaris.index', ['inventaris' => $inventaris]);
    }
}
