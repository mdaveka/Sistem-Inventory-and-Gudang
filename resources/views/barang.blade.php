@extends('layouts.app')

@section('title', 'Data Barang')
@section('page_title', 'Data Barang')
@section('page_subtitle', 'Daftar master barang dan stok yang tersedia.')

@section('page_actions')
<div class="d-flex flex-wrap gap-2">
    <a href="{{ route('barang-masuk.create') }}" class="btn btn-primary">+ Barang Masuk</a>
    <a href="{{ route('barang-keluar.create') }}" class="btn btn-outline-danger">- Barang Keluar</a>
</div>
@endsection

@section('content')
<div class="card table-card">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead>
                    <tr>
                        <th class="ps-4">ID</th>
                        <th>Kode Barang</th>
                        <th>Nama Barang</th>
                        <th>Stok</th>
                        <th>Harga</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($barang as $b)
                        <tr>
                            <td class="ps-4">{{ $b->id }}</td>
                            <td><span class="badge badge-soft rounded-pill">{{ $b->kode_barang }}</span></td>
                            <td class="fw-semibold">{{ $b->nama_barang }}</td>
                            <td>
                                <span class="badge {{ $b->stok > 0 ? 'text-bg-success' : 'text-bg-danger' }} rounded-pill">
                                    {{ $b->stok }} stok
                                </span>
                            </td>
                            <td>Rp {{ number_format($b->harga, 0, ',', '.') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="empty-state">Belum ada data barang.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
