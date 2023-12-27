<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class GajiController extends Controller
{

    public function hitungGaji(Request $request)
    {
        // Mendapatkan user berdasarkan ID yang ada di request
        $user = User::find($request->id);

        // Pastikan user ditemukan sebelum melanjutkan perhitungan gaji
        if ($user) {
            // Panggil metode hitungGajiBulanSebelumnya pada model User
            $user->hitungGajiBulanSebelumnya();

            return view('admin.user.detail')->with('success', 'Gaji berhasil dihitung.');
        } else {
            return view('admin.user.detail')->with('error', 'User tidak ditemukan.');
        }
    }

    // public function hitungGaji(User $user)
    // {
    //     // Panggil metode hitungGajiBulanSebelumnya pada model User
    //     $user->hitungGajiBulanSebelumnya();

    //     return redirect()->back()->with('success', 'Gaji berhasil dihitung.');
    // }
}
