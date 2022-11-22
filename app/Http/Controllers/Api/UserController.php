<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'telp' => 'required',
            'password' => 'required',
        ], [
            'telp.required' => 'Nomor telepon tidak boleh kosong!',
            'password.required' => 'Password tidak boleh kosong!',
        ]);

        if ($validator->fails()) {
            $error = $validator->errors()->all();
            return $this->error($error[0]);
        }

        $telp = $request->telp;
        $password = $request->password;

        $user = User::where('telp', $telp)->first();
        if ($user) {
            if (password_verify($password, $user->password)) {
                return response()->json([
                    'status' => TRUE,
                    'message' => 'Selamat Datang ' . $user->name,
                    'user' => $user
                ]);
            } else {
                return $this->error('Nomor telepon dan password tidak sesuai!');
            }
        } else {
            return $this->error('Pengguna tidak ditemukan!');
        }
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nik' => 'required|min:16|unique:users',
            'nama' => 'required',
            'telp' => 'required|unique:users',
            'gender' => 'required',
            'password' => 'required|min:8|confirmed',
        ], [
            'nik.required' => 'NIK tidak boleh kosong!',
            'nik.min' => 'Masukan NIK dengan benar!',
            'nik.unique' => 'NIK sudah digunakan!',
            'nama.required' => 'Nama tidak boleh kosong!',
            'telp.required' => 'Nomor telepon tidak boleh kosong!',
            'telp.unique' => 'Nomor telepon sudah digunakan!',
            'gender.required' => 'Jenis kelamin harus dipilih!',
            'password.required' => 'Password tidak boleh kosong!',
            'password.min' => 'Password minimal 8 karakter!',
            'password.confirmed' => 'Konfirmasi password tidak sesuai!',
        ]);

        if ($validator->fails()) {
            $error = $validator->errors()->all();
            return $this->error($error[0]);
        }

        $user = User::create(array_merge($request->all(), [
            'password' => bcrypt($request->password)
        ]));

        if ($user) {
            return response()->json([
                'status' => TRUE,
                'message' => 'Pendaftaran berhasil',
                'user' => $user
            ]);
        } else {
            return $this->error('Pendaftaran gagal, ' + $validator->errors()->all()[0]);
        }
    }

    public function detail($id)
    {
        $user = User::where('id', $id)->first();

        if ($user) {
            return response()->json([
                'status' => TRUE,
                'message' => 'Berhasil menampilkan detail',
                'user' => $user
            ]);
        } else {
            return $this->error('Gagal menampilkan detail!');
        }
    }

    public function sopir()
    {
        $users = User::where([
            ['role', 'sopir'],
            ['status', true],
        ])->get();

        if ($users) {
            return response()->json([
                'status' => TRUE,
                'message' => 'Berhasil menampilkan sopir',
                'users' => $users
            ]);
        } else {
            return $this->error('Gagal menampilkan sopir!');
        }
    }

    public function error($message)
    {
        return response()->json([
            'status' => FALSE,
            'message' => $message,
        ]);
    }
}
