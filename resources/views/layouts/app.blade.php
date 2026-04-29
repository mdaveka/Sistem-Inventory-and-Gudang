<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Sistem Inventory & Gudang')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root {
            --sidebar-width: 270px;
            --primary: #2563eb;
            --primary-dark: #1e40af;
            --soft-bg: #f4f7fb;
            --text-muted: #64748b;
        }
        body { background: var(--soft-bg); color: #0f172a; }
        .app-shell { min-height: 100vh; }
        .sidebar {
            width: var(--sidebar-width);
            min-height: 100vh;
            background: linear-gradient(180deg, #0f172a 0%, #1e293b 100%);
            position: fixed;
            left: 0;
            top: 0;
            padding: 24px 18px;
            color: #fff;
            z-index: 20;
        }
        .brand-box { border-bottom: 1px solid rgba(255,255,255,.12); padding-bottom: 18px; margin-bottom: 18px; }
        .brand-title { font-weight: 800; letter-spacing: .2px; margin: 0; }
        .brand-subtitle { color: #cbd5e1; font-size: .875rem; margin: 4px 0 0; }
        .nav-section-label { font-size: .75rem; text-transform: uppercase; letter-spacing: .08em; color: #94a3b8; margin: 18px 10px 8px; }
        .sidebar .nav-link {
            color: #dbeafe;
            border-radius: 12px;
            padding: 10px 12px;
            margin-bottom: 6px;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .sidebar .nav-link:hover,
        .sidebar .nav-link.active { background: rgba(37, 99, 235, .24); color: #fff; }
        .main-content { margin-left: var(--sidebar-width); min-height: 100vh; }
        .topbar {
            background: rgba(255,255,255,.86);
            backdrop-filter: blur(8px);
            border-bottom: 1px solid #e2e8f0;
            padding: 16px 28px;
            position: sticky;
            top: 0;
            z-index: 10;
        }
        .content-wrap { padding: 28px; }
        .page-title { font-weight: 800; margin: 0; }
        .page-subtitle { color: var(--text-muted); margin: 6px 0 0; }
        .stat-card, .table-card, .form-card {
            border: 0;
            border-radius: 18px;
            box-shadow: 0 10px 30px rgba(15, 23, 42, .06);
        }
        .stat-card .icon {
            width: 44px;
            height: 44px;
            display: grid;
            place-items: center;
            border-radius: 14px;
            background: #dbeafe;
            color: var(--primary-dark);
            font-weight: 800;
        }
        .table thead th { color: #475569; font-size: .82rem; text-transform: uppercase; letter-spacing: .04em; background: #f8fafc; }
        .table td, .table th { vertical-align: middle; }
        .btn { border-radius: 10px; }
        .form-control, .form-select { border-radius: 12px; padding: 10px 12px; }
        .empty-state { padding: 42px 20px; text-align: center; color: var(--text-muted); }
        .badge-soft { background: #e0f2fe; color: #0369a1; }
        @media (max-width: 991.98px) {
            .sidebar { position: static; width: 100%; min-height: auto; border-radius: 0 0 22px 22px; }
            .main-content { margin-left: 0; }
            .content-wrap, .topbar { padding: 18px; }
        }
    </style>
    @stack('styles')
</head>
<body>
<div class="app-shell">
    <aside class="sidebar">
        <div class="brand-box">
            <h5 class="brand-title">Inventory Gudang</h5>
            <p class="brand-subtitle">Sistem stok barang</p>
        </div>

        <div class="nav flex-column">
            <div class="nav-section-label">Menu Utama</div>
            <a class="nav-link {{ request()->is('/') ? 'active' : '' }}" href="{{ url('/') }}">🏠 Dashboard</a>
            <a class="nav-link {{ request()->is('barang') ? 'active' : '' }}" href="{{ url('/barang') }}">📦 Data Barang</a>
            <a class="nav-link {{ request()->is('supplier*') ? 'active' : '' }}" href="{{ route('supplier.index') }}">🚚 Supplier</a>
            <a class="nav-link {{ request()->is('gudang*') ? 'active' : '' }}" href="{{ route('gudang.index') }}">🏬 Gudang</a>

            <div class="nav-section-label">Transaksi</div>
            <a class="nav-link {{ request()->is('barang-masuk*') ? 'active' : '' }}" href="{{ route('barang-masuk.create') }}">➕ Barang Masuk</a>
            <a class="nav-link {{ request()->is('barang-keluar') ? 'active' : '' }}" href="{{ route('barang-keluar.index') }}">📤 Riwayat Keluar</a>
            <a class="nav-link {{ request()->is('barang-keluar/create') ? 'active' : '' }}" href="{{ route('barang-keluar.create') }}">➖ Barang Keluar</a>
        </div>
    </aside>

    <main class="main-content">
        <div class="topbar d-flex flex-wrap justify-content-between align-items-center gap-3">
            <div>
                <h1 class="h4 page-title">@yield('page_title', 'Sistem Inventory')</h1>
                <p class="page-subtitle">@yield('page_subtitle', 'Kelola stok, supplier, gudang, dan transaksi barang.')</p>
            </div>
            @yield('page_actions')
        </div>

        <div class="content-wrap">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            @if ($errors->any())
                <div class="alert alert-danger">
                    <strong>Periksa kembali input:</strong>
                    <ul class="mb-0 mt-2">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @yield('content')
        </div>
    </main>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@stack('scripts')
</body>
</html>
