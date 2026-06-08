<!DOCTYPE html>
<html lang="id">
<head>
    <title>Halaman Pembayaran</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light"><div class="container mt-5" style="max-width: 600px;"><div class="card shadow"><div class="card-header bg-primary text-white text-center"><h4>Invoice Pembayaran</h4></div><div class="card-body">
    <h5>Detail Kendaraan:</h5>
    <table class="table table-sm table-borderless">
        <tr><td>Nama Mobil</td><td>: <strong>{{ $dataSewa['nama_mobil'] }}</strong></td></tr>
        <tr><td>Merek / Plat</td><td>: {{ $dataSewa['merek'] }} / {{ $dataSewa['plat_nomor'] }}</td></tr>
        <tr><td>Tarif Dasar</td><td>: Rp {{ number_format($dataSewa['harga_per_hari'], 0, ',', '.') }} / Hari</td></tr>
    </table><hr>
    <h5>Detail Sewa:</h5>
    <table class="table table-sm table-borderless">
        <tr><td>Tanggal Mulai</td><td>: {{ $dataSewa['tanggal_sewa'] }}</td></tr>
        <tr><td>Tanggal Kembali</td><td>: {{ $dataSewa['tanggal_kembali'] }}</td></tr>
        <tr><td>Durasi Sewa</td><td>: <strong>{{ $dataSewa['durasi_hari'] }} Hari</strong></td></tr>
        <tr class="table-warning"><td><h5 class="mb-0 text-danger">Total Bayar</h5></td><td><h5 class="mb-0 text-danger">: Rp {{ number_format($dataSewa['total_harga'], 0, ',', '.') }}</h5></td></tr>
    </table><hr>
    <div class="alert alert-info">
        <h6>Metode Pembayaran Transfer Bank:</h6>
        <p class="mb-1"><strong>Bank BCA:</strong> 123-4567-890 (A/N PT. Semob Jaya)</p>
    </div>
    <form action="{{ route('sewa.store') }}" method="POST" class="mt-4">@csrf
        <input type="hidden" name="mobil_id" value="{{ $dataSewa['mobil_id'] }}">
        <input type="hidden" name="tanggal_sewa" value="{{ $dataSewa['tanggal_sewa'] }}">
        <input type="hidden" name="tanggal_kembali" value="{{ $dataSewa['tanggal_kembali'] }}">
        <input type="hidden" name="total_harga" value="{{ $dataSewa['total_harga'] }}">
        <div class="d-flex justify-content-between">
            <a href="{{ url('/user/dashboard') }}" class="btn btn-secondary">Batal Sewa</a>
            <button type="submit" class="btn btn-success" onclick="return confirm('Apakah Anda sudah transfer?')">Saya Sudah Bayar</button>
        </div>
    </form>
</div></div></div></body>
</html>