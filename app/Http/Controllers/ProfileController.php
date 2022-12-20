<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    public function index()
    {
        return view('profile.index');
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required',
            'alamat' => 'required',
            'telp' => 'required|unique:profiles|min:10',
            'gender' => 'required',
            'foto' => 'nullable|image|mimes:jpeg,jpg,png|max:2048',
        ], [
            'nik.required' => 'NIK tidak boleh kosong!',
            'nik.unique' => 'NIK sudah digunakan!',
            'nik.min' => 'NIK yang dimasukan salah!',
            'nama.required' => 'Nama sopir tidak boleh kosong!',
            'telp.required' => 'Nomor telepon tidak boleh kosong!',
            'telp.min' => 'Nomor telepon yang dimasukan salah!',
            'gender.required' => 'Jenis kelamin harus dipilih!',
            'gambar.image' => 'Gambar harus berformat jpeg, jpg, png!',
        ]);

        if ($validator->fails()) {
            $error = $validator->errors()->all();
            return back()->withInput()->with('status', $error);
        }
    }
}
