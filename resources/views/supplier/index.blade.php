@extends('layouts.app')

@section('title', 'Data Supplier')
@section('page_title', 'Daftar Supplier')
@section('page_subtitle', 'Kelola data pemasok barang untuk transaksi barang masuk.')

@section('page_actions')
<a href="{{ route('supplier.create') }}" class="btn btn-primary">+ Tambah Supplier</a>
@endsection

@section('content')
<div class="card table-card">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead>
                    <tr>
                        <th class="ps-4">No</th>
                        <th>Nama Supplier</th>
                        <th>No Telepon</th>
                        <th>Alamat</th>
                        <th class="text-end pe-4">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($suppliers as $supplier)
                        <tr>
                            <td class="ps-4">{{ $loop->iteration }}</td>
                            <td class="fw-semibold">{{ $supplier->nama_supplier }}</td>
                            <td>{{ $supplier->no_telepon ?: '-' }}</td>
                            <td>{{ $supplier->alamat ?: '-' }}</td>
                            <td class="text-end pe-4">
                                <a href="{{ route('supplier.edit', $supplier->id) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                                <form action="{{ route('supplier.destroy', $supplier->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Yakin mau hapus data ini?')">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="empty-state">Belum ada data supplier.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
