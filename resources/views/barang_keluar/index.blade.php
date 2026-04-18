<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Barang Keluar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4>Riwayat Barang Keluar</h4>
        <div>
            <a href="/barang" class="btn btn-secondary">Data Barang</a>
            <a href="/barang-keluar/create" class="btn btn-danger">+ Input Barang Keluar</a>
        </div>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <table class="table table-bordered table-hover">
                <thead class="table-danger">
                    <tr>
                        <th>No</th>
                        <th>Nama Barang</th>
                        <th>Jumlah Keluar</th>
                        <th>Tanggal</th>
                        <th>Tujuan</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($barang_keluars as $index => $bk)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $bk->barang->nama_barang }}</td>
                        <td>{{ $bk->jumlah }}</td>
                        <td>{{ $bk->tanggal_keluar }}</td>
                        <td><strong>{{ $bk->tujuan }}</strong></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

</body>
</html>