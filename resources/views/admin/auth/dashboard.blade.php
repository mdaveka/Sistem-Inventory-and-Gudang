@extends('layouts.app')

@section('content')
    <h2>Dashboard</h2>

    <p>Selamat datang, {{ $user->name }}</p>

    <form method="POST" action="{{ route('admin.logout') }}">
        @csrf
        <button type="submit">Logout</button>
    </form>
@endsection
