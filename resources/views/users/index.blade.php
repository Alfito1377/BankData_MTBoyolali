@extends('layouts.app')

@section('title', 'Manajemen Pengguna')

@section('content')
<div class="w-full space-y-6" x-data="{ editModal: false, user: { id: '', name: '', email: '' } }">

    {{-- HEADER HALAMAN --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 bg-white p-6 rounded-2xl border border-slate-200/80 shadow-xs">
        <div class="flex items-center gap-4">
            <div class="h-12 w-12 rounded-2xl bg-gradient-to-br from-[#496b88] to-[#2c4053] flex items-center justify-center text-white shadow-md shadow-[#496b88]/25">
                <i class="fas fa-users-gear text-lg"></i>
            </div>
            <div>
                <h1 class="text-base font-bold text-slate-800">Manajemen Pengguna</h1>
                <p class="text-xs text-slate-500 mt-0.5">Kelola data, hak akses, dan informasi pengguna sistem Patra Logistik.</p>
            </div>
        </div>
        <div class="flex items-center gap-2">
            <span class="inline-flex items-center gap-2 px-3.5 py-2 rounded-xl bg-slate-100/80 text-slate-700 text-xs font-bold border border-slate-200/60 shadow-xs">
                <i class="fas fa-database text-[10px] text-[#496b88]"></i>
                Total Pengguna: <span class="text-[#496b88]">{{ method_exists($users, 'total') ? $users->total() : count($users) }}</span>
            </span>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 items-start">
        
        {{-- KOLOM KIRI: FORM TAMBAH USER --}}
        <div class="lg:col-span-1">
            <div class="rounded-2xl border border-slate-200/80 bg-white p-6 shadow-xs">
                <div class="flex items-center gap-3 pb-4 border-b border-slate-100 mb-5">
                    <div class="h-9 w-9 rounded-xl bg-[#496b88]/10 flex items-center justify-center text-[#496b88]">
                        <i class="fas fa-user-plus text-xs"></i>
                    </div>
                    <div>
                        <h3 class="text-xs font-bold text-slate-800 uppercase tracking-wider">Tambah User Baru</h3>
                        <p class="text-[11px] text-slate-400">Daftarkan akun baru ke dalam sistem</p>
                    </div>
                </div>

                <form action="{{ route('users.store') }}" method="POST" class="space-y-4">
                    @csrf
                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1.5">Nama Lengkap</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                                <i class="fas fa-user text-xs"></i>
                            </span>
                            <input type="text" name="name" value="{{ old('name') }}" required 
                                class="w-full rounded-xl border border-slate-200 pl-10 pr-3.5 py-2.5 text-xs text-slate-700 focus:outline-none focus:ring-2 focus:ring-[#496b88]/20 focus:border-[#496b88] transition bg-slate-50/50 focus:bg-white" 
                                placeholder="Masukkan nama lengkap...">
                        </div>
                        @error('name') <span class="text-[11px] text-red-500 mt-1.5 block font-medium flex items-center gap-1"><i class="fas fa-circle-exclamation"></i> {{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1.5">Email Perusahaan / Sistem</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                                <i class="fas fa-envelope text-xs"></i>
                            </span>
                            <input type="email" name="email" value="{{ old('email') }}" required 
                                class="w-full rounded-xl border border-slate-200 pl-10 pr-3.5 py-2.5 text-xs text-slate-700 focus:outline-none focus:ring-2 focus:ring-[#496b88]/20 focus:border-[#496b88] transition bg-slate-50/50 focus:bg-white" 
                                placeholder="email@patralogistik.com">
                        </div>
                        @error('email') <span class="text-[11px] text-red-500 mt-1.5 block font-medium flex items-center gap-1"><i class="fas fa-circle-exclamation"></i> {{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1.5">Password <span class="text-slate-400 font-normal">(Min. 8 Karakter)</span></label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                                <i class="fas fa-lock text-xs"></i>
                            </span>
                            <input type="password" name="password" required 
                                class="w-full rounded-xl border border-slate-200 pl-10 pr-3.5 py-2.5 text-xs text-slate-700 focus:outline-none focus:ring-2 focus:ring-[#496b88]/20 focus:border-[#496b88] transition bg-slate-50/50 focus:bg-white" 
                                placeholder="••••••••">
                        </div>
                        @error('password') <span class="text-[11px] text-red-500 mt-1.5 block font-medium flex items-center gap-1"><i class="fas fa-circle-exclamation"></i> {{ $message }}</span> @enderror
                    </div>

                    {{-- Tombol Simpan Form Tambah User --}}
                    <div class="pt-2">
                        <button type="submit" class="w-full rounded-xl bg-[#496b88] px-4 py-3 text-xs font-semibold text-white shadow-md shadow-[#496b88]/20 hover:bg-[#3b5770] transition active:scale-[0.98] flex items-center justify-center gap-2 cursor-pointer">
                            <i class="fas fa-save text-[11px]"></i> Simpan User Baru
                        </button>
                    </div>
                </form>
            </div>
        </div>

        {{-- KOLOM KANAN: TABEL DAFTAR USER --}}
        <div class="lg:col-span-2">
            <div class="rounded-2xl border border-slate-200/80 bg-white overflow-hidden shadow-xs">
                <div class="p-5 border-b border-slate-100 flex items-center justify-between bg-slate-50/50">
                    <h3 class="text-xs font-bold text-slate-700 uppercase tracking-wider flex items-center gap-2">
                        <i class="fas fa-list text-[#496b88]"></i> Daftar Pengguna Sistem
                    </h3>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-slate-100/70 border-b border-slate-200/60 text-[11px] font-bold text-slate-500 uppercase tracking-wider">
                                <th class="py-3.5 px-4 text-center w-12">No</th>
                                <th class="py-3.5 px-4">Nama Pengguna</th>
                                <th class="py-3.5 px-4">Email</th>
                                <th class="py-3.5 px-4 text-center w-28">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 text-xs text-slate-600">
                            @forelse($users as $index => $u)
                                <tr class="hover:bg-slate-50/80 transition-colors group">
                                    <td class="py-3.5 px-4 text-center text-slate-400 font-medium">
                                        {{ method_exists($users, 'firstItem') ? $users->firstItem() + $index : $loop->iteration }}
                                    </td>
                                    <td class="py-3.5 px-4">
                                        <div class="flex items-center gap-3">
                                            <div class="h-8 w-8 rounded-xl bg-gradient-to-tr from-[#496b88] to-[#6085a5] text-white flex items-center justify-center font-bold text-[11px] shadow-xs shrink-0">
                                                {{ strtoupper(substr($u->name, 0, 2)) }}
                                            </div>
                                            <span class="font-semibold text-slate-800">{{ $u->name }}</span>
                                        </div>
                                    </td>
                                    <td class="py-3.5 px-4 text-slate-500 font-mono text-[11px]">{{ $u->email }}</td>
                                    <td class="py-3.5 px-4 text-center">
                                        <div class="flex items-center justify-center gap-1.5">
                                            {{-- Tombol Edit (Menggunakan Alpine.js) --}}
                                            <button type="button" 
                                                @click="editModal = true; user = { id: '{{ $u->id }}', name: '{{ $u->name }}', email: '{{ $u->email }}' }"
                                                title="Edit Data" class="action-button action-edit">
                                                <i class="fas fa-edit text-[10px]"></i>
                                            </button>

                                            {{-- Tombol Hapus --}}
                                            <form action="{{ route('users.destroy', $u->id) }}" method="POST"
                                                class="inline"
                                                onsubmit="return confirm('Apakah Anda yakin ingin menghapus pengguna {{ $u->name }}?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="action-button action-delete" title="Hapus">
                                                    <i class="fas fa-trash text-[10px]"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="py-12 text-center text-slate-400">
                                        <div class="flex flex-col items-center justify-center space-y-2">
                                            <div class="h-12 w-12 rounded-full bg-slate-100 flex items-center justify-center text-slate-400 text-lg">
                                                <i class="fas fa-folder-open"></i>
                                            </div>
                                            <p class="text-xs font-medium text-slate-500">Belum ada data pengguna yang tersedia.</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{-- Pagination --}}
                @if(method_exists($users, 'hasPages') && $users->hasPages())
                    <div class="p-4 border-t border-slate-100 bg-slate-50/50">
                        {{ $users->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>

    {{-- MODAL EDIT USER (Alpine.js) --}}
    <div x-cloak x-show="editModal" 
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         class="fixed inset-0 z-50 overflow-y-auto bg-slate-900/60 backdrop-blur-xs flex items-center justify-center p-4">
        
        <div @click.away="editModal = false" 
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0 scale-95"
             x-transition:enter-end="opacity-100 scale-100"
             class="bg-white rounded-2xl shadow-2xl max-w-lg w-full p-6 border-2 border-slate-200">
            
            <div class="flex items-center justify-between pb-4 border-b border-slate-100">
                <div class="flex items-center gap-3">
                    <div class="h-9 w-9 rounded-xl bg-amber-500/10 flex items-center justify-center text-amber-600">
                        <i class="fas fa-user-pen text-xs"></i>
                    </div>
                    <div>
                        <h3 class="text-xs font-bold text-slate-800 uppercase tracking-wider">Edit Data Pengguna</h3>
                        <p class="text-[11px] text-slate-400 mt-0.5">Memperbarui akun: <span x-text="user.name" class="font-semibold text-slate-700"></span></p>
                    </div>
                </div>
                <button @click="editModal = false" class="h-8 w-8 rounded-lg text-slate-400 hover:bg-slate-100 hover:text-slate-600 transition flex items-center justify-center cursor-pointer">
                    <i class="fas fa-xmark text-xs"></i>
                </button>
            </div>

            <form :action="'/users/' + user.id" method="POST" class="mt-4 space-y-4">
                @csrf
                @method('PUT')

                <div>
                    <label class="block text-xs font-semibold text-slate-700 mb-1.5">Nama Lengkap</label>
                    <input type="text" name="name" x-model="user.name" required 
                        class="w-full rounded-xl border border-slate-200 px-3.5 py-2.5 text-xs text-slate-700 focus:outline-none focus:ring-2 focus:ring-[#496b88]/20 focus:border-[#496b88] bg-slate-50/50 focus:bg-white transition">
                </div>

                <div>
                    <label class="block text-xs font-semibold text-slate-700 mb-1.5">Email Sistem</label>
                    <input type="email" name="email" x-model="user.email" required 
                        class="w-full rounded-xl border border-slate-200 px-3.5 py-2.5 text-xs text-slate-700 focus:outline-none focus:ring-2 focus:ring-[#496b88]/20 focus:border-[#496b88] bg-slate-50/50 focus:bg-white transition">
                </div>

                <div>
                    <label class="block text-xs font-semibold text-slate-700 mb-1.5">Password Baru <span class="text-slate-400 font-normal">(Opsional)</span></label>
                    <input type="password" name="password" 
                        class="w-full rounded-xl border border-slate-200 px-3.5 py-2.5 text-xs text-slate-700 focus:outline-none focus:ring-2 focus:ring-[#496b88]/20 focus:border-[#496b88] bg-slate-50/50 focus:bg-white transition" 
                        placeholder="Kosongkan jika tidak ingin mengubah sandi">
                </div>

                {{-- Tombol Simpan Form Edit User / Modal --}}
                <div class="pt-4 flex items-center justify-end gap-2.5 border-t border-slate-100">
                    <button type="button" @click="editModal = false" class="rounded-xl border border-slate-200 px-4 py-2 text-xs font-semibold text-slate-600 hover:bg-slate-50 transition cursor-pointer">Batal</button>
                    <button type="submit" class="rounded-xl bg-[#496b88] px-4 py-2 text-xs font-semibold text-white shadow-md shadow-[#496b88]/20 hover:bg-[#3b5770] transition cursor-pointer flex items-center gap-1.5">
                        <i class="fas fa-save text-[11px]"></i> Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>

</div>

@push('styles')
<style>
    [x-cloak] { display: none !important; }

    /* Styling Tombol Aksi */
    .action-button {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 28px;
        height: 28px;
        border-radius: 8px;
        transition: all 0.2s ease-in-out;
        box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
        cursor: pointer;
    }

    .action-edit {
        background-color: #fef3c7; 
        color: #d97706;          
    }
    .action-edit:hover {
        background-color: #f59e0b; 
        color: #ffffff;
    }

    .action-delete {
        background-color: #fee2e2; 
        color: #dc2626;          
    }
    .action-delete:hover {
        background-color: #ef4444; 
        color: #ffffff;
    }
</style>
@endpush
@endsection