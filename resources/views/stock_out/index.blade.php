<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center">
            <i class="ph-fill ph-arrow-up-right text-red-500 text-2xl mr-3"></i> 
            Transaksi Stok Keluar
        </div>
    </x-slot>

    @if($errors->any())
    <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg mb-4 flex items-center fade-in mx-6 mt-6">
        <i class="ph-fill ph-warning-circle text-xl mr-2"></i> {{ $errors->first() }}
    </div>
    @endif

    @if(session('success'))
    <div class="bg-emerald-50 border border-emerald-200 text-emerald-700 px-4 py-3 rounded-lg mb-4 flex items-center fade-in mx-6 mt-6">
        <i class="ph-fill ph-check-circle text-xl mr-2"></i> {{ session('success') }}
    </div>
    @endif

    <div class="p-6">
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 fade-in">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-lg font-semibold text-gray-800 flex items-center">
                    Riwayat Pengeluaran Barang
                </h3>
                <button onclick="document.getElementById('modal-out').classList.remove('hidden'); document.getElementById('modal-out').classList.add('flex')" class="bg-red-600 text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-red-700 flex items-center transition shadow-sm">
                    <i class="ph ph-minus mr-2"></i> Tambah Stok Keluar
                </button>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-50 text-gray-500 text-xs uppercase border-y border-gray-200">
                            <th class="p-4 font-medium">Tanggal</th>
                            <th class="p-4 font-medium">Nama Barang</th>
                            <th class="p-4 font-medium">Dari Gudang</th>
                            <th class="p-4 font-medium text-center">Jumlah</th>
                            <th class="p-4 font-medium">Tujuan</th>
                        </tr>
                    </thead>
                    <tbody class="text-sm divide-y divide-gray-100">
                        @forelse($stockOuts as $out)
                        <tr class="hover:bg-red-50/30 transition">
                            <td class="p-4 text-gray-600 align-middle">{{ \Carbon\Carbon::parse($out->date_out)->format('d M Y') }}</td>
                            <td class="p-4 font-bold text-gray-800 align-middle">{{ $out->item->name ?? 'Barang Dihapus' }}</td>
                            <td class="p-4 text-gray-600 align-middle">
                                <div class="flex items-center text-xs">
                                    <i class="ph-fill ph-buildings mr-2 text-gray-400 text-lg"></i>
                                    {{ $out->warehouse->name ?? '-' }}
                                </div>
                            </td>
                            <td class="p-4 text-center align-middle">
                                <span class="bg-red-100 text-red-700 font-bold px-3 py-1 rounded-full text-xs">- {{ $out->qty }}</span>
                            </td>
                            <td class="p-4 text-gray-500 align-middle text-xs">{{ $out->destination ?? '-' }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="p-12 text-center text-gray-400 italic">
                                <i class="ph ph-arrow-up-right text-4xl mb-2 text-gray-300 block mx-auto"></i>
                                Belum ada riwayat stok keluar.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- MODAL FORM STOK KELUAR -->
    <div id="modal-out" class="fixed inset-0 bg-slate-900/50 hidden items-center justify-center z-50 fade-in">
         <div class="bg-white rounded-xl shadow-2xl w-full max-w-xl mx-4 overflow-hidden border border-gray-200">
            <div class="px-6 py-4 border-b flex justify-between items-center bg-red-50/50">
                <h3 class="font-bold text-lg text-gray-800 flex items-center">
                    <i class="ph-fill ph-arrow-up-right text-gray-700 mr-2"></i> Input Stok Keluar
                </h3>
                <button onclick="document.getElementById('modal-out').classList.add('hidden'); document.getElementById('modal-out').classList.remove('flex')" class="text-gray-400 hover:text-red-500 transition-colors">
                    <i class="ph ph-x text-xl"></i>
                </button>
            </div>
            
            <form action="{{ route('stock-out.store') }}" method="POST">
                @csrf
                <div class="p-6 space-y-4 bg-white">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Pilih Barang *</label>
                        <select name="item_id" required class="w-full border-gray-300 rounded-lg focus:ring-red-500 focus:border-red-500 text-sm px-4 py-2">
                            <option value="">-- Pilih Barang --</option>
                            @foreach($items as $item)
                            <option value="{{ $item->id }}">{{ $item->name }} (Tersedia: {{ $item->stock }})</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Asal Gudang *</label>
                        <select name="warehouse_id" required class="w-full border-gray-300 rounded-lg focus:ring-red-500 focus:border-red-500 text-sm px-4 py-2">
                            <option value="">-- Pilih Gudang --</option>
                            @foreach($warehouses as $wh)
                            <option value="{{ $wh->id }}">{{ $wh->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Jumlah (Qty) *</label>
                            <input type="number" name="qty" placeholder="0" min="1" required class="w-full border-gray-300 rounded-lg focus:ring-red-500 focus:border-red-500 text-sm px-4 py-2">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal *</label>
                            <input type="date" name="date_out" value="{{ date('Y-m-d') }}" required class="w-full border-gray-300 rounded-lg focus:ring-red-500 focus:border-red-500 text-sm px-4 py-2">
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Tujuan Distribusi</label>
                        <input type="text" name="destination" placeholder="Misal: Toko Cabang A" class="w-full border-gray-300 rounded-lg focus:ring-red-500 focus:border-red-500 text-sm px-4 py-2">
                    </div>
                </div>
                
                <div class="px-6 py-4 bg-white border-t flex justify-end space-x-3">
                    <button type="button" onclick="document.getElementById('modal-out').classList.add('hidden'); document.getElementById('modal-out').classList.remove('flex')" class="px-4 py-2 text-gray-600 bg-gray-200 hover:bg-gray-300 rounded-lg text-sm font-medium transition-colors">
                        Batal
                    </button>
                    <button type="submit" class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg text-sm font-medium transition-colors">
                        Keluarkan Barang
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>