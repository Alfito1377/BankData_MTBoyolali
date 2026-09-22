@extends('layouts.app')

@section('title', 'MT Afkir & Dispen')
@section('subtitle', 'Kelola data armada afkir, status operasional, dan proses peremajaan')

@section('content')
<!-- BUKA BUNGKUSAN UTAMA -->
<div class="afkir-page pb-8">
    
    @if ($errors->any())
        <div class="mb-5 rounded-xl border border-red-200 bg-red-50 p-4">
            <div class="flex items-center gap-3">
                <i class="fas fa-exclamation-circle text-red-500"></i>
                <h5 class="text-sm font-bold text-red-800">Gagal menyimpan data!</h5>
            </div>
            <ul class="mt-2 ml-7 list-disc text-xs text-red-700">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="mb-6 rounded-2xl border border-slate-200/80 bg-white shadow-sm">
        <div class="flex flex-col gap-5 p-5 sm:p-6 lg:flex-row lg:items-center lg:justify-between">
            <div class="flex items-center gap-4 shrink-0">
                <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-xl bg-red-50 text-red-600 ring-4 ring-red-50/60">
                    <i class="fas fa-truck text-lg"></i>
                </div>
                <div>
                    <h4 class="text-lg font-bold tracking-tight text-slate-800">MT Afkir & Dispen</h4>
                    <p class="mt-0.5 text-sm text-slate-500">Kelola data armada afkir dan proses peremajaan kendaraan.</p>
                </div>
            </div>

            <div class="flex w-full flex-col gap-3 sm:flex-row sm:items-center lg:w-auto">
                <form action="{{ route('afkir.index') }}" method="GET" class="flex w-full flex-col gap-2 sm:flex-row sm:items-center lg:w-auto">
                    <div class="relative w-full sm:w-64">
                        <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                            <i class="fas fa-search text-sm text-slate-400"></i>
                        </div>
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nomor polisi..." class="block w-full rounded-xl border border-slate-200 bg-white py-2.5 pl-10 pr-3 text-sm text-slate-700 placeholder:text-slate-400 outline-none shadow-none focus:border-emerald-500 focus:ring-0">
                    </div>

                    <div class="relative w-full sm:w-64">
                        <select name="kepemilikan" onchange="this.form.submit()" class="block w-full appearance-none rounded-xl border border-slate-200 bg-white px-4 py-2.5 pr-10 text-sm text-slate-700 outline-none shadow-none focus:border-emerald-500 focus:ring-0">
                            <option value="">Semua Perusahaan</option>
                            @foreach ($listTransportir as $transportir)
                                @php $total = $jumlahPerTransportir[$transportir->nama] ?? 0; @endphp
                                <option value="{{ $transportir->nama }}" {{ request('kepemilikan') == $transportir->nama ? 'selected' : '' }}>
                                    {{ $transportir->nama }} ({{ $total }} Armada)
                                </option>
                            @endforeach
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3">
                            <i class="fas fa-chevron-down text-xs text-slate-400"></i>
                        </div>
                    </div>

                    <button type="submit" class="inline-flex shrink-0 items-center justify-center gap-2 rounded-xl border-0 bg-emerald-600 px-4 py-2.5 text-sm font-medium text-white shadow-none outline-none transition-colors hover:bg-emerald-700 focus:ring-0 active:bg-emerald-800">
                        <i class="fas fa-search text-xs"></i>
                        <span>Cari</span>
                    </button>

                    @if (request('search') || request('kepemilikan'))
                        <a href="{{ route('afkir.index') }}" title="Reset Pencarian" class="inline-flex h-[42px] w-[42px] shrink-0 items-center justify-center rounded-xl border border-slate-200 bg-white text-slate-500 shadow-none outline-none transition-colors hover:border-red-200 hover:bg-red-50 hover:text-red-500 focus:ring-0">
                            <i class="fas fa-times text-xs"></i>
                        </a>
                    @endif
                </form>

                <button type="button" data-modal-target="modalTambah" class="inline-flex w-full shrink-0 items-center justify-center gap-2 rounded-xl border-0 bg-blue-600 px-5 py-2.5 text-sm font-medium text-white shadow-none outline-none transition-colors hover:bg-blue-700 focus:ring-0 active:bg-blue-800 sm:w-auto">
                    <i class="fas fa-plus text-xs"></i>
                    <span>Tambah Data</span>
                </button>
            </div>
        </div>
    </div>

    @if (request('search') || request('kepemilikan'))
        <div class="mb-5 border-t border-slate-100 bg-slate-50/50 px-5 py-3.5 sm:px-6">
            <div class="flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between">
                <div class="flex flex-wrap items-center gap-2 text-sm text-slate-500">
                    <span class="h-2 w-2 shrink-0 rounded-full bg-emerald-500"></span>
                    <span>Menampilkan hasil filter untuk:</span>
                    @if (request('search'))
                        <span class="font-semibold text-slate-700">"{{ request('search') }}"</span>
                    @endif
                    @if (request('search') && request('kepemilikan'))
                        <span>&</span>
                    @endif
                    @if (request('kepemilikan'))
                        <span class="font-semibold text-slate-700">Perusahaan: "{{ request('kepemilikan') }}"</span>
                    @endif
                </div>
                <a href="{{ route('afkir.index') }}" class="text-xs font-medium text-emerald-600 transition hover:text-emerald-700 hover:underline">Bersihkan filter</a>
            </div>
        </div>
    @endif

    <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
        <div class="flex min-h-[64px] items-center border-b border-slate-200 px-5 py-4">
            <div class="flex items-center gap-3">
                <div class="flex h-9 w-9 items-center justify-center rounded-lg bg-blue-50 text-blue-600">
                    <i class="fas fa-list text-sm"></i>
                </div>
                <div>
                    <h5 class="text-sm font-bold text-slate-800">Daftar Armada Afkir</h5>
                    <span class="mt-0.5 block text-xs text-slate-400">Informasi kendaraan dan status peremajaan</span>
                </div>
            </div>
        </div>

        <div class="table-scroll-wrapper">
            <table class="afkir-table min-w-[1600px] text-left">
                <thead>
                    <tr class="border-b-2 border-slate-200 bg-slate-50">
                        <th class="w-14 border-r border-slate-200 px-4 py-3 text-center text-[11px] font-bold uppercase tracking-wide text-slate-500">No.</th>
                        <th class="border-r border-slate-200 px-4 py-3 text-[11px] font-bold uppercase tracking-wide text-slate-500">Nopol</th>
                        <th class="border-r border-slate-200 px-4 py-3 text-[11px] font-bold uppercase tracking-wide text-slate-500">Kapasitas</th>
                        <th class="border-r border-slate-200 px-4 py-3 text-[11px] font-bold uppercase tracking-wide text-slate-500">Kepemilikan</th>
                        <th class="border-r border-slate-200 px-4 py-3 text-[11px] font-bold uppercase tracking-wide text-slate-500">Status</th>
                        <th class="border-r border-slate-200 px-4 py-3 text-[11px] font-bold uppercase tracking-wide text-slate-500">Tahun Pembuatan</th>
                        <th class="border-r border-slate-200 px-4 py-3 text-[11px] font-bold uppercase tracking-wide text-slate-500">Merek</th>
                        <th class="border-r border-slate-200 px-4 py-3 text-center text-[11px] font-bold uppercase tracking-wide text-slate-500">TMT Afkir</th>
                        <th class="border-r border-slate-200 px-4 py-3 text-[11px] font-bold uppercase tracking-wide text-slate-500">Status Peremajaan</th>
                        <th class="border-r border-slate-200 px-4 py-3 text-[11px] font-bold uppercase tracking-wide text-slate-500">Operasi</th>
                        <th class="border-r border-slate-200 px-4 py-3 text-[11px] font-bold uppercase tracking-wide text-slate-500">Lama Afkir</th>
                        <th class="border-r border-slate-200 px-4 py-3 text-center text-[11px] font-bold uppercase tracking-wide text-slate-500">Status Afkir</th>
                        <th class="border-r border-slate-200 px-4 py-3 text-[11px] font-bold uppercase tracking-wide text-slate-500">Keterangan</th>
                        <th class="border-r border-slate-200 px-4 py-3 text-[11px] font-bold uppercase tracking-wide text-slate-500">Timeline</th>
                        <th class="action-column px-4 py-3 text-center text-[11px] font-bold uppercase tracking-wide text-slate-500">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($afkirData as $row)
                        <tr class="border-b border-slate-200 transition hover:bg-blue-50/40">
                            <td class="w-14 border-r border-slate-200 px-4 py-3 text-center text-xs font-semibold text-slate-500">{{ $loop->iteration }}</td>
                            <td class="border-r border-slate-200 px-4 py-3 text-sm font-bold text-slate-800">{{ $row->nopol }}</td>
                            <td class="border-r border-slate-200 px-4 py-3 text-xs font-semibold text-slate-600">{{ $row->kapasitas }} KL</td>
                            <td class="border-r border-slate-200 px-4 py-3 text-xs text-slate-600">{{ $row->kepemilikan ?: '-' }}</td>
                            <td class="border-r border-slate-200 px-4 py-3">
                                <span class="inline-flex items-center gap-1.5 rounded-md bg-blue-50 px-2.5 py-1.5 text-[10px] font-bold text-blue-600">
                                    <span class="h-1.5 w-1.5 rounded-full bg-current"></span> {{ $row->status ?: '-' }}
                                </span>
                            </td>
                            <td class="border-r border-slate-200 px-4 py-3 text-xs text-slate-600">
                                {{ $row->tahun_pembuatan ? \Carbon\Carbon::parse($row->tahun_pembuatan)->format('d/m/Y') : '-' }}
                            </td>
                            <td class="border-r border-slate-200 px-4 py-3 text-xs text-slate-600">{{ $row->merek ?: '-' }}</td>
                            <td class="border-r border-slate-200 px-4 py-3 text-center text-xs text-slate-600">
                                {{ $row->tmt_afkir ? \Carbon\Carbon::parse($row->tmt_afkir)->format('d/m/Y') : '-' }}
                            </td>
                            <td class="border-r border-slate-200 px-4 py-3 text-xs text-slate-600">{{ $row->status_peremajaan ?: '-' }}</td>
                            <td class="border-r border-slate-200 px-4 py-3">
                                @if ($row->operasi == 'Aktif')
                                    <span class="inline-flex items-center gap-1.5 rounded-md bg-emerald-50 px-2.5 py-1.5 text-[10px] font-bold text-emerald-600">
                                        <span class="h-1.5 w-1.5 rounded-full bg-current"></span> Aktif
                                    </span>
                                @elseif ($row->operasi == 'Tidak Aktif')
                                    <span class="inline-flex items-center gap-1.5 rounded-md bg-red-50 px-2.5 py-1.5 text-[10px] font-bold text-red-600">
                                        <span class="h-1.5 w-1.5 rounded-full bg-current"></span> Tidak Aktif
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1.5 rounded-md bg-slate-100 px-2.5 py-1.5 text-[10px] font-bold text-slate-600">
                                        <span class="h-1.5 w-1.5 rounded-full bg-current"></span> {{ $row->operasi ?: '-' }}
                                    </span>
                                @endif
                            </td>
                            <td class="border-r border-slate-200 px-4 py-3 text-xs text-slate-600">{{ $row->lama_afkir ?: '-' }}</td>
                            <td class="border-r border-slate-200 px-4 py-3 text-center">
                                @php
                                    $statusClass = $row->status_tmt['class'] ?? 'secondary';
                                    $statusBadge = match ($statusClass) {
                                        'danger' => 'bg-red-50 text-red-600',
                                        'success' => 'bg-emerald-50 text-emerald-600',
                                        'warning' => 'bg-amber-50 text-amber-600',
                                        'info' => 'bg-blue-50 text-blue-600',
                                        default => 'bg-slate-100 text-slate-600',
                                    };
                                @endphp
                                <span class="inline-flex items-center gap-1.5 rounded-md px-2.5 py-1.5 text-[10px] font-bold {{ $statusBadge }}">
                                    <span class="h-1.5 w-1.5 rounded-full bg-current"></span> {{ $row->status_tmt['label'] ?? '-' }}
                                </span>
                            </td>
                            <td class="border-r border-slate-200 px-4 py-3">
                                <div class="max-w-[220px] truncate text-xs text-slate-600" title="{{ $row->keterangan }}">{{ $row->keterangan ?: '-' }}</div>
                            </td>
                            <td class="border-r border-slate-200 px-4 py-3 text-xs text-slate-600">{{ $row->timeline_peremajaan ?: '-' }}</td>
                            <td class="action-column px-4 py-3 text-center">
                                <div class="action-wrapper">
                                    <button type="button" data-modal-target="modalEdit"
                                        data-update-url="{{ route('afkir.update', $row->id) }}"
                                        data-nopol="{{ $row->nopol }}" 
                                        data-kapasitas="{{ $row->kapasitas }}"
                                        data-kepemilikan="{{ $row->kepemilikan }}"
                                        data-tahun-pembuatan="{{ $row->tahun_pembuatan ? \Carbon\Carbon::parse($row->tahun_pembuatan)->format('Y-m-d') : '' }}"
                                        data-merek="{{ $row->merek }}" 
                                        data-status="{{ $row->status }}"
                                        data-operasi="{{ $row->operasi }}"
                                        data-tmt-afkir="{{ $row->tmt_afkir ? \Carbon\Carbon::parse($row->tmt_afkir)->format('Y-m-d') : '' }}"
                                        data-lama-afkir="{{ $row->lama_afkir }}"
                                        data-status-peremajaan="{{ $row->status_peremajaan }}"
                                        data-timeline-peremajaan="{{ $row->timeline_peremajaan }}"
                                        data-keterangan="{{ $row->keterangan }}" 
                                        title="Edit Data"
                                        aria-label="Edit data {{ $row->nopol }}" class="action-button action-edit">
                                        <i class="fas fa-pen text-xs pointer-events-none"></i>
                                    </button>

                                    <form action="{{ route('afkir.destroy', $row->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data {{ $row->nopol }}?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" title="Hapus Data" aria-label="Hapus data {{ $row->nopol }}" class="action-button action-delete">
                                            <i class="fas fa-trash text-xs"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="15" class="px-4 py-12 text-center">
                                <div class="flex flex-col items-center justify-center text-slate-400">
                                    <div class="mb-3 flex h-14 w-14 items-center justify-center rounded-full bg-slate-100">
                                        <i class="fas fa-inbox text-xl"></i>
                                    </div>
                                    <div class="text-sm font-semibold text-slate-600">Belum ada data armada afkir</div>
                                    <div class="mt-1 text-xs text-slate-400">Silakan tambahkan data baru menggunakan tombol Tambah Data.</div>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    @if ($afkirData->hasPages())
        <div class="border-t border-slate-200 bg-slate-50 px-5 py-4 mt-5 rounded-xl">
            <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                <div class="text-xs text-slate-500">
                    Menampilkan <span class="font-semibold text-slate-700">{{ $afkirData->firstItem() ?? 0 }}</span>
                    sampai <span class="font-semibold text-slate-700">{{ $afkirData->lastItem() ?? 0 }}</span> dari 
                    <span class="font-semibold text-slate-700">{{ $afkirData->total() }}</span> data
                </div>
                <div>
                    {{ $afkirData->withQueryString()->links() }}
                </div>
            </div>
        </div>
    @endif

    <style>
        .afkir-page .table-scroll-wrapper { width: 100%; overflow-x: auto; overflow-y: hidden; -webkit-overflow-scrolling: touch; scrollbar-width: thin; scrollbar-color: #cbd5e1 #f8fafc; }
        .afkir-page .afkir-table { width: max-content; min-width: 100%; border-collapse: separate; border-spacing: 0; font-size: 0.875rem; }
        .afkir-page .afkir-table thead th { position: sticky; top: 0; z-index: 20; padding: 0.85rem 1rem; background: #f8fafc; color: #475569; font-size: 0.72rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.045em; white-space: nowrap; text-align: left; border-right: 1px solid #e2e8f0; border-bottom: 2px solid #cbd5e1; }
        .afkir-page .afkir-table tbody td { padding: 0.85rem 1rem; background: #fff; color: #475569; white-space: nowrap; border-right: 1px solid #eef2f7; border-bottom: 1px solid #e2e8f0; vertical-align: middle; transition: background-color 0.15s ease; }
        .afkir-page .afkir-table tbody tr:hover td { background: #f8fbff; }
        .afkir-page .action-column { position: sticky; right: 0; z-index: 25; width: 105px; min-width: 105px; text-align: center; background: #fff !important; border-left: 1px solid #e2e8f0; box-shadow: -6px 0 14px rgba(15, 23, 42, 0.07); }
        .afkir-page .action-wrapper { display: flex; align-items: center; justify-content: center; gap: 6px; }
        .afkir-page .action-button { display: inline-flex; align-items: center; justify-content: center; width: 34px; height: 34px; border: 1px solid; border-radius: 9px; background: #fff; cursor: pointer; transition: all 0.15s ease; }
        .afkir-page .action-edit { color: #2563eb; border-color: #bfdbfe; }
        .afkir-page .action-edit:hover { background: #eff6ff; border-color: #93c5fd; }
        .afkir-page .action-delete { color: #dc2626; border-color: #fecaca; }
        .afkir-page .action-delete:hover { background: #fef2f2; border-color: #fca5a5; }
        
        /* Modal CSS tetap berada di scope .afkir-page */
       .afkir-page .modal { position: fixed; inset: 0; z-index: 9999; align-items: center; justify-content: center; padding: 1rem; }
.afkir-page .modal:not(.hidden) { display: flex; }
        .afkir-page .modal-backdrop { position: absolute; inset: 0; background: rgba(15, 23, 42, 0.5); backdrop-filter: blur(4px); }
        .afkir-page .modal-content { position: relative; z-index: 10; display: flex; width: 100%; max-width: 72rem; max-height: 92vh; flex-direction: column; overflow: hidden; border: 1px solid #e2e8f0; border-radius: 1rem; background: #fff; box-shadow: 0 25px 50px -12px rgba(15, 23, 42, 0.25); }
        .afkir-page .modal-header { display: flex; align-items: center; justify-content: space-between; flex-shrink: 0; padding: 1rem 1.5rem; background: #f9fafb; border-bottom: 1px solid #e5e7eb; }
        .afkir-page .modal-body { min-height: 0; flex: 1; overflow-y: auto; padding: 1.25rem 1.5rem; }
        .afkir-page .modal-footer { display: flex; justify-content: flex-end; gap: 0.5rem; flex-shrink: 0; padding: 1rem 1.5rem; background: #fff; border-top: 1px solid #e2e8f0; }
        .afkir-page .modal-close { display: inline-flex; align-items: center; justify-content: center; width: 36px; height: 36px; border: 0; border-radius: 9px; color: #94a3b8; background: transparent; cursor: pointer; transition: all 0.15s ease; }
        .afkir-page .modal-close:hover { color: #475569; background: #f1f5f9; }
        .afkir-page .form-control { height: 40px; width: 100%; border: 1px solid #e2e8f0; border-radius: 8px; background: #fff; padding: 0 0.75rem; color: #334155; font-size: 0.75rem; outline: none; transition: border-color 0.15s ease, box-shadow 0.15s ease; }
        .afkir-page .form-control:focus, .afkir-page textarea.form-control:focus { border-color: #93c5fd; box-shadow: 0 0 0 3px rgba(219, 234, 254, 0.8); }
        .afkir-page textarea.form-control { height: auto; min-height: 88px; padding: 0.625rem 0.75rem; resize: vertical; }
        .afkir-page .form-label { display: block; margin-bottom: 0.375rem; color: #475569; font-size: 0.75rem; font-weight: 600; }
        .afkir-page .section-card { padding: 1rem; border: 1px solid #e2e8f0; border-radius: 0.75rem; background: #f8fafc; }
        .afkir-page .section-divider { margin-bottom: 1.5rem; padding-bottom: 1.5rem; border-bottom: 1px solid #e2e8f0; }
        @media (max-width: 640px) {
            .afkir-page .modal { padding: 0.75rem; }
            .afkir-page .modal-content { max-height: 95vh; border-radius: 0.875rem; }
            .afkir-page .modal-header, .afkir-page .modal-body, .afkir-page .modal-footer { padding-left: 1rem; padding-right: 1rem; }
        }
    </style>

    <!-- Modal Tambah -->
    <div id="modalTambah" class="modal hidden" aria-hidden="true">
        <div class="modal-backdrop" data-modal-close></div>
        <div class="modal-content" role="dialog" aria-modal="true" aria-labelledby="modalTambahTitle">
            <div class="modal-header">
                <div class="flex items-center gap-3">
                    <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-blue-50 text-blue-600">
                        <i class="fas fa-plus"></i>
                    </div>
                    <div>
                        <h5 id="modalTambahTitle" class="text-base font-bold text-slate-800">Tambah Data Armada</h5>
                        <p class="mt-0.5 text-xs text-slate-400">Masukkan informasi armada afkir yang baru.</p>
                    </div>
                </div>
                <button type="button" class="modal-close" data-modal-close aria-label="Tutup">
                    <i class="fas fa-times pointer-events-none"></i>
                </button>
            </div>
            <form method="POST" action="{{ route('afkir.store') }}" class="flex min-h-0 flex-1 flex-col">
                @csrf
                <div class="modal-body">
                    <div class="section-divider">
                        <div class="mb-3 flex items-center gap-2.5">
                            <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-blue-50 text-blue-600">
                                <i class="fas fa-truck text-xs"></i>
                            </div>
                            <div>
                                <h6 class="text-sm font-bold text-slate-700">Data Kendaraan</h6>
                                <span class="block text-[10px] text-slate-400">Informasi utama kendaraan</span>
                            </div>
                        </div>
                        <div class="section-card">
                            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-5">
                                <div>
                                    <label class="form-label">Nopol</label>
                                    <input type="text" name="nopol" value="{{ old('nopol') }}" placeholder="Contoh: B 1234 ABC" required class="form-control">
                                </div>
                                <div>
                                    <label class="form-label">Kapasitas (KL)</label>
                                    <input type="number" name="kapasitas" value="{{ old('kapasitas') }}" placeholder="Contoh: 24" required class="form-control">
                                </div>
                                <div>
                                    <label class="form-label">Kepemilikan</label>
                                    <select name="kepemilikan" required class="form-control">
                                        <option value="">-- Pilih Kepemilikan --</option>
                                        @foreach ($listTransportir as $transportir)
                                            <option value="{{ $transportir->nama }}" {{ old('kepemilikan') == $transportir->nama ? 'selected' : '' }}>{{ $transportir->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div>
                                    <label class="form-label">Tahun Pembuatan</label>
                                    <input type="date" name="tahun_pembuatan" value="{{ old('tahun_pembuatan') }}" required class="form-control">
                                </div>
                                <div>
                                    <label class="form-label">Merek</label>
                                    <select name="merek" required class="form-control">
                                        <option value="">-- Pilih Merek --</option>
                                        @foreach ($merekList ?? [] as $merek)
                                            <option value="{{ $merek->nama }}" {{ old('merek') == $merek->nama ? 'selected' : '' }}>{{ $merek->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="section-divider">
                        <div class="mb-3 flex items-center gap-2.5">
                            <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-emerald-50 text-emerald-600">
                                <i class="fas fa-shield-alt text-xs"></i>
                            </div>
                            <div>
                                <h6 class="text-sm font-bold text-slate-700">Status & Operasi</h6>
                                <span class="block text-[10px] text-slate-400">Status penggunaan kendaraan</span>
                            </div>
                        </div>
                        <div class="section-card">
                            <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                                <div>
                                    <label class="form-label">Status</label>
                                    <select name="status" required class="form-control">
                                        <option value="">-- Pilih Status --</option>
                                        @foreach ($options['status'] ?? [] as $opt)
                                            <option value="{{ $opt->value }}" {{ old('status') == $opt->value ? 'selected' : '' }}>{{ $opt->value }}</option>
                                        @endforeach
                                        <option value="All In Lokal" {{ old('status') == 'All In Lokal' ? 'selected' : '' }}>All In Lokal</option>
                                        <option value="Pola Tarif" {{ old('status') == 'Pola Tarif' ? 'selected' : '' }}>Pola Tarif</option>
                                    </select>
                                </div>
                                <div>
                                    <label class="form-label">Operasi</label>
                                    <select name="operasi" required class="form-control">
                                        <option value="">-- Pilih Operasi --</option>
                                        @foreach ($options['operasi'] ?? [] as $opt)
                                            <option value="{{ $opt->value }}" {{ old('operasi') == $opt->value ? 'selected' : '' }}>{{ $opt->value }}</option>
                                        @endforeach
                                        <option value="Aktif" {{ old('operasi') == 'Aktif' ? 'selected' : '' }}>Aktif</option>
                                        <option value="Tidak Aktif" {{ old('operasi') == 'Tidak Aktif' ? 'selected' : '' }}>Tidak Aktif</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="mb-3 flex items-center gap-2.5">
                            <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-red-50 text-red-600">
                                <i class="fas fa-calendar-times text-xs"></i>
                            </div>
                            <div>
                                <h6 class="text-sm font-bold text-slate-700">Afkir & Peremajaan</h6>
                                <span class="block text-[10px] text-slate-400">Informasi masa afkir dan rencana peremajaan</span>
                            </div>
                        </div>
                        <div class="section-card">
                            <div class="grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-4">
                                <div>
                                    <label class="form-label">TMT Afkir</label>
                                    <input type="date" name="tmt_afkir" value="{{ old('tmt_afkir') }}" required class="form-control">
                                </div>
                                <div>
                                    <label class="form-label">Lama Afkir</label>
                                    <input type="text" name="lama_afkir" value="{{ old('lama_afkir') }}" placeholder="Contoh: 9 Tahun 5 Bulan 2 Hari" required class="form-control">
                                </div>
                                <div>
                                    <label class="form-label">Status Peremajaan</label>
                                    <select name="status_peremajaan" required class="form-control">
                                        <option value="">-- Pilih Status --</option>
                                        @foreach ($options['status_peremajaan'] ?? [] as $opt)
                                            <option value="{{ $opt->value }}" {{ old('status_peremajaan') == $opt->value ? 'selected' : '' }}>{{ $opt->value }}</option>
                                        @endforeach
                                        <option value="DIREMAJAKAN" {{ old('status_peremajaan') == 'DIREMAJAKAN' ? 'selected' : '' }}>DIREMAJAKAN</option>
                                    </select>
                                </div>
                                <div>
                                    <label class="form-label">Timeline Peremajaan</label>
                                    <input type="text" name="timeline_peremajaan" value="{{ old('timeline_peremajaan') }}" placeholder="Contoh: Aug-26" class="form-control">
                                </div>
                                <div class="md:col-span-2 lg:col-span-4">
                                    <label class="form-label">Keterangan Tambahan</label>
                                    <textarea name="keterangan" rows="3" placeholder="Contoh: Proses di karoseri / Menunggu persetujuan" class="form-control">{{ old('keterangan') }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="rounded-lg border border-slate-200 bg-white px-4 py-2 text-xs font-semibold text-slate-600 transition hover:bg-slate-50" data-modal-close>
                        Batal
                    </button>
                    <button type="submit" class="rounded-lg bg-blue-600 px-5 py-2 text-xs font-semibold text-white shadow-sm transition hover:bg-blue-700">
                        <i class="fas fa-save mr-1"></i> Simpan Data
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Edit -->
    <div id="modalEdit" class="modal hidden" aria-hidden="true">
        <div class="modal-backdrop" data-modal-close></div>
        <div class="modal-content" role="dialog" aria-modal="true" aria-labelledby="modalEditTitle">
            <div class="modal-header">
                <div class="flex items-center gap-3">
                    <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-blue-50 text-blue-600">
                        <i class="fas fa-pen"></i>
                    </div>
                    <div>
                        <h5 id="modalEditTitle" class="text-base font-bold text-slate-800">Edit Data Armada</h5>
                        <p class="mt-0.5 text-xs text-slate-400">
                            Perbarui informasi kendaraan <strong id="editNopolLabel" class="text-slate-600">-</strong>
                        </p>
                    </div>
                </div>
                <button type="button" class="modal-close" data-modal-close aria-label="Tutup">
                    <i class="fas fa-times pointer-events-none"></i>
                </button>
            </div>
            <form id="formEditAfkir" method="POST" action="" class="flex min-h-0 flex-1 flex-col">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="section-divider">
                        <div class="mb-3 flex items-center gap-2.5">
                            <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-blue-50 text-blue-600">
                                <i class="fas fa-truck text-xs"></i>
                            </div>
                            <div>
                                <h6 class="text-sm font-bold text-slate-700">Data Kendaraan</h6>
                                <span class="block text-[10px] text-slate-400">Informasi utama kendaraan</span>
                            </div>
                        </div>
                        <div class="section-card">
                            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-5">
                                <div>
                                    <label class="form-label">Nopol</label>
                                    <input id="edit_nopol" type="text" name="nopol" required class="form-control">
                                </div>
                                <div>
                                    <label class="form-label">Kapasitas (KL)</label>
                                    <input id="edit_kapasitas" type="number" name="kapasitas" required class="form-control">
                                </div>
                                <div>
                                    <label class="form-label">Kepemilikan</label>
                                    <select id="edit_kepemilikan" name="kepemilikan" required class="form-control">
                                        <option value="">-- Pilih Kepemilikan --</option>
                                        @foreach ($listTransportir as $transportir)
                                            <option value="{{ $transportir->nama }}">{{ $transportir->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div>
                                    <label class="form-label">Tahun Pembuatan</label>
                                    <input id="edit_tahun_pembuatan" type="date" name="tahun_pembuatan" required class="form-control">
                                </div>
                                <div>
                                    <label class="form-label">Merek</label>
                                    <select id="edit_merek" name="merek" required class="form-control">
                                        <option value="">-- Pilih Merek --</option>
                                        @foreach ($merekList ?? [] as $merek)
                                            <option value="{{ $merek->nama }}">{{ $merek->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="section-divider">
                        <div class="mb-3 flex items-center gap-2.5">
                            <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-emerald-50 text-emerald-600">
                                <i class="fas fa-shield-alt text-xs"></i>
                            </div>
                            <div>
                                <h6 class="text-sm font-bold text-slate-700">Status & Operasi</h6>
                                <span class="block text-[10px] text-slate-400">Status penggunaan kendaraan</span>
                            </div>
                        </div>
                        <div class="section-card">
                            <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                                <div>
                                    <label class="form-label">Status</label>
                                    <select id="edit_status" name="status" required class="form-control">
                                        <option value="">-- Pilih Status --</option>
                                        @foreach ($options['status'] ?? [] as $opt)
                                            <option value="{{ $opt->value }}">{{ $opt->value }}</option>
                                        @endforeach
                                        <option value="All In Lokal">All In Lokal</option>
                                        <option value="Pola Tarif">Pola Tarif</option>
                                    </select>
                                </div>
                                <div>
                                    <label class="form-label">Operasi</label>
                                    <select id="edit_operasi" name="operasi" required class="form-control">
                                        <option value="">-- Pilih Operasi --</option>
                                        @foreach ($options['operasi'] ?? [] as $opt)
                                            <option value="{{ $opt->value }}">{{ $opt->value }}</option>
                                        @endforeach
                                        <option value="Aktif">Aktif</option>
                                        <option value="Tidak Aktif">Tidak Aktif</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="mb-3 flex items-center gap-2.5">
                            <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-red-50 text-red-600">
                                <i class="fas fa-calendar-times text-xs"></i>
                            </div>
                            <div>
                                <h6 class="text-sm font-bold text-slate-700">Afkir & Peremajaan</h6>
                                <span class="block text-[10px] text-slate-400">Informasi masa afkir dan rencana peremajaan</span>
                            </div>
                        </div>
                        <div class="section-card">
                            <div class="grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-4">
                                <div>
                                    <label class="form-label">TMT Afkir</label>
                                    <input id="edit_tmt_afkir" type="date" name="tmt_afkir" required class="form-control">
                                </div>
                                <div>
                                    <label class="form-label">Lama Afkir</label>
                                    <input id="edit_lama_afkir" type="text" name="lama_afkir" placeholder="Contoh: 9 Tahun 5 Bulan 2 Hari" required class="form-control">
                                </div>
                                <div>
                                    <label class="form-label">Status Peremajaan</label>
                                    <select id="edit_status_peremajaan" name="status_peremajaan" required class="form-control">
                                        <option value="">-- Pilih Status --</option>
                                        @foreach ($options['status_peremajaan'] ?? [] as $opt)
                                            <option value="{{ $opt->value }}">{{ $opt->value }}</option>
                                        @endforeach
                                        <option value="DIREMAJAKAN">DIREMAJAKAN</option>
                                    </select>
                                </div>
                                <div>
                                    <label class="form-label">Timeline Peremajaan</label>
                                    <input id="edit_timeline_peremajaan" type="text" name="timeline_peremajaan" placeholder="Contoh: Aug-26" class="form-control">
                                </div>
                                <div class="md:col-span-2 lg:col-span-4">
                                    <label class="form-label">Keterangan Tambahan</label>
                                    <textarea id="edit_keterangan" name="keterangan" rows="3" placeholder="Contoh: Proses di karoseri / Menunggu persetujuan" class="form-control"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="rounded-lg border border-slate-200 bg-white px-4 py-2 text-xs font-semibold text-slate-600 transition hover:bg-slate-50" data-modal-close>
                        Batal
                    </button>
                    <button type="submit" class="rounded-lg bg-blue-600 px-5 py-2 text-xs font-semibold text-white shadow-sm transition hover:bg-blue-700">
                        <i class="fas fa-save mr-1"></i> Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Script yang dioptimasi menggunakan Event Delegation -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const body = document.body;
            const modals = document.querySelectorAll('.modal');
            const editModal = document.querySelector('#modalEdit');
            const editForm = document.querySelector('#formEditAfkir');

            function closeAllModals() {
                modals.forEach(function(modal) {
                    modal.classList.add('hidden');
                    modal.setAttribute('aria-hidden', 'true');
                });
                body.classList.remove('overflow-hidden');
            }

            function openModal(modal) {
                if (!modal) return;
                closeAllModals();
                modal.classList.remove('hidden');
                modal.setAttribute('aria-hidden', 'false');
                body.classList.add('overflow-hidden');
            }

            function setValue(id, value) {
                const field = document.querySelector('#' + id);
                if (field) field.value = value ?? '';
            }

            function openEditModal(button) {
                if (!editModal || !editForm) return;

                const data = button.dataset;
                const updateUrl = data.updateUrl || '';

                if (!updateUrl) {
                    console.error('URL update afkir tidak ditemukan.');
                    return;
                }

                editForm.action = updateUrl;
                setValue('edit_nopol', data.nopol);
                setValue('edit_kapasitas', data.kapasitas);
                setValue('edit_kepemilikan', data.kepemilikan);
                setValue('edit_tahun_pembuatan', data.tahunPembuatan);
                setValue('edit_merek', data.merek);
                setValue('edit_status', data.status);
                setValue('edit_operasi', data.operasi);
                setValue('edit_tmt_afkir', data.tmtAfkir);
                setValue('edit_lama_afkir', data.lamaAfkir);
                setValue('edit_status_peremajaan', data.statusPeremajaan);
                setValue('edit_timeline_peremajaan', data.timelinePeremajaan);
                setValue('edit_keterangan', data.keterangan);

                const label = document.querySelector('#editNopolLabel');
                if (label) label.textContent = data.nopol || '-';

                openModal(editModal);
            }

            // Event Delegation untuk mendengarkan klik di seluruh halaman
            document.addEventListener('click', function(event) {
                // Handle tombol buka Modal (baik Tambah maupun Edit)
                const targetBtn = event.target.closest('[data-modal-target]');
                if (targetBtn) {
                    const targetId = targetBtn.getAttribute('data-modal-target');
                    if (targetId === 'modalEdit') {
                        openEditModal(targetBtn);
                    } else {
                        openModal(document.querySelector('#' + targetId));
                    }
                }

                // Handle tombol tutup Modal (tombol Batal, Tanda Silang, atau area abu-abu backdrop)
                const closeBtn = event.target.closest('[data-modal-close]');
                if (closeBtn) {
                    closeAllModals();
                }
            });

            // Tutup modal saat menekan tombol ESC di keyboard
            document.addEventListener('keydown', function(event) {
                if (event.key === 'Escape') {
                    closeAllModals();
                }
            });
        });
    </script>

</div> <!-- TAG PENUTUP UTAMA .afkir-page DIPINDAHKAN KE SINI -->
@endsection