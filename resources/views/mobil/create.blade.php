@extends('layout.main')

@section('title', 'Data Produk')

@section('content')
<div class="card mb-3">
  <div class="bg-holder d-none d-lg-block bg-card"
    style="background-image:url({{ asset('falcon/public/assets/img/icons/spot-illustrations/corner-4.png') }});">
  </div>
  <!--/.bg-holder-->
  <div class="card-body position-relative">
    <div class="row">
      <div class="col-lg-8">
        <h3>Data Produk</h3>
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
    <h5>Tambah Produk</h5>
  </div>
  <form action="{{ url('produk') }}" method="POST" enctype="multipart/form-data" autocomplete="off">
    @csrf
    <div class="card-body">
      <div class="mb-3">
        <label class="form-label" for="mobil_id">Mobil *</label>
        <select class="form-select js-choice" id="mobil_id" size="1" name="mobil_id"
          data-options="{'removeItemButton': true, 'placeholder': true}">
          <option value="">- Pilih Mobil -</option>
          {{-- @foreach ($produks as $produk)
          <option value="{{ $produk->id }}" {{ old('mobil_id')==$produk->id ? 'selected' : '' }}>{{
            $produk->nama }} (@rupiah($produk->sewa))</option>
          @endforeach --}}
        </select>
      </div>
      <div class="mb-3">
        <label class="form-label" for="tahun">Tahun *</label>
        <input class="form-control @error('tahun') is-invalid @enderror" id="tahun" name="tahun" type="year"
          placeholder="masukan tahun keluaran" value="{{ old('tahun') }}" />
      </div>
      <div class="mb-3">
        <label class="form-label" for="plat">Plat *</label>
        <input class="form-control @error('plat') is-invalid @enderror" id="plat" name="plat" type="text"
          placeholder="masukan plat mobil" value="{{ old('plat') }}" />
      </div>
      <div class="mb-3">
        <label class="form-label" for="warna">Warna *</label>
        <input class="form-control @error('warna') is-invalid @enderror" id="warna" name="warna" type="text"
          placeholder="masukan warna mobil" value="{{ old('warna') }}" />
      </div>
      <div class="mb-3">
        <label class="form-label" for="kapasitas">Kapasitas *</label>
        <input class="form-control @error('kapasitas') is-invalid @enderror" id="kapasitas" name="kapasitas"
          type="number" placeholder="masukan kapasitas mobil"
          oninput="this.value = !!this.value && Math.abs(this.value) >= 1 ? Math.abs(this.value) : null"
          value="{{ old('kapasitas') }}" />
      </div>
      <div class="mb-3">
        <label class="form-label" for="kategori">Kategori *</label>
        <select class="form-select" id="kategori" name="kategori">
          <option value="">- Pilih -</option>
          <option value="rental" {{ old('kategori')=='rental' ? 'selected' : '' }}>Rental</option>
          <option value="tour" {{ old('kategori')=='tour' ? 'selected' : '' }}>Tour</option>
        </select>
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
      {{-- <div class="mb-3">
        <div class="dropzone dropzone-single p-0" data-dropzone="data-dropzone"
          data-options='{"url":"valid/url","maxFiles":1,"dictDefaultMessage":"Pilih atau pindahkan gambar kesini"}'>
          <div class="fallback">
            <input type="file" name="file" />
          </div>
          <div class="dz-preview dz-preview-single">
            <div class="dz-preview-cover dz-complete">
              <img class="dz-preview-img" src="{{ asset('falcon/public/assets/img/generic/image-file-2.png') }}"
                alt="..." data-dz-thumbnail="" />
              <a class="dz-remove text-danger" href="#!" data-dz-remove="data-dz-remove">
                <span class="fas fa-times"></span>
              </a>
              <div class="dz-progress">
                <span class="dz-upload" data-dz-uploadprogress=""></span>
              </div>
              <div class="dz-errormessage m-1">
                <span data-dz-errormessage="data-dz-errormessage"></span>
              </div>
            </div>
            <div class="dz-progress">
              <span class="dz-upload" data-dz-uploadprogress=""></span>
            </div>
          </div>
          <div class="dz-message" data-dz-message="data-dz-message">
            <div class="dz-message-text">
              <img class="me-2" src="{{ asset('falcon/public/assets/img/icons/cloud-upload.svg') }}" width="25"
                alt="" />Pindahkan
              gambar disini
            </div>
          </div>
        </div>
      </div> --}}
      <div class="mb-3">
        <label class="form-label" for="sewa">Harga Sewa *</label>
        <input class="form-control @error('sewa') is-invalid @enderror" id="sewa" name="sewa" type="number"
          placeholder="masukan harga sewa mobil"
          oninput="this.value = !!this.value && Math.abs(this.value) >= 1 ? Math.abs(this.value) : null"
          value="{{ old('sewa') }}" />
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