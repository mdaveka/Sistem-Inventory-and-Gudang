@extends('layouts.app')

@section('title', 'Tambah Supplier')
@section('page_title', 'Tambah Supplier')
@section('page_subtitle', 'Input data supplier baru.')

@section('page_actions')
<a href="{{ route('supplier.index') }}" class="btn btn-outline-secondary">Kembali</a>
@endsection

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card form-card">
            <div class="card-body p-4">
                <form action="{{ route('supplier.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Nama Supplier</label>
                        <input type="text" name="nama_supplier" class="form-control" value="{{ old('nama_supplier') }}" placeholder="Masukkan nama supplier" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">No Telepon</label>
                        <input type="text" name="no_telepon" class="form-control" value="{{ old('no_telepon') }}" placeholder="Contoh: 08123456789">
                    </div>
                    <div class="mb-4">
                        <label class="form-label">Alamat</label>
                        <textarea name="alamat" class="form-control" rows="4" placeholder="Alamat supplier">{{ old('alamat') }}</textarea>
                    </div>
                    <div class="d-flex justify-content-end gap-2">
                        <a href="{{ route('supplier.index') }}" class="btn btn-light">Batal</a>
                        <button type="submit" class="btn btn-primary">Simpan Data</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
