<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\PenjualController;
use App\Http\Controllers\Api\PelangganController;
use App\Http\Controllers\Api\LelangController;
use App\Http\Controllers\Api\TambahStokController;
use App\Http\Controllers\Api\ProdukController;
use App\Http\Controllers\Api\Auth\UserMobileController;
use App\Http\Controllers\Api\Auth\UserPenjualController;
use App\Http\Controllers\Api\Auth\UserPembeliController;

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

Route::middleware('auth:passport')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
Route::get('logout', [AuthController::class, 'logout']);

// Route::post('register', [AuthController::class, 'register_pembeli']);
// Route::post('login', [AuthController::class, 'login']);
// Route::get('logout', [AuthController::class, 'logout']);

Route::post('reg', [UserMobileController::class, 'register_penjual']);
Route::post('log', [UserMobileController::class, 'login']);

Route::post('regpenjual', [UserPenjualController::class, 'register_penjual']);
Route::post('logpenjual', [UserPenjualController::class, 'login_penjual']);
Route::get('datapenjual/{id}', [UserPenjualController::class, 'get_penjual']);

Route::post('regpembeli', [UserPembeliController::class, 'register_pembeli']);
Route::post('logpembeli', [UserPembeliController::class, 'login_pembeli']);



// Route::post('penjual', [PenjualController::class, 'register_penjual']);
// Route::post('loginpenjual', [PenjualController::class, 'login_penjual']);
// Route::get('logoutpenjual', [PenjualController::class, 'logout_penjual']);

// Route::get('penjual/{penjual}', [PenjualController::class, 'get']);
// Route::get('penjual', [PenjualController::class, 'get_all']);
// Route::delete('penjual/{penjual}', [PenjualController::class, 'delete']);
// Route::put('penjual/{penjual}', [PenjualController::class, 'update']);

// Route::post('pelanggan', [PelangganController::class, 'register_pelanggan']);
// Route::post('loginPelanggan', [PelangganController::class, 'login_pelanggan']);
// Route::get('logoutPelanggan', [PelangganController::class, 'logout_pelanggan']);
// Route::get('pelanggan/{pelanggan}', [PelangganController::class, 'get']);
// Route::get('pelanggan', [PelangganController::class, 'get_all']);
// Route::delete('pelanggan/{pelanggan}', [PelangganController::class, 'delete']);
// Route::put('pelanggan/{pelanggan}', [PelangganController::class, 'update']);

Route::post('produk', [ProdukController::class, 'tambah_produk']);
Route::post('getproduk', [ProdukController::class, 'tampil_produk']);
// Route::get('produk', [ProdukController::class, 'tampil_semua']);
Route::post('produk/edit', [ProdukController::class, 'edit_produk']);
Route::post('produk/update', [ProdukController::class, 'update_produk']);

Route::post('lelang', [LelangController::class, 'tambah_lelang']);
Route::get('lelang/{lang}', [LelangController::class, 'tampil_lelang']);
Route::get('lelang', [LelangController::class, 'tampil_semua']);

Route::post('tambah_stok', [TambahStokController::class, 'tambah_stok']);
Route::delete('hapus_stok/{hps_stok}', [TambahStokController::class, 'hapus_stok']);


