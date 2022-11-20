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
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $transaksis = Transaksi::where('status', 'proses')->paginate(10);

        return view('transaksi.index', compact('transaksis'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pelanggans = User::where('role', 'pelanggan')->get();
        $produks = Produk::where('status', true)->get();
        $sopirs = User::where('role', 'sopir')->get();

        return view('transaksi.create', compact('pelanggans', 'produks', 'sopirs'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
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
                'tujuan' => 'required',
            ], [
                'sopir_id.required' => 'Sopir harus dipilih!',
                'tujuan.required' => 'Tempat tujuan harus diisi!',
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

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
