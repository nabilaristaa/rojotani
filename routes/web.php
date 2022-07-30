<?php

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
    return view('welcome');
});

Auth::routes();


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::prefix('admin')->middleware(['auth','isAdmin'])->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index']);

    //Data Pegawai (userdata Web)

    Route::get('userdata', [App\Http\Controllers\UserdataController::class, 'index']);

    Route::get('add-userdata', [App\Http\Controllers\UserdataController::class, 'create']);

    Route::post('add-userdata', [App\Http\Controllers\UserdataController::class, 'store']);

    Route::get('edit-userdata/{userdata_id}', [App\Http\Controllers\UserdataController::class, 'edit']);

    Route::put('update-userdata/{userdata_id}', [App\Http\Controllers\UserdataController::class, 'update']);

    Route::get('delete-userdata/{userdata_id}', [App\Http\Controllers\UserdataController::class, 'destroy']);


    //Data Pelanggan RojoTani

    Route::get('datapembeli', [App\Http\Controllers\PembeliController::class, 'index']);

    Route::get('edit-datapembeli/{userpembeli_id}', [App\Http\Controllers\PembeliController::class, 'edit_userpembeli']);

    Route::put('update-datapembeli/{userpembeli_id}', [App\Http\Controllers\PembeliController::class, 'update_userpembeli']);

    Route::get('delete-datapembeli/{userpembeli_id}', [App\Http\Controllers\PembeliController::class, 'delete_userpembeli']);


    //Data Pemilik Komoditas penjual)
    Route::get('datapenjual', [App\Http\Controllers\PenjualController::class, 'index']);

    Route::get('edit-datapenjual/{userpenjual_id}', [App\Http\Controllers\PenjualController::class, 'edit_userpenjual']);

    Route::put('update-datapenjual/{userpenjual_id}', [App\Http\Controllers\PenjualController::class, 'update_userpenjual']);

    Route::get('delete-datapenjual/{userpenjual_id}', [App\Http\Controllers\PenjualController::class, 'delete_userpenjual']);





    Route::get('pembayaran', [App\Http\Controllers\PembayaranController::class, 'index']);

    Route::get('pesanan', [App\Http\Controllers\PesananController::class, 'index']);

    Route::get('laporan', [App\Http\Controllers\LaporanController::class, 'index']);

    Route::get('produklelang', [App\Http\Controllers\ProdukLelangController::class, 'index']);

    Route::get('produk', [App\Http\Controllers\ProdukController::class, 'index']);

});

