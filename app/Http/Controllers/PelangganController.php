<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class PelangganController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::where('role', 'pelanggan')->get();

        return view('user.pelanggan.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.pelanggan.create');
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
            'nik' => 'required|unique:users|min:16',
            'nama' => 'required',
            'telp' => 'required|unique:users|min:10',
            'gender' => 'required',
            'foto' => 'nullable|image|mimes:jpeg,jpg,png|max:2048',
        ], [
            'nik.required' => 'NIK tidak boleh kosong!',
            'nik.unique' => 'NIK sudah digunakan!',
            'nik.min' => 'NIK yang dimasukan salah!',
            'nama.required' => 'Nama pelanggan tidak boleh kosong!',
            'telp.required' => 'Nomor telepon tidak boleh kosong!',
            'telp.min' => 'Nomor telepon yang dimasukan salah!',
            'gender.required' => 'Jenis kelamin harus dipilih!',
            'gambar.image' => 'Gambar harus berformat jpeg, jpg, png!',
        ]);

        if ($validator->fails()) {
            $error = $validator->errors()->all();
            return back()->withInput()->with('status', $error);
        }

        if ($request->gambar) {
            $gambar = str_replace(' ', '', $request->gambar->getClientOriginalName());
            $namagambar = 'user/' . date('mYdHs') . rand(1, 10) . '_' . $gambar;
            $request->gambar->storeAs('public/uploads/', $namagambar);
        } else {
            $namagambar = "";
        }

        User::create(array_merge($request->all(), [
            'password' => bcrypt($request->nik),
            'role' => 'pelanggan',
            'gambar' => $namagambar,
        ]));

        return redirect('pelanggan')->with('status', 'Berhasil menambahkan pelanggan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::findOrFail($id);

        return view('user.pelanggan.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);

        return view('user.pelanggan.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nik' => 'required|unique:users,nik,' . $id . '|min:16',
            'nama' => 'required',
            'telp' => 'required|unique:users,telp,' . $id . '|min:10',
            'gender' => 'required',
            'foto' => 'nullable|image|mimes:jpeg,jpg,png|max:2048',
        ], [
            'nik.required' => 'NIK tidak boleh kosong!',
            'nik.unique' => 'NIK sudah digunakan!',
            'nik.min' => 'NIK yang dimasukan salah!',
            'nama.required' => 'Nama pelanggan tidak boleh kosong!',
            'telp.required' => 'Nomor telepon tidak boleh kosong!',
            'telp.min' => 'Nomor telepon yang dimasukan salah!',
            'gender.required' => 'Jenis kelamin harus dipilih!',
            'foto.image' => 'Foto harus berformat jpeg, jpg, png!',
        ]);

        if ($validator->fails()) {
            $error = $validator->errors()->all();
            return back()->withInput()->with('status', $error);
        }

        $user = User::findOrFail($id);

        if ($request->foto) {
            Storage::disk('local')->delete('public/uploads/' . $user->foto);
            $foto = str_replace(' ', '', $request->foto->getClientOriginalName());
            $namafoto = 'user/' . date('mYdHs') . rand(1, 10) . '_' . $foto;
            $request->foto->storeAs('public/uploads/', $namafoto);
        } else {
            $namafoto = $user->foto;
        }

        User::where('id', $id)->update([
            'nik' => $request->nik,
            'nama' => $request->nama,
            'password' => bcrypt($request->nik),
            'telp' => $request->telp,
            'gender' => $request->gender,
            'foto' => $namafoto,
        ]);

        return redirect('pelanggan')->with('status', 'Berhasil memperbarui pelanggan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);

        Storage::disk('local')->delete('public/uploads/' . $user->foto);
        $user->delete();

        return back()->with('status', 'Berhasil menghapus pelanggan');
    }
}
