<!DOCTYPE html>
<html lang="id">
<head>
    <title>Dashboard Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <nav class="navbar navbar-dark bg-dark px-4">
        <span class="navbar-brand">Panel Admin - Sewa Mobil</span>
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button class="btn btn-outline-danger btn-sm">Logout</button>
        </form>
    </nav>
    <div class="container mt-4">
        @if(session('sukses')) 
            <div class="alert alert-success shadow-sm">{{ session('sukses') }}</div> 
        @endif
        
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h3>Manajemen Daftar Mobil</h3>
            <a href="{{ route('mobil.create') }}" class="btn btn-primary">+ Tambah Mobil</a>
        </div>
        <table class="table table-bordered bg-white mb-5 shadow-sm">
            <thead class="table-dark">
                <tr>
                    <th>No</th><th>Nama Mobil</th><th>Merek</th><th>Plat Nomor</th><th>Tarif/Hari</th><th>Status</th><th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($daftarMobil as $key => $m)
                <tr>
                    <td>{{ $key+1 }}</td><td>{{ $m->nama_mobil }}</td><td>{{ $m->merek }}</td><td>{{ $m->plat_nomor }}</td><td>Rp {{ number_format($m->harga_per_hari, 0, ',', '.') }}</td>
                    <td><span class="badge {{ $m->status=='tersedia'?'bg-success':'bg-danger' }}">{{ $m->status }}</span></td>
                    <td>
                        <a href="{{ route('mobil.edit', $m->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('mobil.destroy', $m->id) }}" method="POST" class="d-inline">
                            @csrf @method('DELETE')
                            <button class="btn btn-danger btn-sm" onclick="return confirm('Hapus mobil ini?')">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <h3>Daftar Penyewa (Transaksi Masuk)</h3>
        <table class="table table-striped bg-white shadow-sm">
            <thead class="table-secondary">
                <tr>
                    <th>Nama Pelanggan</th>
                    <th>Mobil Disewa</th>
                    <th>Mulai Sewa</th>
                    <th>Kembali</th>
                    <th>Total Biaya</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($daftarPenyewa as $p)
                <tr>
                    <td>{{ $p->user->name }}</td>
                    <td>{{ $p->mobil->nama_mobil }} ({{ $p->mobil->plat_nomor }})</td>
                    <td>{{ $p->tanggal_sewa }}</td>
                    <td>{{ $p->tanggal_kembali }}</td>
                    <td>Rp {{ number_format($p->total_harga, 0, ',', '.') }}</td>
                    <td>
                        <span class="badge {{ $p->status_pembayaran == 'lunas' ? 'bg-success' : 'bg-warning' }}">
                            {{ $p->status_pembayaran }}
                        </span>
                    </td>
                    <td>
                        @if($p->status_pembayaran == 'belum_bayar')
                        <form action="{{ route('sewa.selesai', $p->id) }}" method="POST" class="d-inline">
                            @csrf
                            <button class="btn btn-success btn-sm" onclick="return confirm('Konfirmasi bahwa mobil sudah kembali dan pembayaran lunas?')">
                                Selesai Sewa
                            </button>
                        </form>
                        @else
                        <span class="text-muted small">Transaksi Selesai</span>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>