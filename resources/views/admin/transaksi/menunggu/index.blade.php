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
        <p class="mb-0">Menunggu Konfirmasi</p>
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
@if (session('error'))
<div class="alert alert-danger border-2 d-flex align-items-center" role="alert">
  <div class="bg-danger me-3 icon-item"><span class="fas fa-times-circle text-white fs-3"></span></div>
  <p class="mb-0 flex-1">{{ session('error') }}</p>
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
            <th>Pembayaran</th>
            <th class="text-center">Opsi</th>
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
            <th>
              @if ($transaksi->metode != 'null')
              {{ ucfirst($transaksi->metode) }}
              @if ($transaksi->metode == 'cash')
              <i class="fas fa-money-bill-wave"></i>
              @else
              <i class="far fa-credit-card"></i>
              @endif
              @else
              Belum bayar <i class="fas fa-times-circle"></i>
              @endif
            </th>
            <th class="text-center">
              <a href="{{ url('admin/transaksi/menunggu/' . $transaksi->id) }}" class="btn btn-info btn-sm">
                <i class="fas fa-eye"></i> Lihat
              </a>
              <a href="" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                data-bs-target="#modalKonfirmasi{{ $transaksi->id }}">
                <i class="fas fa-check-circle"></i> Konfirmasi
              </a>
              <div class="modal fade" id="modalKonfirmasi{{ $transaksi->id }}" data-bs-keyboard="false"
                data-bs-backdrop="static" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                  <div class="modal-content border-0">
                    <div class="position-absolute top-0 end-0 mt-3 me-3 z-index-1">
                      <button class="btn-close btn btn-sm btn-circle d-flex flex-center transition-base"
                        data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ url('admin/transaksi/konfirmasi/' . $transaksi->id) }}" method="post">
                      @csrf
                      <div class="modal-body p-0">
                        <div class="bg-light rounded-top-lg py-3 px-4 text-start">
                          <h4 class="mb-3">Konfirmasi</h4>
                          <h5 class="fs-0 fw-normal mb-3">Yakin konfirmasi peminjaman dari
                            <strong>{{ $transaksi->pelanggan->nama }}?</strong>
                          </h5>
                          @if ($transaksi->produk->kategori == 'tour')
                          <label class="form-label" for="sopir_id">Pilih Sopir *</label>
                          <select class="form-select" id="sopir_id" name="sopir_id">
                            <option value="">- Pilih -</option>
                            @foreach ($sopirs as $sopir)
                            <option value="{{ $sopir->id }}">{{ $sopir->nama }}</option>
                            @endforeach
                          </select>
                          @endif
                        </div>
                      </div>
                      <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Batal</button>
                        <button class="btn btn-primary" type="submit">Konfirmasi</a>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
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
@endsection