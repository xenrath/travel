<?php

use App\Http\Controllers\HomeController;
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

Auth::routes();

Route::get('/', [HomeController::class, 'index']);

// Route::get('get-harga/{id}', [ProdukController::class, 'get_harga']);

Route::middleware('admin')->prefix('admin')->group(function () {
    Route::get('/', [\App\Http\Controllers\Admin\DashboardController::class, 'index']);
    Route::resource('profile', \App\Http\Controllers\Admin\ProfileController::class);
    Route::resource('admin', \App\Http\Controllers\Admin\AdminController::class);
    Route::resource('sopir', \App\Http\Controllers\Admin\SopirController::class);
    Route::resource('pelanggan', \App\Http\Controllers\Admin\PelangganController::class);
    Route::get('mobil/detail/{id}', [\App\Http\Controllers\Admin\MobilController::class, 'detail']);
    Route::resource('mobil', \App\Http\Controllers\Admin\MobilController::class);
    Route::get('produk/detail/{id}', [\App\Http\Controllers\Admin\ProdukController::class, 'detail']);
    Route::resource('produk', \App\Http\Controllers\Admin\ProdukController::class);
    Route::get('buat', [\App\Http\Controllers\Admin\BuatController::class, 'index']);
    Route::get('buat/create/{id}', [\App\Http\Controllers\Admin\BuatController::class, 'create']);
    Route::post('buat/store/{id}', [\App\Http\Controllers\Admin\BuatController::class, 'store']);
    Route::get('transaksi/menunggu', [\App\Http\Controllers\Admin\TransaksiController::class, 'menunggu']);
    Route::get('transaksi/menunggu/{id}', [\App\Http\Controllers\Admin\TransaksiController::class, 'menunggu_detail']);
    Route::post('transaksi/konfirmasi/{id}', [\App\Http\Controllers\Admin\TransaksiController::class, 'konfirmasi']);
    Route::get('transaksi/proses', [\App\Http\Controllers\Admin\TransaksiController::class, 'proses']);
    Route::get('transaksi/proses/{id}', [\App\Http\Controllers\Admin\TransaksiController::class, 'proses_detail']);
    Route::get('transaksi/selesai/{id}', [\App\Http\Controllers\Admin\TransaksiController::class, 'selesai']);
    Route::get('transaksi/riwayat', [\App\Http\Controllers\Admin\TransaksiController::class, 'riwayat']);
    Route::get('transaksi/riwayat/{id}', [\App\Http\Controllers\Admin\TransaksiController::class, 'riwayat_detail']);
    Route::get('transaksi/print', [\App\Http\Controllers\Admin\TransaksiController::class, 'print']);
    Route::get('transaksi/rekapexport', [\App\Http\Controllers\Admin\TransaksiController::class, 'rekapexport']);
    Route::get('invoice', [\App\Http\Controllers\Admin\TransaksiController::class, 'invoice']);
    Route::resource('transaksi', \App\Http\Controllers\Admin\TransaksiController::class);
    Route::resource('rekening', \App\Http\Controllers\Admin\RekeningController::class);
});

Route::middleware('owner')->prefix('owner')->group(function () {
    Route::get('/', [\App\Http\Controllers\Owner\DashboardController::class, 'index']);
    Route::get('transaksi/riwayat', [\App\Http\Controllers\Owner\TransaksiController::class, 'riwayat']);
    Route::get('transaksi/riwayat/{id}', [\App\Http\Controllers\Owner\TransaksiController::class, 'riwayat_detail']);
    Route::get('transaksi/print', [\App\Http\Controllers\Owner\TransaksiController::class, 'print']);
    Route::get('invoice', [\App\Http\Controllers\Owner\TransaksiController::class, 'invoice']);
});