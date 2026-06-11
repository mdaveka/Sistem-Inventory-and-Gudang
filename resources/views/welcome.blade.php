@extends('layouts.app')

@section('title', 'Dashboard Analytics')
@section('page_icon', 'D')
@section('page_title', 'Dashboard Analytics')

@push('styles')
<style>
    .welcome-alert {
        display: flex;
        align-items: flex-start;
        gap: 10px;
        margin-bottom: 18px;
        padding: 12px 14px;
        border: 1px solid #cfe4ff;
        border-radius: 5px;
        background: #eef7ff;
        color: #1d4ed8;
    }

    .welcome-alert .alert-mark {
        width: 18px;
        height: 18px;
        display: grid;
        place-items: center;
        flex: 0 0 18px;
        border-radius: 50%;
        background: #2f6df6;
        color: #fff;
        font-size: 11px;
        font-weight: 800;
    }

    .welcome-alert strong {
        display: block;
        margin-bottom: 2px;
        font-size: 12px;
        line-height: 1.2;
    }

    .welcome-alert span {
        display: block;
        color: #3561a8;
        font-size: 11px;
        line-height: 1.35;
    }

    .dashboard-grid {
        display: grid;
        grid-template-columns: minmax(0, 1fr) 355px;
        gap: 18px;
        align-items: start;
    }

    .dashboard-card-header {
        min-height: 48px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 14px;
        padding: 0 16px;
        border-bottom: 1px solid var(--line);
    }

    .dashboard-card-title {
        display: flex;
        align-items: center;
        gap: 9px;
        margin: 0;
        color: #172033;
        font-size: 13px;
        font-weight: 800;
    }

    .title-dot {
        width: 14px;
        height: 14px;
        display: grid;
        place-items: center;
        border-radius: 50%;
        color: #fff;
        font-size: 9px;
        font-weight: 800;
    }

    .title-dot.warning {
        background: #f97316;
    }

    .title-dot.info {
        background: #60a5fa;
    }

    .view-link {
        color: #2563eb;
        font-size: 11px;
        font-weight: 700;
        text-decoration: none;
    }

    .stock-table {
        margin: 0;
    }

    .stock-safe {
        min-height: 254px;
        display: grid;
        place-items: center;
        color: #7b8798;
        text-align: center;
    }

    .stock-safe-mark {
        width: 26px;
        height: 26px;
        display: grid;
        place-items: center;
        margin: 0 auto 13px;
        border-radius: 50%;
        background: #4ade80;
        color: #fff;
        font-size: 11px;
        font-weight: 800;
    }

    .status-pill {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 66px;
        min-height: 22px;
        padding: 3px 8px;
        border-radius: 999px;
        font-size: 10px;
        font-weight: 800;
    }

    .status-pill.danger {
        background: #fee2e2;
        color: #dc2626;
    }

    .status-pill.warning {
        background: #fef3c7;
        color: #b45309;
    }

    .activity-list {
        padding: 12px 14px 0;
    }

    .activity-item {
        display: grid;
        grid-template-columns: 34px minmax(0, 1fr) auto;
        gap: 10px;
        align-items: center;
        padding: 11px 0;
        border-bottom: 1px solid #f0f3f8;
    }

    .activity-item:last-child {
        border-bottom: 0;
    }

    .activity-icon {
        width: 31px;
        height: 31px;
        display: grid;
        place-items: center;
        border-radius: 50%;
        font-size: 10px;
        font-weight: 900;
    }

    .activity-icon.success {
        background: #dcfce7;
        color: #16a34a;
    }

    .activity-icon.danger {
        background: #fee2e2;
        color: #dc2626;
    }

    .activity-icon.warning {
        background: #fef3c7;
        color: #b45309;
    }

    .activity-title {
        margin-bottom: 3px;
        color: #172033;
        font-size: 11px;
        font-weight: 800;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .activity-title span {
        margin-left: 5px;
        font-weight: 800;
    }

    .activity-user {
        color: #8b97a8;
        font-size: 10px;
    }

    .activity-time {
        color: #8b97a8;
        font-size: 10px;
        white-space: nowrap;
    }

    .activity-footer {
        padding: 11px 14px 14px;
        border-top: 1px solid #f0f3f8;
        text-align: center;
    }

    .activity-empty {
        padding: 44px 20px;
        color: #8b97a8;
        text-align: center;
    }

    @media (max-width: 1199.98px) {
        .dashboard-grid {
            grid-template-columns: 1fr;
        }
    }
</style>
@endpush

@section('content')
<div class="welcome-alert">
    <div class="alert-mark">i</div>
    <div>
        <strong>Selamat Datang kembali, Staff Gudang!</strong>
        <span>Sistem manajemen inventory siap digunakan. Anda login sebagai USER.</span>
    </div>
</div>

<div class="row g-3 mb-3">
    <div class="col-md-6 col-xl-3">
        <div class="stat-card d-flex align-items-center justify-content-between">
            <div>
                <div class="stat-label">Total Barang</div>
                <h2 class="stat-value">{{ $totalBarang ?? 0 }}</h2>
            </div>
            <div class="stat-icon blue">B</div>
        </div>
    </div>
    <div class="col-md-6 col-xl-3">
        <div class="stat-card d-flex align-items-center justify-content-between">
            <div>
                <div class="stat-label">Total Supplier</div>
                <h2 class="stat-value">{{ $totalSupplier ?? 0 }}</h2>
            </div>
            <div class="stat-icon purple">SP</div>
        </div>
    </div>
    <div class="col-md-6 col-xl-3">
        <div class="stat-card d-flex align-items-center justify-content-between">
            <div>
                <div class="stat-label">Gudang Aktif</div>
                <h2 class="stat-value">{{ $gudangAktif ?? 0 }}</h2>
            </div>
            <div class="stat-icon indigo">GD</div>
        </div>
    </div>
    <div class="col-md-6 col-xl-3">
        <div class="stat-card d-flex align-items-center justify-content-between">
            <div>
                <div class="stat-label">Aktivitas Hari Ini</div>
                <h2 class="stat-value">{{ $aktivitasHariIni ?? 0 }}</h2>
            </div>
            <div class="stat-icon green">AK</div>
        </div>
    </div>
</div>

<div class="dashboard-grid">
    <section class="dashboard-card">
        <div class="dashboard-card-header">
            <h2 class="dashboard-card-title"><span class="title-dot warning">!</span> Peringatan Stok Menipis</h2>
            <a class="view-link" href="{{ url('/barang') }}">Lihat Barang</a>
        </div>

        <div class="table-responsive">
            <table class="table stock-table align-middle">
                <thead>
                    <tr>
                        <th>Nama Barang</th>
                        <th>Sisa Stok</th>
                        <th>Min. Stok</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse(($lowStockItems ?? collect()) as $item)
                        <tr>
                            <td class="fw-bold">{{ $item->nama_barang }}</td>
                            <td>{{ $item->stok }}</td>
                            <td>{{ $lowStockLimit ?? 5 }}</td>
                            <td>
                                <span class="status-pill {{ $item->stok <= 0 ? 'danger' : 'warning' }}">
                                    {{ $item->stok <= 0 ? 'Habis' : 'Menipis' }}
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4">
                                <div class="stock-safe">
                                    <div>
                                        <div class="stock-safe-mark">OK</div>
                                        <div>Semua stok barang dalam kondisi aman.</div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>

    <aside class="dashboard-card">
        <div class="dashboard-card-header">
            <h2 class="dashboard-card-title"><span class="title-dot info">L</span> Log Aktivitas Terbaru</h2>
        </div>

        @if(($recentActivities ?? collect())->isNotEmpty())
            <div class="activity-list">
                @foreach($recentActivities as $activity)
                    <div class="activity-item">
                        <div class="activity-icon {{ $activity['tone'] }}">{{ $activity['tone'] === 'success' ? 'IN' : 'EX' }}</div>
                        <div>
                            <div class="activity-title">
                                {{ $activity['type'] }}: {{ $activity['item'] }}
                                <span>{{ $activity['quantity'] }} unit</span>
                            </div>
                            <div class="activity-user">{{ $activity['user'] }}</div>
                        </div>
                        <div class="activity-time">{{ $activity['time'] }}</div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="activity-empty">Belum ada aktivitas transaksi.</div>
        @endif

        <div class="activity-footer">
            <a class="view-link" href="{{ route('barang-keluar.index') }}">Lihat Seluruh Log Aktivitas</a>
        </div>
    </aside>
</div>
@endsection
