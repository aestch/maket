@extends('kurir.dashboard.layouts.main')

@section('container')

<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h3 class="text-themecolor">Tambah Paket Baru</h3>
    </div>
</div>

<div class="col-lg-8">
  <form method="POST" action="{{ route('kurir.paket.store') }}">
    @csrf
    <div class="form-group">
        <label for="awb">Nomor Resi</label>
        <input type="text" class="form-control" id="awb" name="awb" required>
        
    </div>
    <div class="form-group">
      <label for="ekspedisi_id">Ekspedisi</label>
      <select class="form-control" id="ekspedisi" name="ekspedisi" required>
        @foreach ($ekspedisis as $ekspedisi)
            <option
              value="{{ $ekspedisi->id }}">{{ $ekspedisi->jenis_ekspedisi }}</option>
        @endforeach
      </select>
      <button type="button" id="cekResiButton" class="btn btn-primary">Cek Resi</button>
    </div>
    <div class="form-group">
        <label for="nama">Nama</label>
        <input type="text" class="form-control" id="nama" name="nama" disabled>
    </div>
    <div class="form-group">
        <label for="nomor_telepon">Nomor Telepon</label>
        <input type="text" class="form-control" id="no_telepon" name="no_telepon" required>
    </div>
    <div class="form-group">
        <label for="no_rak">Nomor Rak</label>
        <input type="text" class="form-control" id="no_rak" name="no_rak" required>
    </div>
    <div class="form-group disable">
      <label for="status">Status</label>
      <select class="form-control" id="status" name="status" required>
          <option value="belum diambil">Belum Diambil</option>
          <option value="sudah diambil">Sudah Diambil</option>
      </select>
    </div>
    
    <button type="submit" id="tambahPaketButton" class="btn btn-success">Tambah Paket</button>
</form>
</div>

<script>
  document.getElementById('cekResiButton').addEventListener('click', function() {
    var awb = document.getElementById('awb').value;
    var courier = document.getElementById('ekspedisi').value;
    fetch('{{ route('kurir.cek-resi') }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({ awb: awb, courier: courier })
        
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok: ' + response.statusText);
        }
        return response.json();
    })
    .then(data => {
        if (data.status === 'success') {
            document.getElementById('nama').value = data.nama;
        } else {
            alert(data.message || 'Resi tidak ditemukan');
        }
    })
    .catch(error => {
        console.error('There was a problem with the fetch operation:', error);
        alert('Terjadi kesalahan pada server, coba lagi nanti.');
    
    });
});

// WHATSAPP MESSAGE
  document.getElementById('tambahPaketButton').addEventListener('click', function() {
    var target = document.getElementById('no_telepon').value;
    var nama = document.getElementById('nama').value;
    fetch('{{ route('kurir.paket.store') }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({ target: target , nama : nama })
        
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok: ' + response.statusText);
        }
        return response.json();
    })
    
});
</script>

@endsection