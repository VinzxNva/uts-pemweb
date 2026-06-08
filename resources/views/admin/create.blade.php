<!DOCTYPE html>
<html>
<head>
    <title>Tambah Mobil</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light"><div class="container mt-5" style="max-width: 500px;"><div class="card shadow-sm"><div class="card-body">
    <h4>Form Tambah Mobil</h4><hr>
    <form action="{{ route('mobil.store') }}" method="POST">@csrf
        <div class="mb-3"><label class="form-label">Nama Mobil</label><input type="text" name="nama_mobil" class="form-control" required></div>
        <div class="mb-3"><label class="form-label">Merek</label><input type="text" name="merek" class="form-control" required></div>
        <div class="mb-3"><label class="form-label">Plat Nomor</label><input type="text" name="plat_nomor" class="form-control" required></div>
        <div class="mb-3"><label class="form-label">Harga Sewa / Hari</label><input type="number" name="harga_per_hari" class="form-control" required></div>
        <button type="submit" class="btn btn-success w-100">Simpan Mobil</button>
    </form>
</div></div></div></body>
</html>