<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Gudang</title>
</head>
<body>
    <h1>Edit Data Gudang</h1>
    
    <a href="{{ route('gudang.index') }}">Kembali ke Daftar</a>
    <br><br>

    <form action="{{ route('gudang.update', $gudang->id) }}" method="POST">
        @csrf 
        @method('PUT')
        
        <label>Nama Gudang:</label><br>
        <input type="text" name="nama_gudang" value="{{ $gudang->nama_gudang }}" required><br><br>

        <label>Lokasi:</label><br>
        <input type="text" name="lokasi" value="{{ $gudang->lokasi }}" required><br><br>

        <label>Kapasitas (Jumlah Barang):</label><br>
        <input type="number" name="kapasitas" value="{{ $gudang->kapasitas }}" required><br><br>

        <button type="submit">Update Data</button>
    </form>
</body>
</html>