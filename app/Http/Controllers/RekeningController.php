<?php

namespace App\Http\Controllers;

use App\Models\Rekening;
use Illuminate\Http\Request;

class RekeningController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rekenings = Rekening::get();

        return view('rekening.index', compact('rekenings'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('mobil.create');
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
            'plat' => 'required|unique:mobils',
            'warna' => 'required',
            'kapasitas' => 'required',
            'fasilitas' => 'required',
            'gambar' => 'required|image|mimes:jpeg,jpg,png|max:2048',
        ], [
            'nama.required' => 'Nama mobil tidak boleh kosong!',
            'tahun.required' => 'Tahun keluaran tidak boleh kosong!',
            'plat.required' => 'Plat tidak boleh kosong!',
            'plat.unique' => 'Plat sudah digunakan!',
            'warna.required' => 'Warna tidak boleh kosong!',
            'kapasitas.required' => 'Kapasitas tidak boleh kosong!',
            'fasilitas.required' => 'Fasilitas tidak boleh kosong!',
            'gambar.required' => 'Gambar tidak boleh kosong!',
            'gambar.image' => 'Gambar harus berformat jpeg, jpg, png!',
        ]);

        if ($validator->fails()) {
            $error = $validator->errors()->all();
            return back()->withInput()->with('status', $error);
        }

        $gambar = str_replace(' ', '', $request->gambar->getClientOriginalName());
        $namagambar = 'mobil/' . date('mYdHs') . rand(1, 10) . '_' . $gambar;
        $request->gambar->storeAs('public/uploads/', $namagambar);

        Mobil::create(array_merge($request->all(), [
            'gambar' => $namagambar
        ]));

        return redirect('mobil')->with('status', 'Berhasil menambahkan Mobil');
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
        $mobil = Mobil::findOrFail($id);

        return view('mobil.edit', compact('mobil'));
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
            'plat' => 'required|unique:mobils,plat,' . $id . ',id',
            'warna' => 'required',
            'kapasitas' => 'required',
            'fasilitas' => 'required',
            'gambar' => 'nullable|image|mimes:jpeg,jpg,png|max:2048',
        ], [
            'nama.required' => 'Nama mobil tidak boleh kosong!',
            'tahun.required' => 'Tahun keluaran tidak boleh kosong!',
            'plat.required' => 'Plat tidak boleh kosong!',
            'plat.unique' => 'Plat sudah digunakan!',
            'warna.required' => 'Warna tidak boleh kosong!',
            'kapasitas.required' => 'Kapasitas tidak boleh kosong!',
            'fasilitas.required' => 'Fasilitas tidak boleh kosong!',
            'gambar.image' => 'Gambar harus berformat jpeg, jpg, png!',
        ]);

        if ($validator->fails()) {
            $error = $validator->errors()->all();
            return back()->withInput()->with('status', $error);
        }

        $mobil = Mobil::findOrFail($id);

        if ($request->gambar) {
            Storage::disk('local')->delete('public/uploads/' . $mobil->gambar);
            $gambar = str_replace(' ', '', $request->gambar->getClientOriginalName());
            $namagambar = 'mobil/' . date('mYdHs') . rand(1, 10) . '_' . $gambar;
            $request->gambar->storeAs('public/uploads/', $namagambar);
        } else {
            $namagambar = $mobil->gambar;
        }

        Mobil::where('id', $id)->update([
            'nama' => $request->nama,
            'tahun' => $request->tahun,
            'plat' => $request->plat,
            'warna' => $request->warna,
            'kapasitas' => $request->kapasitas,
            'fasilitas' => $request->fasilitas,
            'gambar' => $namagambar,
        ]);

        return redirect('mobil')->with('status', 'Berhasil memperbarui Mobil');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Merk  $merk
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $mobil = Mobil::findOrFail($id);

        Storage::disk('local')->delete('public/uploads/' . $mobil->foto);
        $mobil->delete();

        return back()->with('status', 'Berhasil menghapus Mobil');
    }
}
