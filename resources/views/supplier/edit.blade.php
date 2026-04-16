<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Supplier</title>
</head>
<body>
    <h1>Edit Data Supplier</h1>
    
    <a href="{{ route('supplier.index') }}">Kembali ke Daftar</a>
    <br><br>

    <form action="{{ route('supplier.update', $supplier->id) }}" method="POST">
        @csrf 
        @method('PUT') <label>Nama Supplier:</label><br>
        <input type="text" name="nama_supplier" value="{{ $supplier->nama_supplier }}" required><br><br>

        <label>No Telepon:</label><br>
        <input type="text" name="no_telepon" value="{{ $supplier->no_telepon }}"><br><br>

        <label>Alamat:</label><br>
        <textarea name="alamat">{{ $supplier->alamat }}</textarea><br><br>

        <button type="submit">Update Data</button>
    </form>
</body>
</html>