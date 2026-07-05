<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center">
            <i class="ph-fill ph-warning-circle text-orange-500 text-2xl mr-3"></i> 
            Minimum Stock Alert
        </div>
    </x-slot>

    <div class="p-6">
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 fade-in">
            <!-- Banner Peringatan -->
            <div class="bg-red-50 border border-red-200 text-red-700 px-5 py-4 rounded-xl flex items-center mb-6 shadow-sm">
                <i class="ph-fill ph-warning-circle text-3xl mr-4"></i>
                <div>
                    <p class="font-bold text-lg leading-tight">Perhatian!</p>
                    <p class="text-sm mt-1">Daftar barang di bawah ini sudah mencapai atau melewati batas minimum stok. Segera lakukan pemesanan (Restock) ke Supplier terkait.</p>
                </div>
            </div>
            
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-50 text-gray-500 text-xs uppercase border-y border-gray-200">
                            <th class="p-4 font-semibold text-center w-16">No</th>
                            <th class="p-4 font-semibold">Barcode</th>
                            <th class="p-4 font-semibold">Nama Barang</th>
                            <th class="p-4 font-semibold">Supplier</th>
                            <th class="p-4 font-semibold text-center">Sisa Stok</th>
                            <th class="p-4 font-semibold text-center">Batas Min.</th>
                        </tr>
                    </thead>
                    <tbody class="text-sm divide-y divide-gray-100">
                        @forelse($alerts as $index => $item)
                        <tr class="hover:bg-orange-50/30 transition">
                            <td class="p-4 text-center text-gray-500 align-middle">{{ $index + 1 }}</td>
                            <td class="p-4 font-mono text-gray-600 align-middle">{{ $item->barcode ?? '-' }}</td>
                            <td class="p-4 font-bold text-gray-800 align-middle">{{ $item->name }}</td>
                            <td class="p-4 text-gray-600 align-middle">
                                <div class="flex items-center text-xs">
                                    <i class="ph ph-truck mr-1 text-gray-400"></i> {{ $item->supplier->name ?? '-' }}
                                </div>
                            </td>
                            <td class="p-4 text-center align-middle">
                                <span class="text-red-600 font-extrabold text-lg">{{ $item->stock }}</span>
                            </td>
                            <td class="p-4 text-center align-middle">
                                <span class="text-gray-500 font-medium">{{ $item->min_stock }}</span>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="p-12 text-center text-gray-400">
                                <i class="ph-fill ph-check-circle text-5xl mb-3 text-emerald-400 block mx-auto"></i>
                                <span class="font-medium text-gray-500">Semua stok barang dalam kondisi aman!</span><br>
                                <span class="text-xs">Tidak ada peringatan restock saat ini.</span>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>