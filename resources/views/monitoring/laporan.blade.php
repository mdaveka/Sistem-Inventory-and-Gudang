<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center">
            <div class="bg-blue-100 text-blue-600 p-2 rounded-lg mr-3">
                <i class="ph-bold ph-file-text text-xl"></i>
            </div>
            <span class="font-bold text-gray-800 text-xl tracking-tight">Laporan Riwayat Stok</span>
        </div>
    </x-slot>

    <div class="p-6">
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 fade-in">
            
            <!-- HEADER & TOMBOL AKSI -->
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-5 mb-8">
                <!-- Sisi Kiri: Judul Laporan -->
                <div>
                    <h3 class="text-xl font-extrabold text-gray-800 tracking-tight">Buku Besar Aktivitas Gudang</h3>
                    <p class="text-sm text-gray-500 mt-1">Seluruh riwayat keluar-masuk dan mutasi tercatat lengkap di sini.</p>
                </div>
                
                <!-- Sisi Kanan: Tombol Export & Cetak -->
                <div class="flex flex-wrap items-center justify-end gap-3 w-full md:w-auto">
                    <!-- Tombol Print / Simpan PDF (Kiri) -->
                    <button onclick="window.print()" class="inline-flex items-center justify-center px-4 py-2.5 bg-blue-600 text-white hover:bg-blue-700 font-semibold text-sm rounded-xl transition-colors shadow-sm">
                        <i class="ph-bold ph-printer mr-2 text-lg"></i> Cetak Laporan
                    </button>
                    
                    <!-- Tombol Export Excel (Kanan) -->
                    <a href="{{ route('monitoring.export') }}" class="inline-flex items-center justify-center px-4 py-2.5 bg-green-600 text-white hover:bg-green-700 font-semibold text-sm rounded-xl transition-colors shadow-sm">
                        <i class="ph-bold ph-microsoft-excel-logo mr-2 text-lg"></i> Export Excel
                    </a>
                </div>
            </div>
            
            <!-- TABEL LAPORAN -->
            <div class="overflow-x-auto rounded-xl border border-gray-200">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-50/80 text-gray-500 text-[11px] uppercase tracking-widest border-b border-gray-200">
                            <th class="p-4 font-bold w-16 text-center">No</th>
                            <th class="p-4 font-bold">Waktu Transaksi</th>
                            <th class="p-4 font-bold text-center">Tipe Transaksi</th>
                            <th class="p-4 font-bold">Nama Barang</th>
                            <th class="p-4 font-bold text-center">Qty</th>
                            <th class="p-4 font-bold">Keterangan / Tujuan</th>
                            <th class="p-4 font-bold">Oleh</th>
                        </tr>
                    </thead>
                    <tbody class="text-sm divide-y divide-gray-100">
                        @forelse($logs as $index => $log)
                        <tr class="hover:bg-blue-50/40 transition-colors">
                            <td class="p-4 text-center text-gray-400 font-medium align-middle">{{ $index + 1 }}</td>
                            
                            <!-- Kolom Waktu -->
                            <td class="p-4 align-middle">
                                <div class="font-semibold text-gray-800">{{ $log->created_at->format('d M Y') }}</div>
                                <div class="text-xs text-gray-400 font-medium mt-0.5">{{ $log->created_at->format('H:i') }} WIB</div>
                            </td>
                            
                            <!-- Kolom Tipe (Badge Estetik) -->
                            <td class="p-4 align-middle text-center">
                                @if($log->type == 'IN')
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-md bg-emerald-50 text-emerald-700 border border-emerald-100 font-bold text-[11px] tracking-wider w-24 justify-center">
                                        <i class="ph-bold ph-arrow-down-left mr-1.5"></i> MASUK
                                    </span>
                                @elseif($log->type == 'OUT')
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-md bg-rose-50 text-rose-700 border border-rose-100 font-bold text-[11px] tracking-wider w-24 justify-center">
                                        <i class="ph-bold ph-arrow-up-right mr-1.5"></i> KELUAR
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-md bg-yellow-50 text-yellow-700 border border-yellow-100 font-bold text-[11px] tracking-wider w-24 justify-center">
                                        <i class="ph-bold ph-arrows-left-right mr-1.5"></i> MUTASI
                                    </span>
                                @endif
                            </td>
                            
                            <!-- Kolom Barang -->
                            <td class="p-4 font-bold text-gray-800 align-middle">
                                {{ $log->item->name ?? 'Barang Dihapus' }}
                            </td>
                            
                            <!-- Kolom Qty -->
                            <td class="p-4 text-center align-middle">
                                <span class="font-extrabold text-gray-800 text-base">{{ $log->qty }}</span>
                            </td>
                            
                            <!-- Kolom Keterangan -->
                            <td class="p-4 text-gray-500 text-xs align-middle max-w-[200px] leading-relaxed font-medium">
                                {{ $log->description ?? '-' }}
                            </td>
                            
                            <!-- Kolom Admin (Lebih simple tanpa kotak berlebihan) -->
                            <td class="p-4 align-middle">
                                <div class="flex items-center text-xs font-semibold text-gray-600">
                                    <div class="w-6 h-6 rounded-full bg-gray-200 flex items-center justify-center text-gray-500 mr-2 uppercase">
                                        {{ substr($log->user->name ?? 'S', 0, 1) }}
                                    </div>
                                    {{ $log->user->name ?? 'System' }}
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="p-16 text-center">
                                <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-gray-50 mb-4">
                                    <i class="ph-fill ph-file-text text-3xl text-gray-300"></i>
                                </div>
                                <p class="text-base font-bold text-gray-700">Belum Ada Aktivitas</p>
                                <p class="text-sm text-gray-500 mt-1">Data riwayat barang keluar-masuk akan muncul di sini.</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Sembunyikan Header dan Sidebar saat di-Print -->
    <style>
        @media print {
            aside, header, button, a[href*="export"] { display: none !important; }
            .p-6 { padding: 0 !important; }
            .shadow-sm { box-shadow: none !important; border: none !important; }
        }
    </style>
</x-app-layout>