<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $produks = Produk::whereHas('mobil', function ($query) {
            $query->orderBy('status', 'DESC');
        })->paginate(10);

        return view('produk.index', compact('produks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('produk.create');
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
            'nama' => 'required',
            'tahun' => 'required',
            'plat' => 'required|unique:produks',
            'warna' => 'required',
            'kapasitas' => 'required',
            'fasilitas' => 'required',
            'gambar' => 'required|image|mimes:jpeg,jpg,png|max:2048',
            'sewa' => 'required',
        ], [
            'nama.required' => 'Nama mobil tidak boleh kosong!',
            'tahun.required' => 'Tahun keluaran tidak boleh kosong!',
            'plat.required' => 'Plat tidak boleh kosong!',
            'plat.unique' => 'PLat sudah digunakan!',
            'warna.required' => 'Warna tidak boleh kosong!',
            'kapasitas.required' => 'Kapasitas tidak boleh kosong!',
            'fasilitas.required' => 'Fasilitas tidak boleh kosong!',
            'gambar.required' => 'Gambar tidak boleh kosong!',
            'gambar.image' => 'Gambar harus berformat jpeg, jpg, png!',
            'sewa.required' => 'Harga sewa tidak boleh kosong!',
        ]);

        if ($validator->fails()) {
            $error = $validator->errors()->all();
            return back()->withInput()->with('status', $error);
        }

        if ($request->gambar) {
            $gambar = str_replace(' ', '', $request->gambar->getClientOriginalName());
            $namagambar = 'produk/' . date('mYdHs') . rand(1, 10) . '_' . $gambar;
            $request->gambar->storeAs('public/uploads/', $namagambar);
        } else {
            $namagambar = "";
        }

        Produk::create($request->all(), [
            'gambar' => $namagambar
        ]);

        return redirect('produk')->with('status', 'Berhasil menambahkan Produk');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Merk  $merk
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Merk  $merk
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $produk = Produk::findOrFail($id);

        return view('produk.edit', compact('produk'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Merk  $merk
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required',
            'tahun' => 'required',
            'plat' => 'required|unique:produks',
            'warna' => 'required',
            'kapasitas' => 'required',
            'fasilitas' => 'required',
            'gambar' => 'nullable|image|mimes:jpeg,jpg,png|max:2048',
            'sewa' => 'required',
        ], [
            'nama.required' => 'Nama mobil tidak boleh kosong!',
            'tahun.required' => 'Tahun keluaran tidak boleh kosong!',
            'plat.required' => 'Plat tidak boleh kosong!',
            'plat.unique' => 'PLat sudah digunakan!',
            'warna.required' => 'Warna tidak boleh kosong!',
            'kapasitas.required' => 'Kapasitas tidak boleh kosong!',
            'fasilitas.required' => 'Fasilitas tidak boleh kosong!',
            'gambar.image' => 'Gambar harus berformat jpeg, jpg, png!',
            'sewa.required' => 'Harga sewa tidak boleh kosong!',
        ]);

        if ($validator->fails()) {
            $error = $validator->errors()->all();
            return back()->withInput()->with('status', $error);
        }

        $produk = Produk::findOrFail($id);

        if ($request->gambar) {
            Storage::disk('local')->delete('public/uploads/' . $produk->gambar);
            $gambar = str_replace(' ', '', $request->gambar->getClientOriginalName());
            $namagambar = 'produk/' . date('mYdHs') . rand(1, 10) . '_' . $gambar;
            $request->gambar->storeAs('public/uploads/', $namagambar);
        } else {
            $namagambar = $produk->gambar;
        }

        Produk::where('id', $id)->update([
            'nama' => $request->nama,
            'tahun' => $request->tahun,
            'plat' => $request->plat,
            'warna' => $request->warna,
            'kapasitas' => $request->kapasitas,
            'fasilitas' => $request->fasilitas,
            'gambar' => $namagambar,
            'sewa' => $request->sewa,
        ]);

        return redirect('produk')->with('status', 'Berhasil memperbarui Produk');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Merk  $merk
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $produk = Produk::findOrFail($id);

        Storage::disk('local')->delete('public/uploads/' . $produk->foto);
        $produk->delete();

        return back()->with('status', 'Berhasil menghapus Produk');
    }

    public function detail($id)
    {
        $produk = Produk::where('id', $id)->with('mobil')->first();
        return json_encode($produk);
    }

    public function get_harga($id)
    {
        $harga = Produk::where('id', $id)->pluck('sewa')->first();

        return $harga;
    }
}
