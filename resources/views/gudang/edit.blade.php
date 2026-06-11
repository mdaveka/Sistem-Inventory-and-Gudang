@extends('layouts.app')

@section('title', 'Edit Gudang')
@section('page_title', 'Edit Gudang')
@section('page_subtitle', 'Perbarui data lokasi dan kapasitas gudang.')

@section('page_actions')
<a href="{{ route('gudang.index') }}" class="btn btn-outline-secondary">Kembali</a>
@endsection

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card form-card">
            <div class="card-body p-4">
                <form action="{{ route('gudang.update', $gudang->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label class="form-label">Nama Gudang</label>
                        <input type="text" name="nama_gudang" class="form-control" value="{{ old('nama_gudang', $gudang->nama_gudang) }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Lokasi</label>
                        <input type="text" name="lokasi" class="form-control" value="{{ old('lokasi', $gudang->lokasi) }}" required>
                    </div>
                    <div class="mb-4">
                        <label class="form-label">Kapasitas</label>
                        <input type="number" name="kapasitas" class="form-control" value="{{ old('kapasitas', $gudang->kapasitas) }}" min="0" required>
                    </div>
                    <div class="d-flex justify-content-end gap-2">
                        <a href="{{ route('gudang.index') }}" class="btn btn-light">Batal</a>
                        <button type="submit" class="btn btn-primary">Update Data</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
