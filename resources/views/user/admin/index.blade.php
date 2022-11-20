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
        <p class="mb-0">Admin</p>
      </div>
    </div>
  </div>
</div>
<div class="card">
  <div class="card-header">
    <h5 class="float-start">Tabel Admin</h5>
    <a href="{{ url('admin/create') }}" class="btn btn-outline-primary btn-sm float-end">
      <i class="fas fa-plus"></i> Tambah
    </a>
  </div>
  <div class="card-body p-0">
    <div class="table-responsive scrollbar">
      <table class="table table-bordered table-striped">
        <thead class="bg-200 text-900">
          <tr>
            <th class="text-center">No.</th>
            <th>Nama</th>
            <th class="text-center">Opsi</th>
          </tr>
        </thead>
        <tbody class="list">
          @foreach ($users as $user)
          <tr>
            <td class="text-center">{{ $loop->iteration }}</td>
            <td>{{ $user->nama }}</td>
            <td class="text-center">
              <a href="" class="btn btn-warning btn-sm">
                <i class="fas fa-pen"></i> Edit
              </a>
              <a href="" class="btn btn-danger btn-sm">
                <i class="fas fa-trash"></i> Hapus
              </a>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>
@endsection