@extends('layout.main')

@section('title', 'Lihat Rekening')

@section('content')
<div class="card mb-3">
  <div class="bg-holder d-none d-lg-block bg-card"
    style="background-image:url({{ asset('falcon/public/assets/img/icons/spot-illustrations/corner-4.png') }});">
  </div>
  <!--/.bg-holder-->
  <div class="card-body position-relative">
    <div class="row">
      <div class="col-lg-8">
        <h3>Data Rekening</h3>
        <p class="mb-0">Tambah</p>
      </div>
    </div>
  </div>
</div>
@if (session('status'))
<div class="alert alert-danger border-2" role="alert">
  <div class="clearfix">
    <div class="d-flex align-items-center float-start">
      <div class="bg-danger me-3 icon-item">
        <span class="fas fa-times-circle text-white fs-3"></span>
      </div>
      <h5 class="mb-0 text-danger">Error!</h5>
    </div>
    <button class="btn-close float-end" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
  <div class="mt-3">
    @foreach (session('status') as $error)
    <p>
      <span class="dot bg-danger"></span> {{ $error }}
    </p>
    @endforeach
  </div>
</div>
@endif
<div class="card">
  <div class="card-header">
    <h5>Tambah Rekening</h5>
  </div>
  <form action="{{ url('rekening') }}" method="POST" enctype="multipart/form-data" autocomplete="off">
    @csrf
    <div class="card-body">
      <div class="row">
        <div class="col-md-6">
          <div class="mb-3">
            <label class="form-label" for="bank">Bank *</label>
            <input class="form-control @error('bank') is-invalid @enderror" id="bank" name="bank" type="text"
              placeholder="masukan bank" value="{{ old('bank') }}" />
          </div>
        </div>
        <div class="col-md-6">
          <div class="mb-3">
            <label class="form-label" for="nama">Nama Rekening *</label>
            <input class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama" type="year"
              placeholder="masukan nama rekening" value="{{ old('nama') }}" />
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-6">
          <div class="mb-3">
            <label class="form-label" for="nomor">Nomor Rekening *</label>
            <input class="form-control @error('nomor') is-invalid @enderror" id="nomor" name="nomor" type="text"
              placeholder="masukan nomor rekening" value="{{ old('nomor') }}" />
          </div>
        </div>
        <div class="col-md-6">
          <div class="mb-3">
            <label class="form-label" for="gambar">Gambar Bank * <small>(ukuran 16:9)</small></label>
            <input class="form-control @error('gambar') is-invalid @enderror" id="gambar" name="gambar" type="file"
              accept="image/*" />
            @error('gambar')
            <span class="invalid-feedback" role="alert">{{ $message }}</span>
            @enderror
          </div>
        </div>
      </div>
    </div>
    <div class="card-footer text-end">
      <button class="btn btn-secondary me-1" type="reset">
        <i class="fas fa-undo"></i> Reset
      </button>
      <button class="btn btn-primary" type="submit">
        <i class="fas fa-save"></i> Simpan
      </button>
    </div>
  </form>
</div>
@endsection