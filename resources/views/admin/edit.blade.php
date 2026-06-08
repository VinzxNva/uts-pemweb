<!DOCTYPE html>
<html>
<head>
    <title>Edit Mobil</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light"><div class="container mt-5" style="max-width: 500px;"><div class="card shadow-sm"><div class="card-body">
    <h4>Form Edit Mobil</h4><hr>
    <form action="{{ route('mobil.update', $mobil->id) }}" method="POST">@csrf @method('PUT')
        <div class="mb-3"><label class="form-label">Nama Mobil</label><input type="text" name="nama_mobil" value="{{ $mobil->nama_mobil }}" class="form-control" required></div>
        <div class="mb-3"><label class="form-label">Merek</label><input type="text" name="merek" value="{{ $mobil->merek }}" class="form-control" required></div>
        <div class="mb-3"><label class="form-label">Plat Nomor</label><input type="text" name="plat_nomor" value="{{ $mobil->plat_nomor }}" class="form-control" required></div>
        <div class="mb-3"><label class="form-label">Harga Sewa / Hari</label><input type="number" name="harga_per_hari" value="{{ $mobil->harga_per_hari }}" class="form-control" required></div>
        <div class="mb-3"><label class="form-label">Status</label>
            <select name="status" class="form-select">
                <option value="tersedia" {{ $mobil->status == 'tersedia'?'selected':'' }}>Tersedia</option>
                <option value="disewa" {{ $mobil->status == 'disewa'?'selected':'' }}>Disewa</option>
            </select>
        </div>
        <button type="submit" class="btn btn-warning w-100">Simpan Perubahan</button>
    </form>
</div></div></div></body>
</html>