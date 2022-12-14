<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Cetak Peminjaman</title>
  <style>
    /* * {
      border: 1px solid black;
    } */
    .b {
      border: 1px solid black;
    }

    .table,
    .td {
      border: 1px solid black;
    }

    body {
      margin: 0;
      padding: 0;
    }

    span.h2 {
      font-size: 24px;
      font-weight: 500;
    }
  </style>
</head>
<body onload="window.print();">
  <table width="100%" cellspacing="0" cellpadding="0">
    <tr>
      <td>
        <h1>INVOICE</h1>
      </td>
      <td style="width: 50%; float: right;">
        <p style="font-weight: bold;">CV. JATIBARANG TRANS 354</p>
        <p>
          Jl. Pramuka Selatan RT 03 RW 05, Kel. Jatibarang Kidul, Kec. Jatibarang, Kab. Brebes
          <br>
          <u>jatibarangtrans@gmail.com</u>
        </p>
      </td>
    </tr>
  </table>
  <hr>
  <p style="text-align: right;">{{ Carbon\Carbon::now()->translatedFormat('l, d F Y') }}</p>
  <p style="font-weight: bold;">Detail Pelanggan</p>
  <table style="width: 100%;" cellpadding="10" cellspacing="0">
    <tr>
      <td class="td" width="120">Nama</td>
      <td class="td" style="text-align: center; width: 10px;">:</td>
      <td class="td">{{ $transaksi->pelanggan->nama }}</td>
    </tr>
    <tr>
      <td class="td" width="120">NIK</td>
      <td class="td" style="text-align: center; width: 10px;">:</td>
      <td class="td">{{ $transaksi->pelanggan->nik }}</td>
    </tr>
    <tr>
      <td class="td" width="120">No. Telepon</td>
      <td class="td" style="text-align: center; width: 10px;">:</td>
      <td class="td">+62{{ $transaksi->pelanggan->telp }}</td>
    </tr>
    <tr>
      <td class="td" width="120">Jenis Kelamin</td>
      <td class="td" style="text-align: center; width: 10px;">:</td>
      <td class="td">
        @if ($transaksi->pelanggan->gender == 'L')
        Laki-laki
        @else
        Perempuan
        @endif
      </td>
    </tr>
    <tr>
      <td class="td" width="120">Alamat</td>
      <td class="td" style="text-align: center; width: 10px;">:</td>
      <td class="td">{{ $transaksi->pelanggan->alamat }}</td>
    </tr>
  </table>
  <p style="font-weight: bold;">Detail Peminjaman</p>
  <table style="width: 100%;" cellpadding="10" cellspacing="0">
    <tr>
      <td class="td" width="120">Mobil (Plat)</td>
      <td class="td" style="text-align: center; width: 10px;">:</td>
      <td class="td">{{ $transaksi->produk->mobil->nama }} {{ $transaksi->produk->mobil->plat }}</td>
    </tr>
    <tr>
      <td class="td" width="120">Kategori</td>
      <td class="td" style="text-align: center; width: 10px;">:</td>
      <td class="td">{{ ucfirst($transaksi->produk->kategori) }}</td>
    </tr>
    <tr>
      <td class="td" width="120">Harga Sewa / hari</td>
      <td class="td" style="text-align: center; width: 10px;">:</td>
      <td class="td">@rupiah($transaksi->produk->sewa)</td>
    </tr>
    <tr>
      <td class="td" width="120">Tanggal Peminjaman</td>
      <td class="td" style="text-align: center; width: 10px;">:</td>
      <td class="td">NIK Pelanggan</td>
    </tr>
    <tr>
      <td class="td" width="120">Lama Peminjaman</td>
      <td class="td" style="text-align: center; width: 10px;">:</td>
      <td class="td">{{ $transaksi->lama }} Hari</td>
    </tr>
    <tr>
      <td class="td" width="120">Total Pembayaran</td>
      <td class="td" style="text-align: center; width: 10px;">:</td>
      <td class="td">@rupiah($transaksi->harga)</td>
    </tr>
    <tr>
      <td class="td" width="120">Metode Pembayaran</td>
      <td class="td" style="text-align: center; width: 10px;">:</td>
      <td class="td">{{ ucfirst($transaksi->metode) }}</td>
    </tr>
    @if ($transaksi->metode == 'transfer')
    <tr>
      <td class="td" width="120" style="vertical-align: top">Bukti Pembayaran</td>
      <td class="td" style="text-align: center; width: 10px; vertical-align: top">:</td>
      <td class="td">
        <img src="{{ asset('storage/uploads/' . $transaksi->produk->mobil->gambar) }}"
          alt="{{ $transaksi->produk->mobil->nama }}" style="height: 180px;">
      </td>
    </tr>
    @endif
  </table>
</body>
</html>