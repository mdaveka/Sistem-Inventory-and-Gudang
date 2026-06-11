@extends('layouts.app')

@section('title', 'Riwayat Barang Keluar')
@section('page_title', 'Riwayat Barang Keluar')
@section('page_subtitle', 'Daftar transaksi barang keluar yang sudah tercatat.')

@section('page_actions')
<div class="d-flex flex-wrap gap-2">
    <a href="{{ url('/barang') }}" class="btn btn-outline-secondary">Data Barang</a>
    <a href="{{ route('barang-keluar.create') }}" class="btn btn-danger">+ Input Barang Keluar</a>
</div>
@endsection

@section('content')
<div class="card table-card">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead>
                    <tr>
                        <th class="ps-4">No</th>
                        <th>Nama Barang</th>
                        <th>Jumlah Keluar</th>
                        <th>Tanggal</th>
                        <th>Tujuan</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($barang_keluars as $index => $bk)
                        <tr>
                            <td class="ps-4">{{ $index + 1 }}</td>
                            <td class="fw-semibold">{{ $bk->barang->nama_barang }}</td>
                            <td><span class="badge text-bg-danger rounded-pill">{{ $bk->jumlah }} keluar</span></td>
                            <td>{{ $bk->tanggal_keluar }}</td>
                            <td>{{ $bk->tujuan }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="empty-state">Belum ada riwayat barang keluar.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
