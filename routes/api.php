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

// Route::prefix('auth')->group(function () {
//     Route::post('/register', [AuthController::class, 'register']);
//     Route::post('/login', [AuthController::class, 'login']);

//     Route::middleware('auth:sanctum')->group(function () {
//         Route::post('/logout', [AuthController::class, 'logout']);
//         // Additional authenticated routes can be defined here
//     });
// });
// Pengajuan Cuti
Route::middleware('auth:sanctum')->prefix('admin')->group(function () {
    Route::get('/pengajuancuti', [CutiController::class, 'index'])->name('admin.pengajuancuti.index');
    Route::get('/pengajuancuti/create', [CutiController::class, 'create'])->name('admin.pengajuancuti.create');
    Route::post('/pengajuancuti/store', [CutiController::class, 'store'])->name('admin.pengajuancuti.store');
    Route::get('/pengajuancuti/{id}', [CutiController::class, 'show'])->name('admin.pengajuancuti.show');
    Route::put('/pengajuancuti/{id}/updateToDiterima', [CutiController::class, 'updateToDiterima'])->name('admin.pengajuancuti.updateToDiterima');
    Route::put('/pengajuancuti/{id}/updateToDitolak', [CutiController::class, 'updateToDitolak'])->name('admin.pengajuancuti.updateToDitolak');
});
//Dinas
Route::middleware('auth:sanctum')->prefix('admin')->group(function () {
    Route::get('/perjalanandinas', [DinasController::class, 'index'])->name('admin.perjalanandinas.index');
    Route::get('/perjalanandinas/create', [DinasController::class, 'create'])->name('admin.perjalanandinas.create');
    Route::post('/perjalanandinas', [DinasController::class, 'store'])->name('admin.perjalanandinas.store');
    Route::get('/perjalanandinas/{id}', [DinasController::class, 'show'])->name('admin.perjalanandinas.show');
    Route::put('/perjalanandinas/{id}', [DinasController::class, 'update'])->name('admin.perjalanandinas.update');
    Route::delete('/perjalanandinas/{id}', [DinasController::class, 'destroy'])->name('admin.perjalanandinas.destroy');
});
//Karyawan
Route::middleware('auth:sanctum')->prefix('admin')->group(function () {
    Route::get('/karyawan', [KaryawanController::class, 'index'])->name('admin.karyawan.index');
    Route::get('/karyawan/create', [KaryawanController::class, 'create'])->name('admin.karyawan.create');
    Route::post('/karyawan/store', [KaryawanController::class, 'store'])->name('admin.karyawan.store');
    Route::get('/karyawan/show', [KaryawanController::class, 'show'])->name('admin.karyawan.show');
    Route::get('/karyawan/{id}', [KaryawanController::class, 'edit'])->name('admin.karyawan.edit');
    Route::put('/karyawan/{id}', [KaryawanController::class, 'update'])->name('admin.karyawan.update');
    Route::get('/karyawan/ajax', [KaryawanController::class, 'ajax'])->name('admin.karyawan.ajax');
    Route::get('/getGajiPosisiById/{id}', [KaryawanController::class, 'getGajiPosisiById'])->name('getGajiPosisiById');
    Route::get('/get-nip-by-name/{name}', [KaryawanController::class, 'getNIPByName'])->name('getNIPByName');
    Route::get('/get-nip-by-id/{id}', [KaryawanController::class, 'getNIPById'])->name('getNIPById');
    Route::get('/karyawan/status-filter', [KaryawanController::class, 'StatusFilter'])->name('karyawan.status.filter');
    // Route::get('/karyawan/status-filter', [KaryawanController::class, 'StatusFilter'])->name('karyawan.status.filter');
});
// User
Route::get('/users', [UserController::class, 'index']); // Endpoint to fetch all users
// Route::get('/users/create', [UserController::class, 'create']); // Endpoint to get data for user creation (positions, users, etc.)
Route::post('/users/create', [UserController::class, 'store']); // Endpoint to create a new user



Route::middleware('auth:sanctum')->prefix('user')->group(function () {
    Route::get('/pengajuancuti', [CutiController::class, 'index'])->name('user.pengajuancuti.index');
    Route::get('/pengajuancuti/create', [CutiController::class, 'create'])->name('user.pengajuancuti.create');
    Route::post('/pengajuancuti/store', [CutiController::class, 'store'])->name('user.pengajuancuti.store');
    Route::get('/pengajuancuti/{id}', [CutiController::class, 'show'])->name('user.pengajuancuti.show');
    Route::put('/pengajuancuti/{id}/updateToDiterima', [CutiController::class, 'updateToDiterima'])->name('user.pengajuancuti.updateToDiterima');
    Route::put('/pengajuancuti/{id}/updateToDitolak', [CutiController::class, 'updateToDitolak'])->name('user.pengajuancuti.updateToDitolak');
});

