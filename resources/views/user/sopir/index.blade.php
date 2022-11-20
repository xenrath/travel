@extends('layout.main')

@section('title', 'Data Sopir')

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
        <p class="mb-0">Tabel</p>
      </div>
    </div>
  </div>
</div>
@if (session('status'))
<div class="alert alert-success border-2 d-flex align-items-center" role="alert">
  <div class="bg-success me-3 icon-item">
    <span class="fas fa-check-circle text-white fs-3"></span>
  </div>
  <p class="mb-0 flex-1">{{ session('status') }}</p>
  <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif
<div class="card">
  <div class="card-header">
    <h5 class="float-start">Tabel Sopir</h5>
    <a href="{{ url('sopir/create') }}" class="btn btn-outline-primary btn-sm float-end">
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
              <a href="{{ url('sopir/' . $user->id) }}" class="btn btn-info btn-sm">
                <i class="fas fa-eye"></i> Lihat
              </a>
              <a href="{{ url('sopir/' . $user->id . '/edit') }}" class="btn btn-warning btn-sm">
                <i class="fas fa-pen"></i> Edit
              </a>
              <a href="" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                data-bs-target="#modalHapus{{ $user->id }}">
                <i class="fas fa-trash"></i> Hapus
              </a>
              <div class="modal fade" id="modalHapus{{ $user->id }}" data-bs-keyboard="false" data-bs-backdrop="static"
                tabindex="-1" aria-hidden="true">
                <div class="modal-dialog mt-6" role="document">
                  <div class="modal-content border-0">
                    <div class="position-absolute top-0 end-0 mt-3 me-3 z-index-1">
                      <button class="btn-close btn btn-sm btn-circle d-flex flex-center transition-base"
                        data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body p-0">
                      <div class="bg-light rounded-top-lg py-3 ps-4 pe-6 text-start">
                        <h4 class="mb-3">Hapus</h4>
                        <h5 class="fs-0 fw-normal">Yakin hapus sopir
                          <strong>{{ $user->nama }}?</strong>
                        </h5>
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Batal</button>
                      <button class="btn btn-primary" type="button"
                        onclick="event.preventDefault(); document.getElementById('delete{{ $user->id }}').submit();">Hapus</button>
                      <form action="{{ url('sopir/' . $user->id) }}" method="POST" id="delete{{ $user->id }}">
                        @csrf
                        @method('delete')
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>
@endsection