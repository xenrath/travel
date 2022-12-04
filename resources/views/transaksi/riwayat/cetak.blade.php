<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Cetak Peminjaman</title>
  <style>
    body {
      padding: 0px 24px
    }

    .table-1 .td-1,
    .th-1 {
      border: 1px solid black;
    }

    .td-1 {
      text-align: left;
    }

    * {
      font-family: 'Times New Roman', Times, serif;
      /* border: 1px solid black; */
    }

    .text-center {
      text-align: center
    }

    .text-header {
      font-size: 18px;
      font-weight: 500;
    }
  </style>
</head>
<body>
  <h3 style="text-align: center">
    <u>CETAK PEMINJAMAN</u>
  </h3>
  <br>
  <table style="width: 100%;" class="table-1" cellspacing="0" cellpadding="8">
    <tr>
      <th class="th-1">No.</th>
      <th class="th-1" style="text-align: left">Tanggal</th>
      <th class="th-1" style="text-align: left">Nama Pelanggan</th>
      <th class="th-1" style="text-align: left">Mobil</th>
      <th class="th-1" style="text-align: left">Kategori</th>
    </tr>
    @foreach ($transaksis as $transaksi)
    <tr>
      <td class="td-1 text-center">{{ $loop->iteration }}</td>
      <td class="td-1">{{ date('d M Y', strtotime($transaksi->tanggal)) }}</td>
      <td class="td-1">{{ $transaksi->pelanggan->nama }}</td>
      <td class="td-1">{{ $transaksi->produk->mobil->nama }}</td>
      <td class="td-1">{{ ucfirst($transaksi->produk->kategori) }}</td>
    </tr>
    @endforeach
  </table>
</body>
</html>