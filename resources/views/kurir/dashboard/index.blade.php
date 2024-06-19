@extends('kurir.dashboard.layouts.main')

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
    <a href="/kurir/dashboard/paket/create" role="button" class="btn btn-primary float-right">Tambah Paket Baru</a>
    <table class="table table-striped table-bordered align-middle table-xl table-hover">
      <thead>
        <tr>
          <th scope="col">No</th>
          <th scope="col">Nama</th>
          <th scope="col">Ekspedisi</th>
          <th scope="col">Di Rak</th>
          <th scope="col">waktu Datang</th>
          <th scope="col">Status</th>
        </tr>
      </thead>
      <tbody class="table-group-divider">
        @foreach ( $pakets as $paket)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $paket->nama }}</td>
            <td>{{ $paket->jenis_ekspedisi }}</td>
            <td>{{ $paket->no_rak }}</td>
            <td class="{{ $paket->status == 'belum diambil' ? 'status-belum-diambil' : 'status-sudah-diambil' }}">
              {{ $paket->status }}
            </td>
        </tr>    
        @endforeach
      </tbody>
    </table>
</div>


@endsection