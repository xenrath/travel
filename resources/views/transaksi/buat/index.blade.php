@extends('layout.main')

@section('title', 'Buat Pemesanan')

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
            <th>Nama Mobil (Plat)</th>
            <th>Kategori (Area)</th>
            <th>Harga Sewa / hari</th>
            <th>Gambar</th>
            <th class="text-center">Opsi</th>
          </tr>
        </thead>
        <tbody class="list">
          @forelse ($produks as $key => $produk)
          <tr>
            <th class="text-center">{{ $produks->firstItem() + $key }}</th>
            <th>{{ $produk->mobil->nama }} ({{ $produk->mobil->plat }})</th>
            <th>
              @if ($produk->kategori == 'rental')
              Rental
              @else
              Travel ({{ ucfirst($produk->area) }})
              @endif
            </th>
            <th>@rupiah($produk->sewa)</th>
            <th>
              <img src="{{ asset('storage/uploads/' . $produk->mobil->gambar) }}" alt="{{ $produk->mobil->nama }}" width="160"
                class="rounded">
            </th>
            <th class="text-center">
              <a href="{{ url('buat/create/' . $produk->id) }}" class="btn btn-primary btn-sm">
                <i class="fas fa-check"></i> Pilih
              </a>
            </th>
          </tr>
          @empty
          <tr>
            <td colspan="5" class="text-center">- Data tidak ditemukan -</td>
          </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>
</div>
@endsection