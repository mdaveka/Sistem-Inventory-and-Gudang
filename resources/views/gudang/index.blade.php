@extends('layouts.app')

@section('title', 'Data Gudang')
@section('page_title', 'Daftar Gudang')
@section('page_subtitle', 'Kelola lokasi penyimpanan dan kapasitas gudang.')

@section('page_actions')
<a href="{{ route('gudang.create') }}" class="btn btn-primary">+ Tambah Gudang</a>
@endsection

@section('content')
<div class="card table-card">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead>
                    <tr>
                        <th class="ps-4">No</th>
                        <th>Nama Gudang</th>
                        <th>Lokasi</th>
                        <th>Kapasitas</th>
                        <th class="text-end pe-4">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($gudangs as $gudang)
                        <tr>
                            <td class="ps-4">{{ $loop->iteration }}</td>
                            <td class="fw-semibold">{{ $gudang->nama_gudang }}</td>
                            <td>{{ $gudang->lokasi }}</td>
                            <td><span class="badge badge-soft rounded-pill">{{ number_format($gudang->kapasitas, 0, ',', '.') }} barang</span></td>
                            <td class="text-end pe-4">
                                <a href="{{ route('gudang.edit', $gudang->id) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                                <form action="{{ route('gudang.destroy', $gudang->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Yakin mau hapus gudang ini?')">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="empty-state">Belum ada data gudang.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
