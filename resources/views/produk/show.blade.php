@extends('layout.main')

@section('title', 'Lihat Sopir')

@section('content')
<div class="card mb-3">
  <div class="bg-holder d-none d-lg-block bg-card"
    style="background-image:url({{ asset('falcon/public/assets/img/icons/spot-illustrations/corner-4.png') }});">
  </div>
  <!--/.bg-holder-->
  <div class="card-body position-relative">
    <div class="row">
      <div class="col-lg-8">
        <h3>Data Sopir</h3>
        <p class="mb-0">Lihat</p>
      </div>
    </div>
  </div>
</div>
<div class="card">
  <div class="card-header">
    <h5>Lihat Sopir</h5>
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
  </div>
</div>
@endsection