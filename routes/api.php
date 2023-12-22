<?php

use App\Http\Controllers\API\Admin\CutiController;
use App\Http\Controllers\API\Admin\DinasController;
use App\Http\Controllers\API\Admin\KaryawanController;
use App\Http\Controllers\API\Auth\AuthController;
use App\Http\Controllers\API\Auth\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
// Endpoint untuk registrasi pengguna baru
Route::post('/register', [AuthController::class, 'register']);

// Endpoint untuk login pengguna
Route::post('/login', [AuthController::class, 'login'])->name('login');

// Endpoint untuk logout pengguna
Route::middleware('auth:sanctum')->post('/logout', [AuthController::class, 'logout']);

// Pengajuan Cuti
Route::middleware('auth:sanctum')->prefix('user')->group(function () {
    Route::get('/cuti/{userId}', [CutiController::class, 'getCutiByUserId']);
    Route::post('/cuti/{user_id}', [CutiController::class, 'store']);
    Route::put('/cuti/{user_id}/{cuti_id}', [CutiController::class, 'updateByUserIdAndCutiId']);
});

//Dinas
Route::middleware('auth:sanctum')->prefix('user')->group(function () {

});
//Karyawan
Route::middleware('auth:sanctum')->prefix('admin')->group(function () {
    // Route::get('/karyawan', [KaryawanController::class, 'index'])->name('admin.karyawan.index');
    // Route::get('/karyawan/create', [KaryawanController::class, 'create'])->name('admin.karyawan.create');
    // Route::post('/karyawan/store', [KaryawanController::class, 'store'])->name('admin.karyawan.store');
    // Route::get('/karyawan/show', [KaryawanController::class, 'show'])->name('admin.karyawan.show');
    // Route::get('/karyawan/{id}', [KaryawanController::class, 'edit'])->name('admin.karyawan.edit');
    // Route::put('/karyawan/{id}', [KaryawanController::class, 'update'])->name('admin.karyawan.update');
    // Route::get('/karyawan/ajax', [KaryawanController::class, 'ajax'])->name('admin.karyawan.ajax');
    // Route::get('/getGajiPosisiById/{id}', [KaryawanController::class, 'getGajiPosisiById'])->name('getGajiPosisiById');
    // Route::get('/get-nip-by-name/{name}', [KaryawanController::class, 'getNIPByName'])->name('getNIPByName');
    // Route::get('/get-nip-by-id/{id}', [KaryawanController::class, 'getNIPById'])->name('getNIPById');
    // Route::get('/karyawan/status-filter', [KaryawanController::class, 'StatusFilter'])->name('karyawan.status.filter');
    // Route::get('/karyawan/status-filter', [KaryawanController::class, 'StatusFilter'])->name('karyawan.status.filter');
});
Route::middleware('auth:sanctum')->prefix('user')->group(function () {
    // Route::get('/pengajuancuti', [CutiController::class, 'index'])->name('user.pengajuancuti.index');
    // Route::get('/pengajuancuti/create', [CutiController::class, 'create'])->name('user.pengajuancuti.create');
    // Route::post('/pengajuancuti/store', [CutiController::class, 'store'])->name('user.pengajuancuti.store');
    // Route::get('/pengajuancuti/{id}', [CutiController::class, 'show'])->name('user.pengajuancuti.show');
    // Route::put('/pengajuancuti/{id}/updateToDiterima', [CutiController::class, 'updateToDiterima'])->name('user.pengajuancuti.updateToDiterima');
    // Route::put('/pengajuancuti/{id}/updateToDitolak', [CutiController::class, 'updateToDitolak'])->name('user.pengajuancuti.updateToDitolak');
});
