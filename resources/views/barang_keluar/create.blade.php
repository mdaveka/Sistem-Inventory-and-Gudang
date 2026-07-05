@extends('layouts.app')

@section('title', 'Input Barang Keluar')
@section('page_title', 'Input Barang Keluar')
@section('page_subtitle', 'Catat transaksi barang keluar agar stok berkurang otomatis.')

@section('page_actions')
<a href="{{ route('barang-keluar.index') }}" class="btn btn-outline-secondary">Riwayat Barang Keluar</a>
@endsection

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card form-card border-danger">
            <div class="card-header bg-danger text-white rounded-top-4">
                <h5 class="mb-0">Form Input Barang Keluar</h5>
            </div>
            <div class="card-body p-4">
                <form action="{{ route('barang-keluar.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Pilih Barang</label>
                        <select name="barang_id" class="form-select" required>
                            <option value="">-- Pilih Barang --</option>
                            @foreach($barangs as $b)
                                <option value="{{ $b->id }}" {{ old('barang_id') == $b->id ? 'selected' : '' }}>
                                    {{ $b->nama_barang }} (Stok: {{ $b->stok }})
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Jumlah Keluar</label>
                        <input type="number" name="jumlah" class="form-control" value="{{ old('jumlah') }}" min="1" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Tanggal Keluar</label>
                        <input type="date" name="tanggal_keluar" class="form-control" value="{{ old('tanggal_keluar') }}" required>
                    </div>
                    <div class="mb-4">
                        <label class="form-label">Tujuan</label>
                        <input type="text" name="tujuan" class="form-control" value="{{ old('tujuan') }}" placeholder="Contoh: Divisi IT" required>
                    </div>
                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-danger">Keluarkan Barang</button>
                        <a href="{{ url('/barang') }}" class="btn btn-light">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
