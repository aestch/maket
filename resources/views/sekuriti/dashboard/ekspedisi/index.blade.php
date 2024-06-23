@extends('sekuriti.dashboard.layouts.main')

@section('container')

<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h3 class="text-themecolor">Daftar Ekspedisi</h3>
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
    <a href="/sekuriti/dashboard/ekspedisi/create" role="button" class="btn btn-primary float-right">Tambah Ekspedisi Baru</a>
  <table class="table table-striped table-bordered align-middle table-xl table-hover">
    <thead>
      <tr>
        <th scope="col">No</th>
        <th scope="col">Nama Ekspedisi</th>
        <th scope="col">Courier</th>
        <th scope="col">Aksi</th>
      </tr>
    </thead>
    <tbody class="table-group-divider">
      @foreach ( $ekspedisis as $ekspedisi)
      <tr>
          <td>{{ $loop->iteration }}</td>
          <td>{{ $ekspedisi->jenis_ekspedisi }}</td>
          <td>{{ $ekspedisi->courier }}</td>
          <td>
            <a href="/sekuriti/dashboard/ekspedisi/{{ $ekspedisi->id }}/edit" class="btn btn-warning">Edit</a>
            <a href="/sekuriti/dashboard/ekspedisi/{{ $ekspedisi->id }}/delete" class="btn btn-danger">Delete</a>
          </td>
      </tr>    
      @endforeach
    </tbody>
  </table>
</div>


@endsection