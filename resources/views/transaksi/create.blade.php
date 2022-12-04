@extends('layout.main')

@section('title', 'Data Peminjaman')

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
  <form action="{{ url('transaksi') }}" method="POST" autocomplete="off">
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
      <div class="mb-3">
        <label class="form-label" for="produk_id">Produk *</label>
        <select class="form-select js-choice" id="produk_id" size="1" name="produk_id"
          data-options="{'removeItemButton': true, 'placeholder': true}">
          <option value="">- Pilih Produk -</option>
          @foreach ($produks as $produk)
          <option value="{{ $produk->id }}" {{ old('produk_id')==$produk->id ? 'selected' : '' }}>
            {{ $produk->mobil->nama }}
            -
            {{ ucfirst($produk->kategori) }}
            @if ($produk->kategori == 'tour')
            ({{ ucfirst($produk->area) }} Kota)
            @endif
          </option>
          @endforeach
        </select>
      </div>
      <div id="layout_produk" style="display: none">
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
                    <h5 class="fs-0">Kategori</h5>
                  </td>
                  <td>
                    <h5 class="fs-0">:</h5>
                  </td>
                  <td class="text-end">
                    <h5 class="fs-0" id="kategori_produk" style="text-transform: capitalize"></h5>
                  </td>
                </tr>
                <tr height="50" id="layout_area">
                  <td>
                    <h5 class="fs-0">Area</h5>
                  </td>
                  <td>
                    <h5 class="fs-0">:</h5>
                  </td>
                  <td class="text-end">
                    <h5 class="fs-0" id="area_produk" style="text-transform: capitalize"></h5>
                  </td>
                </tr>
                <tr height="40">
                  <td>
                    <h5 class="fs-0">Harga Sewa / hari</h5>
                  </td>
                  <td>
                    <h5 class="fs-0">:</h5>
                  </td>
                  <td class="text-end">
                    <h5 class="fs-0" id="harga_produk"></h5>
                  </td>
                </tr>
              </table>
            </div>
          </div>
        </div>
      </div>
      <div id="layout_empty">
        <div class="p-5 border rounded mb-3 text-center">
          <h5 class="fs-0">- pilih produk terlebih dahulu -</h5>
        </div>
      </div>
      <div id="layout_tour" style="display: none">
        <div class="mb-3">
          <label class="form-label" for="sopir_id">Nama Sopir *</label>
          <select class="form-select" id="sopir_id" name="sopir_id">
            <option value="">- Pilih Sopir -</option>
            @foreach ($sopirs as $sopir)
            <option value="{{ $sopir->id }}" {{ old('sopir_id')==$sopir->id ? 'selected' : '' }}>{{ $sopir->nama }}
            </option>
            @endforeach
          </select>
        </div>
      </div>
      <div class="mb-3">
        <label class="form-label" for="datepicker">Tanggal Sewa *</label>
        <input class="form-control datetimepicker" id="datepicker" name="tanggal" type="text" placeholder="d/m/y"
          data-options="{'disableMobile':true}" data-id="minDateToday" value="{{ old('tanggal') }}" />
      </div>
      <div class="mb-3">
        <label class="form-label" for="lama">Lama Peminjaman *</label>
        <select class="form-select" id="lama" name="lama">
          <option value="">- Pilih -</option>
          <option value="1" {{ old('lama')=='1' ? 'selected' : '' }}>1 Hari</option>
          <option value="2" {{ old('lama')=='2' ? 'selected' : '' }}>2 Hari</option>
          <option value="3" {{ old('lama')=='3' ? 'selected' : '' }}>3 Hari</option>
          <option value="4" {{ old('lama')=='4' ? 'selected' : '' }}>4 Hari</option>
          <option value="5" {{ old('lama')=='5' ? 'selected' : '' }}>5 Hari</option>
          <option value="6" {{ old('lama')=='6' ? 'selected' : '' }}>6 Hari</option>
          <option value="7" {{ old('lama')=='7' ? 'selected' : '' }}>7 Hari</option>
        </select>
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
  var layout_produk = document.getElementById('layout_produk');
  var layout_empty = document.getElementById('layout_empty');
  var produk_id = document.getElementById('produk_id');
  var gambar_mobil = document.getElementById('gambar_mobil');
  var nama_mobil = document.getElementById('nama_mobil');
  var plat_mobil = document.getElementById('plat_mobil');
  var kategori_produk = document.getElementById('kategori_produk');
  var layout_area = document.getElementById('layout_area');
  var area_produk = document.getElementById('area_produk');
  var harga_produk = document.getElementById('harga_produk');
  var layout_tour = document.getElementById('layout_tour');
  var sewa = 0;
  var isTour = false;
  if (produk_id.value != "") {
    $.ajax({
      url: "{{ url('produk/detail') }}" + "/" + produk_id.value,
      type: "GET",
      dataType: "json",
      success: function(produk) {
        layout_produk.style.display = 'inline';
        layout_empty.style.display = 'none';
        gambar_mobil.src = "{{ asset('storage/uploads') }}" + "/" + produk.mobil.gambar;
        gambar_mobil.alt = produk.mobil.nama;
        nama_mobil.innerText = produk.mobil.nama;
        plat_mobil.innerText = produk.mobil.plat;
        kategori_produk.innerText = produk.kategori;
        if (produk.kategori == 'rental') {
          layout_area.style.display = 'none';
          layout_tour.style.display = 'none';
        } else {
          layout_area.style.display = '';
          area_produk.innerText = produk.area + " Kota";
          layout_tour.style.display = 'inline';
        }
        harga_produk.innerText = rupiah(produk.sewa, 'Rp');
        sewa = produk.sewa;
      },
    });
  } else {
    layout_produk.style.display = 'none';
    layout_empty.style.display = 'inline';
    sewa = 0;
  }
  produk_id.addEventListener('change', function () {
    if (this.value != "") {
      $.ajax({
        url: "{{ url('produk/detail') }}" + "/" + this.value,
        type: "GET",
        dataType: "json",
        success: function(produk) {
          layout_produk.style.display = 'inline';
          layout_empty.style.display = 'none';
          gambar_mobil.src = "{{ asset('storage/uploads') }}" + "/" + produk.mobil.gambar;
          gambar_mobil.alt = produk.mobil.nama;
          nama_mobil.innerText = produk.mobil.nama;
          plat_mobil.innerText = produk.mobil.plat;
          kategori_produk.innerText = produk.kategori;
          if (produk.kategori == 'rental') {
            layout_area.style.display = 'none';
            layout_tour.style.display = 'none';
          } else {
            layout_area.style.display = '';
            area_produk.innerText = produk.area + " Kota";
            layout_tour.style.display = 'inline';
          }
          harga_produk.innerText = rupiah(produk.sewa, 'Rp');
          sewa = produk.sewa;
        },
      });
    } else {
      layout_produk.style.display = 'none';
      layout_empty.style.display = 'inline';
      sewa = 0;
    }
  });
  var lama = document.getElementById('lama');
  var harga = document.getElementById('harga');
  lama.addEventListener('change', function() {
    if (sewa != 0) {
      harga.value = sewa * this.value;
    } else {
      harga.value = 0;
    }
  });
  var kategori = document.getElementById('kategori');
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

  function rupiah(angka, prefix){
    var number_string = angka.replace(/[^,\d]/g, '').toString(),
    split   		= number_string.split(','),
    sisa     		= split[0].length % 3,
    rupiah     		= split[0].substr(0, sisa),
    ribuan     		= split[0].substr(sisa).match(/\d{3}/gi);

    // tambahkan titik jika yang di input sudah menjadi angka ribuan
    if(ribuan){
      separator = sisa ? '.' : '';
      rupiah += separator + ribuan.join('.');
    }

    rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
    return prefix == undefined ? rupiah : (rupiah ? 'Rp' + rupiah : '');
  }
</script>
@endsection