<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InventarisController;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MitraController;
use App\Http\Controllers\PengajuancutiController;
use App\Http\Controllers\PerjalanandinasController;
use App\Http\Controllers\RouterController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});
// Route::get('/home', function () {
//     return redirect('/admin.dashboard.index');
// });
//login
Route::get('/login', [LoginController::class, 'index'])->name('auth.login');
Route::post('/', [LoginController::class, 'login_proses'])->name('login-proses');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
//

    Route::get('/admin/dashboard', [DashboardController::class, 'index'])->middleware('laravel10')->name('admin.dashboard.index');
    Route::get('/admin/pengajuancuti', [PengajuancutiController::class, 'index'])->middleware('laravel10')->name('admin.pengajuancuti.index');
    Route::get('/admin/perjalanandinas', [PerjalanandinasController::class, 'index'])->middleware('laravel10')->name('admin.perjalanandinas.index');
    Route::get('/admin/karyawan', [KaryawanController::class, 'index'])->middleware('laravel10')->name('admin.karyawan.index');
    Route::get('/admin/mitra', [MitraController::class, 'index'])->middleware('laravel10')->name('admin.mitra.index');
    Route::get('/admin/dataperusahaan/inventaris', [InventarisController::class, 'index'])->middleware('laravel10')->name('admin.dataperusahaan.inventaris.index');
    Route::get('/admin/dataperusahaan/router', [RouterController::class, 'index'])->middleware('laravel10')->name('admin.dataperusahaan.router.index');

