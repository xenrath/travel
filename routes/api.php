<?php

use App\Http\Controllers\Api\ProdukController;
use App\Http\Controllers\Api\RekeningController;
use App\Http\Controllers\Api\TransaksiController;
use App\Http\Controllers\Api\UserController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('login', [UserController::class, 'login']);
Route::post('register', [UserController::class, 'register']);
Route::get('user-detail/{id}', [UserController::class, 'detail']);
Route::get('user-sopir', [UserController::class, 'sopir']);
Route::post('user/u_password/{id}', [UserController::class, 'u_password']);
Route::post('user/u_profile/{id}', [UserController::class, 'u_profile']);

Route::get('produk-list', [ProdukController::class, 'list']);
Route::get('produk-detail/{id}', [ProdukController::class, 'detail']);
Route::post('produk-search', [ProdukController::class, 'search']);

Route::post('transaksi-store', [TransaksiController::class, 'store']);
Route::get('transaksi-belumbayar/{id}', [TransaksiController::class, 'belumbayar']);
Route::get('transaksi-sudahbayar/{id}', [TransaksiController::class, 'sudahbayar']);
Route::get('transaksi-selesai/{id}', [TransaksiController::class, 'selesai']);
Route::get('transaksi-detail/{id}', [TransaksiController::class, 'detail']);
Route::post('transaksi-upload/{id}', [TransaksiController::class, 'upload']);
Route::get('transaksi-invoice/{id}', [TransaksiController::class, 'invoice']);

Route::get('rekening-list', [RekeningController::class, 'list']);