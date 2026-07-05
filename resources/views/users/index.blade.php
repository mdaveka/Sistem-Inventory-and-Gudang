<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center">
            <div class="bg-indigo-100 text-indigo-600 p-2 rounded-lg mr-3">
                <i class="ph-bold ph-users text-xl"></i>
            </div>
            <span class="font-bold text-gray-800 text-xl tracking-tight">Manajemen Pengguna</span>
        </div>
    </x-slot>

    @if(session('success'))
    <div class="bg-emerald-50 border border-emerald-200 text-emerald-700 px-4 py-3 rounded-xl mb-4 flex items-center fade-in mx-6 mt-6 shadow-sm">
        <i class="ph-fill ph-check-circle text-xl mr-3"></i> 
        <span class="font-medium text-sm">{{ session('success') }}</span>
    </div>
    @endif

    @if(session('error'))
    <div class="bg-rose-50 border border-rose-200 text-rose-700 px-4 py-3 rounded-xl mb-4 flex items-center fade-in mx-6 mt-6 shadow-sm">
        <i class="ph-fill ph-warning-circle text-xl mr-3"></i> 
        <span class="font-medium text-sm">{{ session('error') }}</span>
    </div>
    @endif

    @if($errors->any())
    <div class="bg-rose-50 border border-rose-200 text-rose-700 px-5 py-4 rounded-xl mb-4 mx-6 mt-6 fade-in shadow-sm">
        <div class="flex items-center mb-2 font-bold text-sm">
            <i class="ph-fill ph-x-circle text-xl mr-2 text-rose-600"></i> Pendaftaran Gagal:
        </div>
        <ul class="list-disc pl-7 text-xs font-medium space-y-1 text-rose-600">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <div class="p-6">
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 fade-in">
            
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-6">
                <div class="w-full md:flex-1 text-left mb-2 md:mb-0">
                    <h3 class="text-xl font-extrabold text-gray-800 tracking-tight">Daftar Akun Karyawan</h3>
                    <p class="text-sm text-gray-500 mt-1">Kelola akses login untuk Admin dan Staff Gudang.</p>
                </div>
                
                <div class="flex flex-row items-center justify-end w-full md:w-auto">
                    <button onclick="document.getElementById('modal-tambah').classList.remove('hidden'); document.getElementById('modal-tambah').classList.add('flex')" class="shrink-0 bg-indigo-600 text-white px-4 py-2.5 rounded-xl text-sm font-bold hover:bg-indigo-700 flex items-center justify-center transition-all shadow-sm active:scale-95 whitespace-nowrap">
                        <i class="ph-bold ph-user-plus mr-2 text-lg"></i> Tambah Pengguna
                    </button>
                </div>
            </div>
            
            <div class="overflow-x-auto rounded-xl border border-gray-100">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-50/80 text-gray-500 text-[11px] uppercase tracking-widest border-b border-gray-100">
                            <th class="p-4 font-bold text-center w-16">No</th>
                            <th class="p-4 font-bold">Profil Pengguna</th>
                            <th class="p-4 font-bold">Email Login</th>
                            <th class="p-4 font-bold text-center">Hak Akses (Role)</th>
                            <th class="p-4 font-bold text-center w-32">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="text-sm divide-y divide-gray-100">
                        @foreach($users as $index => $user)
                        <tr class="hover:bg-indigo-50/30 transition-colors">
                            <td class="p-4 text-center text-gray-500 font-medium align-middle">{{ $index + 1 }}</td>
                            
                            <td class="p-4 align-middle">
                                <div class="flex items-center">
                                    <div class="w-10 h-10 rounded-full bg-gradient-to-br {{ $user->role === 'admin' ? 'from-indigo-500 to-purple-500' : 'from-emerald-400 to-teal-500' }} flex items-center justify-center text-white font-bold text-lg shadow-sm mr-3">
                                        {{ substr($user->name, 0, 1) }}
                                    </div>
                                    <div>
                                        <div class="font-bold text-gray-800">{{ $user->name }}</div>
                                        <div class="text-xs text-gray-400 mt-0.5">Bergabung {{ $user->created_at->format('M Y') }}</div>
                                    </div>
                                </div>
                            </td>
                            
                            <td class="p-4 text-gray-600 font-medium align-middle">
                                {{ $user->email }}
                            </td>
                            
                            <td class="p-4 text-center align-middle">
                                @if($user->role === 'admin')
                                    <span class="inline-flex items-center px-3 py-1 rounded-md bg-indigo-50 text-indigo-700 border border-indigo-100 font-bold text-xs tracking-wide">
                                        <i class="ph-fill ph-shield-check mr-1.5 text-sm"></i> Administrator
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-3 py-1 rounded-md bg-gray-50 text-gray-700 border border-gray-200 font-bold text-xs tracking-wide">
                                        <i class="ph-fill ph-user mr-1.5 text-sm"></i> Staff Gudang
                                    </span>
                                @endif
                            </td>
                            
                            <td class="p-4 align-middle">
                                <div class="flex justify-center items-center gap-2">
                                    <button onclick="openEditModal('{{ $user->id }}', '{{ $user->name }}', '{{ $user->email }}', '{{ $user->role }}')" class="w-8 h-8 flex items-center justify-center text-blue-600 bg-blue-50 hover:bg-blue-100 hover:text-blue-700 rounded-lg transition-colors" title="Edit Akun">
                                        <i class="ph-bold ph-pencil-simple text-base"></i>
                                    </button>
                                    
                                    @if($user->id !== Auth::id())
                                    <form action="{{ route('users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus akun {{ $user->name }}?');" class="m-0">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="w-8 h-8 flex items-center justify-center text-rose-600 bg-rose-50 hover:bg-rose-100 hover:text-rose-700 rounded-lg transition-colors" title="Hapus Akun">
                                            <i class="ph-bold ph-trash text-base"></i>
                                        </button>
                                    </form>
                                    @else
                                    <button disabled class="w-8 h-8 flex items-center justify-center text-gray-300 bg-gray-50 rounded-lg cursor-not-allowed" title="Tidak dapat menghapus diri sendiri">
                                        <i class="ph-bold ph-trash text-base"></i>
                                    </button>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- MODAL TAMBAH PENGGUNA -->
    <div id="modal-tambah" class="fixed inset-0 bg-slate-900/60 hidden items-center justify-center z-50 fade-in backdrop-blur-sm px-4">
        <div class="bg-white rounded-2xl shadow-2xl w-full max-w-lg overflow-hidden border border-gray-100">
            <div class="px-6 py-5 border-b border-gray-100 flex justify-between items-center bg-indigo-50/50">
                <div class="flex items-center">
                    <div class="bg-indigo-100 text-indigo-600 p-2 rounded-lg mr-3">
                        <i class="ph-bold ph-user-plus text-xl"></i>
                    </div>
                    <h3 class="font-bold text-lg text-gray-800 tracking-tight">Tambah Akun Karyawan</h3>
                </div>
                <button type="button" onclick="document.getElementById('modal-tambah').classList.add('hidden'); document.getElementById('modal-tambah').classList.remove('flex')" class="text-gray-400 hover:bg-gray-100 hover:text-red-500 transition-all p-2 rounded-lg">
                    <i class="ph-bold ph-x text-lg"></i>
                </button>
            </div>
            
            <form action="{{ route('users.store') }}" method="POST" class="p-6">
                @csrf
                <div class="space-y-4">
                    <div class="space-y-1.5">
                        <label class="text-xs font-bold text-gray-500 uppercase tracking-widest ml-1">Nama Lengkap *</label>
                        <input type="text" name="name" required placeholder="Contoh: Budi Santoso" class="w-full border-gray-200 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 text-sm py-2.5 outline-none">
                    </div>
                    <div class="space-y-1.5">
                        <label class="text-xs font-bold text-gray-500 uppercase tracking-widest ml-1">Alamat Email *</label>
                        <input type="email" name="email" required placeholder="budi@gudang.com" class="w-full border-gray-200 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 text-sm py-2.5 outline-none">
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div class="space-y-1.5">
                            <label class="text-xs font-bold text-gray-500 uppercase tracking-widest ml-1">Password Login *</label>
                            <input type="password" name="password" required placeholder="Minimal 8 karakter" class="w-full border-gray-200 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 text-sm py-2.5 outline-none">
                        </div>
                        <div class="space-y-1.5">
                            <label class="text-xs font-bold text-gray-500 uppercase tracking-widest ml-1">Hak Akses *</label>
                            <select name="role" required class="w-full border-gray-200 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 text-sm py-2.5 outline-none">
                                <option value="staff">Staff Gudang</option>
                                <option value="admin">Administrator</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="mt-8 flex justify-end items-center gap-3">
                    <button type="button" onclick="document.getElementById('modal-tambah').classList.add('hidden'); document.getElementById('modal-tambah').classList.remove('flex')" class="px-5 py-2.5 text-gray-600 font-semibold text-sm transition-all bg-white border border-gray-200 hover:bg-gray-50 rounded-xl">Batal</button>
                    <button type="submit" class="px-6 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white rounded-xl text-sm font-bold shadow-md shadow-indigo-200 transition-all active:scale-95">Simpan Akun</button>
                </div>
            </form>
        </div>
    </div>

    <!-- MODAL EDIT PENGGUNA -->
    <div id="modal-edit" class="fixed inset-0 bg-slate-900/60 hidden items-center justify-center z-50 fade-in backdrop-blur-sm px-4">
        <div class="bg-white rounded-2xl shadow-2xl w-full max-w-lg overflow-hidden border border-gray-100">
            <div class="px-6 py-5 border-b border-gray-100 flex justify-between items-center bg-indigo-50/50">
                <div class="flex items-center">
                    <div class="bg-indigo-100 text-indigo-600 p-2 rounded-lg mr-3">
                        <i class="ph-bold ph-pencil-simple text-xl"></i>
                    </div>
                    <h3 class="font-bold text-lg text-gray-800 tracking-tight">Edit Akun Karyawan</h3>
                </div>
                <button type="button" onclick="document.getElementById('modal-edit').classList.add('hidden'); document.getElementById('modal-edit').classList.remove('flex')" class="text-gray-400 hover:bg-gray-100 hover:text-red-500 transition-all p-2 rounded-lg">
                    <i class="ph-bold ph-x text-lg"></i>
                </button>
            </div>
            
            <form id="form-edit-user" method="POST" class="p-6">
                @csrf @method('PUT')
                <div class="space-y-4">
                    <div class="space-y-1.5">
                        <label class="text-xs font-bold text-gray-500 uppercase tracking-widest ml-1">Nama Lengkap *</label>
                        <input type="text" name="name" id="edit_name" required class="w-full border-gray-200 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 text-sm py-2.5 outline-none">
                    </div>
                    <div class="space-y-1.5">
                        <label class="text-xs font-bold text-gray-500 uppercase tracking-widest ml-1">Alamat Email *</label>
                        <input type="email" name="email" id="edit_email" required class="w-full border-gray-200 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 text-sm py-2.5 outline-none">
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div class="space-y-1.5">
                            <label class="text-xs font-bold text-gray-500 uppercase tracking-widest ml-1">Password Baru</label>
                            <input type="password" name="password" placeholder="(Kosongkan jika tak diubah)" class="w-full border-gray-200 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 text-sm py-2.5 outline-none">
                        </div>
                        <div class="space-y-1.5">
                            <label class="text-xs font-bold text-gray-500 uppercase tracking-widest ml-1">Hak Akses *</label>
                            <select name="role" id="edit_role" required class="w-full border-gray-200 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 text-sm py-2.5 outline-none">
                                <option value="staff">Staff Gudang</option>
                                <option value="admin">Administrator</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="mt-8 flex justify-end items-center gap-3">
                    <button type="button" onclick="document.getElementById('modal-edit').classList.add('hidden'); document.getElementById('modal-edit').classList.remove('flex')" class="px-5 py-2.5 text-gray-600 font-semibold text-sm transition-all bg-white border border-gray-200 hover:bg-gray-50 rounded-xl">Batal</button>
                    <button type="submit" class="px-6 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white rounded-xl text-sm font-bold shadow-md shadow-indigo-200 transition-all active:scale-95">Update Akun</button>
                </div>
            </form>
        </div>
    </div>

    @push('scripts')
        <script>
            function openEditModal(id, name, email, role) {
                document.getElementById('modal-edit').classList.remove('hidden');
                document.getElementById('modal-edit').classList.add('flex');
                
                document.getElementById('form-edit-user').action = `/users/${id}`;
                document.getElementById('edit_name').value = name;
                document.getElementById('edit_email').value = email;
                document.getElementById('edit_role').value = role;
            }
        </script>
    @endpush
</x-app-layout>