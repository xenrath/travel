<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Produk;
use App\Models\Transaksi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TransaksiController extends Controller
{
    public function store(Request $request)
    {
        $produk = Produk::where('id', $request->produk_id)->first();
        
        if ($produk->kategori == "tour") {
            $validator = Validator::make($request->all(), [
                'pelanggan_id' => 'required',
                'sopir_id' => 'required',
                'tanggal' => 'required',
                'lama' => 'required'
            ], [
                'pelanggan_id.required' => 'Pelanggan harus dipilih!',
                'sopir_id.required' => 'Sopir harus dipilih!',
                'tanggal.required' => 'Tanggal sewa harus diisi!',
                'lama.required' => 'Lama sewa harus diisi!',
            ]);
        } else {
            $validator = Validator::make($request->all(), [
                'pelanggan_id' => 'required',
                'tanggal' => 'required',
                'lama' => 'required'
            ], [
                'pelanggan_id.required' => 'Pelanggan harus dipilih!',
                'tanggal.required' => 'Tanggal sewa harus diisi!',
                'lama.required' => 'Lama sewa harus diisi!',
            ]);
        }

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
            User::where('id', $request->sopir_id)->update([
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

    public function upload(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'bukti' => 'required|image|mimes:jpeg,jpg,png'
        ], [
            'bukti.required' => 'Bukti pembayaran harus diisi!'
        ]);

        if ($validator->fails()) {
            $error = $validator->errors()->all();
            return $this->error($error[0]);
        }

        $bukti = str_replace(' ', '', $request->bukti->getClientOriginalName());
        $namabukti = 'bukti/' . date('mYdHs') . rand(1, 10) . '_' . $bukti;
        $request->bukti->storeAs('public/uploads/', $namabukti);

        $transaksi = Transaksi::where('id', $id)->update([
            'bukti' => $namabukti
        ]);

        if ($transaksi) {
            return response()->json([
                'status' => TRUE,
                'message' => 'Berhasil membayar transaksi',
            ]);
        } else {
            return $this->error('Gagal membayar transaksi!');
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
