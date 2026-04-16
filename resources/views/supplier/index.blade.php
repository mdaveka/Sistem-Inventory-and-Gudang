<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Supplier</title>
</head>
<body>
    <h1>Daftar Supplier</h1>
    
    <a href="{{ route('supplier.create') }}">Tambah Supplier Baru</a>
    
    <table border="1" cellpadding="10" cellspacing="0" style="margin-top: 15px;">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Supplier</th>
                <th>No Telepon</th>
                <th>Alamat</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($suppliers as $supplier)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $supplier->nama_supplier }}</td>
                <td>{{ $supplier->no_telepon }}</td>
                <td>{{ $supplier->alamat }}</td>
                <td>
                    <a href="{{ route('supplier.edit', $supplier->id) }}">Edit</a>
                    
                    <form action="{{ route('supplier.destroy', $supplier->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Yakin mau hapus data ini?')">Hapus</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" style="text-align: center;">Belum ada data supplier.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>