@extends('dashboard.layouts.main')

@section('container')

<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h3 class="text-themecolor">Daftar Paket</h3>
    </div>
</div>

@if(session()->has('success'))  
  <div class="alert alert-success d-flex align-items-center" role="alert">
      <div class="bi bi-check-circle me-2">
        {{ session('success') }}
      </div>
  </div>
@endif
@if(session()->has('deleted'))  
  <div class="alert alert-warning d-flex align-items-center" role="alert">
      <div class="bi bi-check-circle me-2">
        {{ session('deleted') }}
      </div>
  </div>
@endif

<div class="table-responsive">
    <a href="/dashboard/paket/create" role="button" class="btn btn-primary float-right">Tambah Paket Baru</a>
    <table class="table table-striped table-xl table-hover">
      <thead>
        <tr>
          <th scope="col">No</th>
          <th scope="col">Pemilik</th>
          <th scope="col">Di Rak</th>
          <th scope="col">Ekspedisi</th>
          <th scope="col">Keterangan</th>
        </tr>
      </thead>
      <tbody>
        @foreach ( $pakets as $paket)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $paket->pemilik }}</td>
            <td>{{ $paket->no_rak }}</td>
            <td>{{ $paket->instansi }}</td>
            <td>{{ $paket->keterangan }}</td>
            <td>
                <a href="" class="badge bg-warning"><i class="bi bi-pencil-square"></i></a>
                <form action="/dashboard/paket/ {{ $paket->id }}" method="post" class="d-inline">
                    @csrf
                    @method ('delete')
                    <button class="badge bg-danger border-0 " onclick="return confirm('Yakin Hapus?')"><i class="bi bi-trash3"></i></button>
                </form>
            </td>
        </tr>    
        @endforeach
      </tbody>
    </table>
</div>


@endsection