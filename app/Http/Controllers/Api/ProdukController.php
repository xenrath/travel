<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Produk;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    public function list()
    {
        $produks = Produk::whereHas('mobil', function ($query) {
            $query->where('status', true);
        })->with('mobil')->get();

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
        $produk = Produk::where('id', $id)->with('mobil')->first();

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

    public function search(Request $request)
    {
        $keyword = $request->keyword;
        $kategori = $request->kategori;

        if ($keyword != "" && $kategori != "") {
            $produks = Produk::whereHas('mobil', function ($query) use ($keyword) {
                $query->where([
                    ['status', true],
                    ['nama', 'like', "%$keyword%"],
                ]);
            })->where('kategori', $kategori)->with('mobil')->get();
        } else if ($keyword != "" && $kategori == "") {
            $produks = Produk::whereHas('mobil', function ($query) use ($keyword) {
                $query->where([
                    ['status', true],
                    ['nama', 'like', "%$keyword%"],
                ]);
            })->with('mobil')->get();
        } else if ($keyword == "" && $kategori != "") {
            $produks = Produk::whereHas('mobil', function ($query) {
                $query->where('status', true);
            })->where('kategori', $kategori)->with('mobil')->get();
        } else {
            $produks = Produk::whereHas('mobil', function ($query) {
                $query->where('status', true);
            })->with('mobil')->get();
        }

        if (count($produks)) {
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
