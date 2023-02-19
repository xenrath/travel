@extends('layout.main')

@section('title', 'Tambah Mobil')

@section('content')
<div class="card mb-3">
  <div class="bg-holder d-none d-lg-block bg-card"
    style="background-image:url({{ asset('falcon/public/assets/img/icons/spot-illustrations/corner-4.png') }});">
  </div>
  <!--/.bg-holder-->
  <div class="card-body position-relative">
    <div class="row">
      <div class="col-lg-8">
        <h3>Data Mobil</h3>
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
    <h5>Tambah Mobil</h5>
  </div>
  <form action="{{ url('mobil') }}" method="POST" enctype="multipart/form-data" autocomplete="off">
    @csrf
    <div class="card-body">
      <div class="mb-3">
        <label class="form-label" for="nama">Nama Mobil *</label>
        <input class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama" type="text"
          placeholder="masukan nama mobil" value="{{ old('nama') }}" />
      </div>
      <div class="row">
        <div class="col-md-6">
          <div class="mb-3">
            <label class="form-label" for="tahun">Tahun *</label>
            <input class="form-control @error('tahun') is-invalid @enderror" id="tahun" name="tahun" type="year"
            onkeypress="return event.charCode >= 48 && event.charCode <= 57" maxlength="4" placeholder="masukan tahun keluaran" value="{{ old('tahun') }}" />
          </div>
        </div>
        <div class="col-md-6">
          <div class="mb-3">
            <label class="form-label" for="plat">Plat *</label>
            <input class="form-control @error('plat') is-invalid @enderror" id="plat" name="plat" type="text"
              placeholder="masukan plat mobil" value="{{ old('plat') }}" />
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-6">
          <div class="mb-3">
            <label class="form-label" for="warna">Warna *</label>
            <input class="form-control @error('warna') is-invalid @enderror" id="warna" name="warna" type="text"
              onkeypress="return ((event.charCode >= 65 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122) || (event.charCode == 32))"
              placeholder="masukan warna mobil" value="{{ old('warna') }}" />
          </div>
        </div>
        <div class="col-md-6">
          <div class="mb-3">
            <label class="form-label" for="kapasitas">Kapasitas *</label>
            <input class="form-control @error('kapasitas') is-invalid @enderror" id="kapasitas" name="kapasitas"
              type="number" placeholder="masukan kapasitas mobil"
              oninput="this.value = !!this.value && Math.abs(this.value) >= 1 ? Math.abs(this.value) : null"
              value="{{ old('kapasitas') }}" />
          </div>
        </div>
      </div>
      <div class="mb-3">
        <label class="form-label" for="fasilitas">Fasilitas *</label>
        <textarea class="form-control @error('fasilitas') is-invalid @enderror" id="fasilitas" name="fasilitas"
          rows="3">{{ old('fasilitas') }}</textarea>
        @error('fasilitas')
        <span class="invalid-feedback" role="alert">{{ $message }}</span>
        @enderror
      </div>
      <div class="mb-3">
        <label class="form-label" for="gambar">Gambar *</label>
        <input class="form-control @error('gambar') is-invalid @enderror" id="gambar" name="gambar" type="file"
          accept="image/*" />
        @error('gambar')
        <span class="invalid-feedback" role="alert">{{ $message }}</span>
        @enderror
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