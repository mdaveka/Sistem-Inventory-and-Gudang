<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center">
            <i class="ph-fill ph-buildings text-blue-600 text-2xl mr-3"></i> 
            Data Gudang
        </div>
    </x-slot>

    @if(session('success'))
    <div class="bg-emerald-50 border border-emerald-200 text-emerald-700 px-4 py-3 rounded-lg mb-4 flex items-center fade-in mx-6 mt-6">
        <i class="ph-fill ph-check-circle text-xl mr-2"></i> {{ session('success') }}
    </div>
    @endif

    <div class="p-6">
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 fade-in">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-lg font-semibold text-gray-800 flex items-center">
                    Lokasi Penyimpanan & Distribusi
                </h3>
                
                @if(Auth::user()->role === 'admin')
                <button onclick="openModal('modal-tambah')" class="bg-blue-600 text-white px-4 py-2 rounded-lg text-sm font-semibold hover:bg-blue-700 flex items-center transition shadow-md">
                    <i class="ph ph-plus mr-2 font-bold"></i> Tambah Gudang
                </button>
                @endif
            </div>
            
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-50 text-gray-500 text-xs uppercase border-y border-gray-200">
                            <th class="p-4 font-semibold text-center w-16">No</th>
                            <th class="p-4 font-semibold">Nama Gudang</th>
                            <th class="p-4 font-semibold">Keterangan Lokasi</th>
                            @if(Auth::user()->role === 'admin')
                            <th class="p-4 font-semibold text-center w-32">Aksi</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody class="text-sm divide-y divide-gray-100">
                        @forelse($warehouses as $index => $warehouse)
                        <tr class="hover:bg-blue-50/30 transition">
                            <td class="p-4 text-gray-400 text-center align-middle">{{ $index + 1 }}</td>
                            <td class="p-4 font-bold text-gray-800 align-middle">{{ $warehouse->name }}</td>
                            <td class="p-4 text-gray-600 align-middle">
                                <div class="flex items-center text-xs">
                                    <i class="ph ph-map-pin mr-2 text-blue-500"></i>
                                    {{ $warehouse->location ?? '-' }}
                                </div>
                            </td>
                            
                            @if(Auth::user()->role === 'admin')
                            <td class="p-4 align-middle">
                                <div class="flex justify-center items-center space-x-2">
                                    <button onclick="openEditModal('{{ $warehouse->id }}', '{{ $warehouse->name }}', '{{ $warehouse->location }}')" class="text-blue-600 hover:bg-blue-50 p-2 rounded-lg transition" title="Edit">
                                        <i class="ph ph-pencil-simple text-lg"></i>
                                    </button>
                                    
                                    <form action="{{ route('warehouse.destroy', $warehouse->id) }}" method="POST" onsubmit="return confirm('Hapus gudang ini?');" class="m-0">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="text-rose-600 hover:bg-rose-50 p-2 rounded-lg transition" title="Hapus">
                                            <i class="ph ph-trash text-lg"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                            @endif
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="p-12 text-center text-gray-400 italic">
                                Belum ada lokasi gudang yang terdaftar.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- MODAL TAMBAH GUDANG (Diubah menjadi max-w-xl agar Menengah) -->
    <div id="modal-tambah" class="fixed inset-0 bg-slate-900/60 hidden items-center justify-center z-50 fade-in backdrop-blur-sm">
        <div class="bg-white rounded-xl shadow-2xl w-full max-w-xl mx-4 overflow-hidden border border-gray-200">
            <div class="px-6 py-5 border-b flex justify-between items-center bg-blue-50 text-gray-800">
                <div class="flex items-center">
                    <i class="ph-fill ph-buildings text-blue-600 text-xl mr-3"></i>
                    <h3 class="font-bold text-lg text-gray-800">Tambah Gudang Baru</h3>
                </div>
                <button onclick="closeModal('modal-tambah')" class="text-gray-400 hover:text-red-500 transition-all p-1">
                    <i class="ph ph-x text-xl"></i>
                </button>
            </div>
            
            <form action="{{ route('warehouse.store') }}" method="POST" class="p-6 bg-white">
                @csrf
                <div class="space-y-5">
                    <div class="space-y-1">
                        <label class="text-xs font-bold text-gray-500 uppercase tracking-widest ml-1">Nama Gudang *</label>
                        <input type="text" name="name" required placeholder="Contoh: Gudang Distribusi Solo" class="w-full border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm py-3 transition-all placeholder:text-gray-300 bg-gray-50/30">
                    </div>
                    <div class="space-y-1">
                        <label class="text-xs font-bold text-gray-500 uppercase tracking-widest ml-1">Keterangan Lokasi / Alamat</label>
                        <textarea name="location" rows="3" placeholder="Alamat lengkap gudang..." class="w-full border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm py-3 transition-all placeholder:text-gray-300 bg-gray-50/30"></textarea>
                    </div>
                </div>
                
                <div class="mt-8 flex justify-end items-center space-x-4">
                    <button type="button" onclick="closeModal('modal-tambah')" class="px-6 py-2.5 text-gray-500 hover:text-gray-700 font-semibold text-sm transition bg-gray-100 hover:bg-gray-200 rounded-lg">
                        Batal
                    </button>
                    <button type="submit" class="px-10 py-2.5 bg-blue-600 hover:bg-blue-700 text-white rounded-xl text-sm font-bold shadow-lg shadow-blue-100 transition-all transform active:scale-95">
                        Simpan Gudang
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- MODAL EDIT GUDANG (Diubah menjadi max-w-xl agar Menengah) -->
    <div id="modal-edit" class="fixed inset-0 bg-slate-900/60 hidden items-center justify-center z-50 fade-in backdrop-blur-sm">
        <div class="bg-white rounded-2xl shadow-2xl w-full max-w-xl mx-4 overflow-hidden border border-gray-100">
            <div class="px-6 py-5 border-b flex justify-between items-center bg-blue-50 text-gray-800">
                <div class="flex items-center">
                    <i class="ph-fill ph-pencil-simple text-blue-600 text-xl mr-3"></i>
                    <h3 class="font-bold text-lg text-gray-800">Edit Data Gudang</h3>
                </div>
                <button onclick="closeModal('modal-edit')" class="text-gray-400 hover:text-red-500 transition-all p-1">
                    <i class="ph ph-x text-xl"></i>
                </button>
            </div>
            <form id="form-edit-warehouse" method="POST" class="p-6 bg-white">
                @csrf
                @method('PUT')
                <div class="space-y-5">
                    <div class="space-y-1">
                        <label class="text-xs font-bold text-gray-500 uppercase tracking-widest ml-1">Nama Gudang *</label>
                        <input type="text" name="name" id="edit_name" required class="w-full border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm py-3 transition-all bg-gray-50/30">
                    </div>
                    <div class="space-y-1">
                        <label class="text-xs font-bold text-gray-500 uppercase tracking-widest ml-1">Keterangan Lokasi</label>
                        <textarea name="location" id="edit_location" rows="3" class="w-full border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm py-3 transition-all bg-gray-50/30"></textarea>
                    </div>
                </div>
                <div class="mt-8 flex justify-end items-center space-x-4">
                    <button type="button" onclick="closeModal('modal-edit')" class="px-6 py-2.5 text-gray-500 hover:text-gray-700 font-semibold text-sm transition bg-gray-100 hover:bg-gray-200 rounded-lg">
                        Batal
                    </button>
                    <button type="submit" class="px-10 py-2.5 bg-blue-600 hover:bg-blue-700 text-white rounded-xl text-sm font-bold shadow-lg shadow-blue-100 transition-all">
                        Update Data
                    </button>
                </div>
            </form>
        </div>
    </div>

    @push('scripts')
        <script src="{{ asset('js/warehouse.js') }}"></script>
    @endpush
</x-app-layout>