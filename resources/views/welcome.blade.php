@extends('layouts.app')

@section('title', 'Dashboard Inventory')
@section('page_title', 'Dashboard Inventory')
@section('page_subtitle', 'Ringkasan akses cepat untuk data barang, supplier, gudang, dan transaksi stok.')

@section('page_actions')
<div class="d-flex gap-2">
    <a href="{{ route('barang-masuk.create') }}" class="btn btn-primary">+ Barang Masuk</a>
    <a href="{{ route('barang-keluar.create') }}" class="btn btn-outline-danger">- Barang Keluar</a>
</div>
@endsection

@section('content')
<div class="row g-4 mb-4">
    <div class="col-md-6 col-xl-3">
        <div class="card stat-card h-100">
            <div class="card-body d-flex gap-3 align-items-center">
                <div class="icon">📦</div>
                <div>
                    <div class="text-muted small">Master Data</div>
                    <h5 class="mb-0">Barang</h5>
                </div>
            </div>
            <div class="card-footer bg-white border-0 pt-0">
                <a href="{{ url('/barang') }}" class="btn btn-sm btn-outline-primary w-100">Lihat Data</a>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-xl-3">
        <div class="card stat-card h-100">
            <div class="card-body d-flex gap-3 align-items-center">
                <div class="icon">🚚</div>
                <div>
                    <div class="text-muted small">Mitra Barang</div>
                    <h5 class="mb-0">Supplier</h5>
                </div>
            </div>
            <div class="card-footer bg-white border-0 pt-0">
                <a href="{{ route('supplier.index') }}" class="btn btn-sm btn-outline-primary w-100">Kelola Supplier</a>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-xl-3">
        <div class="card stat-card h-100">
            <div class="card-body d-flex gap-3 align-items-center">
                <div class="icon">🏬</div>
                <div>
                    <div class="text-muted small">Lokasi Stok</div>
                    <h5 class="mb-0">Gudang</h5>
                </div>
            </div>
            <div class="card-footer bg-white border-0 pt-0">
                <a href="{{ route('gudang.index') }}" class="btn btn-sm btn-outline-primary w-100">Kelola Gudang</a>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-xl-3">
        <div class="card stat-card h-100">
            <div class="card-body d-flex gap-3 align-items-center">
                <div class="icon">📤</div>
                <div>
                    <div class="text-muted small">Transaksi</div>
                    <h5 class="mb-0">Barang Keluar</h5>
                </div>
            </div>
            <div class="card-footer bg-white border-0 pt-0">
                <a href="{{ route('barang-keluar.index') }}" class="btn btn-sm btn-outline-primary w-100">Lihat Riwayat</a>
            </div>
        </div>
    </div>
</div>

<div class="card table-card">
    <div class="card-body p-4">
        <h5 class="fw-bold mb-2">Alur penggunaan</h5>
        <p class="text-muted mb-4">Mulai dari master data, lalu input transaksi masuk/keluar agar stok barang terupdate otomatis.</p>
        <div class="row g-3">
            <div class="col-md-3"><div class="p-3 rounded-4 bg-light h-100"><strong>1. Barang</strong><br><span class="text-muted small">Cek master stok barang.</span></div></div>
            <div class="col-md-3"><div class="p-3 rounded-4 bg-light h-100"><strong>2. Supplier</strong><br><span class="text-muted small">Kelola pemasok barang.</span></div></div>
            <div class="col-md-3"><div class="p-3 rounded-4 bg-light h-100"><strong>3. Gudang</strong><br><span class="text-muted small">Kelola lokasi penyimpanan.</span></div></div>
            <div class="col-md-3"><div class="p-3 rounded-4 bg-light h-100"><strong>4. Transaksi</strong><br><span class="text-muted small">Input masuk/keluar stok.</span></div></div>
        </div>
    </div>
</div>
@endsection
