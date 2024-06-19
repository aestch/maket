@extends('home.homeMain')

@section('container-home')

<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h3 class="text-themecolor">Daftar Paket yang sudah diambil</h3>
    </div>
</div>


<div class="table-responsive">
  <table class="table table-striped table-bordered align-middle table-xl table-hover">
    <thead>
      <tr>
        <th scope="col">No</th>
        <th scope="col">Nama</th>
        <th scope="col">Ekspedisi</th>
        <th scope="col">Di Rak</th>
        <th scope="col">waktu ambil</th>
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
          <td>{{ $paket->updated_at }}</td>
          <td class="{{ $paket->status == 'belum diambil' ? 'status-belum-diambil' : 'status-sudah-diambil' }}">
            {{ $paket->status }}
          </td>
      </tr>    
      @endforeach
    </tbody>
  </table>
</div>


@endsection