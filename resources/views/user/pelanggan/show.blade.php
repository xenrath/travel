@extends('layout.main')

@section('title', 'Lihat Pelanggan')

@section('content')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.5.1/dist/leaflet.css"
  integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ=="
  crossorigin="" />
<script src="https://unpkg.com/leaflet@1.5.1/dist/leaflet.js"
  integrity="sha512-GffPMF3RvMeYyc1LWMHtK8EbPv0iNZ8/oTtHPx9/cc2ILxQ+u905qIwdpULaqDkyBKgOaB57QTMg7ztg8Jm2Og=="
  crossorigin=""></script>
<div class="card mb-3">
  <div class="bg-holder d-none d-lg-block bg-card"
    style="background-image:url({{ asset('falcon/public/assets/img/icons/spot-illustrations/corner-4.png') }});">
  </div>
  <!--/.bg-holder-->
  <div class="card-body position-relative">
    <div class="row">
      <div class="col-lg-8">
        <h3>Data Pelanggan</h3>
        <p class="mb-0">Lihat</p>
      </div>
    </div>
  </div>
</div>
<div class="card">
  <div class="card-header">
    <h5>Lihat Pelanggan</h5>
  </div>
  <div class="card-body">
    <div class="row">
      <div class="col-md-6">
        @if ($user->foto)
        <img src="{{ asset('storage/uploads/' . $user->foto) }}" alt="{{ $user->nama }}" class="w-100 rounded border">
        @else
        <img src="{{ asset('falcon/public/assets/img/img-placeholder.jpg') }}" alt="{{ $user->nama }}"
          class="w-100 rounded border">
        @endif
      </div>
      <div class="col-md-6">
        <table class="w-100">
          <tr height="50">
            <td>
              <h5 class="fs-0">Nama</h5>
            </td>
            <td>
              <h5 class="fs-0">:</h5>
            </td>
            <td class="text-end">
              <h5 class="fs-0">{{ $user->nama }}</h5>
            </td>
          </tr>
          <tr height="50">
            <td>
              <h5 class="fs-0">NIK</h5>
            </td>
            <td>
              <h5 class="fs-0">:</h5>
            </td>
            <td class="text-end">
              <h5 class="fs-0">{{ $user->nik }}</h5>
            </td>
          </tr>
          <tr height="50">
            <td>
              <h5 class="fs-0">Jenis Kelamin</h5>
            </td>
            <td>
              <h5 class="fs-0">:</h5>
            </td>
            <td class="text-end">
              <h5 class="fs-0">
                @if ($user->gender == 'L')
                Laki-laki
                @else
                Perempuan
                @endif
              </h5>
            </td>
          </tr>
          <tr height="50">
            <td>
              <h5 class="fs-0">Nomor Telepon</h5>
            </td>
            <td>
              <h5 class="fs-0">:</h5>
            </td>
            <td class="text-end">
              <h5 class="fs-0">{{ $user->telp }}</h5>
            </td>
          </tr>
          <tr height="50">
            <td>
              <h5 class="fs-0">Alamat</h5>
            </td>
            <td>
              <h5 class="fs-0">:</h5>
            </td>
            <td class="text-end">
              <h5 class="fs-0">{{ $user->alamat }}</h5>
            </td>
          </tr>
        </table>
      </div>
    </div>
    @if ($user->latitude)
    <div class="row mt-3">
      <div class="col">
        <div id="map" style="width:100%; height:400px;"></div>
        <script>
          // var location = {{ $result_lat_long }};
            var map = L.map('map').setView([{{ $user->latitude }}, {{ $user->longitude }}], 18);
            mapLink = '<a href="http://openstreetmap.org">OpenStreetMap</a>';
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
              attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
            }).addTo(map);
            L.marker([{{ $user->latitude }}, {{ $user->longitude }}])
              .addTo(map)
              .bindPopup("{{ $user->nama }}")
              .openPopup();
        </script>
      </div>
    </div>
    @endif
  </div>
</div>
@endsection