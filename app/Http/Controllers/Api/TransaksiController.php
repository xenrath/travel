<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Mobil;
use App\Models\Produk;
use App\Models\Transaksi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TransaksiController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'pelanggan_id' => 'required',
            'produk_id' => 'required',
            'tanggal' => 'required',
            'lama' => 'required'
        ], [
            'pelanggan_id.required' => 'Pelanggan harus dipilih!',
            'produk_id.required' => 'Produk harus dipilih!',
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
            return response()->json([
                'status' => true,
                'message' => 'Berhasil membuat Peminjaman',
            ]);
        } else {
            $this->error('Gagal membuat Peminjaman!');
        }
    }

    public function belumbayar($id)
    {
        $transaksis = Transaksi::where([
            ['pelanggan_id', $id],
            ['metode', 'transfer'],
            ['bukti', null]
        ])->get();

        if (count($transaksis) > 0) {
            return response()->json([
                'status' => true,
                'message' => 'Berhasil menampilkan transaksi',
                'transaksis' => $transaksis
            ]);
        } else {
            return $this->error('Gagal menampilkan transaksi!');
        }
    }

    public function sudahbayar($id)
    {
        $transaksis = Transaksi::where([
            ['pelanggan_id', $id],
            ['metode', 'transfer'],
            ['bukti', '!=', null]
        ])->get();

        if (count($transaksis) > 0) {
            return response()->json([
                'status' => true,
                'message' => 'Berhasil menampilkan transaksi',
                'transaksis' => $transaksis
            ]);
        } else {
            return $this->error('Gagal menampilkan transaksi!');
        }
    }

    public function detail($id)
    {
        $transaksi = Transaksi::where('id', $id)->first();

        if ($transaksi) {
            return response()->json([
                'status' => true,
                'message' => 'Berhasil menampilkan transaksi',
                'transaksi' => $transaksi
            ]);
        } else {
            return $this->error('Gagal menampilkan transaksi!');
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

        $transaksi = Transaksi::where('id', $id);
        $transaksi->update([
            'bukti' => $namabukti
        ]);

        if ($transaksi) {
            $produk = Produk::where('id', $transaksi->first()->produk_id)->first();
            Mobil::where('id', $produk->mobil_id)->update([
                'status' => true
            ]);
            return response()->json([
                'status' => true,
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
