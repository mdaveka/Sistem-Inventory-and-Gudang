<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center">
            <i class="ph-fill ph-squares-four text-blue-600 text-2xl mr-3"></i> 
            Dashboard Analytics
        </div>
    </x-slot>

    <!-- Ucapan Selamat Datang -->
    <div class="bg-blue-50 border border-blue-200 text-blue-700 px-4 py-3 rounded-lg flex items-center mb-6 fade-in shadow-sm mx-6 mt-6">
        <i class="ph-fill ph-info text-2xl mr-3"></i>
        <div>
            <p class="font-bold text-sm">Selamat Datang kembali, {{ Auth::user()->name }}!</p>
            <p class="text-xs">Sistem manajemen inventory siap digunakan. Anda login sebagai <span class="uppercase font-bold">{{ Auth::user()->role }}</span>.</p>
        </div>
    </div>

    <div class="px-6 pb-6">
        <!-- STATISTIK ATAS (Dibuat Full Color Vibrant Gradient) -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6 fade-in">
            
            <!-- Card 1: Total Barang (Biru Gradasi) -->
            <div class="bg-gradient-to-br from-blue-500 to-blue-700 rounded-2xl shadow-lg shadow-blue-500/40 p-6 border border-blue-400/30 hover:shadow-xl hover:shadow-blue-500/50 hover:-translate-y-1 transition-all duration-300 relative overflow-hidden group">
                <!-- Efek Abstrak Latar -->
                <div class="absolute -right-6 -top-6 w-24 h-24 rounded-full bg-white/10 group-hover:scale-150 transition-transform duration-500"></div>
                
                <div class="flex items-center justify-between relative z-10">
                    <div>
                        <p class="text-xs font-bold text-blue-100 uppercase tracking-wider">Total Barang</p>
                        <h3 class="text-3xl font-black text-white mt-1">{{ $total_items }}</h3>
                    </div>
                    <div class="p-3.5 bg-white/20 text-white rounded-xl shadow-inner border border-white/10 backdrop-blur-sm">
                        <i class="ph-fill ph-box-box text-3xl"></i>
                    </div>
                </div>
            </div>
            
            <!-- Card 2: Total Supplier (Ungu Gradasi) -->
            <div class="bg-gradient-to-br from-purple-500 to-purple-700 rounded-2xl shadow-lg shadow-purple-500/40 p-6 border border-purple-400/30 hover:shadow-xl hover:shadow-purple-500/50 hover:-translate-y-1 transition-all duration-300 relative overflow-hidden group">
                <div class="absolute -right-6 -top-6 w-24 h-24 rounded-full bg-white/10 group-hover:scale-150 transition-transform duration-500"></div>
                
                <div class="flex items-center justify-between relative z-10">
                    <div>
                        <p class="text-xs font-bold text-purple-100 uppercase tracking-wider">Total Supplier</p>
                        <h3 class="text-3xl font-black text-white mt-1">{{ $total_suppliers }}</h3>
                    </div>
                    <div class="p-3.5 bg-white/20 text-white rounded-xl shadow-inner border border-white/10 backdrop-blur-sm">
                        <i class="ph-fill ph-truck text-3xl"></i>
                    </div>
                </div>
            </div>
            
            <!-- Card 3: Total Gudang (Indigo Gradasi) -->
            <div class="bg-gradient-to-br from-indigo-500 to-indigo-700 rounded-2xl shadow-lg shadow-indigo-500/40 p-6 border border-indigo-400/30 hover:shadow-xl hover:shadow-indigo-500/50 hover:-translate-y-1 transition-all duration-300 relative overflow-hidden group">
                <div class="absolute -right-6 -top-6 w-24 h-24 rounded-full bg-white/10 group-hover:scale-150 transition-transform duration-500"></div>
                
                <div class="flex items-center justify-between relative z-10">
                    <div>
                        <p class="text-xs font-bold text-indigo-100 uppercase tracking-wider">Gudang Aktif</p>
                        <h3 class="text-3xl font-black text-white mt-1">{{ $total_warehouses }}</h3>
                    </div>
                    <div class="p-3.5 bg-white/20 text-white rounded-xl shadow-inner border border-white/10 backdrop-blur-sm">
                        <i class="ph-fill ph-buildings text-3xl"></i>
                    </div>
                </div>
            </div>
            
            <!-- Card 4: Aktivitas Hari Ini (Hijau Zamrud Gradasi) -->
            <div class="bg-gradient-to-br from-emerald-400 to-emerald-600 rounded-2xl shadow-lg shadow-emerald-500/40 p-6 border border-emerald-300/30 hover:shadow-xl hover:shadow-emerald-500/50 hover:-translate-y-1 transition-all duration-300 relative overflow-hidden group">
                <div class="absolute -right-6 -top-6 w-24 h-24 rounded-full bg-white/10 group-hover:scale-150 transition-transform duration-500"></div>
                
                <div class="flex items-center justify-between relative z-10">
                    <div>
                        <p class="text-xs font-bold text-emerald-50 uppercase tracking-wider">Aktivitas Hari Ini</p>
                        <h3 class="text-3xl font-black text-white mt-1">{{ $activity_today }}</h3>
                    </div>
                    <div class="p-3.5 bg-white/20 text-white rounded-xl shadow-inner border border-white/10 backdrop-blur-sm">
                        <i class="ph-fill ph-trend-up text-3xl"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- BAGIAN BAWAH: ALERT & LOG (Tetap Putih agar balance) -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 fade-in">
            
            <!-- WIDGET 1: Minimum Stock Alert -->
            <div class="col-span-1 lg:col-span-2 bg-white rounded-xl shadow-sm border border-gray-100 flex flex-col">
                <div class="p-5 border-b border-gray-100 flex justify-between items-center bg-orange-50/50 rounded-t-xl">
                    <h3 class="font-bold text-gray-800 flex items-center">
                        <i class="ph-fill ph-warning-circle text-orange-500 mr-2 text-xl"></i> Peringatan Stok Menipis
                    </h3>
                    <a href="{{ url('/items') }}" class="text-sm text-blue-600 hover:text-blue-800 font-medium">Lihat Barang &rarr;</a>
                </div>
                <div class="p-0 flex-1 overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-gray-50 text-gray-500 text-xs uppercase border-y">
                                <th class="p-4 font-medium">Nama Barang</th>
                                <th class="p-4 font-medium text-center">Sisa Stok</th>
                                <th class="p-4 font-medium text-center">Min. Stok</th>
                                <th class="p-4 font-medium text-center">Status</th>
                            </tr>
                        </thead>
                        <tbody class="text-sm divide-y divide-gray-100">
                            @forelse($alerts as $item)
                            <tr class="hover:bg-orange-50/30 transition">
                                <td class="p-4 font-bold text-gray-800">
                                    <div class="flex flex-col">
                                        <span>{{ $item->name }}</span>
                                        <span class="text-xs font-mono text-gray-500 font-normal mt-0.5">{{ $item->barcode }}</span>
                                    </div>
                                </td>
                                <td class="p-4 text-center align-middle">
                                    <span class="text-red-600 font-bold text-lg">{{ $item->stock }}</span>
                                </td>
                                <td class="p-4 text-center text-gray-500 align-middle">{{ $item->min_stock }}</td>
                                <td class="p-4 text-center align-middle">
                                    <span class="bg-red-100 text-red-700 text-xs px-3 py-1 rounded-full font-bold">BUTUH RESTOCK</span>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="p-10 text-center text-gray-500">
                                    <i class="ph-fill ph-check-circle text-4xl mb-2 text-green-400 block mx-auto"></i>
                                    Semua stok barang dalam kondisi aman.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- WIDGET 2: Log Aktivitas Terbaru -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 flex flex-col">
                <div class="p-5 border-b border-gray-100 bg-blue-50/50 rounded-t-xl">
                    <h3 class="font-bold text-gray-800 flex items-center">
                        <i class="ph-fill ph-clock-counter-clockwise text-blue-500 mr-2 text-xl"></i> Log Aktivitas Terbaru
                    </h3>
                </div>
                <div class="p-5 space-y-4 flex-1">
                    @forelse($recent_logs as $log)
                        <div class="flex items-start">
                            <!-- Penentuan Icon Berdasarkan Tipe -->
                            @if($log->type == 'IN')
                                <div class="p-2 rounded-full mr-3 bg-green-100 text-green-600 shadow-sm border border-green-200">
                                    <i class="ph-fill ph-arrow-down-left text-lg"></i>
                                </div>
                            @elseif($log->type == 'OUT')
                                <div class="p-2 rounded-full mr-3 bg-red-100 text-red-600 shadow-sm border border-red-200">
                                    <i class="ph-fill ph-arrow-up-right text-lg"></i>
                                </div>
                            @else
                                <div class="p-2 rounded-full mr-3 bg-yellow-100 text-yellow-600 shadow-sm border border-yellow-200">
                                    <i class="ph-fill ph-arrows-left-right text-lg"></i>
                                </div>
                            @endif

                            <div class="flex-1">
                                <p class="text-sm text-gray-800 font-medium leading-snug">
                                    @if($log->type == 'IN')
                                        <span class="text-green-600 font-bold">Stok Masuk:</span> 
                                    @elseif($log->type == 'OUT')
                                        <span class="text-red-600 font-bold">Stok Keluar:</span> 
                                    @else
                                        <span class="text-yellow-600 font-bold">Mutasi:</span> 
                                    @endif
                                    {{ $log->item->name ?? 'Barang Dihapus' }} 
                                    <span class="font-bold bg-gray-100 px-1.5 py-0.5 rounded text-xs ml-1">{{ $log->qty }} unit</span>
                                </p>
                                <div class="flex justify-between items-center mt-1">
                                    <p class="text-xs text-gray-500 flex items-center"><i class="ph-fill ph-user-circle mr-1"></i> {{ $log->user->name ?? 'System' }}</p>
                                    <p class="text-xs text-gray-400">{{ $log->created_at->diffForHumans() }}</p>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-8 text-gray-400">
                            <i class="ph-fill ph-folder-open text-4xl mb-2 text-gray-300 block"></i>
                            <p class="text-sm">Belum ada aktivitas tercatat.</p>
                        </div>
                    @endforelse
                </div>
            </div>

        </div>
    </div>
</x-app-layout>