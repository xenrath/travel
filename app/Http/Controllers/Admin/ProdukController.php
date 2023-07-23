<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Mobil;
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
        })->paginate(6);

        return view('admin.produk.index', compact('produks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $mobils = Mobil::get();

        return view('admin.produk.create', compact('mobils'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->kategori == "tour") {
            $validator = Validator::make($request->all(), [
                'mobil_id' => 'required',
                'kategori' => 'required',
                'area' => 'required',
                'sewa' => 'required',
            ], [
                'mobil_id.required' => 'Mobil harus dipilih!',
                'kategori.required' => 'Kategori harus dipilih!',
                'area.required' => 'Area harus dipilih!',
                'sewa.required' => 'Harga sewa harus diisi!',
            ]);
        } else {
            $validator = Validator::make($request->all(), [
                'mobil_id' => 'required',
                'kategori' => 'required',
                'sewa' => 'required',
            ], [
                'mobil_id.required' => 'Mobil harus dipilih!',
                'kategori.required' => 'Kategori harus dipilih!',
                'sewa.required' => 'Harga sewa harus diisi!',
            ]);
        }

        if ($validator->fails()) {
            $error = $validator->errors()->all();
            return back()->withInput()->with('status', $error);
        }

        Produk::create($request->all());

        return redirect('admin/produk')->with('status', 'Berhasil menambahkan Produk');
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

        return view('admin.produk.edit', compact('produk'));
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
        if ($request->kategori == "tour") {
            $validator = Validator::make($request->all(), [
                'kategori' => 'required',
                'area' => 'required',
                'sewa' => 'required',
            ], [
                'kategori.required' => 'Kategori harus dipilih!',
                'area.required' => 'Area harus dipilih!',
                'sewa.required' => 'Harga sewa harus diisi!',
            ]);
        } else {
            $validator = Validator::make($request->all(), [
                'kategori' => 'required',
                'sewa' => 'required',
            ], [
                'kategori.required' => 'Kategori harus dipilih!',
                'sewa.required' => 'Harga sewa harus diisi!',
            ]);
        }

        if ($validator->fails()) {
            $error = $validator->errors()->all();
            return back()->withInput()->with('status', $error);
        }

        if ($request->kategori == "tour") {
            $area = $request->area;
        } else {
            $area = null;
        }

        Produk::where('id', $id)->update([
            'kategori' => $request->kategori,
            'area' => $area,
            'sewa' => $request->sewa,
        ]);

        return redirect('admin/produk')->with('status', 'Berhasil memperbarui Produk');
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