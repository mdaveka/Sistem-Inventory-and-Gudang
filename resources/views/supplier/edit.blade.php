@extends('layouts.app')

@section('title', 'Edit Supplier')
@section('page_title', 'Edit Supplier')
@section('page_subtitle', 'Perbarui data supplier yang sudah tersimpan.')

@section('page_actions')
<a href="{{ route('supplier.index') }}" class="btn btn-outline-secondary">Kembali</a>
@endsection

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card form-card">
            <div class="card-body p-4">
                <form action="{{ route('supplier.update', $supplier->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label class="form-label">Nama Supplier</label>
                        <input type="text" name="nama_supplier" class="form-control" value="{{ old('nama_supplier', $supplier->nama_supplier) }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">No Telepon</label>
                        <input type="text" name="no_telepon" class="form-control" value="{{ old('no_telepon', $supplier->no_telepon) }}">
                    </div>
                    <div class="mb-4">
                        <label class="form-label">Alamat</label>
                        <textarea name="alamat" class="form-control" rows="4">{{ old('alamat', $supplier->alamat) }}</textarea>
                    </div>
                    <div class="d-flex justify-content-end gap-2">
                        <a href="{{ route('supplier.index') }}" class="btn btn-light">Batal</a>
                        <button type="submit" class="btn btn-primary">Update Data</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
