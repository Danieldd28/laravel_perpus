<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\siswaController;
use App\Http\Controllers\kelasController;
use App\Http\Controllers\bukuController;
use App\Http\Controllers\transaksiController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
//siswa
Route::get('/getsiswa',[siswaController::class,'getsiswa']);
Route::post('/addsiswa',[siswaController::class,'addsiswa']);
Route::put('/updatesiswa/{id}',[siswaController::class,'updatesiswa']);
Route::delete('/deletesiswa/{id}',[siswaController::class,'deletesiswa']);
//buku
Route::get('/getbuku',[bukuController::class,'getbuku']);
Route::post('/addbuku',[bukuController::class,'addbuku']);
Route::put('/updatebuku/{id}',[bukuController::class,'updatebuku']);
Route::delete('/deletebuku/{id}',[bukuController::class,'deletebuku']);
//kelas
Route::get('/getkelas',[kelasController::class,'getkelas']);
Route::post('/addkelas',[kelasController::class,'addkelas']);
Route::put('/updatekelas/{id}',[kelasController::class,'updatekelas']);
Route::delete('/deletekelas/{id}',[kelasController::class,'deletekelas']);
//transaksi
Route::post('/pinjamBuku',[transaksiController::class,'pinjamBuku']);
Route::post('/tambahItem/{id}',[transaksiController::class,'tambahItem']);
Route::post('/mengembalikanBuku/{id}',[transaksiController::class,'mengembalikanBuku']);