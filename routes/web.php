<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InventarisController;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MitraController;
use App\Http\Controllers\PengajuancutiController;
use App\Http\Controllers\PerjalanandinasController;
use App\Http\Controllers\RouterController;
use Illuminate\Support\Facades\Auth;
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
    Route::get('/admin/pengajuancuti/create', [PengajuancutiController::class, 'create'])->middleware('laravel10')->name('admin.pengajuancuti.create');
    Route::post('/admin/pengajuancuti/store', [PengajuancutiController::class,'store'])->middleware('laravel10')->name('admin.pengajuancuti.store');
    Route::get('/admin/pengajuancuti/{id}', [PengajuancutiController::class,'show'])->middleware('laravel10')->name('admin.pengajuancuti.show');
    Route::get('/admin/perjalanandinas', [PerjalanandinasController::class, 'index'])->middleware('laravel10')->name('admin.perjalanandinas.index');
    Route::get('/admin/perjalanandinas/create', [PerjalanandinasController::class, 'create','user'])->middleware('laravel10')->name('admin.perjalanandinas.create');
    Route::post('/admin/perjalanandinas/store', [PerjalanandinasController::class, 'store'])->middleware('laravel10')->name('admin.perjalanandinas.store');
    Route::get('/admin/karyawan', [KaryawanController::class, 'index'])->middleware('laravel10')->name('admin.karyawan.index');
    Route::get('/admin/karyawan/create',[KaryawanController::class, 'create','user'])->middleware('laravel10')->name('admin.karyawan.create');
    Route::post('/admin/karyawan/store', [KaryawanController::class, 'store','user'])->middleware('laravel10')->name('admin.karyawan.store');
    Route::get('/admin/karyawan/show', [KaryawanController::class, 'show'])->middleware('laravel10')->name('admin.karyawan.show');
    Route::get('/admin/karyawan/{id}', [KaryawanController::class, 'edit'])->middleware('laravel10')->name('admin.karyawan.edit');
    Route::put('/admin/karyawan/{id}', [KaryawanController::class, 'update'])->middleware('laravel10')->name('admin.karyawan.update');
    Route::get('/admin/karyawan/ajax', [KaryawanController::class, 'ajax'])->middleware('laravel10')->name('admin.karyawan.ajax');
    Route::get('/admin/karyawan/getgaji', [KaryawanController::class, 'getgaji'])->middleware('laravel10')->name('admin.karyawan.getgaji');
    Route::get('/admin/karyawan/getgaji1', [KaryawanController::class, 'getgaji1'])->middleware('laravel10')->name('admin.karyawan.getgaji1');
    Route::get('/admin/karyawan/getgaji2', [KaryawanController::class, 'getgaji2'])->middleware('laravel10')->name('admin.karyawan.getgaji2');
    Route::get('/admin/mitra', [MitraController::class, 'index'])->middleware('laravel10')->name('admin.mitra.index');
    Route::get('/admin/mitra/create', [MitraController::class, 'create'])->middleware('laravel10')->name('admin.mitra.create');
    Route::post('/admin/mitra/store', [MitraController::class, 'store'])->middleware('laravel10')->name('admin.mitra.store');
    Route::post('/admin/mitra/getkota', [MitraController::class, 'getkota'])->middleware('laravel10')->name('getkota');
    Route::post('/admin/mitra/getkecamatan', [MitraController::class, 'getkecamatan'])->middleware('laravel10')->name('getkecamatan');
    Route::post('/admin/mitra/getkelurahan', [MitraController::class, 'getkelurahan'])->middleware('laravel10')->name('getkelurahan');
    Route::get('/admin/mitra/{id}', [MitraController::class, 'edit'])->middleware('laravel10')->name('admin.mitra.edit');
    Route::get('/admin/mitra/detail/{id}', [MitraController::class, 'show'])->middleware('laravel10')->name('admin.mitra.show');
    Route::put('/admin/mitra/{id}', [MitraController::class, 'update'])->middleware('laravel10')->name('admin.mitra.update');
    Route::get('/admin/dataperusahaan/inventaris', [InventarisController::class, 'index'])->middleware('laravel10')->name('admin.dataperusahaan.inventaris.index');
    Route::get('/admin/dataperusahaan/router', [RouterController::class, 'index'])->middleware('laravel10')->name('admin.dataperusahaan.router.index');

    // Route::prefix('admin')
    // ->namespace('Admin')
    // ->middleware(['auth','admin'])
    // ->group(function(){
    //     Route::get('/', 'DashboardController@index')
    //         ->name('dashboard');

    //     Route::resource('cuti', 'PengajuancutiController');
    //     Route::resource('karyawan', 'KaryawanController');
    //     Route::resource('dinas', 'PerjalanandinasController');
    //     Route::resource('mitra', 'MitraController');
    //     Route::resource('router', 'RouterController');
    //     Route::resource('inventaris', 'InventarisController');
    //     Route::get('ajax', [TransactionInController::class, 'ajax']);
    // });


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
