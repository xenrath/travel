@extends('layout.main')

@section('title', 'Data Pemesanan')

@section('content')
<div class="card mb-3">
  <div class="bg-holder d-none d-lg-block bg-card"
    style="background-image:url({{ asset('falcon/public/assets/img/icons/spot-illustrations/corner-4.png') }});">
  </div>
  <!--/.bg-holder-->
  <div class="card-body position-relative">
    <div class="row">
      <div class="col-lg-8">
        <h3>Data Pemesanan</h3>
        <p class="mb-0">Tabel</p>
      </div>
    </div>
  </div>
</div>
@if (session('success'))
<div class="alert alert-success border-2 d-flex align-items-center" role="alert">
  <div class="bg-success me-3 icon-item">
    <span class="fas fa-check-circle text-white fs-3"></span>
  </div>
  <p class="mb-0 flex-1">{{ session('success') }}</p>
  <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif
<div class="card">
  <div class="card-header">
    <h5 class="float-start">Tabel Pemesanan</h5>
  </div>
  <div class="card-body p-0">
    <div class="table-responsive scrollbar">
      <table class="table table-bordered table-striped">
        <thead class="bg-200 text-900">
          <tr>
            <th class="text-center">No.</th>
            <th>Nama Pelanggan</th>
            <th>Mobil</th>
            <th>Kategori</th>
            <th>Metode Pembayaran</th>
            <th class="text-center">Opsi</th>
          </tr>
        </thead>
        <tbody class="list">
          @foreach ($transaksis as $key => $transaksi)
          <tr>
            <th class="text-center">{{ $transaksis->firstItem() + $key }}</th>
            <th>{{ $transaksi->pelanggan->nama }}</th>
            <th>{{ $transaksi->produk->nama }}</th>
            {{-- <th>{{ date('d-m-Y', strtotime($transaksi->tanggal . '+ 5 days')) }}</th> --}}
            <th>{{ ucfirst($transaksi->kategori) }}</th>
            <th>{{ ucfirst($transaksi->metode) }}</th>
            <th class="text-center">
              <a href="{{ url('show') }}" class="btn btn-info btn-sm">
                <i class="fas fa-eye"></i> Lihat
              </a>
              <a href="{{ url('show') }}" class="btn btn-secondary btn-sm">
                <i class="fas fa-eye"></i> Perpanjang
              </a>
            </th>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>
@endsection