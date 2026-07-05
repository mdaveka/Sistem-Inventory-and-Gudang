<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center">
            <i class="ph-fill ph-arrows-left-right text-blue-600 text-2xl mr-3"></i> 
            Mutasi Gudang
        </div>
    </x-slot>

    @if(session('success'))
    <div class="bg-emerald-50 border border-emerald-200 text-emerald-700 px-4 py-3 rounded-lg mb-4 flex items-center fade-in mx-6 mt-6">
        <i class="ph-fill ph-check-circle text-xl mr-2"></i> {{ session('success') }}
    </div>
    @endif

    @if($errors->any())
    <div class="bg-rose-50 border border-rose-200 text-rose-700 px-4 py-3 rounded-lg mb-4 mx-6 mt-6 fade-in">
        <div class="flex items-center mb-1 font-bold">
            <i class="ph-fill ph-x-circle text-xl mr-2"></i> Terjadi Kesalahan:
        </div>
        <ul class="list-disc pl-7 text-sm space-y-1">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <div class="p-6">
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 fade-in">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-lg font-semibold text-gray-800 flex items-center">
                    Riwayat Mutasi Antar Gudang
                </h3>
                <button onclick="document.getElementById('modal-mutasi').classList.remove('hidden'); document.getElementById('modal-mutasi').classList.add('flex')" class="bg-blue-600 text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-blue-700 flex items-center transition shadow-sm">
                    <i class="ph ph-plus mr-2"></i> Pindahkan Barang
                </button>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-50 text-gray-500 text-xs uppercase border-y border-gray-200">
                            <th class="p-4 font-medium">Tanggal</th>
                            <th class="p-4 font-medium">Nama Barang</th>
                            <th class="p-4 font-medium">Dari Gudang</th>
                            <th class="p-4 font-medium">Ke Gudang</th>
                            <th class="p-4 font-medium text-center">Jumlah</th>
                            <th class="p-4 font-medium">Oleh</th>
                        </tr>
                    </thead>
                    <tbody class="text-sm divide-y divide-gray-100">
                        @forelse($mutations as $mut)
                        <tr class="hover:bg-blue-50/30 transition">
                            <td class="p-4 text-gray-600 align-middle">{{ $mut->created_at->format('d M Y') }}</td>
                            <td class="p-4 font-bold text-gray-800 align-middle">{{ $mut->item->name ?? 'Barang Dihapus' }}</td>
                            <td class="p-4 text-red-600 align-middle">
                                <div class="flex items-center text-xs">
                                    <i class="ph ph-export mr-1"></i> {{ $mut->from_warehouse->name ?? '-' }}
                                </div>
                            </td>
                            <td class="p-4 text-green-600 align-middle">
                                <div class="flex items-center text-xs">
                                    <i class="ph ph-import mr-1"></i> {{ $mut->to_warehouse->name ?? '-' }}
                                </div>
                            </td>
                            <td class="p-4 text-center align-middle">
                                <span class="bg-blue-100 text-blue-700 font-bold px-3 py-1 rounded-full text-xs">{{ $mut->qty }} unit</span>
                            </td>
                            <td class="p-4 text-gray-500 align-middle italic text-xs">
                                <div class="flex items-center">
                                    <i class="ph-fill ph-user-circle mr-1 text-lg text-gray-400"></i>
                                    {{ $mut->user->name ?? 'System' }}
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="p-12 text-center text-gray-400 italic">
                                <i class="ph ph-arrows-left-right text-4xl mb-2 text-gray-300 block mx-auto"></i>
                                Belum ada riwayat mutasi barang.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- MODAL FORM MUTASI (100% Mengikuti Struktur Modal Supplier) -->
    <div id="modal-mutasi" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50 fade-in">
         <div class="bg-white rounded-xl shadow-2xl w-full max-w-xl mx-4 overflow-hidden border border-gray-200">
            
            <div class="px-6 py-4 border-b flex justify-between items-center bg-blue-50">
                <h3 class="font-bold text-lg text-gray-800 flex items-center">
                    <i class="ph-fill ph-arrows-left-right text-blue-600 mr-2 text-xl"></i> Mutasi Barang
                </h3>
                <button type="button" onclick="document.getElementById('modal-mutasi').classList.add('hidden'); document.getElementById('modal-mutasi').classList.remove('flex')" class="text-gray-400 hover:text-red-500 transition-colors">
                    <i class="ph ph-x text-xl"></i>
                </button>
            </div>
            
            <form action="{{ route('mutasi.store') }}" method="POST">
                @csrf
                <div class="p-6 space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Pilih Barang *</label>
                        <select name="item_id" required class="w-full border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 text-sm">
                            <option value="">-- Pilih Barang --</option>
                            @foreach($items as $item)
                            <option value="{{ $item->id }}">{{ $item->name }} (Stok: {{ $item->stock }})</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Asal Gudang *</label>
                            <select name="from_warehouse_id" required class="w-full border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 text-sm">
                                <option value="">-- Dari --</option>
                                @foreach($warehouses as $wh)
                                <option value="{{ $wh->id }}">{{ $wh->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Gudang Tujuan *</label>
                            <select name="to_warehouse_id" required class="w-full border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 text-sm">
                                <option value="">-- Ke --</option>
                                @foreach($warehouses as $wh)
                                <option value="{{ $wh->id }}">{{ $wh->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Jumlah Unit *</label>
                        <input type="number" name="qty" placeholder="0" min="1" required class="w-full border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 text-sm">
                    </div>
                </div>
                
                <div class="px-6 py-4 bg-gray-50 border-t flex justify-end space-x-3">
                    <button type="button" onclick="document.getElementById('modal-mutasi').classList.add('hidden'); document.getElementById('modal-mutasi').classList.remove('flex')" class="px-4 py-2 text-gray-600 bg-gray-200 hover:bg-gray-300 rounded-lg text-sm font-medium transition-colors">
                        Batal
                    </button>
                    <button type="submit" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg text-sm font-medium transition-colors">
                        Proses Mutasi
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>