<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Supplier</title>
</head>
<body>
    <h1>Tambah Data Supplier Baru</h1>
    
    <a href="{{ route('supplier.index') }}">Kembali ke Daftar</a>
    <br><br>

    <form action="{{ route('supplier.store') }}" method="POST">
        @csrf <label>Nama Supplier:</label><br>
        <input type="text" name="nama_supplier" required><br><br>

        <label>No Telepon:</label><br>
        <input type="text" name="no_telepon"><br><br>

        <label>Alamat:</label><br>
        <textarea name="alamat"></textarea><br><br>

        <button type="submit">Simpan Data</button>
    </form>
</body>
</html>