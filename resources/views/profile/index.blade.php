@extends('layout.main')

@section('title', 'Data Produk')

@section('content')
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
<div class="card mb-3">
  <div class="card-header">
    <div class="row align-items-center">
      <div class="col">
        <h5 class="mb-0">Profile Saya</h5>
      </div>
    </div>
  </div>
  <form action="{{ url('profile/update') }}" method="post" enctype="multipart/form-data" autocomplete="off">
    <div class="card-body bg-light border-top">
      @csrf
      <div class="mb-3">
        <label class="form-label" for="nama">Nama *</label>
        <input class="form-control" id="nama" name="nama" type="text"
          onkeypress="return ((event.charCode >= 65 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122) || (event.charCode == 32))"
          placeholder="masukan nama" value="{{ old('nama', $user->nama) }}" />
      </div>
      <div class="mb-3">
        <label class="form-label" for="telp">Username *</label>
        <input class="form-control" id="telp" name="telp" type="text" placeholder="masukan username"
          value="{{ old('telp', $user->telp) }}" />
      </div>
      <div class="mb-3">
        <label class="form-label" for="password">
          Password
          <small>(Kosongkan saja jika tidak ingin diubah)</small>
        </label>
        <input class="form-control" id="password" name="password" type="password" value="{{ old('password') }}" />
      </div>
      <div class="mb-3">
        <label class="form-label" for="password_confirmation">Konfirmasi Password</label>
        <input class="form-control" id="password_confirmation" name="password_confirmation" type="password"
          value="{{ old('password_confirmation') }}" />
      </div>
      <div class="mb-3">
        <label class="form-label" for="foto">
          Foto
          <small>(Kosongkan saja jika tidak ingin diubah)</small>
        </label>
        <input class="form-control" id="foto" name="foto" type="file" accept="image/*" />
      </div>
      @if ($user->gambar)
      <div class="mb-3">
        <div class="row">
          <div class="col-md-4">
            <img src="{{ asset('storage/uploads/' . $user->gambar) }}" alt="{{ $user->nama }}" class="w-100 rounded">
          </div>
        </div>
      </div>
      @endif
    </div>
    <div class="card-footer border-top text-end">
      <button type="submit" class="btn btn-falcon-primary">
        <span class="fas fa-paper-plane fs--2 me-1"></span> Perbarui Profile
      </button>
    </div>
  </form>
</div>
@endsection