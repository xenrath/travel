<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Produk;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    public function list()
    {
        $produks = Produk::get();

        if ($produks) {
            return response()->json([
                'status' => TRUE,
                'message' => 'Berhasil menampilkan Produk',
                'produks' => $produks
            ]);
        } else {
            return $this->error('Produk tidak ditemukan!');
        }
    }

    public function detail($id)
    {
        $produk = Produk::where('id', $id)->first();

        if ($produk) {
            return response()->json([
                'status' => TRUE,
                'message' => 'Berhasil menampilkan Produk',
                'produk' => $produk
            ]);
        } else {
            return $this->error('Produk tidak ditemukan!');
        }
    }

    public function error($message)
    {
        return response()->json([
            'status' => FALSE,
            'message' => $message,
        ]);
    }
}
