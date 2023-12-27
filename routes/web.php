<?php

use App\Http\Controllers\AbsensiController;
use App\Http\Controllers\Admin\KaryawanController as AdminKaryawanController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InventarisController;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MitraController;
use App\Http\Controllers\PengajuancutiController;
use App\Http\Controllers\PerjalanandinasController;
use App\Http\Controllers\RouterController;
use App\Http\Controllers\UserController;
use App\Models\Absensi;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});
Route::post('/login', [LoginController::class, 'index'])->name('auth.login');
Route::post('/', [LoginController::class, 'login_proses'])->name('login-proses');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

// Middleware
Route::middleware('laravel10')->group(function () {
    Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
    //
    Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard.index');

    // Cuti
    Route::get('/admin/pengajuancuti', [PengajuancutiController::class, 'index'])->name('admin.pengajuancuti.index');
    Route::get('/admin/pengajuancuti/create', [PengajuancutiController::class, 'create'])->name('admin.pengajuancuti.create');
    Route::post('/admin/pengajuancuti/store', [PengajuancutiController::class, 'store'])->name('admin.pengajuancuti.store');
    Route::get('/admin/pengajuancuti/{id}', [PengajuancutiController::class, 'show'])->name('admin.pengajuancuti.show');
    Route::put('/admin/pengajuancuti/{id}/updateToDiterima', [PengajuanCutiController::class, 'updateToDiterima'])->name('admin.pengajuancuti.updateToDiterima');
    Route::put('/admin/pengajuancuti/{id}/updateToDitolak', [PengajuancutiController::class, 'updateToDitolak'])->name('admin.pengajuancuti.updateToDitolak');
    Route::get('/admin/pengajuancuti/create', [PengajuancutiController::class, 'create'])->name('admin.pengajuancuti.create');
    Route::post('/admin/pengajuancuti/store', [PengajuancutiController::class, 'store'])->name('admin.pengajuancuti.store');



    // Dinas
    Route::get('/admin/perjalanandinas', [PerjalanandinasController::class, 'index'])->name('admin.perjalanandinas.index');
    Route::get('/admin/perjalanandinas/create', [PerjalanandinasController::class, 'create', 'user'])->name('admin.perjalanandinas.create');
    Route::post('/admin/perjalanandinas/store', [PerjalanandinasController::class, 'store'])->name('admin.perjalanandinas.store');
    Route::get('/admin/perjalanandinas/edit/{id}', [PerjalanandinasController::class, 'edit'])->name('admin.perjalanandinas.edit');
    Route::get('/admin/perjalanandinas/edit/{id}', [PerjalanandinasController::class, 'edit'])->name('admin.perjalanandinas.edit');
    Route::get('/admin/perjalanandinas/edit/{id}', [PerjalanandinasController::class, 'edit'])->name('admin.perjalanandinas.edit');
    Route::get('/admin/perjalanandinas/edit/{id}', [PerjalanandinasController::class, 'edit'])->name('admin.perjalanandinas.edit');
    Route::get('/admin/perjalanandinas/{id}/edit', [PerjalanandinasController::class, 'edit'])->name('admin.perjalanandinas.edit');
    Route::get('/admin/perjalanandinas/show/{id}', [PerjalanandinasController::class, 'show'])->name('admin.perjalanandinas.show');
    Route::get('/getPosisiById/{id}', [PerjalanandinasController::class, 'getPosisiById'])->name('getPosisiById');
    Route::get('/getPosisiById1/{id}', [PerjalanandinasController::class, 'getPosisiById1'])->name('getPosisiById1');
    Route::get('/getPosisiById2/{id}', [PerjalanandinasController::class, 'getPosisiById2'])->name('getPosisiById2');
    Route::get('/getKaryawanOptions', [PerjalanandinasController::class, 'getKaryawanOptions'])->name('getKaryawanOptions');
    Route::put('/admin/perjalanandinas/{id}/biaya', [PerjalanandinasController::class, 'updateBiaya'])->name('admin.perjalanandinas.updateBiaya');
    Route::put('/admin/perjalanandinas/{id}/updateToDiterima', [PerjalanandinasController::class, 'updateToDiterima'])->name('admin.perjalanandinas.updateToDiterima');
    Route::put('/admin/perjalanandinas/{id}/updateToDitolak', [PerjalanandinasController::class, 'updateToDitolak'])->name('admin.perjalanandinas.updateToDitolak');  


    Route::get('/getGajiPosisiById', [UserController::class, 'getGajiPosisiById']);
    // absensi
    Route::get('/admin/absensi', [AbsensiController::class, 'index'])->name('admin.absensi.index');
    Route::get('/admin/absensi/create', [AbsensiController::class, 'create', 'user'])->name('admin.absensi.create');
    Route::post('/admin/absensi/store', [AbsensiController::class, 'store', 'user'])->name('admin.absensi.store');
    Route::get('/admin/absensi/show/{id}', [AbsensiController::class, 'show'])->name('admin.absensi.show');
    Route::get('/admin/absensi/edit/{id}', [AbsensiController::class, 'edit'])->name('admin.absensi.edit');
    Route::put('/admin/absensi/{id}', [AbsensiController::class, 'update'])->name('admin.absensi.update');
    Route::get('/admin/absensi/ajax', [AbsensiController::class, 'ajax'])->name('admin.absensi.ajax');
    Route::get('/getGajiPosisiById/{id}', [AbsensiController::class, 'getGajiPosisiById'])->name('getGajiPosisiById');
    Route::get('/admin/absensi/filter', [AbsensiController::class, 'filterabsensi'])->name('admin.absensi.filter');
    Route::get('/get-nip-by-name/{name}', [AbsensiController::class, 'getNIPByName'])->name('getNIPByName');

    // Mitra
    Route::get('/admin/mitra', [MitraController::class, 'index'])->name('admin.mitra.index');
    Route::get('/admin/mitra/create', [MitraController::class, 'create'])->name('admin.mitra.create');
    Route::post('/admin/mitra/store', [MitraController::class, 'store'])->name('admin.mitra.store');
    Route::post('/admin/mitra/getkota', [MitraController::class, 'getkota'])->name('getkota');
    Route::post('/admin/mitra/getkecamatan', [MitraController::class, 'getkecamatan'])->name('getkecamatan');
    Route::post('/admin/mitra/getkelurahan', [MitraController::class, 'getkelurahan'])->name('getkelurahan');
    Route::get('/admin/mitra/{id}', [MitraController::class, 'edit'])->name('admin.mitra.edit');
    Route::get('/admin/mitra/detail/{id}', [MitraController::class, 'show'])->name('admin.mitra.show');
    Route::put('/admin/mitra/{id}', [MitraController::class, 'update'])->name('admin.mitra.update');

    // Inventaris
    Route::get('/admin/dataperusahaan/inventaris', [InventarisController::class, 'index'])->name('admin.dataperusahaan.inventaris.index');
    Route::get('/admin/dataperusahaan/inventaris/create', [InventarisController::class, 'create'])->name('admin.dataperusahaan.inventaris.create');
    Route::post('/admin/dataperusahaan/inventaris/store', [InventarisController::class, 'store'])->name('admin.dataperusahaan.inventaris.store');
    Route::get('/admin/dataperusahaan/inventaris/{id}/detail', [InventarisController::class, 'show'])->name('admin.dataperusahaan.inventaris.show');
    Route::get('/admin/dataperusahaan/inventaris/{id}/edit', [InventarisController::class, 'edit'])->name('admin.dataperusahaan.inventaris.edit');
    Route::put('/admin/dataperusahaan/inventaris/{id}/update', [InventarisController::class, 'update'])->name('admin.dataperusahaan.inventaris.update');

    // Router
    Route::get('/admin/dataperusahaan/router', [RouterController::class, 'index'])->name('admin.dataperusahaan.router.index');
    Route::post('/admin/dataperusahaan/router/store', [RouterController::class, 'store'])->name('admin.dataperusahaan.router.store');
    Route::get('/load-router-data', [RouterController::class, 'loadRouterData']);
    Route::get('/get-router/{id}', [RouterController::class, 'getRouter']);
    Route::put('/update-router/{id}', [RouterController::class, 'update'])->name('update-router');
    Route::delete('/delete-router/{id}', [RouterController::class, 'destroy'])->name('delete-router');

    // User
    Route::get('/admin/user/', [UserController::class, 'index'])->name('admin.user.index');
    Route::get('/admin/users', [UserController::class, 'index'])->name('admin.users.index');
    Route::get('/admin/user/create', [UserController::class, 'create'])->name('admin.user.create');
    Route::post('/admin/user/store', [UserController::class, 'store'])->name('admin.user.store');
    Route::get('/admin/user/{id}', [UserController::class, 'edit'])->name('admin.user.edit');
    Route::put('/admin/user/{id}', [UserController::class, 'update'])->name('admin.user.edit');
    Route::get('/admin/user/detail/{id}', [UserController::class, 'show'])->name('admin.user.show');
    // Route::post('/admin/user/{id}/hitung-gaji', [GajiController::class, 'hitungGaji'])->name('user.hitungGaji');
    Route::post('/admin/user/{id}/hitung-gaji', [UserController::class, 'hitungGaji'])->name('admin.user.hitungGaji');
});
