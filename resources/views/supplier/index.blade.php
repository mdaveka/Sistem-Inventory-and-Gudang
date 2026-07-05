<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center">
            <i class="ph-fill ph-truck text-blue-500 text-2xl mr-3"></i> 
            Data Supplier
        </div>
    </x-slot>

    @if(session('success'))
    <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg mb-4 flex items-center fade-in">
        <i class="ph-fill ph-check-circle text-xl mr-2"></i> {{ session('success') }}
    </div>
    @endif

    <div class="p-6">
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 fade-in">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-lg font-semibold text-gray-800 flex items-center">
                    Daftar Supplier
                </h3>
                
                @if(Auth::user()->role === 'admin')
                <button onclick="openModal('modal-tambah')" class="bg-blue-600 text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-blue-700 flex items-center transition shadow-sm">
                    <i class="ph ph-plus mr-2"></i> Tambah Supplier
                </button>
                @endif
            </div>
            
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-50 text-gray-500 text-xs uppercase border-y border-gray-200">
                            <th class="p-4 font-medium text-center">No</th>
                            <th class="p-4 font-medium">Nama Supplier</th>
                            <th class="p-4 font-medium">No. Telepon</th>
                            <th class="p-4 font-medium text-center">Alamat</th>
                            @if(Auth::user()->role === 'admin')
                            <th class="p-4 font-medium text-center">Aksi</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody class="text-sm divide-y divide-gray-100">
                        @forelse($suppliers as $index => $supplier)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="p-4 text-gray-500 text-center align-middle">{{ $index + 1 }}</td>
                            <td class="p-4 font-bold text-gray-800 align-middle">{{ $supplier->name }}</td>
                            <td class="p-4 text-gray-600 align-middle">{{ $supplier->phone ?? '-' }}</td>
                            <td class="p-4 text-gray-600 align-middle">{{ $supplier->address ?? '-' }}</td>
                            
                            @if(Auth::user()->role === 'admin')
                            <td class="p-4 align-middle">
                                <div class="flex justify-center items-center space-x-2">
                                    <button onclick="openEditModal('{{ $supplier->id }}', '{{ $supplier->name }}', '{{ $supplier->phone }}', '{{ $supplier->address }}')" class="text-blue-500 hover:text-blue-700 bg-blue-50 p-1.5 rounded flex items-center justify-center transition" title="Edit">
                                        <i class="ph ph-pencil-simple text-lg"></i>
                                    </button>
                                    
                                    <form action="{{ route('supplier.destroy', $supplier->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus supplier ini?');" class="m-0">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500 hover:text-red-700 bg-red-50 p-1.5 rounded flex items-center justify-center transition" title="Hapus">
                                            <i class="ph ph-trash text-lg"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                            @endif
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="p-12 text-center text-gray-500">
                                <i class="ph ph-truck text-4xl mb-2 text-gray-300 block mx-auto"></i>
                                Belum ada data supplier.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- MODAL TAMBAH: Kotak Terpusat -->
    <div id="modal-tambah" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50 fade-in">
        <div class="bg-white rounded-xl shadow-2xl w-full max-w-xl mx-4 overflow-hidden border border-gray-200">
            <div class="px-6 py-4 border-b flex justify-between items-center bg-blue-50 text-blue-800">
                <h3 class="font-bold text-lg flex items-center"><i class="ph-fill ph-truck mr-2"></i> Tambah Supplier Baru</h3>
                <button onclick="closeModal('modal-tambah')" class="text-gray-400 hover:text-red-500 transition"><i class="ph ph-x text-xl"></i></button>
            </div>
            <form action="{{ route('supplier.store') }}" method="POST">
                @csrf
                <div class="p-6 space-y-4">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Nama Supplier *</label>
                            <input type="text" name="name" required class="w-full border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 text-sm">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">No. Telepon</label>
                            <input type="text" name="phone" placeholder="0812..." class="w-full border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 text-sm">
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Alamat Lengkap</label>
                        <textarea name="address" rows="3" class="w-full border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 text-sm"></textarea>
                    </div>
                </div>
                <div class="px-6 py-4 bg-gray-50 border-t flex justify-end space-x-3">
                    <button type="button" onclick="closeModal('modal-tambah')" class="px-5 py-2 text-gray-600 bg-gray-200 rounded-lg text-sm font-medium transition hover:bg-gray-300">Batal</button>
                    <button type="submit" class="px-5 py-2 bg-blue-600 text-white rounded-lg text-sm font-medium transition shadow-md hover:bg-blue-700">Simpan Supplier</button>
                </div>
            </form>
        </div>
    </div>

    <!-- MODAL EDIT: Kotak Terpusat -->
    <div id="modal-edit" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50 fade-in">
        <div class="bg-white rounded-xl shadow-2xl w-full max-w-xl mx-4 overflow-hidden border border-gray-200">
            <div class="px-6 py-4 border-b flex justify-between items-center bg-blue-50 text-blue-800">
                <h3 class="font-bold text-lg flex items-center"><i class="ph-fill ph-truck mr-2"></i> Edit Data Supplier</h3>
                <button onclick="closeModal('modal-edit')" class="text-gray-400 hover:text-red-500 transition"><i class="ph ph-x text-xl"></i></button>
            </div>
            <form id="form-edit-supplier" method="POST">
                @csrf
                @method('PUT')
                <div class="p-6 space-y-4">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Nama Supplier *</label>
                            <input type="text" name="name" id="edit_name" required class="w-full border-gray-300 rounded-lg text-sm">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">No. Telepon</label>
                            <input type="text" name="phone" id="edit_phone" class="w-full border-gray-300 rounded-lg text-sm">
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Alamat Lengkap</label>
                        <textarea name="address" id="edit_address" rows="3" class="w-full border-gray-300 rounded-lg text-sm"></textarea>
                    </div>
                </div>
                <div class="px-6 py-4 bg-gray-50 border-t flex justify-end space-x-3">
                    <button type="button" onclick="closeModal('modal-edit')" class="px-5 py-2 text-gray-600 bg-gray-200 rounded-lg text-sm font-medium transition hover:bg-gray-300">Batal</button>
                    <button type="submit" class="px-5 py-2 bg-blue-600 text-white rounded-lg text-sm font-medium transition shadow-md hover:bg-blue-700">Update Data</button>
                </div>
            </form>
        </div>
    </div>

    @push('scripts')
        <script src="{{ asset('js/supplier.js') }}"></script>
    @endpush
</x-app-layout>