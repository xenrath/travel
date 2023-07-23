<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\Mobil;
use App\Models\Order;
use App\Models\Produk;
use App\Models\Transaksi;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Carbon\Carbon;
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

        return view('admin.transaksi.index', compact('produks'));
    }

    public function show($id)
    {
        $transaksi = Transaksi::where('id', $id)->with('produk')->first();

        // return response($transaksi);

        return view('admin.transaksi.show', compact('transaksi'));
    }

    public function menunggu()
    {
        $transaksis = Transaksi::where('status', 'menunggu')->orderBy('id', 'DESC')->paginate(10);
        $sopirs = User::where([
            ['role', 'sopir'],
            ['status', true]
        ])->get();

        return view('admin.transaksi.menunggu.index', compact('transaksis', 'sopirs'));
    }

    public function menunggu_detail($id)
    {
        $transaksi = Transaksi::where('id', $id)->with('produk')->first();

        return view('admin.transaksi.menunggu.detail', compact('transaksi'));
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

        if ($transaksi->metode == 'null') {
            $metode = 'cash';
        } else {
            $metode = $transaksi->metode;
        }

        Transaksi::where('id', $id)->update([
            'metode' => $metode,
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

        return view('admin.transaksi.proses.index', compact('transaksis'));
    }

    public function proses_detail($id)
    {
        $transaksi = Transaksi::where('id', $id)->with('produk')->first();

        return view('admin.transaksi.proses.detail', compact('transaksi'));
    }

    public function selesai($id)
    {
        $transaksi = Transaksi::where('id', $id)->first();

        $transaksi->update([
            'status' => 'selesai'
        ]);

        $produk = Produk::where('id', $transaksi->produk_id)->first();

        Mobil::where('id', $produk->mobil_id)->update([
            'status' => true
        ]);

        if ($produk->kategori == 'tour') {
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

        return view('admin.transaksi.riwayat.index', compact('transaksis'));
    }

    public function riwayat_detail($id)
    {
        $transaksi = Transaksi::where('id', $id)->with('produk')->first();

        return view('admin.transaksi.riwayat.detail', compact('transaksi'));
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

        $pdf = PDF::loadview('admin.transaksi.riwayat.cetak', compact('transaksis'));

        return $pdf->stream('Cetak PDF');
    }

    public function invoice()
    {
        $transaksi = Transaksi::where('id', '2')->first();
        $pdf = PDF::loadView('admin.transaksi.invoice', compact('transaksi'));

        return $pdf->stream('Cetak PDF');
    }
}