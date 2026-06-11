<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'DANGGU')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root {
            --sidebar-width: 204px;
            --navy: #0d1629;
            --navy-soft: #111d34;
            --blue: #2f6df6;
            --blue-soft: #eaf3ff;
            --line: #e7edf5;
            --surface: #ffffff;
            --bg: #f5f8fc;
            --text: #172033;
            --muted: #7a8798;
            --green: #22c55e;
            --red: #ef4444;
            --amber: #f59e0b;
        }

        * {
            box-sizing: border-box;
        }

        body {
            min-height: 100vh;
            margin: 0;
            background: var(--bg);
            color: var(--text);
            font-family: Arial, Helvetica, sans-serif;
            font-size: 13px;
        }

        .app-shell {
            min-height: 100vh;
        }

        .sidebar {
            width: var(--sidebar-width);
            min-height: 100vh;
            position: fixed;
            inset: 0 auto 0 0;
            display: flex;
            flex-direction: column;
            background: linear-gradient(180deg, #0b1324 0%, #101b31 100%);
            color: #dbe7ff;
            z-index: 20;
            box-shadow: 4px 0 24px rgba(10, 18, 35, .12);
        }

        .brand-box {
            height: 50px;
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 0 14px;
            border-bottom: 1px solid rgba(255,255,255,.08);
        }

        .brand-logo {
            width: 16px;
            height: 16px;
            position: relative;
            flex: 0 0 16px;
        }

        .brand-logo span {
            width: 6px;
            height: 6px;
            position: absolute;
            border: 1px solid #5da2ff;
            border-radius: 3px;
        }

        .brand-logo span:nth-child(1) { left: 0; top: 0; }
        .brand-logo span:nth-child(2) { right: 0; top: 0; }
        .brand-logo span:nth-child(3) { left: 0; bottom: 0; }
        .brand-logo span:nth-child(4) { right: 0; bottom: 0; }

        .brand-title {
            margin: 0;
            color: #fff;
            font-size: 14px;
            font-weight: 800;
            letter-spacing: 0;
        }

        .sidebar-nav {
            flex: 1;
            padding: 14px 12px;
            overflow-y: auto;
        }

        .nav-section-label {
            margin: 12px 0 8px;
            color: #7d8aa4;
            font-size: 9px;
            font-weight: 700;
            letter-spacing: .05em;
            text-transform: uppercase;
        }

        .sidebar .nav-link {
            min-height: 34px;
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 8px 10px;
            margin-bottom: 6px;
            border-radius: 6px;
            color: #d7e2f5;
            font-size: 12px;
            font-weight: 600;
        }

        .sidebar .nav-link:hover {
            background: rgba(47, 109, 246, .15);
            color: #fff;
        }

        .sidebar .nav-link.active {
            background: var(--blue);
            color: #fff;
        }

        .nav-mark {
            width: 16px;
            height: 16px;
            display: inline-grid;
            place-items: center;
            flex: 0 0 16px;
            color: currentColor;
            font-size: 9px;
            font-weight: 800;
            line-height: 1;
        }

        .staff-box {
            display: flex;
            align-items: center;
            gap: 9px;
            padding: 12px;
            border-top: 1px solid rgba(255,255,255,.08);
        }

        .staff-avatar {
            width: 26px;
            height: 26px;
            display: grid;
            place-items: center;
            flex: 0 0 26px;
            border-radius: 50%;
            background: var(--blue);
            color: #fff;
            font-weight: 800;
        }

        .staff-name {
            color: #fff;
            font-size: 12px;
            font-weight: 800;
            line-height: 1.1;
        }

        .staff-role {
            color: #8c9bb4;
            font-size: 10px;
            line-height: 1.2;
        }

        .main-content {
            min-height: 100vh;
            margin-left: var(--sidebar-width);
        }

        .topbar {
            height: 50px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            padding: 0 20px;
            background: var(--surface);
            border-bottom: 1px solid var(--line);
        }

        .page-heading {
            display: flex;
            align-items: center;
            gap: 9px;
            min-width: 0;
        }

        .page-heading-mark {
            width: 18px;
            height: 18px;
            display: grid;
            place-items: center;
            border-radius: 5px;
            background: var(--blue-soft);
            color: var(--blue);
            font-size: 10px;
            font-weight: 800;
        }

        .page-title {
            margin: 0;
            color: #1f2937;
            font-size: 15px;
            font-weight: 800;
            letter-spacing: 0;
        }

        .page-subtitle {
            display: none;
        }

        .logout-link {
            border: 0;
            background: transparent;
            color: #dc2626;
            font-size: 12px;
            font-weight: 600;
            text-decoration: none;
        }

        .content-wrap {
            padding: 16px 18px;
        }

        .alert {
            border-radius: 5px;
            font-size: 12px;
        }

        .card,
        .stat-card,
        .table-card,
        .form-card,
        .dashboard-card {
            border: 1px solid var(--line);
            border-radius: 7px;
            background: var(--surface);
            box-shadow: 0 8px 18px rgba(31, 45, 71, .035);
        }

        .stat-card {
            height: 86px;
            padding: 18px 18px;
        }

        .stat-label {
            margin-bottom: 8px;
            color: #7d8797;
            font-size: 10px;
            font-weight: 800;
            letter-spacing: .03em;
            text-transform: uppercase;
        }

        .stat-value {
            margin: 0;
            color: #121a2b;
            font-size: 22px;
            font-weight: 800;
            line-height: 1;
        }

        .stat-icon {
            width: 34px;
            height: 34px;
            display: grid;
            place-items: center;
            border-radius: 7px;
            font-size: 10px;
            font-weight: 800;
        }

        .stat-icon.blue { background: #eef5ff; color: var(--blue); }
        .stat-icon.purple { background: #f5edff; color: #9333ea; }
        .stat-icon.indigo { background: #eef2ff; color: #4f46e5; }
        .stat-icon.green { background: #ecfdf3; color: #16a34a; }

        .table thead th {
            border-bottom: 1px solid var(--line);
            background: #fbfcfe;
            color: #7a8798;
            font-size: 10px;
            font-weight: 800;
            letter-spacing: .02em;
            text-transform: uppercase;
        }

        .table td,
        .table th {
            padding: 13px 16px;
            vertical-align: middle;
        }

        .btn {
            border-radius: 6px;
            font-size: 12px;
            font-weight: 700;
        }

        .form-control,
        .form-select {
            border-radius: 7px;
            padding: 10px 12px;
            font-size: 13px;
        }

        .empty-state {
            padding: 46px 20px;
            text-align: center;
            color: var(--muted);
        }

        .badge-soft {
            background: #eaf3ff;
            color: #1d4ed8;
        }

        @media (max-width: 991.98px) {
            .sidebar {
                position: static;
                width: 100%;
                min-height: auto;
            }

            .sidebar-nav {
                display: grid;
                grid-template-columns: repeat(2, minmax(0, 1fr));
                gap: 0 10px;
            }

            .nav-section-label {
                grid-column: 1 / -1;
            }

            .staff-box {
                display: none;
            }

            .main-content {
                margin-left: 0;
            }

            .topbar {
                height: auto;
                min-height: 50px;
                padding: 12px 16px;
            }

            .content-wrap {
                padding: 14px;
            }
        }
    </style>
    @stack('styles')
</head>
<body>
<div class="app-shell">
    <aside class="sidebar">
        <div class="brand-box">
            <div class="brand-logo" aria-hidden="true">
                <span></span><span></span><span></span><span></span>
            </div>
            <h5 class="brand-title">DANGGU</h5>
        </div>

        <nav class="sidebar-nav">
            <div class="nav-section-label">Modul Utama</div>
            <a class="nav-link {{ request()->is('/') ? 'active' : '' }}" href="{{ url('/') }}"><span class="nav-mark">D</span> Dashboard</a>
            <a class="nav-link {{ request()->is('barang') ? 'active' : '' }}" href="{{ url('/barang') }}"><span class="nav-mark">B</span> Data Barang</a>

            <div class="nav-section-label">Transaksi</div>
            <a class="nav-link {{ request()->is('barang-masuk*') ? 'active' : '' }}" href="{{ route('barang-masuk.create') }}"><span class="nav-mark">IN</span> Stok Masuk</a>
            <a class="nav-link {{ request()->is('barang-keluar/create') ? 'active' : '' }}" href="{{ route('barang-keluar.create') }}"><span class="nav-mark">EX</span> Stok Keluar</a>
            <a class="nav-link {{ request()->is('gudang*') ? 'active' : '' }}" href="{{ route('gudang.index') }}"><span class="nav-mark">M</span> Mutasi Gudang</a>

            <div class="nav-section-label">Monitoring</div>
            <a class="nav-link {{ request()->is('barang') ? 'active' : '' }}" href="{{ url('/barang') }}"><span class="nav-mark">!</span> Min. Stock Alert</a>
            <a class="nav-link {{ request()->is('barang-keluar') ? 'active' : '' }}" href="{{ route('barang-keluar.index') }}"><span class="nav-mark">L</span> Laporan Stok</a>
        </nav>

        <div class="staff-box">
            <div class="staff-avatar">S</div>
            <div>
                <div class="staff-name">Staff Gudang</div>
                <div class="staff-role">User</div>
            </div>
        </div>
    </aside>

    <main class="main-content">
        <header class="topbar">
            <div>
                <div class="page-heading">
                    <span class="page-heading-mark">@yield('page_icon', 'D')</span>
                    <h1 class="page-title">@yield('page_title', 'Dashboard Analytics')</h1>
                </div>
                <p class="page-subtitle">@yield('page_subtitle')</p>
            </div>
            <div>
                @hasSection('page_actions')
                    @yield('page_actions')
                @else
                    @auth
                        <form method="POST" action="{{ route('admin.logout') }}">
                            @csrf
                            <button type="submit" class="logout-link">Logout</button>
                        </form>
                    @else
                        <a href="{{ route('admin.login') }}" class="logout-link">Login</a>
                    @endauth
                @endif
            </div>
        </header>

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
