<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
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
            'latitude' => 'required',
            'longitude' => 'required',
            'alamat' => 'required',
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
            'latitude.required' => 'Masukan alamat dengan benar!',
            'longitude.required' => 'Masukan alamat dengan benar!',
            'alamat.required' => 'Masukan alamat dengan benar!',
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

    public function u_password(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'password' => 'required|min:6|confirmed'
        ], [
            'password.required' => 'Password tidak boleh kosong!',
            'password.min' => 'Password minimal 6 karakter!',
            'password.confirmed' => 'Konfirmasi password tidak sesuai!',
        ]);
        if ($validator->fails()) {
            $error = $validator->errors()->all();
            return $this->error($error[0]);
        }
        $user = User::where('id', $id)
            ->update([
                'password' => bcrypt($request->password)
            ]);
        if ($user) {
            return response()->json([
                'status' => TRUE,
                'message' => 'Password berhasil diperbarui',
            ]);
        } else {
            return $this->error('Password gagal diperbarui');
        }
    }

    public function u_profile(Request $request, $id)
    {
        $user = User::where('id', $id)->first();

        if ($user->foto) {
            $validator = Validator::make($request->all(), [
                'nik' => 'required|min:16|unique:users,nik,' . $id . ',id',
                'nama' => 'required',
                'telp' => 'required|unique:users,telp,' . $id . ',id',
                'gender' => 'required',
                'latitude' => 'required',
                'longitude' => 'required',
                'alamat' => 'required',
                'foto' => 'nullable|image|mimes:jpeg,jpg,png|max:2048'
            ], [
                'nik.required' => 'NIK tidak boleh kosong!',
                'nik.min' => 'Masukan NIK dengan benar!',
                'nik.unique' => 'NIK sudah digunakan!',
                'nama.required' => 'Nama tidak boleh kosong!',
                'telp.required' => 'Nomor telepon tidak boleh kosong!',
                'telp.unique' => 'Nomor telepon sudah digunakan!',
                'gender.required' => 'Jenis kelamin harus dipilih!',
                'latitude.required' => 'Masukan alamat dengan benar!',
                'longitude.required' => 'Masukan alamat dengan benar!',
                'alamat.required' => 'Masukan alamat dengan benar!',
                'foto.image' => 'Foto harus berformat jpeg, jpg, png!'
            ]);
        } else {
            $validator = Validator::make($request->all(), [
                'nik' => 'required|min:16|unique:users,nik,' . $id . ',id',
                'nama' => 'required',
                'telp' => 'required|unique:users,telp,' . $id . ',id',
                'gender' => 'required',
                'latitude' => 'required',
                'longitude' => 'required',
                'alamat' => 'required',
                'foto' => 'required|image|mimes:jpeg,jpg,png|max:2048'
            ], [
                'nik.required' => 'NIK tidak boleh kosong!',
                'nik.min' => 'Masukan NIK dengan benar!',
                'nik.unique' => 'NIK sudah digunakan!',
                'nama.required' => 'Nama tidak boleh kosong!',
                'telp.required' => 'Nomor telepon tidak boleh kosong!',
                'telp.unique' => 'Nomor telepon sudah digunakan!',
                'gender.required' => 'Jenis kelamin harus dipilih!',
                'latitude.required' => 'Masukan alamat dengan benar!',
                'longitude.required' => 'Masukan alamat dengan benar!',
                'alamat.required' => 'Masukan alamat dengan benar!',
                'foto.required' => 'Foto harus ditambahkan!',
                'foto.image' => 'Foto harus berformat jpeg, jpg, png!'
            ]);
        }

        if ($validator->fails()) {
            $error = $validator->errors()->all();
            return $this->error($error[0]);
        }

        if ($request->foto) {
            Storage::disk('local')->delete('public/uploads/' . $user->foto);
            $foto = str_replace(' ', '', $request->foto->getClientOriginalName());
            $namafoto = 'users/' . date('mYdHs') . rand(1, 10) . '_' . $foto;
            $request->foto->storeAs('public/uploads/', $namafoto);
        } else {
            $namafoto = $user->foto;
        }

        $user = User::where('id', $id)->update([
            'nik' => $request->nik,
            'nama' => $request->nama,
            'telp' => $request->telp,
            'gender' => $request->gender,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'alamat' => $request->alamat,
            'foto' => $namafoto
        ]);

        if ($user) {
            return response()->json([
                'status' => TRUE,
                'message' => 'Profile berhasil diperbarui'
            ]);
        } else {
            return $this->error('Profile gagal diperbarui');
        }
    }

    public function check_user(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nik' => 'required|min:16',
            'telp' => 'required',
        ], [
            'nik.required' => 'NIK tidak boleh kosong!',
            'nik.min' => 'Masukan NIK dengan benar!',
            'telp.required' => 'Nomor telepon tidak boleh kosong!',
        ]);

        if ($validator->fails()) {
            $error = $validator->errors()->all();
            return $this->error($error[0]);
        }

        $user = User::where([
            ['nik', $request->nik],
            ['telp', $request->telp]
        ])->first();

        if ($user) {
            return response()->json([
                'status' => TRUE,
                'message' => 'User ditemukan'
            ]);
        } else {
            return $this->error('User tidak ditemukan!');
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
