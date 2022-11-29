<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BuatController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MobilController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\PemesananController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\SopirController;
use App\Http\Controllers\TransaksiController;
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

Route::resource('admin', AdminController::class);
Route::resource('sopir', SopirController::class);
Route::resource('pelanggan', PelangganController::class);
Route::resource('mobil', MobilController::class);
Route::resource('produk', ProdukController::class);

Route::get('buat', [BuatController::class, 'index']);
Route::get('buat/create/{id}', [BuatController::class, 'create']);
Route::post('buat/store/{id}', [BuatController::class, 'store']);

Route::get('transaksi/menunggu', [TransaksiController::class, 'menunggu']);
Route::get('transaksi/konfirmasi/{id}', [TransaksiController::class, 'konfirmasi']);

Route::get('transaksi/proses', [TransaksiController::class, 'proses']);
Route::get('transaksi/selesai/{id}', [TransaksiController::class, 'selesai']);

Route::get('transaksi/riwayat', [TransaksiController::class, 'riwayat']);
Route::get('transaksi/print', [TransaksiController::class, 'print']);

Route::resource('transaksi', TransaksiController::class);

Route::get('get-harga/{id}', [ProdukController::class, 'get_harga']);