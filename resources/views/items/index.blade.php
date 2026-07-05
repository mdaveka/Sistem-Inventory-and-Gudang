<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center">
            <div class="bg-blue-100 text-blue-600 p-2 rounded-lg mr-3">
                <i class="ph-bold ph-box-box text-xl"></i>
            </div>
            <span class="font-bold text-gray-800 text-xl tracking-tight">Data Barang</span>
        </div>
    </x-slot>

    @if(session('success'))
    <div class="bg-emerald-50 border border-emerald-200 text-emerald-700 px-4 py-3 rounded-xl mb-4 flex items-center fade-in mx-6 mt-6 shadow-sm">
        <i class="ph-fill ph-check-circle text-xl mr-3"></i> 
        <span class="font-medium text-sm">{{ session('success') }}</span>
    </div>
    @endif

    @if($errors->any())
    <div class="bg-rose-50 border border-rose-200 text-rose-700 px-4 py-3 rounded-xl mb-4 flex items-center fade-in mx-6 mt-6 shadow-sm">
        <i class="ph-fill ph-warning-circle text-xl mr-3"></i> 
        <span class="font-medium text-sm">{{ $errors->first() }}</span>
    </div>
    @endif

    <div class="p-6">
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 fade-in">
            
            <!-- HEADER & ACTION BAR -->
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-6">
                <!-- Bagian Kiri: Judul -->
                <div class="w-full md:flex-1 text-left mb-2 md:mb-0">
                    <h3 class="text-xl font-bold text-gray-800 tracking-tight">Daftar Inventaris Barang</h3>
                    <p class="text-sm text-gray-500 mt-1">Kelola data barang, stok, dan cetak barcode.</p>
                </div>
                
                <!-- Bagian Kanan: Pencarian & Tombol -->
                <div class="flex flex-row items-center justify-end gap-3 w-full md:w-auto">
                    <!-- Form Search -->
                    <form action="{{ route('items.index') }}" method="GET" class="relative w-full sm:w-64 lg:w-80 flex-1 sm:flex-none">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="ph ph-magnifying-glass text-gray-400 text-lg"></i>
                        </div>
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama atau barcode..." class="block w-full pl-9 pr-9 py-2 border border-gray-200 rounded-lg text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 bg-gray-50 hover:bg-white transition-all outline-none">
                        @if(request('search'))
                            <a href="{{ route('items.index') }}" class="absolute inset-y-0 right-0 pr-2.5 flex items-center text-rose-400 hover:text-rose-600 transition-colors">
                                <i class="ph-fill ph-x-circle text-lg"></i>
                            </a>
                        @endif
                    </form>

                    <!-- TOMBOL CETAK LABEL (Muncul otomatis saat checkbox dicentang) -->
                    <button type="submit" form="form-print-barcode" id="btn-print-barcode" class="hidden shrink-0 bg-emerald-600 text-white px-3.5 py-2 rounded-lg text-sm font-medium hover:bg-emerald-700 items-center justify-center transition-all shadow-sm active:scale-95 whitespace-nowrap">
                        <i class="ph-bold ph-printer mr-1.5 text-base"></i> Cetak Label
                    </button>

                    @if(Auth::user()->role === 'admin')
                    <!-- Tombol Tambah Barang -->
                    <button onclick="document.getElementById('modal-tambah').classList.remove('hidden'); document.getElementById('modal-tambah').classList.add('flex')" class="shrink-0 bg-blue-600 text-white px-3.5 py-2 rounded-lg text-sm font-medium hover:bg-blue-700 flex items-center justify-center transition-all shadow-sm active:scale-95 whitespace-nowrap">
                        <i class="ph-bold ph-plus mr-1.5 text-base"></i> Tambah Barang
                    </button>
                    @endif
                </div>
            </div>
            
            <!-- TABEL DATA DIBUNGKUS FORM UNTUK CETAK MASSAL -->
            <form action="{{ route('items.print_barcode') }}" method="POST" target="_blank" id="form-print-barcode">
                @csrf
                <div class="overflow-x-auto rounded-xl border border-gray-100">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-gray-50/80 text-gray-500 text-[11px] uppercase tracking-widest border-b border-gray-100">
                                <!-- CHECKBOX HEADER (SELECT ALL) -->
                                <th class="p-4 font-bold text-center w-12">
                                    <input type="checkbox" id="select-all" onclick="toggleSelectAll()" class="rounded border-gray-300 text-blue-600 focus:ring-blue-500 w-4 h-4 cursor-pointer transition-all">
                                </th>
                                <th class="p-4 font-bold text-center w-16">No</th>
                                <th class="p-4 font-bold text-center w-32">QR Code Label</th>
                                <th class="p-4 font-bold">Nama Barang</th>
                                <th class="p-4 font-bold text-center">Stok</th>
                                <th class="p-4 font-bold">Supplier</th>
                                @if(Auth::user()->role === 'admin')
                                <th class="p-4 font-bold text-center w-32">Aksi</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody class="text-sm divide-y divide-gray-100">
                            @forelse($items as $index => $item)
                            <tr class="hover:bg-blue-50/40 transition-colors">
                                <!-- CHECKBOX ITEM -->
                                <td class="p-4 text-center align-middle">
                                    <input type="checkbox" name="item_ids[]" value="{{ $item->id }}" onclick="togglePrintButton()" class="item-checkbox rounded border-gray-300 text-blue-600 focus:ring-blue-500 w-4 h-4 cursor-pointer transition-all">
                                </td>
                                
                                <td class="p-4 text-center text-gray-500 align-middle font-medium">{{ $items->firstItem() + $index }}</td>
                                
                                <!-- TAMPILAN QR CODE -->
                                <td class="p-4 text-center align-middle">
                                    <div class="inline-flex flex-col items-center bg-white border border-gray-200 p-2 rounded-lg shadow-sm">
                                        <!-- Div kosong tempat QR Code akan digambar -->
                                        <div class="qr-render" data-value="{{ $item->barcode }}"></div>
                                        <!-- Teks ID di bawah QR -->
                                        <span class="text-[10px] font-mono font-bold text-gray-500 mt-1 tracking-wider">{{ $item->barcode }}</span>
                                    </div>
                                </td>

                                <td class="p-4 font-bold text-gray-800 align-middle">{{ $item->name }}</td>
                                
                                <td class="p-4 text-center align-middle">
                                    <span class="inline-flex items-center justify-center {{ $item->stock <= $item->min_stock ? 'bg-rose-100 text-rose-700 ring-1 ring-rose-200' : 'bg-emerald-100 text-emerald-700 ring-1 ring-emerald-200' }} font-bold px-3 py-1 rounded-full text-xs">
                                        {{ $item->stock }} Unit
                                    </span>
                                </td>
                                
                                <td class="p-4 text-gray-600 align-middle text-sm font-medium">
                                    <div class="flex items-center">
                                        <i class="ph-fill ph-truck text-blue-400 mr-2 text-lg"></i> 
                                        {{ $item->supplier->name ?? '-' }}
                                    </div>
                                </td>
                                
                                @if(Auth::user()->role === 'admin')
                                <td class="p-4 align-middle">
                                    <div class="flex justify-center items-center gap-2">
                                        <!-- Tombol Edit Presisi -->
                                        <button type="button" onclick="openEditModal('{{ $item->id }}', '{{ $item->barcode }}', '{{ $item->name }}', '{{ $item->supplier_id }}', '{{ $item->stock }}', '{{ $item->min_stock }}')" class="w-8 h-8 flex items-center justify-center text-blue-600 bg-blue-50 hover:bg-blue-100 hover:text-blue-700 rounded-lg transition-colors" title="Edit Data">
                                            <i class="ph-bold ph-pencil-simple text-base"></i>
                                        </button>
                                        
                                        <!-- Tombol Hapus (Memicu form tersembunyi di bawah) -->
                                        <button type="button" onclick="if(confirm('Yakin ingin menghapus barang ini secara permanen?')) { document.getElementById('form-delete-{{ $item->id }}').submit(); }" class="w-8 h-8 flex items-center justify-center text-rose-600 bg-rose-50 hover:bg-rose-100 hover:text-rose-700 rounded-lg transition-colors" title="Hapus Data">
                                            <i class="ph-bold ph-trash text-base"></i>
                                        </button>
                                    </div>
                                </td>
                                @endif
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="p-16 text-center text-gray-400">
                                    @if(request('search'))
                                        <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-gray-50 mb-4">
                                            <i class="ph-fill ph-magnifying-glass text-3xl text-gray-300"></i>
                                        </div>
                                        <p class="text-base font-medium text-gray-500">Pencarian "{{ request('search') }}" tidak ditemukan.</p>
                                    @else
                                        <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-gray-50 mb-4">
                                            <i class="ph-fill ph-box-box text-3xl text-gray-300"></i>
                                        </div>
                                        <p class="text-base font-medium text-gray-500">Belum ada data barang.</p>
                                    @endif
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </form>

            <!-- PAGINATION LINKS -->
            @if($items->hasPages())
            <div class="mt-6">
                {{ $items->links() }}
            </div>
            @endif
        </div>
    </div>

    <!-- KUMPULAN FORM HAPUS (Diletakkan di luar form cetak agar tidak bentrok) -->
    @foreach($items as $item)
        <form id="form-delete-{{ $item->id }}" action="{{ route('items.destroy', $item->id) }}" method="POST" class="hidden">
            @csrf @method('DELETE')
        </form>
    @endforeach

    <!-- MODAL TAMBAH BARANG -->
    <div id="modal-tambah" class="fixed inset-0 bg-slate-900/60 hidden items-center justify-center z-50 fade-in backdrop-blur-sm px-4">
        <div class="bg-white rounded-2xl shadow-2xl w-full max-w-xl overflow-hidden border border-gray-100">
            <div class="px-6 py-5 border-b border-gray-100 flex justify-between items-center bg-blue-50/50">
                <div class="flex items-center">
                    <div class="bg-blue-100 text-blue-600 p-2 rounded-lg mr-3">
                        <i class="ph-bold ph-package text-xl"></i>
                    </div>
                    <h3 class="font-bold text-lg text-gray-800 tracking-tight">Tambah Barang Baru</h3>
                </div>
                <button type="button" onclick="document.getElementById('modal-tambah').classList.add('hidden'); document.getElementById('modal-tambah').classList.remove('flex')" class="text-gray-400 hover:bg-gray-100 hover:text-red-500 transition-all p-2 rounded-lg">
                    <i class="ph-bold ph-x text-lg"></i>
                </button>
            </div>
            
            <form action="{{ route('items.store') }}" method="POST" class="p-6">
                @csrf
                <div class="space-y-5">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div class="space-y-1.5">
                            <label class="text-xs font-bold text-gray-500 uppercase tracking-widest ml-1">Barcode (Opsional)</label>
                            <input type="text" name="barcode" placeholder="Kosongi = Auto-Generate" class="w-full border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm py-2.5 transition-all placeholder:text-gray-400 bg-gray-50/50 outline-none">
                        </div>
                        <div class="space-y-1.5">
                            <label class="text-xs font-bold text-gray-500 uppercase tracking-widest ml-1">Nama Barang *</label>
                            <input type="text" name="name" required placeholder="Contoh: Laptop Asus" class="w-full border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm py-2.5 transition-all outline-none">
                        </div>
                    </div>
                    <div class="space-y-1.5">
                        <label class="text-xs font-bold text-gray-500 uppercase tracking-widest ml-1">Pilih Supplier *</label>
                        <select name="supplier_id" required class="w-full border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm py-2.5 transition-all outline-none">
                            <option value="">-- Pilih Supplier --</option>
                            @foreach($suppliers as $sup)
                            <option value="{{ $sup->id }}">{{ $sup->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div class="space-y-1.5">
                            <label class="text-xs font-bold text-gray-500 uppercase tracking-widest ml-1">Stok Awal *</label>
                            <input type="number" name="stock" value="0" min="0" required class="w-full border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm py-2.5 transition-all outline-none">
                        </div>
                        <div class="space-y-1.5">
                            <label class="text-xs font-bold text-gray-500 uppercase tracking-widest ml-1">Batas Minimum Alert *</label>
                            <input type="number" name="min_stock" value="10" min="0" required class="w-full border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm py-2.5 transition-all outline-none">
                        </div>
                    </div>
                </div>
                <div class="mt-8 flex justify-end items-center gap-3">
                    <button type="button" onclick="document.getElementById('modal-tambah').classList.add('hidden'); document.getElementById('modal-tambah').classList.remove('flex')" class="px-5 py-2.5 text-gray-600 font-semibold text-sm transition-all bg-white border border-gray-200 hover:bg-gray-50 rounded-xl">Batal</button>
                    <button type="submit" class="px-6 py-2.5 bg-blue-600 hover:bg-blue-700 text-white rounded-xl text-sm font-bold shadow-md shadow-blue-200 transition-all transform active:scale-95 flex items-center">
                        <i class="ph-bold ph-floppy-disk mr-2"></i> Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- MODAL EDIT BARANG -->
    <div id="modal-edit" class="fixed inset-0 bg-slate-900/60 hidden items-center justify-center z-50 fade-in backdrop-blur-sm px-4">
        <div class="bg-white rounded-2xl shadow-2xl w-full max-w-xl overflow-hidden border border-gray-100">
            <div class="px-6 py-5 border-b border-gray-100 flex justify-between items-center bg-blue-50/50">
                <div class="flex items-center">
                    <div class="bg-blue-100 text-blue-600 p-2 rounded-lg mr-3">
                        <i class="ph-bold ph-pencil-simple text-xl"></i>
                    </div>
                    <h3 class="font-bold text-lg text-gray-800 tracking-tight">Edit Data Barang</h3>
                </div>
                <button type="button" onclick="document.getElementById('modal-edit').classList.add('hidden'); document.getElementById('modal-edit').classList.remove('flex')" class="text-gray-400 hover:bg-gray-100 hover:text-red-500 transition-all p-2 rounded-lg">
                    <i class="ph-bold ph-x text-lg"></i>
                </button>
            </div>
            <form id="form-edit-item" method="POST" class="p-6">
                @csrf @method('PUT')
                <div class="space-y-5">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div class="space-y-1.5">
                            <label class="text-xs font-bold text-gray-500 uppercase tracking-widest ml-1">Barcode Label</label>
                            <input type="text" name="barcode" id="edit_barcode" class="w-full border-gray-200 rounded-xl bg-gray-100 text-gray-500 text-sm py-2.5 cursor-not-allowed outline-none" readonly>
                        </div>
                        <div class="space-y-1.5">
                            <label class="text-xs font-bold text-gray-500 uppercase tracking-widest ml-1">Nama Barang *</label>
                            <input type="text" name="name" id="edit_name" required class="w-full border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm py-2.5 transition-all outline-none">
                        </div>
                    </div>
                    <div class="space-y-1.5">
                        <label class="text-xs font-bold text-gray-500 uppercase tracking-widest ml-1">Ubah Supplier *</label>
                        <select name="supplier_id" id="edit_supplier" required class="w-full border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm py-2.5 transition-all outline-none">
                            @foreach($suppliers as $sup)
                            <option value="{{ $sup->id }}">{{ $sup->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div class="space-y-1.5">
                            <label class="text-xs font-bold text-gray-500 uppercase tracking-widest ml-1">Stok Sistem</label>
                            <input type="number" name="stock" id="edit_stock" required class="w-full border-gray-200 rounded-xl bg-gray-100 text-gray-500 text-sm py-2.5 cursor-not-allowed outline-none" readonly title="Gunakan menu transaksi untuk merubah stok secara aman">
                        </div>
                        <div class="space-y-1.5">
                            <label class="text-xs font-bold text-gray-500 uppercase tracking-widest ml-1">Batas Minimum Alert *</label>
                            <input type="number" name="min_stock" id="edit_min_stock" required class="w-full border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm py-2.5 transition-all outline-none">
                        </div>
                    </div>
                </div>
                <div class="mt-8 flex justify-end items-center gap-3">
                    <button type="button" onclick="document.getElementById('modal-edit').classList.add('hidden'); document.getElementById('modal-edit').classList.remove('flex')" class="px-5 py-2.5 text-gray-600 font-semibold text-sm transition-all bg-white border border-gray-200 hover:bg-gray-50 rounded-xl">Batal</button>
                    <button type="submit" class="px-6 py-2.5 bg-blue-600 hover:bg-blue-700 text-white rounded-xl text-sm font-bold shadow-md shadow-blue-200 transition-all transform active:scale-95 flex items-center">
                        <i class="ph-bold ph-arrows-clockwise mr-2"></i> Update
                    </button>
                </div>
            </form>
        </div>
    </div>

    @push('scripts')
        <!-- Ganti library JsBarcode dengan QRCode.js -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>
        <script>
            // Render QR Code otomatis saat halaman dimuat
            document.querySelectorAll('.qr-render').forEach(function(el) {
                new QRCode(el, {
                    text: el.getAttribute('data-value'),
                    width: 50, // Lebar QR Code di tabel
                    height: 50, // Tinggi QR Code di tabel
                    colorDark : "#1e293b", // Warna QR (Gelap slate-800)
                    colorLight : "#ffffff", // Warna background QR (Putih)
                    correctLevel : QRCode.CorrectLevel.L
                });
            });

            // Fungsi untuk Mencentang Semua Checkbox
            function toggleSelectAll() {
                const selectAll = document.getElementById('select-all');
                const checkboxes = document.querySelectorAll('.item-checkbox');
                checkboxes.forEach(cb => cb.checked = selectAll.checked);
                togglePrintButton(); // Panggil fungsi cek tombol
            }

            // Fungsi untuk Memunculkan/Menyembunyikan Tombol Cetak
            function togglePrintButton() {
                // Cari apakah ada checkbox barang yang sedang dicentang
                const checkboxes = document.querySelectorAll('.item-checkbox:checked');
                const btnPrint = document.getElementById('btn-print-barcode');
                
                if(checkboxes.length > 0) {
                    // Jika ada yang dicentang, tampilkan tombol cetak warna hijau
                    btnPrint.classList.remove('hidden');
                    btnPrint.classList.add('flex');
                } else {
                    // Jika tidak ada yang dicentang, sembunyikan
                    btnPrint.classList.add('hidden');
                    btnPrint.classList.remove('flex');
                }
            }

            // Fungsi untuk Membuka Modal Edit
            function openEditModal(id, barcode, name, supplier, stock, min_stock) {
                document.getElementById('modal-edit').classList.remove('hidden');
                document.getElementById('modal-edit').classList.add('flex');
                
                document.getElementById('form-edit-item').action = `/items/${id}`;
                document.getElementById('edit_barcode').value = barcode;
                document.getElementById('edit_name').value = name;
                document.getElementById('edit_supplier').value = supplier;
                document.getElementById('edit_stock').value = stock;
                document.getElementById('edit_min_stock').value = min_stock;
            }
        </script>
    @endpush
</x-app-layout>