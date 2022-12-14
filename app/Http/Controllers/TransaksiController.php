<?php

namespace App\Http\Controllers;

use App\Models\Mobil;
use App\Models\Order;
use App\Models\Produk;
use App\Models\Transaksi;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TransaksiController extends Controller
{
    public function index()
    {
        // $transaksis = Transaksi::where('status', 'proses')->paginate(10);

        $produks = Produk::whereHas('mobil', function ($query) {
            $query->where('status', true);
        })->paginate(10);

        return view('transaksi.index', compact('produks'));
    }

    public function create()
    {
        $pelanggans = User::where('role', 'pelanggan')->get();
        $produks = Produk::whereHas('mobil', function ($query) {
            $query->where('status', true);
        })->get();
        $sopirs = User::where([
            ['role', 'sopir'],
            ['status', true]
        ])->get();

        return view('transaksi.create', compact('pelanggans', 'produks', 'sopirs'));
    }

    public function store(Request $request)
    {
        $produk = Produk::where('id', $request->produk_id)->first();

        if ($produk && $produk->kategori == "tour") {
            $validator = Validator::make($request->all(), [
                'pelanggan_id' => 'required',
                'produk_id' => 'required',
                'sopir_id' => 'required',
                'tanggal' => 'required',
                'lama' => 'required'
            ], [
                'pelanggan_id.required' => 'Pelanggan harus dipilih!',
                'produk_id.required' => 'Mobil harus dipilih!',
                'sopir_id.required' => 'Sopir harus dipilih!',
                'tanggal.required' => 'Tanggal sewa harus diisi!',
                'lama.required' => 'Lama sewa harus diisi!',
            ]);
        } else {
            $validator = Validator::make($request->all(), [
                'pelanggan_id' => 'required',
                'produk_id' => 'required',
                'tanggal' => 'required',
                'lama' => 'required'
            ], [
                'pelanggan_id.required' => 'Pelanggan harus dipilih!',
                'produk_id.required' => 'Mobil harus dipilih!',
                'tanggal.required' => 'Tanggal sewa harus diisi!',
                'lama.required' => 'Lama sewa harus diisi!',
            ]);
        }

        if ($validator->fails()) {
            $error = $validator->errors()->all();
            return back()->withInput()->with('error', $error);
        }

        Transaksi::create(array_merge($request->all(), [
            'metode' => 'cash',
            'status' => 'proses'
        ]));

        $produk = Produk::where('id', $request->produk_id)->first();

        Mobil::where('id', $produk->mobil_id)->update([
            'status' => false
        ]);

        if ($request->sopir_id) {
            User::where('id', $request->sopir_id)->update([
                'status' => false
            ]);
        }

        return back()->with('success', 'Berhasil membuat Peminjaman');
    }

    public function show($id)
    {
        $transaksi = Transaksi::where('id', $id)->with('produk')->first();

        // return response($transaksi);

        return view('transaksi.show', compact('transaksi'));
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }

    public function menunggu()
    {
        $transaksis = Transaksi::where('status', 'menunggu')->orderBy('id', 'DESC')->paginate(10);
        $sopirs = User::where([
            ['role', 'sopir'],
            ['status', true]
        ])->get();

        return view('transaksi.menunggu.index', compact('transaksis', 'sopirs'));
    }

    public function menunggu_detail($id)
    {
        $transaksi = Transaksi::where('id', $id)->with('produk')->first();

        return view('transaksi.menunggu.detail', compact('transaksi'));
    }

    public function konfirmasi(Request $request, $id)
    {
        $transaksi = Transaksi::where('id', $id)->first();

        if ($transaksi->produk->kategori == 'tour') {
            $validator = Validator::make($request->all(), [
                'sopir_id' => 'required',
            ], [
                'sopir_id.required' => 'Sopir harus dipilih!',
            ]);

            if ($validator->fails()) {
                $error = $validator->errors()->all();
                return back()->withInput()->with('error', $error[0]);
            }
        }

        Transaksi::where('id', $id)->update([
            'status' => 'proses'
        ]);

        if ($transaksi->produk->kategori == 'tour') {
            Transaksi::where('id', $id)->update([
                'sopir_id' => $request->sopir_id
            ]);
            User::where('id', $request->sopir_id)->update([
                'status' => false
            ]);
        }

        return back()->with('success', 'Berhasil mengkonfirmasi Peminjaman');
    }

    public function proses()
    {
        $transaksis = Transaksi::where('status', 'proses')->orderBy('id', 'DESC')->paginate(10);

        return view('transaksi.proses.index', compact('transaksis'));
    }

    public function proses_detail($id)
    {
        $transaksi = Transaksi::where('id', $id)->with('produk')->first();

        return view('transaksi.proses.detail', compact('transaksi'));
    }

    public function selesai($id)
    {
        $transaksi = Transaksi::where('id', $id)->first();

        $transaksi->update([
            'status' => 'selesai'
        ]);

        $produk = Produk::where('id', $transaksi->produk_id)->first();

        if ($produk->kategori == 'tour') {
            Mobil::where('id', $produk->mobil_id)->update([
                'status' => true
            ]);
            User::where('id', $transaksi->sopir_id)->update([
                'status' => true
            ]);
        }

        return back()->with('success', 'Berhasil menyelesaikan Peminjaman');
    }

    public function riwayat(Request $request)
    {
        $tanggal_awal = $request->tanggal_awal;
        $tanggal_akhir = $request->tanggal_akhir;

        if ($tanggal_awal != "" && $tanggal_akhir != "") {
            $transaksis = Transaksi::where('status', 'selesai')
                ->whereDate('tanggal', '>=', $tanggal_awal)
                ->whereDate('tanggal', '<=', $tanggal_akhir)
                ->orderBy('id', 'DESC')->paginate(10);
        } else if ($tanggal_awal != "") {
            $transaksis = Transaksi::where('status', 'selesai')
                ->whereDate('tanggal', '>=', $tanggal_awal)
                ->orderBy('id', 'DESC')->paginate(10);
        } else {
            $transaksis = Transaksi::where('status', 'selesai')->orderBy('id', 'DESC')->paginate(10);
        }

        return view('transaksi.riwayat.index', compact('transaksis'));
    }

    public function riwayat_detail($id)
    {
        $transaksi = Transaksi::where('id', $id)->with('produk')->first();

        return view('transaksi.riwayat.detail', compact('transaksi'));
    }

    public function print(Request $request)
    {
        $tanggal_awal = $request->tanggal_awal;
        $tanggal_akhir = $request->tanggal_akhir;

        if ($tanggal_awal != "" && $tanggal_akhir != "") {
            $transaksis = Transaksi::where('status', 'selesai')
                ->whereDate('tanggal', '>=', $tanggal_awal)
                ->whereDate('tanggal', '<=', $tanggal_akhir)
                ->orderBy('id', 'DESC')->paginate(10);
        } else if ($tanggal_awal != "") {
            $transaksis = Transaksi::where('status', 'selesai')
                ->whereDate('tanggal', '>=', $tanggal_awal)
                ->orderBy('id', 'DESC')->paginate(10);
        } else {
            $transaksis = Transaksi::where('status', 'selesai')->orderBy('id', 'DESC')->paginate(10);
        }

        $pdf = PDF::loadview('transaksi.riwayat.cetak', compact('transaksis'));

        return $pdf->stream('Cetak PDF');
    }

    public function invoice()
    {
        $transaksi = Transaksi::where('id', '2')->first();
        $pdf = PDF::loadView('transaksi.invoice', compact('transaksi'));

        return $pdf->stream('Cetak PDF');
    }
}
