<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Rekening;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

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

        return view('admin.rekening.index', compact('rekenings'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.rekening.create');
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
            'bank' => 'required',
            'nama' => 'required',
            'nomor' => 'required|unique:rekenings',
            'gambar' => 'required|image|mimes:jpeg,jpg,png|max:2048',
        ], [
            'bank.required' => 'Bank tidak boleh kosong!',
            'nama.required' => 'Nama rekening tidak boleh kosong!',
            'nomor.required' => 'Nomor rekening tidak boleh kosong!',
            'nomor.unique' => 'Nomor rekening sudah digunakan!',
            'gambar.required' => 'Gambar tidak boleh kosong!',
            'gambar.image' => 'Gambar harus berformat jpeg, jpg, png!',
        ]);

        if ($validator->fails()) {
            $error = $validator->errors()->all();
            return back()->withInput()->with('status', $error);
        }

        $gambar = str_replace(' ', '', $request->gambar->getClientOriginalName());
        $namagambar = 'rekening/' . date('mYdHs') . rand(1, 10) . '_' . $gambar;
        $request->gambar->storeAs('public/uploads/', $namagambar);

        Rekening::create(array_merge($request->all(), [
            'gambar' => $namagambar
        ]));

        return redirect('admin/rekening')->with('status', 'Berhasil menambahkan Rekening');
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
        $rekening = Rekening::findOrFail($id);

        return view('admin.rekening.edit', compact('rekening'));
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
            'bank' => 'required',
            'nama' => 'required',
            'nomor' => 'required|unique:rekenings,nomor,' . $id,
            'gambar' => 'nullable|image|mimes:jpeg,jpg,png|max:2048',
        ], [
            'bank.required' => 'Bank tidak boleh kosong!',
            'nama.required' => 'Nama rekening tidak boleh kosong!',
            'nomor.required' => 'Nomor rekening tidak boleh kosong!',
            'nomor.unique' => 'Nomor rekening sudah digunakan!',
            'gambar.image' => 'Gambar harus berformat jpeg, jpg, png!',
        ]);

        if ($validator->fails()) {
            $error = $validator->errors()->all();
            return back()->withInput()->with('status', $error);
        }

        $rekening = Rekening::findOrFail($id);

        if ($request->gambar) {
            Storage::disk('local')->delete('public/uploads/' . $rekening->gambar);
            $gambar = str_replace(' ', '', $request->gambar->getClientOriginalName());
            $namagambar = 'rekening/' . date('mYdHs') . rand(1, 10) . '_' . $gambar;
            $request->gambar->storeAs('public/uploads/', $namagambar);
        } else {
            $namagambar = $rekening->gambar;
        }

        Rekening::where('id', $id)->update([
            'bank' => $request->bank,
            'nama' => $request->nama,
            'nomor' => $request->nomor,
            'gambar' => $namagambar,
        ]);

        return redirect('admin/rekening')->with('status', 'Berhasil memperbarui Rekening');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Merk  $merk
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $rekening = Rekening::findOrFail($id);

        Storage::disk('local')->delete('public/uploads/' . $rekening->foto);
        $rekening->delete();

        return back()->with('status', 'Berhasil menghapus Rekening');
    }
}