@extends('dashboard.layouts.main')

@section('container')

<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h3 class="text-themecolor">Tambah Paket Baru</h3>
    </div>
</div>

<div class="col-lg-8">
<form method="post" action="/dashboard/paket">
  @csrf
  @method('POST')
  <div class="mb-3">
    <label for="pemilik" class="form-label">Nama Pemilik Paket</label>
    <input type="text" class="form-control" id="pemilik" name="pemilik" required>
  </div>
  <div class="mb-3">
    <label for="no_rak" class="form-label">No Rak</label>
    <input type="text" class="form-control" id="no_rak" name="no_rak" required>
  </div>
  <div class="mb-3">
    <label for="instansi" class="form-label">Ekspedisi</label>
    <input type="text" class="form-control" id="instansi" name="instansi" required>
  </div>
  <div class="mb-3">
    <label for="keterangan" class="form-label">Keterangan</label>
    <input type="text" class="form-control" id="keterangan" name="keterangan">
  </div>
  
  <button type="submit" class="btn btn-primary">Tambah Paket</button>
</form>
</div>

@endsection