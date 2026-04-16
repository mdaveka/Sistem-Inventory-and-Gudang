<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Gudang</title>
</head>
<body>
    <h1>Daftar Gudang</h1>
    
    <a href="{{ route('gudang.create') }}">Tambah Gudang Baru</a>
    
    <table border="1" cellpadding="10" cellspacing="0" style="margin-top: 15px;">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Gudang</th>
                <th>Lokasi</th>
                <th>Kapasitas</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($gudangs as $gudang)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $gudang->nama_gudang }}</td>
                <td>{{ $gudang->lokasi }}</td>
                <td>{{ $gudang->kapasitas }}</td>
                <td>
                    <a href="{{ route('gudang.edit', $gudang->id) }}">Edit</a>
                    
                    <form action="{{ route('gudang.destroy', $gudang->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Yakin mau hapus gudang ini?')">Hapus</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" style="text-align: center;">Belum ada data gudang.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>