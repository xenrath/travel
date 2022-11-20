<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Mobil;
use App\Models\Produk;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TransaksiController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'pelanggan_id' => 'required',
            'produk_id' => 'required',
            'kategori' => 'required',
            'tanggal' => 'required',
            'lama' => 'required'
        ], [
            'pelanggan_id.required' => 'Pelanggan harus dipilih!',
            'produk_id.required' => 'Mobil harus dipilih!',
            'kategori.required' => 'Kategori harus dipilih!',
            'tanggal.required' => 'Tanggal sewa harus diisi!',
            'lama.required' => 'Lama sewa harus diisi!',
        ]);

        if ($validator->fails()) {
            $error = $validator->errors()->all();
            return $this->error($error[0]);
        }

        $transaksi = Transaksi::create(array_merge($request->all(), [
            'metode' => 'transfer',
            'status' => 'menunggu'
        ]));

        if ($transaksi) {
            Produk::where('id', $request->produk_id)->update([
                'status' => false
            ]);
            return response()->json([
                'status' => TRUE,
                'message' => 'Berhasil membuat Peminjaman',
            ]);
        } else {
            $this->error('Gagal membuat Peminjaman!');
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
