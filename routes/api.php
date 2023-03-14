<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\AnggotaController;
use App\Http\Controllers\PeminjamanController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('buku',[BukuController::class,'insert_buku']);
Route::get('buku',[BukuController::class,'get_buku']);
Route::delete('buku/{kode_buku}',[BukuController::class,'delete_buku']);
Route::put('buku/{kode_buku}',[BukuController::class,'update_buku']);

Route::post('anggota/store', [AnggotaController::class, 'store']);
Route::get('anggota/all', [AnggotaController::class, 'index']);
Route::get('anggota{nik_anggota}', [AnggotaController::class, 'showById']);
Route::put('anggota/update/{nik_anggota}', [AnggotaController::class, 'update']);
Route::delete('anggota/delete/{nik_anggota}',[AnggotaController::class,'destroy']);

Route::post('peminjaman/store',[PeminjamanController::class,'store']);
Route::get('peminjaman/index',[PeminjamanController::class,'index']);
Route::put('peminjaman/update_status/{id_peminjaman}',[PeminjamanController::class,'update_status']);
