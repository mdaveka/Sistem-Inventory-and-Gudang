<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Sistem Inventory & Gudang</title>

    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- LINK ICON -->
    <link rel="stylesheet" type="text/css" href="https://unpkg.com/@phosphor-icons/web@2.1.1/src/regular/style.css">
    <link rel="stylesheet" type="text/css" href="https://unpkg.com/@phosphor-icons/web@2.1.1/src/fill/style.css">
    <script src="https://unpkg.com/@phosphor-icons/web"></script>

    <!-- CSS & JS VITE -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body { font-family: 'Outfit', sans-serif; }

        /* Custom Scrollbar yang Elegan */
        ::-webkit-scrollbar { width: 6px; height: 6px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 10px; }
        ::-webkit-scrollbar-thumb:hover { background: #94a3b8; }
        
        .sidebar-scroll::-webkit-scrollbar-thumb { background: #334155; }
        .sidebar-scroll::-webkit-scrollbar-thumb:hover { background: #475569; }

        .fade-in { animation: fadeIn 0.4s ease-in-out; }
        @keyframes fadeIn { from { opacity: 0; transform: translateY(10px); } to { opacity: 1; transform: translateY(0); } }
    </style>
</head>
<body class="antialiased text-slate-800 h-screen overflow-hidden flex flex-col bg-slate-50">
    <div class="flex h-screen w-full">
        
        <!-- SIDEBAR (Modern Dark Theme) -->
        <aside class="w-[280px] bg-[#0F172A] text-white flex flex-col hidden md:flex border-r border-slate-800/50 shadow-2xl z-20">
            <!-- Logo Area -->
            <div class="h-20 flex items-center px-8 border-b border-slate-800/80 bg-[#0F172A]">
                <div class="bg-blue-500/10 p-2.5 rounded-xl mr-3 border border-blue-500/20">
                    <i class="ph-fill ph-dropbox-logo text-2xl text-blue-500"></i>
                </div>
                <span class="text-2xl font-extrabold tracking-widest text-white">DANGGU</span>
            </div>
            
            <!-- Menu List -->
            <div class="p-6 overflow-y-auto flex-1 sidebar-scroll">
                
                <!-- MODUL UTAMA -->
                <p class="text-xs font-bold text-slate-500 uppercase tracking-[0.15em] mb-3 ml-2">Modul Utama</p>
                <nav class="space-y-2">
                    <a href="{{ route('dashboard') }}" class="flex items-center px-5 py-3.5 {{ request()->routeIs('dashboard') ? 'bg-blue-600 text-white shadow-md shadow-blue-600/20' : 'text-slate-400 hover:bg-slate-800/50 hover:text-white' }} rounded-xl transition-all duration-300 group">
                        <i class="ph-fill ph-squares-four text-2xl mr-4 {{ request()->routeIs('dashboard') ? 'text-white' : 'group-hover:text-blue-400 transition-colors' }}"></i> 
                        <span class="font-semibold text-[15px]">Dashboard</span>
                    </a>
                    
                    <a href="{{ route('items.index') }}" class="flex items-center px-5 py-3.5 {{ request()->routeIs('items.*') ? 'bg-blue-600 text-white shadow-md shadow-blue-600/20' : 'text-slate-400 hover:bg-slate-800/50 hover:text-white' }} rounded-xl transition-all duration-300 group">
                        <i class="ph-fill ph-folder-simple-star text-2xl mr-4 {{ request()->routeIs('items.*') ? 'text-white' : 'group-hover:text-blue-400 transition-colors' }}"></i> 
                        <span class="font-semibold text-[15px]">Data Barang</span>
                    </a>
                    
                    @if(Auth::check() && Auth::user()->role === 'admin')
                    <a href="{{ route('supplier.index') }}" class="flex items-center px-5 py-3.5 {{ request()->routeIs('supplier.*') ? 'bg-blue-600 text-white shadow-md shadow-blue-600/20' : 'text-slate-400 hover:bg-slate-800/50 hover:text-white' }} rounded-xl transition-all duration-300 group">
                        <i class="ph-fill ph-truck text-2xl mr-4 {{ request()->routeIs('supplier.*') ? 'text-white' : 'group-hover:text-blue-400 transition-colors' }}"></i> 
                        <span class="font-semibold text-[15px]">Supplier</span>
                    </a>
                    <a href="{{ route('warehouse.index') }}" class="flex items-center px-5 py-3.5 {{ request()->routeIs('warehouse.*') ? 'bg-blue-600 text-white shadow-md shadow-blue-600/20' : 'text-slate-400 hover:bg-slate-800/50 hover:text-white' }} rounded-xl transition-all duration-300 group">
                        <i class="ph-fill ph-buildings text-2xl mr-4 {{ request()->routeIs('warehouse.*') ? 'text-white' : 'group-hover:text-blue-400 transition-colors' }}"></i> 
                        <span class="font-semibold text-[15px]">Gudang (Warehouse)</span>
                    </a>
                    @endif
                </nav>

                <!-- TRANSAKSI -->
                <p class="text-xs font-bold text-slate-500 uppercase tracking-[0.15em] mb-3 mt-8 ml-2">Transaksi</p>
                <nav class="space-y-2">
                    <a href="{{ route('stock-in.index') }}" class="flex items-center px-5 py-3.5 {{ request()->routeIs('stock-in.*') ? 'bg-emerald-500 text-white shadow-md shadow-emerald-500/20' : 'text-slate-400 hover:bg-slate-800/50 hover:text-white' }} rounded-xl transition-all duration-300 group">
                        <i class="ph-fill ph-arrow-down-left text-2xl mr-4 {{ request()->routeIs('stock-in.*') ? 'text-white' : 'text-emerald-500 group-hover:text-emerald-400' }}"></i> 
                        <span class="font-semibold text-[15px]">Stok Masuk</span>
                    </a>
                    <a href="{{ route('stock-out.index') }}" class="flex items-center px-5 py-3.5 {{ request()->routeIs('stock-out.*') ? 'bg-rose-500 text-white shadow-md shadow-rose-500/20' : 'text-slate-400 hover:bg-slate-800/50 hover:text-white' }} rounded-xl transition-all duration-300 group">
                        <i class="ph-fill ph-arrow-up-right text-2xl mr-4 {{ request()->routeIs('stock-out.*') ? 'text-white' : 'text-rose-500 group-hover:text-rose-400' }}"></i> 
                        <span class="font-semibold text-[15px]">Stok Keluar</span>
                    </a>
                    <a href="{{ route('mutasi.index') }}" class="flex items-center px-5 py-3.5 {{ request()->routeIs('mutasi.*') ? 'bg-amber-500 text-white shadow-md shadow-amber-500/20' : 'text-slate-400 hover:bg-slate-800/50 hover:text-white' }} rounded-xl transition-all duration-300 group">
                        <i class="ph-fill ph-arrows-left-right text-2xl mr-4 {{ request()->routeIs('mutasi.*') ? 'text-white' : 'text-amber-500 group-hover:text-amber-400' }}"></i> 
                        <span class="font-semibold text-[15px]">Mutasi Gudang</span>
                    </a>
                </nav>

                <!-- MONITORING -->
                <p class="text-xs font-bold text-slate-500 uppercase tracking-[0.15em] mb-3 mt-8 ml-2">Monitoring</p>
                <nav class="space-y-2">
                    <a href="{{ route('monitoring.alert') }}" class="flex items-center px-5 py-3.5 {{ request()->routeIs('monitoring.alert') ? 'bg-orange-500 text-white shadow-md shadow-orange-500/20' : 'text-slate-400 hover:bg-slate-800/50 hover:text-white' }} rounded-xl transition-all duration-300 group">
                        <i class="ph-fill ph-warning-circle text-2xl mr-4 {{ request()->routeIs('monitoring.alert') ? 'text-white' : 'text-orange-500 group-hover:text-orange-400' }}"></i> 
                        <span class="font-semibold text-[15px]">Min. Stock Alert</span>
                    </a>
                    <a href="{{ route('monitoring.laporan') }}" class="flex items-center px-5 py-3.5 {{ request()->routeIs('monitoring.laporan') ? 'bg-blue-600 text-white shadow-md shadow-blue-600/20' : 'text-slate-400 hover:bg-slate-800/50 hover:text-white' }} rounded-xl transition-all duration-300 group">
                        <i class="ph-fill ph-file-text text-2xl mr-4 {{ request()->routeIs('monitoring.laporan') ? 'text-white' : 'group-hover:text-blue-400 transition-colors' }}"></i> 
                        <span class="font-semibold text-[15px]">Laporan Stok</span>
                    </a>
                </nav>

                <!-- PENGATURAN -->
                @if(Auth::check() && Auth::user()->role === 'admin')
                <p class="text-xs font-bold text-slate-500 uppercase tracking-[0.15em] mb-3 mt-8 ml-2">Pengaturan</p>
                <nav class="space-y-2">
                    <a href="{{ route('users.index') }}" class="flex items-center px-5 py-3.5 {{ request()->routeIs('users.*') ? 'bg-indigo-600 text-white shadow-md shadow-indigo-600/20' : 'text-slate-400 hover:bg-slate-800/50 hover:text-white' }} rounded-xl transition-all duration-300 group">
                        <i class="ph-fill ph-users text-2xl mr-4 {{ request()->routeIs('users.*') ? 'text-white' : 'text-indigo-400 group-hover:text-indigo-300' }}"></i> 
                        <span class="font-semibold text-[15px]">Manajemen Pengguna</span>
                    </a>
                </nav>
                @endif
            </div>
            
            <!-- User Profile Bawah -->
            <div class="p-6 border-t border-slate-800/80 bg-slate-900/30">
                <div class="flex items-center gap-4">
                    <div class="h-12 w-12 rounded-full bg-gradient-to-tr from-blue-600 to-indigo-500 flex items-center justify-center text-white font-bold shadow-md border border-slate-700 text-lg">
                        {{ Auth::check() ? substr(Auth::user()->name, 0, 1) : 'U' }}
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-base font-bold text-white truncate">{{ Auth::user()->name ?? 'Guest' }}</p>
                        <p class="text-sm text-slate-400 capitalize truncate font-medium mt-0.5">{{ Auth::user()->role ?? 'User' }}</p>
                    </div>
                </div>
            </div>
        </aside>

        <!-- MAIN CONTENT AREA -->
        <main class="flex-1 flex flex-col h-screen overflow-hidden relative">
            
            <!-- Efek Latar Belakang Pola (Sangat Tipis) -->
            <div class="absolute inset-0 z-0 opacity-[0.03] pointer-events-none" style="background-image: radial-gradient(#0f172a 1px, transparent 1px); background-size: 24px 24px;"></div>

            <!-- TOP HEADER (Glassmorphism Effect) -->
            <header class="h-20 bg-white/80 backdrop-blur-xl border-b border-slate-200/60 shadow-sm flex items-center justify-between px-8 z-10 sticky top-0">
                <div class="flex items-center">
                    <h2 class="text-2xl font-extrabold text-slate-800 tracking-tight">
                        {{ $header ?? 'Sistem Inventory' }}
                    </h2>
                </div>
                
                <div class="flex items-center space-x-4">
                    <!-- Status Indikator Kosmetik -->
                    <div class="hidden sm:flex items-center bg-emerald-50 px-3 py-1.5 rounded-full border border-emerald-100 mr-2">
                        <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse mr-2"></span>
                        <span class="text-xs font-bold text-emerald-700 tracking-wide">SYSTEM ONLINE</span>
                    </div>

                    <!-- Tombol Logout Modern -->
                    <form method="POST" action="{{ route('logout') }}" class="m-0">
                        @csrf
                        <button type="submit" class="flex items-center text-rose-600 bg-rose-50 hover:bg-rose-600 hover:text-white px-4 py-2.5 rounded-xl font-bold text-sm transition-all duration-300 shadow-sm active:scale-95">
                            <i class="ph-bold ph-sign-out mr-2 text-lg"></i> Logout
                        </button>
                    </form>
                </div>
            </header>

            <!-- HALAMAN KONTEN DINAMIS -->
            <div class="flex-1 overflow-auto bg-transparent relative z-10">
                <div class="p-6 lg:p-8 fade-in">
                    {{ $slot }}
                </div>
            </div>
        </main>
    </div>

    <!-- Script khusus per halaman -->
    @stack('scripts')
</body>
</html>