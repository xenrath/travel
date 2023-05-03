<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::where('role', 'admin')->get();

        return view('user.admin.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.admin.create');
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
            'telp' => 'required|unique:users',
            'password' => 'required',
            'foto' => 'nullable|image|mimes:jpeg,jpg,png|max:2048',
        ], [
            'nama.required' => 'Nama tidak boleh kosong!',
            'telp.required' => 'Username tidak boleh kosong!',
            'telp.unique' => 'Username sudah digunakan!',
            'password.required' => 'Password tidak boleh kosong!',
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
            'password' => bcrypt($request->password),
            'role' => 'admin',
            'gambar' => $namagambar,
        ]));

        return redirect('admin')->with('status', 'Berhasil menambahkan admin');
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

        return view('user.admin.show', compact('user'));
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

        return view('user.admin.edit', compact('user'));
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
            'nama' => 'required',
            'telp' => 'required|unique:users,telp,' . auth()->user()->id . ',id',
            'password' => 'nullable',
            'foto' => 'nullable|image|mimes:jpeg,jpg,png|max:2048',
        ], [
            'nama.required' => 'Nama tidak boleh kosong!',
            'telp.required' => 'Username tidak boleh kosong!',
            'telp.unique' => 'Username sudah digunakan!',
            'password.required' => 'Password tidak boleh kosong!',
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

        return redirect('admin')->with('status', 'Berhasil memperbarui admin');
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

        return back()->with('status', 'Berhasil menghapus admin');
    }
}
