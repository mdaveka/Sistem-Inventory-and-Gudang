@extends('layouts.app')

@section('title', 'Tambah Gudang')
@section('page_title', 'Tambah Gudang')
@section('page_subtitle', 'Input data gudang baru untuk lokasi penyimpanan barang.')

@section('page_actions')
<a href="{{ route('gudang.index') }}" class="btn btn-outline-secondary">Kembali</a>
@endsection

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card form-card">
            <div class="card-body p-4">
                <form action="{{ route('gudang.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Nama Gudang</label>
                        <input type="text" name="nama_gudang" class="form-control" value="{{ old('nama_gudang') }}" placeholder="Contoh: Gudang Utama" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Lokasi</label>
                        <input type="text" name="lokasi" class="form-control" value="{{ old('lokasi') }}" placeholder="Contoh: Jakarta" required>
                    </div>
                    <div class="mb-4">
                        <label class="form-label">Kapasitas</label>
                        <input type="number" name="kapasitas" class="form-control" value="{{ old('kapasitas') }}" min="0" placeholder="Jumlah maksimal barang" required>
                    </div>
                    <div class="d-flex justify-content-end gap-2">
                        <a href="{{ route('gudang.index') }}" class="btn btn-light">Batal</a>
                        <button type="submit" class="btn btn-primary">Simpan Data</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
