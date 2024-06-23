@extends('sekuriti.dashboard.layouts.main')

@section('container')

<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h3 class="text-themecolor">Tambah Ekspedisi Baru</h3>
    </div>
</div>

<div class="col-lg-8">
  <form id="paketForm" method="POST" action="{{ route('sekuriti.ekspedisi.store') }}">
    @csrf
    <div class="form-group">
        <label for="jenis_ekspedisi">Nama Ekspedisi</label>
        <input type="text" class="form-control" id="jenis_ekspedisi" name="jenis_ekspedisi"  required>
    </div>
    <div class="form-group">
        <label for="courier">Courier</label>
        <input type="text" class="form-control" id="courier" name="courier" autocapitalize="off">
    </div>
    <button type="submit" id="tambahEkspedisiButton" class="btn btn-success">Tambah Ekspedisi</button>
</form>
</div>

@endsection