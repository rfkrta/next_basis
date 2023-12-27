<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Router;
use App\Models\Cuti;
use App\Models\Dinas;
use App\Models\User;
use App\Models\Mitra;

class DashboardController extends Controller
{
    public function index()
    {
        $item = Router::all();
        $cuti = Cuti::where('status', 'Tertunda')->count();
        $dinas = Dinas::where('status', 'Tertunda')->count();
        $user = User::where('status', 'Aktif')->count();
        $mitra = Mitra::where('status', 'Aktif')->count();
        return view('admin.dashboard.index', compact('item', 'cuti', 'dinas', 'user', 'mitra'));
    }

}
