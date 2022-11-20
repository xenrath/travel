@extends('layout.main')

@section('title', 'Data Admin')

@section('content')
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
@endsection