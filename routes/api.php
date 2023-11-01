<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\siswacontroller;
use App\Http\Controllers\kelascontroller;
use App\Http\Controllers\bukucontroller;
use App\Http\Controllers\transaksicontroller;

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
Route::get('/getsiswa',[siswacontroller::class,'getsiswa']);
Route::post('/addsiswa',[siswacontroller::class,'addsiswa']);
Route::put('/updatesiswa/{id}',[siswacontroller::class,'updatesiswa']);
Route::delete('/deletesiswa/{id}',[siswacontroller::class,'deletesiswa']);
//buku
Route::get('/getbuku',[bukucontroller::class,'getbuku']);
Route::post('/addbuku',[bukucontroller::class,'addbuku']);
Route::put('/updatebuku/{id}',[bukucontroller::class,'updatebuku']);
Route::delete('/deletebuku/{id}',[bukucontroller::class,'deletebuku']);
//kelas
Route::get('/getkelas',[kelascontroller::class,'getkelas']);
Route::post('/addkelas',[kelascontroller::class,'addkelas']);
Route::put('/updatekelas/{id}',[kelascontroller::class,'updatekelas']);
Route::delete('/deletekelas/{id}',[kelascontroller::class,'deletekelas']);
//transaksi
Route::post('/pinjambuku',[transaksicontroller::class,'pinjambuku']);
Route::post('/tambahitem/{id}',[transaksicontroller::class,'tambahitem']);
Route::post('/mengembalikanbuku/{id}',[transaksicontroller::class,'mengembalikanbuku']);