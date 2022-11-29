<?php

namespace App\Http\Controllers;

use App\Models\Mobil;
use App\Models\Produk;
use App\Models\Transaksi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BuatController extends Controller
{
    public function index()
    {
        $produks = Produk::whereHas('mobil', function ($query) {
            $query->where('status', true);
        })->paginate(10);

        return view('transaksi.buat.index', compact('produks'));
    }

    public function create($id)
    {
        $produk = Produk::where('id', $id)->first();
        $pelanggans = User::where('role', 'pelanggan')->get();
        $sopirs = User::where('role', 'sopir')->get();

        return view('transaksi.buat.create', compact('produk', 'pelanggans', 'sopirs'));
    }

    public function store(Request $request, $id)
    {
        $produk = Produk::where('id', $id)->first();

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
            return back()->withInput()->with('error', $error);
        }

        Transaksi::create(array_merge($request->all(), [
            'produk_id' => $produk->id,
            'metode' => 'cash',
            'status' => 'proses'
        ]));

        Mobil::where('id', $produk->mobil_id)->update([
            'status' => false
        ]);

        return redirect('buat')->with('success', 'Berhasil membuat Peminjaman');
    }
}
