@extends('admin.layouts.app')

@section('title', 'Register Staff Gudang')
@section('content')
    <div class="auth-brand">
        <h1>DANGGU</h1>
        <p>Sistem Manajemen Inventory</p>
    </div>

    <form method="POST" action="{{ url('/admin/register') }}">
        @csrf

        <div class="mb-3">
            <label for="name" class="form-label">Nama</label>
            <input id="name" type="text" name="name" class="form-control" value="{{ old('name') }}" placeholder="Nama staff gudang" autocomplete="name" required autofocus>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email Address</label>
            <input id="email" type="email" name="email" class="form-control" value="{{ old('email') }}" placeholder="user@gudang.com" autocomplete="email" required>
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input id="password" type="password" name="password" class="form-control" placeholder="........" autocomplete="new-password" required>
        </div>

        <div class="mb-4">
            <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
            <input id="password_confirmation" type="password" name="password_confirmation" class="form-control" placeholder="........" autocomplete="new-password" required>
        </div>

        <button type="submit" class="btn btn-primary btn-auth w-100">REGISTER</button>
    </form>

    @if ($errors->any())
        <div class="alert alert-danger mt-3">
            {{ $errors->first() }}
        </div>
    @endif

    <p class="auth-switch">
        Sudah punya akun? <a href="{{ route('admin.login') }}">Login</a>
    </p>
@endsection
