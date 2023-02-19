@extends('layout.main')

@section('title', 'Buat Peminjaman')

@section('content')
<div class="card mb-3">
  <div class="bg-holder d-none d-lg-block bg-card"
    style="background-image:url({{ asset('falcon/public/assets/img/icons/spot-illustrations/corner-4.png') }});">
  </div>
  <!--/.bg-holder-->
  <div class="card-body position-relative">
    <div class="row">
      <div class="col-lg-8">
        <h3>Data Peminjaman</h3>
        <p class="mb-0">Tambah</p>
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
<div class="card mb-3">
  <div class="card-body">
    <div class="row">
      <div class="col-4">
        <img src="{{ asset('storage/uploads/' . $produk->mobil->gambar) }}" alt="{{ $produk->mobil->nama }}"
          class="rounded w-100">
      </div>
      <div class="col-8">
        <table class="w-100">
          <tr height="40">
            <td>
              <h5 class="fs-0">Mobil</h5>
            </td>
            <td>
              <h5 class="fs-0">:</h5>
            </td>
            <td class="text-end">
              <h5 class="fs-0">{{ $produk->mobil->nama }}</h5>
            </td>
          </tr>
          <tr height="40">
            <td>
              <h5 class="fs-0">Plat</h5>
            </td>
            <td>
              <h5 class="fs-0">:</h5>
            </td>
            <td class="text-end">
              <h5 class="fs-0">{{ $produk->mobil->plat }}</h5>
            </td>
          </tr>
          <tr height="40">
            <td>
              <h5 class="fs-0">Kategori</h5>
            </td>
            <td>
              <h5 class="fs-0">:</h5>
            </td>
            <td class="text-end">
              <h5 class="fs-0">{{ ucfirst($produk->kategori) }}</h5>
            </td>
          </tr>
          @if ($produk->kategori == 'tour')
          <tr height="50">
            <td>
              <h5 class="fs-0">Area</h5>
            </td>
            <td>
              <h5 class="fs-0">:</h5>
            </td>
            <td class="text-end">
              <h5 class="fs-0">{{ ucfirst($produk->area) }}</h5>
            </td>
          </tr>
          @endif
          <tr height="40">
            <td>
              <h5 class="fs-0">Harga Sewa / hari</h5>
            </td>
            <td>
              <h5 class="fs-0">:</h5>
            </td>
            <td class="text-end">
              <h5 class="fs-0">@rupiah($produk->sewa)</h5>
            </td>
          </tr>
        </table>
      </div>
    </div>
  </div>
</div>
@if (session('error'))
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
    @foreach (session('error') as $error)
    <p>
      <span class="dot bg-danger"></span> {{ $error }}
    </p>
    @endforeach
  </div>
</div>
@endif
<div class="card">
  <div class="card-header">
    <h5>Tambah Peminjaman</h5>
  </div>
  <form action="{{ url('buat/store/' . $produk->id) }}" method="POST" autocomplete="off">
    @csrf
    <div class="card-body">
      <div class="mb-3">
        <label class="form-label" for="pelanggan_id">Nama Pelanggan *</label>
        <select class="form-select js-choice" id="pelanggan_id" size="1" name="pelanggan_id"
          data-options="{'removeItemButton': true, 'placeholder': true}">
          <option value="">- Pilih Pelanggan -</option>
          @foreach ($pelanggans as $pelanggan)
          <option value="{{ $pelanggan->id }}" {{ old('pelanggan_id')==$pelanggan->id ? 'selected' : '' }}>{{
            $pelanggan->nama }}</option>
          @endforeach
        </select>
      </div>
      @if ($produk->kategori == 'tour')
      <div class="mb-3">
        <label class="form-label" for="sopir_id">Nama Sopir *</label>
        <select class="form-select js-choice" id="sopir_id" size="1" name="sopir_id"
          data-options="{'removeItemButton': true, 'placeholder': true}">
          <option value="">- Pilih Sopir -</option>
          @foreach ($sopirs as $sopir)
          <option value="{{ $sopir->id }}" {{ old('sopir_id')==$sopir->id ? 'selected' : '' }}>{{ $sopir->nama }}
          </option>
          @endforeach
        </select>
      </div>
      @endif
      <div class="mb-3">
        <label class="form-label" for="tanggal">Tanggal Sewa *</label>
        <input class="form-control" id="tanggal" name="tanggal" type="date" value="{{ old('tanggal') }}" />
      </div>
      <div class="mb-3">
        <label class="form-label" for="lama">Lama Peminjaman *</label>
        <input class="form-control" id="lama" name="lama" type="text" value="{{ old('lama') }}" />
      </div>
      <div class="mb-3">
        <label class="form-label" for="harga">Harga <span class="fw-light">(pilih mobil dan lama
            peminjaman)</span></label>
        <input class="form-control" id="harga" name="harga" type="text" value="{{ old('harga', '0') }}" readonly />
        @error('harga')
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
<script>
  var lama = document.getElementById('lama');
  var harga = document.getElementById('harga');
  var sewa = "{{ $produk->sewa }}";
  lama.addEventListener('change', function() {
    if (this.value != "") {
      harga.value = this.value * sewa;
    } else {
      harga.value = 0;
    }
  });
  var kategori = document.getElementById('kategori');
  var layout_travel = document.getElementById('layout_travel');
  var sopir_id = document.getElementById('sopir_id');
  var tujuan = document.getElementById('tujuan');
  if (kategori.value == 'travel') {
    layout_travel.style.display = 'inline';
  }
  kategori.addEventListener('change', function () {
    if (this.value == 'travel') {
      layout_travel.style.display = 'inline';
      isTravel = true;
      if (lamaValue != 0 && sewa != 0) {
        harga.value = (sewa * lamaValue) + 250000;
      }
    } else {
      layout_travel.style.display = 'none';
      sopir_id.value = "";
      area.value = "";
      isTravel = false;
      if (lamaValue != 0 && sewa != 0) {
        harga.value = sewa * lamaValue;
      }
    }
  });
  var area = document.getElementById('area');
  area.addEventListener('change', function () {
    if (this.value == 'luar') {
      isLuar = true;
      if (lamaValue != 0 && sewa != 0) {
        harga.value = (sewa * lamaValue) + 250000 + 100000;
      }
    } else {
      isLuar = false;
      if (lamaValue != 0 && sewa != 0) {
        harga.value = (sewa * lamaValue) + 250000;
      }
    }
  })
</script>
@endsection