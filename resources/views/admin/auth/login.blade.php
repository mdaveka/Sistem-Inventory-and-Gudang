@extends('admin.layouts.app')

@section('title', 'Login Staff Gudang')
@section('content')
    <h4 class="text-center mb-4">Login</h4>
 ++++++++++++++++++++++++++++++++++++++++++++++++++++
    <form method="POST" action="{{ url('/admin/login') }}">
        @csrf

        <div class="mb-3">
            <label for="email" class="form-label">Email Address</label>
            <input id="email" type="email" name="email" class="form-control" value="{{ old('email') }}" placeholder="user@gudang.com" autocomplete="email" required autofocus>
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input id="password" type="password" name="password" class="form-control" placeholder="........" autocomplete="current-password" required>
        </div>

        <div class="auth-options">
            <div class="form-check">
                <input id="remember" type="checkbox" name="remember" class="form-check-input" value="1">
                <label for="remember" class="form-check-label">Remember me</label>
            </div>
            <a href="#">Forgot password?</a>
        </div>

        <button type="submit" class="btn btn-primary btn-auth w-100">LOG IN</button>
    </form>

    @if ($errors->any())
        <div class="alert alert-danger mt-3">
            {{ $errors->first() }}
        </div>
    @endif

    <a href="{{ url('/admin/register') }}" class="d-block text-center mt-3">
        Belum punya akun? Register
    </a>
    <a href="{{ route('register') }}" class="d-block text-center mt-3">
        Belum punya akun? Register
    </a>
@endsection
