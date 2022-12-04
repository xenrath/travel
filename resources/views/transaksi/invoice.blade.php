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
        <h1>Invoice</h1>
      </td>
      <td style="width: 40%; float: right;">
        <p style="font-weight: bold;">Rental Mobil Anam</p>
        <p>Jalan Raya limbangan brebes no. 45</p>
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
      <td class="td">Nama Pelanggan</td>
    </tr>
    <tr>
      <td class="td" width="120">NIK</td>
      <td class="td" style="text-align: center; width: 10px;">:</td>
      <td class="td">NIK Pelanggan</td>
    </tr>
    <tr>
      <td class="td" width="120">No. Telepon</td>
      <td class="td" style="text-align: center; width: 10px;">:</td>
      <td class="td">83012938920</td>
    </tr>
    <tr>
      <td class="td" width="120">Jenis Kelamin</td>
      <td class="td" style="text-align: center; width: 10px;">:</td>
      <td class="td">NIK Pelanggan</td>
    </tr>
    <tr>
      <td class="td" width="120">Alamat</td>
      <td class="td" style="text-align: center; width: 10px;">:</td>
      <td class="td">NIK Pelanggan</td>
    </tr>
  </table>
  <p style="font-weight: bold;">Detail Peminjaman</p>
  <table style="width: 100%;" cellpadding="10" cellspacing="0">
    <tr>
      <td class="td" width="120">Mobil (Plat)</td>
      <td class="td" style="text-align: center; width: 10px;">:</td>
      <td class="td">Nama Pelanggan</td>
    </tr>
    <tr>
      <td class="td" width="120">Kategori</td>
      <td class="td" style="text-align: center; width: 10px;">:</td>
      <td class="td">NIK Pelanggan</td>
    </tr>
    <tr>
      <td class="td" width="120">Harga Sewa / hari</td>
      <td class="td" style="text-align: center; width: 10px;">:</td>
      <td class="td">10000000</td>
    </tr>
    <tr>
      <td class="td" width="120">Tanggal Peminjaman</td>
      <td class="td" style="text-align: center; width: 10px;">:</td>
      <td class="td">NIK Pelanggan</td>
    </tr>
    <tr>
      <td class="td" width="120">Lama Peminjaman</td>
      <td class="td" style="text-align: center; width: 10px;">:</td>
      <td class="td">NIK Pelanggan</td>
    </tr>
    <tr>
      <td class="td" width="120">Total Pembayaran</td>
      <td class="td" style="text-align: center; width: 10px;">:</td>
      <td class="td">Total Pembayaran</td>
    </tr>
    <tr>
      <td class="td" width="120">Metode Pembayaran</td>
      <td class="td" style="text-align: center; width: 10px;">:</td>
      <td class="td">NIK Pelanggan</td>
    </tr>
  </table>
</body>
</html>