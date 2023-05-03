<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    public function index()
    {
        $user = User::where('id', auth()->user()->id)->first();
        return view('profile.index', compact('user'));
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required',
            'telp' => 'required|unique:users,telp,' . auth()->user()->id . ',id',
            'password' => 'nullable|confirmed',
            'foto' => 'nullable|image|mimes:jpeg,jpg,png|max:2048',
        ], [
            'nama.required' => 'Nama tidak boleh kosong!',
            'telp.required' => 'Username tidak boleh kosong!',
            'telp.unique' => 'Username sudah digunakan!',
            'password.required' => 'Password tidak boleh kosong!',
            'password.confirmed' => 'Konfirmasi Password tidak sesuai!',
            'gambar.image' => 'Gambar harus berformat jpeg, jpg, png!',
        ]);

        if ($validator->fails()) {
            $error = $validator->errors()->all();
            return back()->withInput()->with('error', $error);
        }

        $user = User::findOrFail(auth()->user()->id);

        if ($request->foto) {
            Storage::disk('local')->delete('public/uploads/' . $user->foto);
            $foto = str_replace(' ', '', $request->foto->getClientOriginalName());
            $namafoto = 'user/' . date('mYdHs') . rand(1, 10) . '_' . $foto;
            $request->foto->storeAs('public/uploads/', $namafoto);
        } else {
            $namafoto = $user->foto;
        }

        User::where('id', auth()->user()->id)->update([
            'nama' => $request->nama,
            'telp' => $request->telp,
            'password' => bcrypt($request->password),
            'foto' => $namafoto,
        ]);

        return back()->with('success', 'Berhasil memperbarui profile');
    }
}
