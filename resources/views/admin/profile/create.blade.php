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
  <form action="{{ url('admin/produk') }}" method="POST" enctype="multipart/form-data" autocomplete="off">
    @csrf
    <div class="card-body">
      <div class="mb-3">
        <label class="form-label" for="mobil_id">Mobil *</label>
        <select class="form-select js-choice" id="mobil_id" size="1" name="mobil_id"
          data-options="{'removeItemButton': true, 'placeholder': true}">
          <option value="">- Pilih Mobil -</option>
          @foreach ($mobils as $mobil)
          <option value="{{ $mobil->id }}" {{ old('mobil_id')==$mobil->id ? 'selected' : '' }}>{{
            $mobil->nama }}</option>
          @endforeach
        </select>
      </div>
      <div id="layout_mobil" style="display: none;">
        <div class="p-3 border rounded mb-3">
          <div class="row">
            <div class="col-4">
              <img id="gambar_mobil" class="rounded w-100">
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
                    <h5 class="fs-0" id="nama_mobil"></h5>
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
                    <h5 class="fs-0" id="plat_mobil"></h5>
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
                    <h5 class="fs-0" id="warna_mobil" style="text-transform: capitalize"></h5>
                  </td>
                </tr>
                <tr height="50" id="layout_area">
                  <td>
                    <h5 class="fs-0">Kapasitas</h5>
                  </td>
                  <td>
                    <h5 class="fs-0">:</h5>
                  </td>
                  <td class="text-end">
                    <h5 class="fs-0" id="kapasitas_mobil" style="text-transform: capitalize"></h5>
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
                    <h5 class="fs-0" id="fasilitas_mobil"></h5>
                  </td>
                </tr>
              </table>
            </div>
          </div>
        </div>
      </div>
      <div id="layout_empty">
        <div class="p-5 border rounded mb-3 text-center">
          <h5 class="fs-0">- pilih mobil terlebih dahulu -</h5>
        </div>
      </div>
      <div class="mb-3">
        <label class="form-label" for="kategori">Kategori *</label>
        <select class="form-select" id="kategori" name="kategori">
          <option value="">- Pilih -</option>
          <option value="rental" {{ old('kategori')=='rental' ? 'selected' : '' }}>Rental</option>
          <option value="tour" {{ old('kategori')=='tour' ? 'selected' : '' }}>Tour</option>
        </select>
      </div>
      <div id="layout_tour" style="display: none;">
        <div class="mb-3">
          <label class="form-label" for="area">Area *</label>
          <select class="form-select" id="area" name="area">
            <option value="">- Pilih -</option>
            <option value="dalam" {{ old('area')=='dalam' ? 'selected' : '' }}>Dalam Kota</option>
            <option value="luar" {{ old('area')=='luar' ? 'selected' : '' }}>Luar Kota</option>
          </select>
        </div>
      </div>
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
<script>
  var layout_mobil = document.getElementById('layout_mobil');
  var layout_empty = document.getElementById('layout_empty');
  var mobil_id = document.getElementById('mobil_id');
  var gambar_mobil = document.getElementById('gambar_mobil');
  var nama_mobil = document.getElementById('nama_mobil');
  var plat_mobil = document.getElementById('plat_mobil');
  var warna_mobil = document.getElementById('warna_mobil');
  var kapasitas_mobil = document.getElementById('kapasitas_mobil');
  var fasilitas_mobil = document.getElementById('fasilitas_mobil');

  var kategori = document.getElementById('kategori');
  var layout_tour = document.getElementById('layout_tour');
  var area = document.getElementById('area');
  
  if (mobil_id.value != "") {
    if (mobil_id.value != "") {
      $.ajax({
        url: "{{ url('admin/mobil/detail') }}" + "/" + mobil_id.value,
        type: "GET",
        dataType: "json",
        success: function(mobil) {
          layout_mobil.style.display = 'inline';
          layout_empty.style.display = 'none';
          console.log(mobil);
          gambar_mobil.src = "{{ asset('storage/uploads') }}" + "/" + mobil.gambar;
          gambar_mobil.alt = mobil.nama;
          nama_mobil.innerText = mobil.nama;
          plat_mobil.innerText = mobil.plat;
          warna_mobil.innerText = mobil.warna;
          kapasitas_mobil.innerText = mobil.kapasitas + " Kursi";
          fasilitas_mobil.innerText = mobil.fasilitas;
        },
      });
    } else {
      layout_mobil.style.display = 'none';
      layout_empty.style.display = 'inline';
    }
  }
  mobil_id.addEventListener('change', function () {
    if (this.value != "") {
      $.ajax({
        url: "{{ url('admin/mobil/detail') }}" + "/" + this.value,
        type: "GET",
        dataType: "json",
        success: function(mobil) {
          layout_mobil.style.display = 'inline';
          layout_empty.style.display = 'none';
          console.log(mobil);
          gambar_mobil.src = "{{ asset('storage/uploads') }}" + "/" + mobil.gambar;
          gambar_mobil.alt = mobil.nama;
          nama_mobil.innerText = mobil.nama;
          plat_mobil.innerText = mobil.plat;
          warna_mobil.innerText = mobil.warna;
          kapasitas_mobil.innerText = mobil.kapasitas + " Kursi";
          fasilitas_mobil.innerText = mobil.fasilitas;
        },
      });
    } else {
      layout_mobil.style.display = 'none';
      layout_empty.style.display = 'inline';
    }
  });

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