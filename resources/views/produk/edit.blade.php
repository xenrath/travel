@extends('layout.main')

@section('title', 'Ubah Produk')

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
        <p class="mb-0">Edit</p>
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
    <h5>Edit Produk</h5>
  </div>
  <form action="{{ url('produk/' . $produk->id) }}" method="POST" enctype="multipart/form-data" autocomplete="off">
    @csrf
    @method('put')
    <div class="card-body">
      <div class="p-3 border rounded mb-3">
        <div class="row">
          <div class="col-4">
            <img src="{{ asset('storage/uploads/' . $produk->mobil->gambar) }}" class="rounded w-100"
              alt="{{ $produk->mobil->nama }}">
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
                  <h5 class="fs-0">Warna</h5>
                </td>
                <td>
                  <h5 class="fs-0">:</h5>
                </td>
                <td class="text-end">
                  <h5 class="fs-0">{{ $produk->mobil->warna }}</h5>
                </td>
              </tr>
              <tr height="50">
                <td>
                  <h5 class="fs-0">Kapasitas</h5>
                </td>
                <td>
                  <h5 class="fs-0">:</h5>
                </td>
                <td class="text-end">
                  <h5 class="fs-0">{{ $produk->mobil->kapasitas }} Kursi</h5>
                </td>
              </tr>
              <tr height="40">
                <td>
                  <h5 class="fs-0">Fasilitas</h5>
                </td>
                <td>
                  <h5 class="fs-0">:</h5>
                </td>
                <td class="text-end">
                  <h5 class="fs-0">{{ $produk->mobil->fasilitas }}</h5>
                </td>
              </tr>
            </table>
          </div>
        </div>
      </div>
      <div class="mb-3">
        <label class="form-label" for="kategori">Kategori *</label>
        <select class="form-select" id="kategori" name="kategori">
          <option value="">- Pilih -</option>
          <option value="rental" {{ old('kategori', $produk->kategori)=='rental' ? 'selected' : '' }}>Rental</option>
          <option value="tour" {{ old('kategori', $produk->kategori)=='tour' ? 'selected' : '' }}>Tour</option>
        </select>
      </div>
      <div id="layout_tour" style="display: none;">
        <div class="mb-3">
          <label class="form-label" for="area">Area *</label>
          <select class="form-select" id="area" name="area">
            <option value="">- Pilih -</option>
            <option value="dalam" {{ old('area', $produk->area)=='dalam' ? 'selected' : '' }}>Dalam Kota</option>
            <option value="luar" {{ old('area', $produk->area)=='luar' ? 'selected' : '' }}>Luar Kota</option>
          </select>
        </div>
      </div>
      <div class="mb-3">
        <label class="form-label" for="sewa">Harga Sewa *</label>
        <input class="form-control @error('sewa') is-invalid @enderror" id="sewa" name="sewa" type="number"
          placeholder="masukan harga sewa mobil"
          oninput="this.value = !!this.value && Math.abs(this.value) >= 1 ? Math.abs(this.value) : null"
          value="{{ old('sewa', $produk->sewa) }}" />
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
  var kategori = document.getElementById('kategori');
  var layout_tour = document.getElementById('layout_tour');
  var area = document.getElementById('area');

  if (kategori.value == 'tour') {
    layout_tour.style.display = 'inline';
  }
  kategori.addEventListener('change', function () {
    if (this.value == "tour") {
      layout_tour.style.display = 'inline';
      area.value = "";
    } else {
      layout_tour.style.display = 'none';
      area.value = "";
    }
  });
</script>
@endsection