@extends('layout.main')

@section('title', 'Data Admin')

@section('content')
<h5 class="mb-3">Menu User</h5>
<div class="row g-3 mb-3">
  <div class="col-sm-6 col-md-4">
    <div class="card overflow-hidden" style="min-width: 12rem">
      <div class="bg-holder bg-card" style="background-image:url(assets/img/icons/spot-illustrations/corner-1.png);">
      </div>
      <!--/.bg-holder-->
      <div class="card-body position-relative">
        <h6>Admin</h6>
        <div class="display-4 fs-4 mb-2 fw-normal font-sans-serif text-warning"
          data-countup='{"endValue":{{ count($admin) }},"suffix":" data"}'>0</div>
        <a class="fw-semi-bold fs--1 text-nowrap" href="{{ url('admin') }}">Lihat Data
          <span class="fas fa-angle-right ms-1" data-fa-transform="down-1"></span>
        </a>
      </div>
    </div>
  </div>
  <div class="col-sm-6 col-md-4">
    <div class="card overflow-hidden" style="min-width: 12rem">
      <div class="bg-holder bg-card" style="background-image:url(assets/img/icons/spot-illustrations/corner-1.png);">
      </div>
      <!--/.bg-holder-->
      <div class="card-body position-relative">
        <h6>Sopir</h6>
        <div class="display-4 fs-4 mb-2 fw-normal font-sans-serif text-warning"
          data-countup='{"endValue":{{ count($sopir) }},"suffix":" data"}'>0</div>
        <a class="fw-semi-bold fs--1 text-nowrap" href="{{ url('sopir') }}">Lihat Data
          <span class="fas fa-angle-right ms-1" data-fa-transform="down-1"></span>
        </a>
      </div>
    </div>
  </div>
  <div class="col-sm-6 col-md-4">
    <div class="card overflow-hidden" style="min-width: 12rem">
      <div class="bg-holder bg-card" style="background-image:url(assets/img/icons/spot-illustrations/corner-1.png);">
      </div>
      <!--/.bg-holder-->
      <div class="card-body position-relative">
        <h6>Pelanggan</h6>
        <div class="display-4 fs-4 mb-2 fw-normal font-sans-serif text-warning"
          data-countup='{"endValue":{{ count($pelanggan) }},"suffix":" data"}'>0</div>
        <a class="fw-semi-bold fs--1 text-nowrap" href="{{ url('pelanggan') }}">Lihat Data
          <span class="fas fa-angle-right ms-1" data-fa-transform="down-1"></span>
        </a>
      </div>
    </div>
  </div>
</div>
<h5 class="mb-3">Menu Produk</h5>
<div class="row g-3 mb-3">
  <div class="col-sm-6 col-md-4">
    <div class="card overflow-hidden" style="min-width: 12rem">
      <div class="bg-holder bg-card" style="background-image:url(assets/img/icons/spot-illustrations/corner-1.png);">
      </div>
      <!--/.bg-holder-->
      <div class="card-body position-relative">
        <h6>Mobil</h6>
        <div class="display-4 fs-4 mb-2 fw-normal font-sans-serif text-warning"
          data-countup='{"endValue":{{ count($mobil) }},"suffix":" data"}'>0</div>
        <a class="fw-semi-bold fs--1 text-nowrap" href="{{ url('mobil') }}">Lihat Data
          <span class="fas fa-angle-right ms-1" data-fa-transform="down-1"></span>
        </a>
      </div>
    </div>
  </div>
  <div class="col-sm-6 col-md-4">
    <div class="card overflow-hidden" style="min-width: 12rem">
      <div class="bg-holder bg-card" style="background-image:url(assets/img/icons/spot-illustrations/corner-1.png);">
      </div>
      <!--/.bg-holder-->
      <div class="card-body position-relative">
        <h6>Produk</h6>
        <div class="display-4 fs-4 mb-2 fw-normal font-sans-serif text-warning"
          data-countup='{"endValue":{{ count($produk) }},"suffix":" data"}'>0</div>
        <a class="fw-semi-bold fs--1 text-nowrap" href="{{ url('produk') }}">Lihat Data
          <span class="fas fa-angle-right ms-1" data-fa-transform="down-1"></span>
        </a>
      </div>
    </div>
  </div>
</div>
<h5 class="mb-3">Menu Transaksi</h5>
<div class="row g-3 mb-3">
  <div class="col-sm-6 col-md-4">
    <div class="card overflow-hidden" style="min-width: 12rem">
      <div class="bg-holder bg-card" style="background-image:url(assets/img/icons/spot-illustrations/corner-1.png);">
      </div>
      <!--/.bg-holder-->
      <div class="card-body position-relative">
        <h6>Menunggu Konfirmasi</h6>
        <div class="display-4 fs-4 mb-2 fw-normal font-sans-serif text-warning"
          data-countup='{"endValue":{{ count($menunggu) }},"suffix":" data"}'>0</div>
        <a class="fw-semi-bold fs--1 text-nowrap" href="{{ url('transkasi/menunggu') }}">Lihat Data
          <span class="fas fa-angle-right ms-1" data-fa-transform="down-1"></span>
        </a>
      </div>
    </div>
  </div>
  <div class="col-sm-6 col-md-4">
    <div class="card overflow-hidden" style="min-width: 12rem">
      <div class="bg-holder bg-card" style="background-image:url(assets/img/icons/spot-illustrations/corner-1.png);">
      </div>
      <!--/.bg-holder-->
      <div class="card-body position-relative">
        <h6>Dalam Peminjaman</h6>
        <div class="display-4 fs-4 mb-2 fw-normal font-sans-serif text-warning"
          data-countup='{"endValue":{{ count($proses) }},"suffix":" data"}'>0</div>
        <a class="fw-semi-bold fs--1 text-nowrap" href="{{ url('transaksi/proses') }}">Lihat Data
          <span class="fas fa-angle-right ms-1" data-fa-transform="down-1"></span>
        </a>
      </div>
    </div>
  </div>
  <div class="col-sm-6 col-md-4">
    <div class="card overflow-hidden" style="min-width: 12rem">
      <div class="bg-holder bg-card" style="background-image:url(assets/img/icons/spot-illustrations/corner-1.png);">
      </div>
      <!--/.bg-holder-->
      <div class="card-body position-relative">
        <h6>Pelanggan</h6>
        <div class="display-4 fs-4 mb-2 fw-normal font-sans-serif text-warning"
          data-countup='{"endValue":{{ count($pelanggan) }},"suffix":" data"}'>0</div>
        <a class="fw-semi-bold fs--1 text-nowrap" href="{{ url('pelanggan') }}">Lihat Data
          <span class="fas fa-angle-right ms-1" data-fa-transform="down-1"></span>
        </a>
      </div>
    </div>
  </div>
</div>
@endsection