<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Produk;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    public function list()
    {
        $produks = Produk::with('mobil')->get();

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

    public function error($message)
    {
        return response()->json([
            'status' => FALSE,
            'message' => $message,
        ]);
    }
}
