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
        <p class="mb-0">Riwayat Transaksi</p>
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
    <div class="p-3">
      <form method="GET" id="form-action">
        <div class="row">
          <div class="col-md-4 mb-3">
            <input class="form-control" id="tanggal_awal" name="tanggal_awal" type="date"
              value="{{ Request::get('tanggal_awal') }}" />
          </div>
          <div class="col-md-4 mb-3">
            <input class="form-control" id="tanggal_akhir" name="tanggal_akhir" type="date"
              value="{{ Request::get('tanggal_akhir') }}" />
          </div>
          <div class="col-md-4">
            <button type="button" class="btn btn-outline-primary me-2" onclick="cari()">
              <i class="fas fa-search"></i> Cari
            </button>
            <button type="button" class="btn btn-primary" onclick="print()" target="_blank">
              <i class="fas fa-print"></i> Print
              </a>
          </div>
        </div>
      </form>
    </div>
    <div class="table-responsive scrollbar">
      <table class="table table-bordered table-striped">
        <thead class="bg-200 text-900">
          <tr>
            <th class="text-center">No.</th>
            <th>Nama Pelanggan</th>
            <th>Mobil</th>
            <th>Kategori</th>
            <th>Pembayaran</th>
            <th>Tanggal</th>
          </tr>
        </thead>
        <tbody class="list">
          @forelse ($transaksis as $key => $transaksi)
          <tr>
            <th class="text-center">{{ $transaksis->firstItem() + $key }}</th>
            <th>{{ $transaksi->pelanggan->nama }}</th>
            <th>{{ $transaksi->produk->mobil->nama }}</th>
            {{-- <th>{{ date('d-m-Y', strtotime($transaksi->tanggal . '+ 5 days')) }}</th> --}}
            <th>
              @if ($transaksi->produk->kategori == 'rental')
              Rental
              @else
              Tour ({{ ucfirst($transaksi->produk->area) }} Kota)
              @endif
            </th>
            <th>{{ date('d M Y', strtotime($transaksi->tanggal)) }}</th>
            <th>
              <a href="{{ url('transaksi/riwayat/' . $transaksi->id) }}" class="btn btn-info btn-sm">
                <i class="fas fa-eye"></i> Lihat
              </a>
            </th>
          </tr>
          @empty
          <tr>
            <th colspan="6" class="text-center">- Data tidak ditemukan -</th>
          </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>
</div>
<script>
  var tanggalAwal = document.getElementById('tanggal_awal');
  var tanggalAkhir = document.getElementById('tanggal_akhir');
  if (tanggalAwal.value == "") {
    tanggalAkhir.readOnly = true;
  }
  tanggalAwal.addEventListener('change', function() {
    if (this.value == "") {
      tanggalAkhir.readOnly = true;
    } else {
      tanggalAkhir.readOnly = false;
    };
    tanggalAkhir.value = "";
    tanggalAkhir.setAttribute('min', this.value);
  });
  var form = document.getElementById('form-action')
  function cari() {
    form.action = "{{ url('transaksi/riwayat') }}";
    form.submit();
  }
  function print() {
    form.action = "{{ url('transaksi/print') }}";
    form.submit();
  }
</script>
@endsection