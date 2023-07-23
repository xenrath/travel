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
  <form action="{{ url('admin/transaksi') }}" method="POST" id="form_transaksi" autocomplete="off">
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
        <label class="form-label" for="waktu">Waktu Sewa *</label>
        <select class="form-select" id="waktu" name="waktu">
          <option value="">- Pilih Waktu -</option>
          <option value="0">Hari ini</option>
          <option value="1">Besok</option>
        </select>
      </div>
      <div class="mb-3">
        <label class="form-label" for="lama">Lama Peminjaman *</label>
        <input class="form-control" id="lama" name="lama" type="number" value="{{ old('lama') }}" />
      </div>
      <div class="mb-3" style="display: none;">
        <label class="form-label" for="harga">Harga <span class="fw-light">(pilih mobil dan lama
            peminjaman)</span></label>
        <input class="form-control" id="harga" name="harga" type="text" value="{{ old('harga', '0') }}" readonly />
        @error('harga')
        <span class="invalid-feedback" role="alert">{{ $message }}</span>
        @enderror
      </div>
      <div class="mb-3" style="display: none">
        <button type="button" id="btnKonfirmasi" class="btn btn-primary me-1" data-bs-toggle="modal"
          data-bs-target="#modalKonfirmasi">Modal
          Konfirmasi</button>
        <button type="button" id="btnGagal" class="btn btn-danger" data-bs-toggle="modal"
          data-bs-target="#modalGagal">Modal
          Konfirmasi</button>
      </div>
    </div>
    <div class="card-footer text-end">
      <button class="btn btn-secondary me-1" type="reset">
        <i class="fas fa-undo"></i> Reset
      </button>
      <button class="btn btn-primary" type="button" onclick="konfirmasi()">
        <i class="fas fa-save"></i> Simpan
      </button>
    </div>
  </form>
</div>
<div class="modal fade" id="modalKonfirmasi" data-bs-keyboard="false" data-bs-backdrop="static" tabindex="-1"
  aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content border-0">
      <div class="position-absolute top-0 end-0 mt-3 me-3 z-index-1">
        <button class="btn-close btn btn-sm btn-circle d-flex flex-center transition-base" data-bs-dismiss="modal"
          aria-label="Close"></button>
      </div>
      <div class="modal-body p-0">
        <div class="bg-light rounded-top-lg py-3 ps-4 pe-6 text-start">
          <h4 class="mb-3">Konfirmasi</h4>
          <h5 class="fs-0 fw-normal">Harga yang harus dibayar sejumlah <strong id="total"></strong></h5>
        </div>
      </div>
      <div class="modal-footer">
        <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Tidak</button>
        <button class="btn btn-primary" type="button"
          onclick="event.preventDefault(); document.getElementById('form_transaksi').submit();">Ya</a>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="modalGagal" data-bs-keyboard="false" data-bs-backdrop="static" tabindex="-1"
  aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content border-0">
      <div class="position-absolute top-0 end-0 mt-3 me-3 z-index-1">
        <button class="btn-close btn btn-sm btn-circle d-flex flex-center transition-base" data-bs-dismiss="modal"
          aria-label="Close"></button>
      </div>
      <div class="modal-body p-0">
        <div class="bg-light rounded-top-lg py-3 ps-4 pe-6 text-start">
          <h4 class="mb-3">Error!</h4>
          <h5 class="fs-0 fw-normal">Lengkapi data terlebih dahulu!</h5>
        </div>
      </div>
      <div class="modal-footer">
        <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Tutup</button>
      </div>
    </div>
  </div>
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
      url: "{{ url('admin/produk/detail') }}" + "/" + produk_id.value,
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
        url: "{{ url('admin/produk/detail') }}" + "/" + this.value,
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
  // lama.addEventListener('change', function() {
  //   if (sewa != 0) {
  //     harga.value = sewa * this.value;
  //   } else {
  //     harga.value = 0;
  //   }
  // });
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
  
  var modalKonfirmasi = document.getElementById('modalKonfirmasi');
  var alert_konfirmasi = document.getElementById('alert_konfirmasi');
  var alert_gagal = document.getElementById('alert_gagal');

  function konfirmasi() {
    var form_transaksi = document.getElementById('form_transaksi');
    var total = document.getElementById('total');
    if (lama.value != 0 && sewa != 0) {
      v_total = lama.value * sewa;
      harga.value = v_total;
      total.textContent = rupiah("" + v_total, 'Rp');
      document.getElementById('btnKonfirmasi').click();
    } else {
      document.getElementById('btnGagal').click();
    }
  }

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