@extends('sekuriti.dashboard.layouts.main')

@section('container')

<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h3 class="text-themecolor">Edit Paket</h3>
    </div>
</div>

<div class="col-lg-8">
<form method="post" action="/sekuriti/dashboard/paket/{{ $paket->id }}">
  @method('PUT')
  @csrf
  <div class="form-group">
    <label for="awb">Nomor Resi</label>
    <input type="text" class="form-control" id="awb" name="awb" value="{{ $paket->awb}}">
  </div>
  <div class="form-group">
    <label for="ekspedisi_id">Ekspedisi</label>
    <select class="form-control" id="ekspedisi" name="ekspedisi" required>
      @foreach ($ekspedisis as $ekspedisi)
          <option
            value="{{ $ekspedisi->id }}" {{ $paket->ekspedisi == $ekspedisi->id ? 'selected' : '' }}>{{ $ekspedisi->jenis_ekspedisi }}</option>
      @endforeach
    </select>
  </div>
  <div class="form-group">
      <label for="nama">Nama</label>
      <input type="text" class="form-control" id="nama" name="nama" value="{{ $paket->nama }}">
  </div>
  <div class="form-group">
      <label for="nomor_telepon">Nomor Telepon</label>
      <input type="text" class="form-control" id="no_telepon" name="no_telepon" value="{{ $paket->no_telepon}}" required>
  </div>
  <div class="form-group">
      <label for="no_rak">Nomor Rak</label>
      <input type="text" class="form-control" id="no_rak" name="no_rak" value="{{ $paket->no_rak }}" required>
  </div>
  <div class="form-group>
    <label for="status">Status</label>
    <select class="form-control" id="status" name="status" required>
        <option value="belum diambil" {{ $paket->status == 'belum diambil' ? 'selected' : '' }}>Belum Diambil</option>
        <option value="sudah diambil" {{ $paket->status == 'sudah diambil' ? 'selected' : '' }}>Sudah Diambil</option>
    </select>
  </div>
  
  <button type="submit" class="btn btn-primary">Edit Paket</button>
</form>
</div>

@endsection