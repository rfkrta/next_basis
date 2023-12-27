<?php

use App\Http\Controllers\API\Admin\AbsenController;
use App\Http\Controllers\API\Admin\BiayaDinasController;
use App\Http\Controllers\API\Admin\BiayaPerbandinganController;
use App\Http\Controllers\Api\Admin\BiayaRealisasiController;
use App\Http\Controllers\API\Admin\BiayaRealisasiDinasController;
use App\Http\Controllers\API\Admin\CutiController;
use App\Http\Controllers\API\Admin\DinasController;
use App\Http\Controllers\API\Admin\MitraController;
use App\Http\Controllers\API\Admin\RegencyController;
use App\Http\Controllers\API\Auth\AuthController;
use App\Http\Controllers\API\Auth\UserController;
use App\Models\BiayaRealisasi;
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

Route::middleware('auth:sanctum')->prefix('user')->group(function () {
    // Rute untuk memperbarui pengguna berdasarkan ID
    Route::put('/users/{user_id}', [UserController::class, 'update']);
    Route::get('/getuser', [UserController::class, 'showUsersWithRoleId']);
    Route::get('/users/{user_id}', [UserController::class, 'getUserById']);
});
// Pengajuan Cuti
Route::middleware('auth:sanctum')->prefix('user')->group(function () {
    Route::get('/cuti/{userId}', [CutiController::class, 'getCutiByUserId']);
    Route::post('/cuti/{user_id}', [CutiController::class, 'store']);
    Route::put('/cuti/{user_id}/{cuti_id}', [CutiController::class, 'updateByUserIdAndCutiId']);
});
//Dinas
Route::middleware('auth:sanctum')->prefix('user')->group(function () {
    Route::get('/perjalanandinas', [DinasController::class, 'index'])->name('dinas.index');
    Route::post('/perjalanandinas/{user_id}', [DinasController::class, 'store'])->name('dinas.store');
    Route::get('/perjalanandinas/{user_id}', [DinasController::class, 'getDinasByUserId']);
});
//BiayaDinas
Route::middleware('auth:sanctum')->prefix('user')->group(function () {
    Route::post('/biayarealisasi/{userId}', [BiayaRealisasiDinasController::class, 'store']);
    Route::post('/biayaperbandingan/{perjalananDinasId}', [BiayaPerbandinganController::class, 'storePerbandinganDifferences']);
    Route::get('/biayaperbandingan/{perjalananDinasId}', [BiayaPerbandinganController::class, 'getBiayaPerbandingan']);
    Route::get('biayadinas/{perjalanan_dinas_id}', [BiayaDinasController::class, 'getBiayaDinasByPerjalananDinasId']);
    Route::get('/biayarealisasi/{perjalanan_dinas_id}', [BiayaRealisasiDinasController::class, 'getBiayaRealisasi']);
});
//Mitra
Route::middleware('auth:sanctum')->prefix('user')->group(function () {
    Route::get('/mitra', [MitraController::class, 'getMitra']);
    Route::get('regencies/getByName', [RegencyController::class, 'getByName']);
    Route::get('/regencies/search', [RegencyController::class, 'search']);
});
// Absensi
Route::middleware('auth:sanctum')->prefix('user')->group(function () {
    Route::post('absensi/{user_id}', [AbsenController::class, 'store']);
    Route::get('/absensi/{user_id}', [AbsenController::class, 'getAbsensiByUserId']);
    Route::get('/regencies/getByFirstName', [RegencyController::class, 'getByFirstName']);
    Route::get('/regencies/searchByName', [RegencyController::class, 'searchByName']);
});
