<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function user_login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'telp' => 'required',
            'password' => 'required',
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

    public function user_register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nik' => 'required|unique:users',
            'nama' => 'required',
            'telp' => 'required|unique:users',
            'gender' => 'required',
            'password' => 'required|min:6|confirmed',
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
                'message' => 'Pendaftaran berhasil, silahkan lakukan verifikasi terlebih dahulu',
                'user' => $user
            ]);
        } else {
            return $this->error('Pendaftaran gagal, ' + $validator->errors()->all()[0]);
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
