@extends('layouts.app')

@section('title', 'Master Transportir')
@section('subtitle', 'Kelola daftar perusahaan mitra logistik')

@section('content')
<div class="w-full">
    <div class="mb-6">
        <div class="flex items-center gap-3">
            <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-[#eef4f8] text-[#5f7f9b]">
                <i class="fas fa-building text-sm"></i>
            </div>
            <div>
                <h5 class="m-0 text-[18px] font-bold tracking-tight text-[#263746]">Master Transportir</h5>
                <p class="mt-1 text-[11px] text-[#929da5]">Kelola daftar perusahaan yang menjadi mitra transportasi logistik.</p>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 gap-5 lg:grid-cols-[minmax(280px,0.85fr)_minmax(0,1.75fr)]">
        <div>
            <div class="h-full overflow-hidden rounded-2xl border border-[#e5ebef] bg-white shadow-[0_4px_18px_rgba(38,55,70,0.04)]">
                <div class="flex items-center gap-3 border-b border-[#edf1f4] px-5 py-4">
                    <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-xl bg-[#eef4f8] text-[#5f7f9b]">
                        <i class="fas fa-plus text-xs"></i>
                    </div>
                    <div>
                        <h6 class="m-0 text-[13px] font-bold text-[#263746]">Tambah Transportir</h6>
                        <p class="mt-1 text-[9px] text-[#929da5]">Tambahkan perusahaan baru</p>
                    </div>
                </div>

                <div class="p-5">
                    <form action="{{ route('transportir.store') }}" method="POST">
                        @csrf
                        <div>
                            <label for="nama" class="mb-2 block text-[11px] font-semibold text-[#52616c]">Nama Perusahaan (PT)</label>
                            <div class="relative">
                                <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3 text-[#a8b3ba]">
                                    <i class="fas fa-building text-[11px]"></i>
                                </div>
                                <input id="nama" type="text" name="nama" placeholder="Contoh: PT. Maju Jaya" value="{{ old('nama') }}" autocomplete="off" required class="h-[43px] w-full rounded-xl border border-[#dfe6ea] bg-white pl-9 pr-3 text-[12px] text-[#354550] outline-none transition placeholder:text-[#b1bac0] focus:border-[#5f7f9b] focus:ring-4 focus:ring-[#5f7f9b]/10">
                            </div>
                            @error('nama')
                                <p class="mt-2 flex items-center gap-1 text-[10px] text-red-500">
                                    <i class="fas fa-circle-exclamation"></i> {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <button type="submit" class="mt-4 flex h-[43px] w-full items-center justify-center gap-2 rounded-xl bg-[#5f7f9b] text-[11px] font-semibold text-white shadow-sm transition-all duration-200 hover:bg-[#496b88] hover:shadow-md active:translate-y-px">
                            <i class="fas fa-plus text-[10px]"></i> Simpan Transportir
                        </button>
                    </form>

                    <div class="mt-5 flex items-start gap-2.5 rounded-xl border border-[#edf2f5] bg-[#f7fafc] px-3 py-3 text-[9px] leading-relaxed text-[#84919a]">
                        <i class="fas fa-circle-info mt-[2px] shrink-0 text-[#5f7f9b]"></i>
                        <span>Gunakan nama perusahaan sesuai dengan data transportir yang terdaftar.</span>
                    </div>
                </div>
            </div>
        </div>

        <div>
            <div class="overflow-hidden rounded-2xl border border-[#e5ebef] bg-white shadow-[0_4px_18px_rgba(38,55,70,0.04)]">
                <div class="flex items-center justify-between border-b border-[#edf1f4] px-5 py-4">
                    <div class="flex items-center gap-3">
                        <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-xl bg-[#eef4f8] text-[#5f7f9b]">
                            <i class="fas fa-building text-xs"></i>
                        </div>
                        <div>
                            <h6 class="m-0 text-[13px] font-bold text-[#263746]">Daftar Transportir</h6>
                            <p class="mt-1 text-[9px] text-[#929da5]">Data perusahaan mitra yang tersimpan</p>
                        </div>
                    </div>
                    <div class="flex h-7 min-w-7 items-center justify-center rounded-full bg-[#eef4f8] px-2 text-[9px] font-bold text-[#5f7f9b]">
                        {{ $transportir->count() }}
                    </div>
                </div>

                <div class="max-h-[470px] overflow-auto">
                    <table class="w-full border-collapse">
                        <thead class="sticky top-0 z-10">
                            <tr class="border-b border-[#e3e8ec] bg-[#f8fafb]">
                                <th class="w-[10%] whitespace-nowrap px-4 py-3 text-center text-[9px] font-bold uppercase tracking-[0.4px] text-[#687783]">No</th>
                                <th class="px-4 py-3 text-left text-[9px] font-bold uppercase tracking-[0.4px] text-[#687783]">Nama Transportir</th>
                                <th class="w-[20%] whitespace-nowrap px-4 py-3 text-center text-[9px] font-bold uppercase tracking-[0.4px] text-[#687783]">Jumlah Armada</th>
                                <th class="w-[18%] whitespace-nowrap px-4 py-3 text-center text-[9px] font-bold uppercase tracking-[0.4px] text-[#687783]">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($transportir as $index => $row)
                                <tr class="border-b border-[#edf1f4] transition-colors duration-150 last:border-b-0 hover:bg-[#f9fbfc]">
                                    <td class="px-4 py-3 text-center">
                                        <div class="mx-auto flex h-7 w-7 items-center justify-center rounded-lg bg-[#f5f8fa] text-[10px] font-semibold text-[#7d8a93]">
                                            {{ $index + 1 }}
                                        </div>
                                    </td>
                                    <td class="px-4 py-3">
                                        <div class="flex items-center gap-3">
                                            <div class="flex h-8 w-8 shrink-0 items-center justify-center rounded-lg bg-[#eef4f8] text-[#5f7f9b]">
                                                <i class="fas fa-building text-[10px]"></i>
                                            </div>
                                            <div class="min-w-0">
                                                <div class="truncate text-[11px] font-semibold text-[#354550]">{{ $row->nama }}</div>
                                                <div class="mt-0.5 text-[8px] text-[#9aa5ac]">Mitra transportasi</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-4 py-3 text-center">
                                        <span class="inline-flex items-center justify-center rounded-md bg-[#eef4f8] px-2 py-1 text-[10px] font-bold text-[#5f7f9b]">
                                            {{ $jumlahArmada[$row->nama] ?? 0 }} Unit
                                        </span>
                                    </td>
                                    <td class="px-4 py-3 text-center">
                                        <form action="{{ route('transportir.destroy', $row->id) }}" method="POST" onsubmit="return confirm('Hapus transportir {{ $row->nama }}?');" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="inline-flex h-8 items-center gap-1.5 rounded-lg border border-[#e8dfe1] bg-white px-3 text-[9px] font-semibold text-[#9a7074] transition-all duration-200 hover:border-[#ead9db] hover:bg-[#faf1f2] hover:text-[#a95b61]">
                                                <i class="fas fa-trash text-[9px]"></i> Hapus
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-4 py-0">
                                        <div class="flex flex-col items-center justify-center py-14 text-center">
                                            <div class="mb-3 flex h-12 w-12 items-center justify-center rounded-2xl bg-[#f1f5f7] text-[#8fa0ab]">
                                                <i class="fas fa-building text-base"></i>
                                            </div>
                                            <strong class="text-[11px] font-semibold text-[#52616c]">Belum ada data transportir</strong>
                                            <span class="mt-1 text-[9px] text-[#9aa5ac]">Tambahkan perusahaan melalui form di sebelah kiri.</span>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection