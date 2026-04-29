@extends('layouts.app')

@section('title', 'Input Barang Masuk')
@section('page_title', 'Input Barang Masuk')
@section('page_subtitle', 'Catat transaksi barang masuk agar stok bertambah otomatis.')

@section('page_actions')
<a href="{{ url('/barang') }}" class="btn btn-outline-secondary">Kembali ke Data Barang</a>
@endsection

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card form-card">
            <div class="card-header bg-primary text-white rounded-top-4">
                <h5 class="mb-0">Form Input Barang Masuk</h5>
            </div>
            <div class="card-body p-4">
                <form action="{{ route('barang-masuk.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Pilih Barang</label>
                        <select name="barang_id" class="form-select" required>
                            <option value="">-- Pilih Barang --</option>
                            @foreach($barangs as $b)
                                <option value="{{ $b->id }}" {{ old('barang_id') == $b->id ? 'selected' : '' }}>
                                    {{ $b->nama_barang }} (Sisa Stok: {{ $b->stok }})
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Pilih Supplier</label>
                        <select name="supplier_id" class="form-select" required>
                            <option value="">-- Pilih Supplier --</option>
                            @foreach($suppliers as $s)
                                <option value="{{ $s->id }}" {{ old('supplier_id') == $s->id ? 'selected' : '' }}>{{ $s->nama_supplier }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Pilih Gudang Tujuan</label>
                        <select name="gudang_id" class="form-select" required>
                            <option value="">-- Pilih Gudang --</option>
                            @foreach($gudangs as $g)
                                <option value="{{ $g->id }}" {{ old('gudang_id') == $g->id ? 'selected' : '' }}>{{ $g->nama_gudang }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Jumlah Masuk</label>
                        <input type="number" name="jumlah" class="form-control" value="{{ old('jumlah') }}" min="1" placeholder="Contoh: 50" required>
                    </div>
                    <div class="mb-4">
                        <label class="form-label">Tanggal Masuk</label>
                        <input type="date" name="tanggal_masuk" class="form-control" value="{{ old('tanggal_masuk') }}" required>
                    </div>
                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary">Simpan Barang Masuk</button>
                        <a href="{{ url('/barang') }}" class="btn btn-light">Kembali ke Daftar Barang</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
