<?php

namespace App\Http\Controllers;

use App\Models\Mobil;
use App\Models\Order;
use App\Models\Produk;
use App\Models\Transaksi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TransaksiController extends Controller
{
    public function index()
    {
        $transaksis = Transaksi::where('status', 'proses')->paginate(10);

        return view('transaksi.index', compact('transaksis'));
    }

    public function create()
    {
        $pelanggans = User::where('role', 'pelanggan')->get();
        $produks = Produk::where('status', true)->get();
        $sopirs = User::where('role', 'sopir')->get();

        return view('transaksi.create', compact('pelanggans', 'produks', 'sopirs'));
    }

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
            return back()->withInput()->with('error', $error);
        }

        if ($request->kategori == "travel") {
            $validator = Validator::make($request->all(), [
                'sopir_id' => 'required',
                'area' => 'required',
            ], [
                'sopir_id.required' => 'Sopir harus dipilih!',
                'area.required' => 'Area harus diisi!',
            ]);

            if ($validator->fails()) {
                $error = $validator->errors()->all();
                return back()->withInput()->with('error', $error);
            }
        }

        Transaksi::create(array_merge($request->all(), [
            'metode' => 'cash',
            'status' => 'proses'
        ]));

        Produk::where('id', $request->produk_id)->update([
            'status' => false
        ]);

        return back()->with('success', 'Berhasil membuat Peminjaman');
    }

    public function show($id)
    {
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
