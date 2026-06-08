<!DOCTYPE html>
<html lang="id">
<head>
    <title>Katalog Mobil</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <nav class="navbar navbar-dark bg-primary px-4">
        <span class="navbar-brand">Katalog Rental Mobil (Pelanggan)</span>
        <form action="{{ route('logout') }}" method="POST">@csrf<button class="btn btn-outline-light btn-sm">Logout</button></form>
    </nav>
    <div class="container mt-4">
        @if(session('sukses')) <div class="alert alert-success shadow-sm">{{ session('sukses') }}</div> @endif
        <h3 class="mb-4">Daftar Mobil yang Tersedia</h3>
        <div class="row">
            @forelse($daftarMobil as $m)
            <div class="col-md-4 mb-4">
                <div class="card shadow-sm h-100">
                    <div class="card-body">
                        <h5 class="card-title">{{ $m->nama_mobil }}</h5>
                        <p class="text-muted mb-1">Merek: {{ $m->merek }}</p>
                        <p class="text-muted mb-1">Plat: <strong>{{ $m->plat_nomor }}</strong></p>
                        <h6 class="text-primary mt-2">Rp {{ number_format($m->harga_per_hari, 0, ',', '.') }} / Hari</h6><hr>
                        <form action="{{ route('sewa.pembayaran') }}" method="POST">@csrf
                            <input type="hidden" name="mobil_id" value="{{ $m->id }}">
                            <div class="mb-2"><label class="small text-secondary">Tgl Mulai Sewa</label><input type="date" name="tanggal_sewa" class="form-control form-control-sm" required></div>
                            <div class="mb-3"><label class="small text-secondary">Tgl Kembali</label><input type="date" name="tanggal_kembali" class="form-control form-control-sm" required></div>
                            <button type="submit" class="btn btn-success btn-sm w-100">Sewa Mobil Ini</button>
                        </form>
                    </div>
                </div>
            </div>
            @empty
            <p class="text-muted text-center w-100">Saat ini belum ada mobil yang tersedia.</p>
            @endforelse
        </div>
    </div>
</body>
</html>