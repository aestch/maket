@extends('sekuriti.dashboard.layouts.main')

@section('container')

<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h3 class="text-themecolor">Daftar Paket yang sudah diambil</h3>
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
  <table class="table table-striped table-bordered align-middle table-xl table-hover">
    <thead>
      <tr>
        <th scope="col">No</th>
        <th scope="col">Nama</th>
        <th scope="col">Ekspedisi</th>
        <th scope="col">Di Rak</th>
        <th scope="col">Status</th>
        <th scope="col">Aksi</th>
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
          <td>
            <a href="/sekuriti/dashboard/paket/{{ $paket->id }}/edit" class="btn btn-warning">Edit</a>
            <a href="/sekuriti/dashboard/paket/{{ $paket->id }}/delete" class="btn btn-danger">Delete</a>
                  @if($paket->status == 'belum diambil')
                        <form action="{{ route('sekuriti.paket.updateStatus', $paket->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('PATCH')
                              <input type="hidden" name="status" value="sudah diambil">
                              <button type="submit" class="btn btn-success">Sudah Diambil</button>
                        </form>
                  @endif
          </td>
      </tr>    
      @endforeach
    </tbody>
  </table>
</div>


@endsection