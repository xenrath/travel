@extends('layout.main')

@section('title', 'Data Admin')

@section('content')
<div class="card mb-3">
  <div class="bg-holder d-none d-lg-block bg-card"
    style="background-image:url({{ asset('falcon/public/assets/img/icons/spot-illustrations/corner-4.png') }});">
  </div>
  <!--/.bg-holder-->
  <div class="card-body position-relative">
    <div class="row">
      <div class="col-lg-8">
        <h3>Data Admin</h3>
        <p class="mb-0">Tambah</p>
      </div>
    </div>
  </div>
</div>
@endsection