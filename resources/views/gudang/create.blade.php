<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Gudang</title>
</head>
<body>
    <h1>Tambah Data Gudang Baru</h1>
    
    <a href="{{ route('gudang.index') }}">Kembali ke Daftar</a>
    <br><br>

    <form action="{{ route('gudang.store') }}" method="POST">
        @csrf 
        
        <label>Nama Gudang:</label><br>
        <input type="text" name="nama_gudang" required><br><br>

        <label>Lokasi:</label><br>
        <input type="text" name="lokasi" required><br><br>

        <label>Kapasitas (Jumlah Barang):</label><br>
        <input type="number" name="kapasitas" required><br><br>

        <button type="submit">Simpan Data</button>
    </form>
</body>
</html>