@extends('layout.main')

@section('title', 'Dashboard')

@section('content')
  <div class="card">
    <div class="card-body text-center p-5">
      <h3>Selamat Datang <strong>{{ ucfirst(auth()->user()->nama) }}</strong></h3>
      <h6>Anda login sebagai {{ ucfirst(auth()->user()->role) }}</h6>
    </div>
  </div>
@endsection
