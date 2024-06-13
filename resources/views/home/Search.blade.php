@extends('home.homeMain')

@section('container-home')


<div class="table-responsive">

  @if(isset($results))
            <h2 class="text-themecolor">Hasil Pencarian</h2>
            @if($results->isEmpty())
                <p>Tidak Ada Paket.</p>
            @else
            <table class="table table-striped table-bordered align-middle table-xl table-hover">
              <thead>
                <tr>
                  <th scope="col">No</th>
                  <th scope="col">Nama</th>
                  <th scope="col">Ekspedisi</th>
                  <th scope="col">Di Rak</th>
                  <th scope="col">Status</th>
                </tr>
              </thead>
              <tbody class="table-group-divider">
                @foreach ( $results as $paket)
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
            @endif
  @endif
    
    
</div>


@endsection