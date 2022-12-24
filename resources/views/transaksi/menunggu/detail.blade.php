@extends('layout.main')

@section('title', 'Lihat Transaksi')

@section('content')
<div class="card mb-3">
  <div class="bg-holder d-none d-lg-block bg-card"
    style="background-image:url({{ asset('falcon/public/assets/img/icons/spot-illustrations/corner-4.png') }});">
  </div>
  <!--/.bg-holder-->
  <div class="card-body position-relative">
    <div class="row">
      <div class="col-lg-8">
        <h3>Data Transaksi</h3>
        <p class="mb-0">Lihat</p>
      </div>
    </div>
  </div>
</div>
<div class="card">
  <div class="card-header">
    <h5>Lihat Transaksi</h5>
  </div>
  <div class="card-body">
    <div class="row">
      <div class="col-md-5">
        @if ($transaksi->produk->mobil->gambar)
        <img src="{{ asset('storage/uploads/' . $transaksi->produk->mobil->gambar) }}"
          alt="{{ $transaksi->produk->mobil->nama }}" class="w-100 rounded border">
        @else
        <img src="{{ asset('falcon/public/assets/img/img-placeholder.jpg') }}"
          alt="{{ $transaksi->produk->mobil->nama }}" class="w-100 rounded border">
        @endif
      </div>
      <div class="col-md-7">
        <table class="w-100">
          <tr height="50">
            <td>
              <h5 class="fs-0">Nama Pelanggan</h5>
            </td>
            <td>
              <h5 class="fs-0">:</h5>
            </td>
            <td class="text-end">
              <h5 class="fs-0">{{ $transaksi->pelanggan->nama }}</h5>
            </td>
          </tr>
          <tr height="50">
            <td>
              <h5 class="fs-0">Mobil</h5>
            </td>
            <td>
              <h5 class="fs-0">:</h5>
            </td>
            <td class="text-end">
              <h5 class="fs-0">{{ $transaksi->produk->mobil->nama }}</h5>
            </td>
          </tr>
          <tr height="50">
            <td>
              <h5 class="fs-0">Kategori (Area)</h5>
            </td>
            <td>
              <h5 class="fs-0">:</h5>
            </td>
            <td class="text-end">
              <h5 class="fs-0">
                @if ($transaksi->produk->kategori == 'rental')
                Rental
                @else
                Tour ({{ ucfirst($transaksi->produk->area) }} Kota)
                @endif
              </h5>
            </td>
          </tr>
          @if ($transaksi->produk->kategori == 'tour')
          <tr height="50">
            <td>
              <h5 class="fs-0">Nama Sopir</h5>
            </td>
            <td>
              <h5 class="fs-0">:</h5>
            </td>
            <td class="text-end">
              <h5 class="fs-0">{{ $transaksi->sopir->nama }}</h5>
            </td>
          </tr>
          @endif
          <tr height="50">
            <td>
              <h5 class="fs-0">Tanggal Peminjaman</h5>
            </td>
            <td>
              <h5 class="fs-0">:</h5>
            </td>
            <td class="text-end">
              <h5 class="fs-0">{{ date('d M Y', strtotime($transaksi->tanggal)) }}</h5>
            </td>
          </tr>
          <tr height="50">
            <td>
              <h5 class="fs-0">Lama Peminjaman</h5>
            </td>
            <td>
              <h5 class="fs-0">:</h5>
            </td>
            <td class="text-end">
              <h5 class="fs-0">{{ $transaksi->lama }} Hari</h5>
            </td>
          </tr>
          <tr height="50">
            <td>
              <h5 class="fs-0">Metode Pembayaran</h5>
            </td>
            <td>
              <h5 class="fs-0">:</h5>
            </td>
            <td class="text-end">
              <h5 class="fs-0">{{ ucfirst($transaksi->metode) }}</h5>
            </td>
          </tr>
          @if ($transaksi->metode == 'transfer')
          <tr height="50">
            <td>
              <h5 class="fs-0">Bukti Transfer</h5>
            </td>
            <td>
              <h5 class="fs-0">:</h5>
            </td>
            <td class="text-end">
              <h5 class="fs-0">
                <button class="btn btn-outline-info btn-sm" type="button" data-bs-toggle="modal"
                  data-bs-target="#modalBukti">Lihat Bukti</button>
              </h5>
            </td>
          </tr>
          @endif
        </table>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="modalBukti" data-bs-keyboard="false" data-bs-backdrop="static" tabindex="-1"
  aria-hidden="true">
  <div class="modal-dialog mt-6" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="scrollinglongcontentLabel">Bukti Transfer</h5>
        <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body p-0">
        <div class="bg-light rounded-top-lg text-center p-3">
          <img src="{{ asset('storage/uploads/' . $transaksi->bukti) }}" alt="{{ $transaksi->pelanggan->nama }}"
            class="w-100 rounded border">
        </div>
      </div>
      <div class="modal-footer">
        <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Tutup</button>
      </div>
    </div>
  </div>
</div>
@endsection