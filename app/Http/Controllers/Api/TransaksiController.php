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
            'waktu' => 'required',
            'lama' => 'required'
        ], [
            'pelanggan_id.required' => 'Pelanggan harus dipilih!',
            'produk_id.required' => 'Produk harus dipilih!',
            'waktu.required' => 'Waktu sewa harus diisi!',
            'lama.required' => 'Lama sewa harus diisi!',
        ]);

        if ($validator->fails()) {
            $error = $validator->errors()->all();
            return $this->error($error[0]);
        }

        $tanggal = date('Y-m-d', strtotime('+' . $request->waktu . ' days'));

        return response($tanggal);

        $transaksi = Transaksi::create(array_merge($request->all(), [
            'metode' => 'null',
            'tanggal' => $tanggal,
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
            ['metode', 'null'],
            ['status', 'menunggu'],
        ])->with('produk.mobil', 'pelanggan', 'sopir')->get();

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
        $upload = $transaksi->update([
            'metode' => 'transfer',
            'bukti' => $namabukti
        ]);

        if ($upload) {
            $produk = Produk::where('id', $transaksi->first()->produk_id)->first();
            return response()->json([
                'status' => true,
                'message' => 'Berhasil membayar transaksi',
            ]);
        } else {
            return $this->error('Gagal membayar transaksi!');
        }
    }


    public function sudahbayar($id)
    {
        $transaksis = Transaksi::where([
            ['pelanggan_id', $id],
            ['status', 'proses'],
        ])->with('produk.mobil', 'pelanggan', 'sopir')->get();

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

    public function selesai($id)
    {
        $transaksis = Transaksi::where([
            ['pelanggan_id', $id],
            ['status', 'selesai'],
        ])->with('produk.mobil', 'pelanggan', 'sopir')->get();

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
        $transaksi = Transaksi::where('id', $id)->with('produk.mobil', 'pelanggan', 'sopir')->first();

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

    public function invoice($id)
    {
        $transaksi = Transaksi::where('id', $id)->first();

        return view('transaksi.invoice', compact('transaksi'));
    }

    public function error($message)
    {
        return response()->json([
            'status' => FALSE,
            'message' => $message,
        ]);
    }
}
