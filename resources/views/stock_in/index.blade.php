<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center">
            <i class="ph-fill ph-arrow-down-left text-green-500 text-2xl mr-3"></i> 
            Transaksi Stok Masuk
        </div>
    </x-slot>

    @if(session('success'))
    <div class="bg-emerald-50 border border-emerald-200 text-emerald-700 px-4 py-3 rounded-lg mb-4 flex items-center fade-in mx-6 mt-6">
        <i class="ph-fill ph-check-circle text-xl mr-2"></i> {{ session('success') }}
    </div>
    @endif
    
    @if($errors->any())
    <div class="bg-rose-50 border border-rose-200 text-rose-700 px-4 py-3 rounded-xl mb-4 flex items-center fade-in mx-6 mt-6 shadow-sm">
        <i class="ph-fill ph-warning-circle text-xl mr-3"></i> 
        <span class="font-medium text-sm">{{ $errors->first() }}</span>
    </div>
    @endif

    <div class="p-6">
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 fade-in">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-lg font-semibold text-gray-800 flex items-center">
                    Riwayat Penerimaan Barang
                </h3>
                
                <button onclick="document.getElementById('modal-in').classList.remove('hidden'); document.getElementById('modal-in').classList.add('flex')" class="bg-blue-600 text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-blue-700 flex items-center transition shadow-sm">
                    <i class="ph ph-plus mr-2"></i> Tambah Stok Masuk
                </button>
            </div>
            
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-50 text-gray-500 text-xs uppercase border-y border-gray-200">
                            <th class="p-4 font-medium">Tanggal</th>
                            <th class="p-4 font-medium">Nama Barang</th>
                            <th class="p-4 font-medium">Gudang Penerima</th>
                            <th class="p-4 font-medium text-center">Jumlah (Qty)</th>
                            <th class="p-4 font-medium">Penerima</th>
                        </tr>
                    </thead>
                    <tbody class="text-sm divide-y divide-gray-100">
                        @forelse($stockIns as $in)
                        <tr class="hover:bg-green-50/30 transition">
                            <td class="p-4 text-gray-600 align-middle">
                                {{ \Carbon\Carbon::parse($in->date_in)->format('d M Y') }}
                            </td>
                            <td class="p-4 font-bold text-gray-800 align-middle">
                                {{ $in->item->name ?? 'Barang Dihapus' }}
                            </td>
                            <td class="p-4 text-gray-600 align-middle">
                                <div class="flex items-center text-xs">
                                    <i class="ph-fill ph-buildings mr-2 text-gray-400 text-lg"></i>
                                    {{ $in->warehouse->name ?? 'Gudang Dihapus' }}
                                </div>
                            </td>
                            <td class="p-4 text-center align-middle">
                                <span class="bg-green-100 text-green-700 font-bold px-3 py-1 rounded-full text-xs">
                                    + {{ $in->qty }}
                                </span>
                            </td>
                            <td class="p-4 text-gray-500 align-middle">
                                <div class="flex items-center text-xs">
                                    <i class="ph-fill ph-user-circle mr-1 text-lg text-gray-400"></i>
                                    {{ $in->user->name ?? 'System' }}
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="p-12 text-center text-gray-400 italic">
                                <i class="ph ph-arrow-down-left text-4xl mb-2 text-gray-300 block mx-auto"></i>
                                Belum ada riwayat stok masuk.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- MODAL FORM STOK MASUK (Standar Desain Baru) -->
    <div id="modal-in" class="fixed inset-0 bg-slate-900/50 hidden items-center justify-center z-50 fade-in">
         <div class="bg-white rounded-xl shadow-2xl w-full max-w-xl mx-4 overflow-hidden border border-gray-200">
            <div class="px-6 py-4 border-b flex justify-between items-center bg-green-50/50">
                <h3 class="font-bold text-lg text-gray-800 flex items-center">
                    <i class="ph-fill ph-arrow-down-left text-gray-700 mr-2"></i> Input Stok Masuk
                </h3>
                <button onclick="document.getElementById('modal-in').classList.add('hidden'); document.getElementById('modal-in').classList.remove('flex')" class="text-gray-400 hover:text-red-500 transition-colors">
                    <i class="ph ph-x text-xl"></i>
                </button>
            </div>
            
            <form action="{{ route('stock-in.store') }}" method="POST">
                @csrf
                <div class="p-6 space-y-4 bg-white">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Pilih Barang *</label>
                        <select name="item_id" required class="w-full border-gray-300 rounded-lg focus:ring-green-500 focus:border-green-500 text-sm px-4 py-2">
                            <option value="">-- Pilih Barang --</option>
                            @foreach($items as $item)
                            <option value="{{ $item->id }}">{{ $item->name }} (Stok: {{ $item->stock }})</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Gudang Penerima *</label>
                        <select name="warehouse_id" required class="w-full border-gray-300 rounded-lg focus:ring-green-500 focus:border-green-500 text-sm px-4 py-2">
                            <option value="">-- Pilih Gudang --</option>
                            @foreach($warehouses as $wh)
                            <option value="{{ $wh->id }}">{{ $wh->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Jumlah (Qty) *</label>
                            <input type="number" name="qty" placeholder="0" min="1" required class="w-full border-gray-300 rounded-lg focus:ring-green-500 focus:border-green-500 text-sm px-4 py-2">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal *</label>
                            <input type="date" name="date_in" value="{{ date('Y-m-d') }}" required class="w-full border-gray-300 rounded-lg focus:ring-green-500 focus:border-green-500 text-sm px-4 py-2">
                        </div>
                    </div>
                </div>
                
                <div class="px-6 py-4 bg-white border-t flex justify-end space-x-3">
                    <button type="button" onclick="document.getElementById('modal-in').classList.add('hidden'); document.getElementById('modal-in').classList.remove('flex')" class="px-4 py-2 text-gray-600 bg-gray-200 hover:bg-gray-300 rounded-lg text-sm font-medium transition-colors">
                        Batal
                    </button>
                    <button type="submit" class="px-5 py-2 bg-blue-600 text-white rounded-lg text-sm font-medium transition shadow-md hover:bg-blue-700">Simpan Stock</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>