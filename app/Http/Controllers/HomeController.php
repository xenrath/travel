<?php

namespace App\Http\Controllers;

use App\Models\Mobil;
use App\Models\Produk;
use App\Models\Transaksi;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        if (auth()->user()->isAdmin()) {
            return redirect('admin');
        } elseif (auth()->user()->isOwner()) {
            return redirect('owner');
        }
        
        $admin = User::where('role', 'admin')->get();
        $sopir = User::where('role', 'sopir')->get();
        $pelanggan = User::where('role', 'pelanggan')->get();
        $mobil = Mobil::get();
        $produk = Produk::get();
        $menunggu = Transaksi::where('status', 'menunggu')->get();
        $proses = Transaksi::where('status', 'proses')->get();
        $selesai = Transaksi::where('status', 'selesai')->get();

        return view('home', compact(
            'admin',
            'sopir',
            'pelanggan',
            'mobil',
            'produk',
            'menunggu',
            'proses',
            'selesai'
        ));
    }
}
