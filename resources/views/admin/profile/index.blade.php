@extends('layout.main')

@section('title', 'Data Produk')

@section('content')
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
<div class="card mb-3">
  <div class="card-header">
    <div class="row align-items-center">
      <div class="col">
        <h5 class="mb-0">Profile Perusahaan</h5>
      </div>
    </div>
  </div>
  <div class="card-body bg-light border-top">
    <form action="{{ url('admin/profile') }}" method="post" autocomplete="off">
      @csrf
      <div class="row mb-3">
        <label class="col-sm-3 col-form-label" for="nama">Nama Perusahaan</label>
        <div class="col-sm-9">
          <input class="form-control" id="nama" type="text" name="nama" />
        </div>
      </div>
      <div class="row mb-3">
        <label class="col-sm-3 col-form-label" for="alamat">Alamat Kantor</label>
        <div class="col-sm-9">
          <textarea class="form-control" name="alamat" id="" cols="30" rows="10"></textarea>
        </div>
      </div>
      <div class="row mb-3">
        <label class="col-sm-3 col-form-label" for="telp">Nomor Telepon</label>
        <div class="col-sm-9">
          <input class="form-control" id="telp" type="text" name="telp" />
        </div>
      </div>
      <div class="row mb-3">
        <label class="col-sm-3 col-form-label" for="email">Email</label>
        <div class="col-sm-9">
          <input class="form-control" id="email" type="text" name="email" />
        </div>
      </div>
    </form>
  </div>
  <div class="card-footer border-top text-end">
    <a class="btn btn-falcon-primary" href="#!">
      <span class="fas fa-paper-plane fs--2 me-1"></span> Perbarui Profile
    </a>
  </div>
</div>
@endsection