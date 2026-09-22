@extends('layouts.app')

@section('title', 'Bank Data')
@section('subtitle', 'Manajemen daftar seluruh armada logistik')

@section('content')
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">

        <div class="mb-6 rounded-2xl border border-slate-200/80 bg-white shadow-sm">
            <div class="flex flex-col gap-5 p-5 sm:p-6 lg:flex-row lg:items-center lg:justify-between">

                <div class="flex items-center gap-4 shrink-0">
                    <div
                        class="flex h-12 w-12 shrink-0 items-center justify-center rounded-xl bg-blue-50 text-blue-600 ring-4 ring-blue-50/60">
                        <i class="fas fa-truck-moving text-lg"></i>
                    </div>
                    <div>
                        <h4 class="text-lg font-bold tracking-tight text-slate-800">Tabel Armada Aktif</h4>
                        <p class="mt-0.5 text-sm text-slate-500">Daftar seluruh armada logistik yang beroperasi.</p>
                    </div>
                </div>

                <div class="flex w-full flex-col gap-3 sm:flex-row sm:items-center lg:w-auto">

                    <form action="{{ route('bank-data.index') }}" method="GET"
                        class="flex w-full flex-col gap-2 sm:flex-row sm:items-center lg:w-auto">

                        <div class="relative w-full sm:w-64">
                            <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                                <i class="fas fa-search text-sm text-slate-400"></i>
                            </div>

                            <input type="text" name="search" value="{{ request('search') }}"
                                placeholder="Cari nomor polisi..."
                                class="block w-full rounded-xl border border-slate-200 bg-white
                       py-2.5 pl-10 pr-3 text-sm text-slate-700
                       placeholder:text-slate-400
                       outline-none shadow-none
                       focus:border-emerald-500
                       focus:outline-none
                       focus:ring-0">
                        </div>

                        <div class="relative w-full sm:w-64">

                            <select name="transportir" onchange="this.form.submit()"
                                class="block w-full appearance-none rounded-xl
                       border border-slate-200 bg-white
                       px-4 py-2.5 pr-10 text-sm text-slate-700
                       outline-none shadow-none
                       focus:border-emerald-500
                       focus:outline-none
                       focus:ring-0">

                                <option value="">Semua Perusahaan</option>

                                @foreach ($listTransportir as $transportir)
                                    @php
                                        $total = $jumlahArmada[$transportir->nama] ?? 0;
                                    @endphp

                                    <option value="{{ $transportir->nama }}"
                                        {{ request('transportir') == $transportir->nama ? 'selected' : '' }}>
                                        {{ $transportir->nama }} ({{ $total }} Armada)
                                    </option>
                                @endforeach

                            </select>

                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3">
                                <i class="fas fa-chevron-down text-xs text-slate-400"></i>
                            </div>

                        </div>


                        <button type="submit"
                            class="inline-flex shrink-0 items-center justify-center gap-2
                   rounded-xl border-0
                   bg-emerald-600 px-4 py-2.5
                   text-sm font-medium text-white
                   shadow-none
                   outline-none
                   transition-colors
                   hover:bg-emerald-700
                   focus:outline-none
                   focus:ring-0
                   active:bg-emerald-800">

                            <i class="fas fa-search text-xs"></i>
                            <span>Cari</span>
                        </button>


                        @if (request('search') || request('transportir'))
                            <a href="{{ route('bank-data.index') }}" title="Reset Pencarian"
                                class="inline-flex h-[42px] w-[42px] shrink-0
                       items-center justify-center
                       rounded-xl border border-slate-200
                       bg-white text-slate-500
                       shadow-none
                       outline-none
                       transition-colors
                       hover:border-red-200
                       hover:bg-red-50
                       hover:text-red-500
                       focus:outline-none
                       focus:ring-0">

                                <i class="fas fa-times text-xs"></i>
                            </a>
                        @endif

                    </form>


                    <button type="button" data-modal-target="modalTambah"
                        class="inline-flex w-full shrink-0 items-center justify-center gap-2
               rounded-xl border-0
               bg-blue-600 px-5 py-2.5
               text-sm font-medium text-white
               shadow-none
               outline-none
               transition-colors
               hover:bg-blue-700
               focus:outline-none
               focus:ring-0
               active:bg-blue-800
               sm:w-auto">

                        <i class="fas fa-plus text-xs"></i>
                        <span>Tambah Data</span>

                    </button>

                </div>
            </div>
        </div>

        @if (request('search') || request('transportir'))
            <div class="mb-5 border-t border-slate-100 bg-slate-50/50 px-5 py-3.5 sm:px-6">
                <div class="flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between">
                    <div class="flex flex-wrap items-center gap-2 text-sm text-slate-500">
                        <span class="h-2 w-2 shrink-0 rounded-full bg-emerald-500"></span>
                        <span>Menampilkan hasil filter untuk:</span>
                        @if (request('search'))
                            <span class="font-semibold text-slate-700">"{{ request('search') }}"</span>
                        @endif
                        @if (request('search') && request('transportir'))
                            <span>&</span>
                        @endif
                        @if (request('transportir'))
                            <span class="font-semibold text-slate-700">Perusahaan: "{{ request('transportir') }}"</span>
                        @endif
                    </div>
                    <a href="{{ route('bank-data.index') }}"
                        class="text-xs font-medium text-emerald-600 transition hover:text-emerald-700 hover:underline">
                        Bersihkan filter
                    </a>
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
                        <h5 class="text-sm font-bold text-slate-800">Bank Data Armada</h5>
                        <span class="mt-0.5 block text-xs text-slate-400">Informasi kendaraan dan status peremajaan</span>
                    </div>
                </div>
            </div>

            <div class="table-scroll-info">
                <div class="flex items-center gap-2">
                    <i class="fas fa-arrows-alt-h"></i>
                    <span>Geser ke kanan untuk melihat data lainnya</span>
                </div>
            </div>

            <div class="table-scroll-wrapper">
                <table class="bank-data-table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>No. Polisi</th>
                            <th>Kapasitas (KL)</th>
                            <th>Transportir</th>
                            <th>Status</th>
                            <th>Tahun Trailer</th>
                            <th>Tahun STNK (Head)</th>
                            <th>Umur Trailer</th>
                            <th>Umur Head</th>
                            <th>Peringatan Afkir Trailer</th>
                            <th>Peringatan Afkir Head</th>
                            <th>Merek</th>
                            <th>Type</th>
                            <th>Kategori</th>
                            <th>Pabrikan Trailer</th>
                            <th>Material Tangki</th>
                            <th>Kompartemen</th>
                            <th>Status Asuransi</th>
                            <th>Aktif / Tidak Aktif</th>
                            <th>Ket Dispen</th>
                            <th>Keterangan</th>
                            <th>Ket Euro</th>
                            <th>Kompensator</th>
                            <th>Tgl Operasi</th>
                            <th class="action-column">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($bankData as $index => $row)
                            <tr>
                                <td class="text-center number-column">{{ $bankData->firstItem() + $index }}</td>
                                <td class="nopol-column">{{ $row->nopol }}</td>
                                <td class="text-center">{{ $row->kapasitas }} KL</td>
                                <td>{{ $row->transportir }}</td>
                                <td>
                                    <span class="badge badge-gray">{{ $row->status ?? '-' }}</span>
                                </td>
                                <td>{{ $row->tahun_pembuatan_trailer ? \Carbon\Carbon::parse($row->tahun_pembuatan_trailer)->format('d/m/Y') : '-' }}
                                </td>
                                <td>{{ $row->tahun_stnk_head ? \Carbon\Carbon::parse($row->tahun_stnk_head)->format('d/m/Y') : '-' }}
                                </td>

                                <td>
                                    @if ($row->tahun_pembuatan_trailer)
                                        @php $umurTrailer = \Carbon\Carbon::parse($row->tahun_pembuatan_trailer)->diff(now()); @endphp
                                        {{ $umurTrailer->y }} Thn {{ $umurTrailer->m }} Bln
                                    @else
                                        -
                                    @endif
                                </td>

                                <td>
                                    @if ($row->tahun_stnk_head)
                                        @php $umurHead = \Carbon\Carbon::parse($row->tahun_stnk_head)->diff(now()); @endphp
                                        {{ $umurHead->y }} Thn {{ $umurHead->m }} Bln
                                    @else
                                        -
                                    @endif
                                </td>

                                <td>
                                    @php
                                        $peringatanTrailer = $row->peringatan_afkir_trailer;
                                        $classTrailer = $peringatanTrailer['class'] ?? 'success';
                                        $badgeTrailer = match ($classTrailer) {
                                            'danger' => 'badge-red',
                                            'warning' => 'badge-yellow',
                                            default => 'badge-green',
                                        };
                                    @endphp
                                    <span
                                        class="badge {{ $badgeTrailer }}">{{ $peringatanTrailer['label'] ?? '-' }}</span>
                                </td>

                                <td>
                                    @php
                                        $peringatanHead = $row->peringatan_afkir_head;
                                        $classHead = $peringatanHead['class'] ?? 'success';
                                        $badgeHead = match ($classHead) {
                                            'danger' => 'badge-red',
                                            'warning' => 'badge-yellow',
                                            default => 'badge-green',
                                        };
                                    @endphp
                                    <span class="badge {{ $badgeHead }}">{{ $peringatanHead['label'] ?? '-' }}</span>
                                </td>

                                <td>{{ $row->merek ?? '-' }}</td>
                                <td>{{ $row->type ?? '-' }}</td>
                                <td>{{ $row->kategori ?? '-' }}</td>
                                <td>{{ $row->pabrikan_trailer ?? '-' }}</td>
                                <td>{{ $row->material_tangki ?? '-' }}</td>
                                <td class="text-center">{{ $row->jumlah_kompartemen ?? '-' }}</td>
                                <td>{{ $row->status_asuransi ?? '-' }}</td>
                                <td>
                                    @if ($row->aktif_tidak_aktif === 'Aktif')
                                        <span class="badge badge-green">Aktif</span>
                                    @else
                                        <span class="badge badge-gray">{{ $row->aktif_tidak_aktif ?? '-' }}</span>
                                    @endif
                                </td>
                                <td>{{ $row->keterangan_dispen ?? '-' }}</td>
                                <td>{{ $row->keterangan ?? '-' }}</td>
                                <td>{{ $row->keterangan_euro ?? '-' }}</td>
                                <td>{{ $row->kompensator_fifth_wheel ?? '-' }}</td>
                                <td>{{ $row->tanggal_operasi_awal ? \Carbon\Carbon::parse($row->tanggal_operasi_awal)->format('d/m/Y') : '-' }}
                                </td>

                                <td class="action-column">
                                    <div class="action-wrapper">
                                        <button type="button" data-modal-target="modalEdit{{ $row->id }}"
                                            title="Edit Data" class="action-button action-edit">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <form action="{{ route('bank-data.destroy', $row->id) }}" method="POST"
                                            class="inline"
                                            onsubmit="return confirm('Apakah Anda yakin ingin menghapus data armada {{ $row->nopol }}?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="action-button action-delete" title="Hapus">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="25" class="empty-data">
                                    <div class="flex flex-col items-center justify-center py-12">
                                        <div class="empty-icon"><i class="fas fa-truck"></i></div>
                                        <p class="mt-3 text-sm font-medium text-slate-500">Belum ada data armada.</p>
                                        <span class="mt-1 text-xs text-slate-400">Data armada akan muncul di sini.</span>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if ($bankData->hasPages())
                <div class="border-t border-slate-200 bg-white px-5 py-4 sm:px-6">
                    {{ $bankData->links() }}
                </div>
            @endif
        </div>
    </div>

    @foreach ($bankData as $row)
        <div id="modalEdit{{ $row->id }}" class="modal fixed inset-0 z-[9999] hidden overflow-y-auto" role="dialog"
            aria-modal="true">
            <div class="flex min-h-screen items-center justify-center px-4 py-8">
                <div class="modal-backdrop fixed inset-0 bg-gray-900/60"></div>

                <div class="modal-content relative z-10 w-full max-w-6xl overflow-hidden rounded-xl bg-white shadow-2xl">
                    <div class="modal-header">
                        <div>
                            <h5 class="text-lg font-bold text-gray-800"><i class="fas fa-edit mr-2 text-blue-600"></i>
                                Edit Armada</h5>
                            <p class="mt-1 text-sm text-gray-500">No. Polisi: {{ $row->nopol }}</p>
                        </div>
                        <button type="button" class="modal-close modal-close-button">
                            <i class="fas fa-times text-xl"></i>
                        </button>
                    </div>

                    <form method="POST" action="{{ route('bank-data.update', $row->id) }}">
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                            <div class="form-group">
                                <h6 class="section-title text-blue-600"><i class="fas fa-truck-moving mr-2"></i> Informasi
                                    Umum</h6>
                                <div class="form-section bg-gray-50 border-gray-100">
                                    <div>
                                        <label class="form-label">No. Polisi</label>
                                        <input type="text" name="nopol" class="form-input"
                                            value="{{ $row->nopol }}" required>
                                    </div>
                                    <div>
                                        <label class="form-label">Kapasitas (KL)</label>
                                        <input type="number" name="kapasitas" class="form-input"
                                            value="{{ $row->kapasitas }}" required>
                                    </div>
                                    <div>
                                        <label class="form-label">Transportir</label>
                                        <select name="transportir" class="form-select select2-field" required>
                                            <option value="">-- Pilih Transportir --</option>
                                            @foreach ($listTransportir as $transportir)
                                                <option value="{{ $transportir->nama }}"
                                                    {{ $row->transportir == $transportir->nama ? 'selected' : '' }}>
                                                    {{ $transportir->nama }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div>
                                        <label class="form-label">Status</label>
                                        <select name="status" class="form-select select2-field" required>
                                            <option value="">-- Pilih Status --</option>
                                            @foreach ($options['status'] ?? [] as $opt)
                                                <option value="{{ $opt->value }}"
                                                    {{ $row->status == $opt->value ? 'selected' : '' }}>
                                                    {{ $opt->value }}</option>
                                            @endforeach
                                            <option value="All In Lokal"
                                                {{ $row->status == 'All In Lokal' ? 'selected' : '' }}>All In Lokal
                                            </option>
                                            <option value="Pola Tarif"
                                                {{ $row->status == 'Pola Tarif' ? 'selected' : '' }}>Pola Tarif</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <h6 class="section-title text-yellow-500"><i class="fas fa-trailer mr-2"></i> Gandengan /
                                    Trailer</h6>
                                <div class="form-section bg-yellow-50 border-yellow-100 trailer-section">
                                    <div>
                                        <label class="form-label">Tahun Pembuatan Trailer</label>
                                        <input type="date" name="tahun_pembuatan_trailer" class="form-input"
                                            value="{{ $row->tahun_pembuatan_trailer ? \Carbon\Carbon::parse($row->tahun_pembuatan_trailer)->format('Y-m-d') : '' }}"
                                            required>
                                    </div>
                                    <div>
                                        <label class="form-label">Pabrikan</label>
                                        <select name="pabrikan_trailer" class="form-select select2-field" required>
                                            <option value="">-- Pilih Pabrikan --</option>
                                            @foreach ($options['pabrikan_trailer'] ?? [] as $opt)
                                                <option value="{{ $opt->value }}"
                                                    {{ $row->pabrikan_trailer == $opt->value ? 'selected' : '' }}>
                                                    {{ $opt->value }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div>
                                        <label class="form-label">Material Tangki</label>
                                        <select name="material_tangki" class="form-select select2-field" required>
                                            <option value="">-- Pilih Material --</option>
                                            @foreach ($options['material_tangki'] ?? [] as $opt)
                                                <option value="{{ $opt->value }}"
                                                    {{ $row->material_tangki == $opt->value ? 'selected' : '' }}>
                                                    {{ $opt->value }}</option>
                                            @endforeach
                                            <option value="Carbon Steel"
                                                {{ $row->material_tangki == 'Carbon Steel' ? 'selected' : '' }}>Carbon
                                                Steel</option>
                                            <option value="Mild Steel"
                                                {{ $row->material_tangki == 'Mild Steel' ? 'selected' : '' }}>Mild Steel
                                            </option>
                                            <option value="Aluminium Alloy"
                                                {{ $row->material_tangki == 'Aluminium Alloy' ? 'selected' : '' }}>
                                                Aluminium Alloy</option>
                                        </select>
                                    </div>
                                    <div>
                                        <label class="form-label">Jumlah Kompartemen</label>
                                        <input type="number" name="jumlah_kompartemen" class="form-input"
                                            value="{{ $row->jumlah_kompartemen }}" min="1" required>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <h6 class="section-title text-gray-600"><i class="fas fa-truck mr-2"></i> Head Truck</h6>
                                <div class="form-section bg-gray-50 border-gray-200 head-section">
                                    <div>
                                        <label class="form-label">Merek</label>
                                        <select name="merek" class="form-select select2-field" required>
                                            <option value="">-- Pilih Merek --</option>
                                            @foreach ($options['merek'] ?? [] as $opt)
                                                <option value="{{ $opt->value }}"
                                                    {{ $row->merek == $opt->value ? 'selected' : '' }}>{{ $opt->value }}
                                                </option>
                                            @endforeach
                                            @foreach ($merekList ?? [] as $merek)
                                                <option value="{{ $merek->nama }}"
                                                    {{ $row->merek == $merek->nama ? 'selected' : '' }}>
                                                    {{ $merek->nama }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div>
                                        <label class="form-label">Type</label>
                                        <select name="type" class="form-select select2-field" required>
                                            <option value="">-- Pilih Type --</option>
                                            @foreach ($typeKendaran as $type)
                                                <option value="{{ $type->nama_kendaraan }}"
                                                    {{ old('type', $row->type ?? '') == $type->nama_kendaraan ? 'selected' : '' }}>
                                                    {{ $type->nama_kendaraan }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div>
                                        <label class="form-label">Nomor Mesin</label>
                                        <input type="text" name="nomor_mesin" class="form-input"
                                            value="{{ $row->nomor_mesin }}" required>
                                    </div>
                                    <div>
                                        <label class="form-label">Nomor Rangka</label>
                                        <input type="text" name="nomor_rangka" class="form-input"
                                            value="{{ $row->nomor_rangka }}" required>
                                    </div>
                                    <div>
                                        <label class="form-label">Kategori</label>
                                        <select name="kategori" class="form-select select2-field" required>
                                            <option value="">-- Pilih Kategori --</option>
                                            @foreach ($options['kategori'] ?? [] as $opt)
                                                <option value="{{ $opt->value }}"
                                                    {{ $row->kategori == $opt->value ? 'selected' : '' }}>
                                                    {{ $opt->value }}</option>
                                            @endforeach
                                            @foreach (['1', '2', '3', '4', '5'] as $kategori)
                                                <option value="{{ $kategori }}"
                                                    {{ $row->kategori == $kategori ? 'selected' : '' }}>
                                                    {{ $kategori }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div>
                                        <label class="form-label">Tahun STNK (Head)</label>
                                        <input type="date" name="tahun_stnk_head" class="form-input" 
    value="{{ $row->tahun_stnk_head ? \Carbon\Carbon::parse($row->tahun_stnk_head)->format('Y-m-d') : '' }}" required>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <h6 class="section-title text-green-600"><i class="fas fa-file-contract mr-2"></i>
                                    Legalitas & Lainnya</h6>
                                <div class="form-section bg-green-50 border-green-100 legal-section">
                                    <div>
                                        <label class="form-label">Status Asuransi</label>
                                        <select name="status_asuransi" class="form-select select2-field" required>
                                            <option value="">-- Pilih --</option>
                                            @foreach ($options['status_asuransi'] ?? [] as $opt)
                                                <option value="{{ $opt->value }}"
                                                    {{ $row->status_asuransi == $opt->value ? 'selected' : '' }}>
                                                    {{ $opt->value }}</option>
                                            @endforeach
                                            @foreach (['TUGU (MANDIRI)', 'TUGU', 'ASTRA', 'ASTRA BUANA', 'AVRIST', 'ACA (Mandiri)', 'Lippo (Mandiri)', 'Sunday', 'MAG'] as $asuransi)
                                                <option value="{{ $asuransi }}"
                                                    {{ $row->status_asuransi == $asuransi ? 'selected' : '' }}>
                                                    {{ $asuransi }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div>
                                        <label class="form-label">Aktif / Tidak Aktif</label>
                                        <select name="aktif_tidak_aktif" class="form-select" required>
                                            <option value="">-- Pilih --</option>
                                            <option value="Aktif"
                                                {{ $row->aktif_tidak_aktif == 'Aktif' ? 'selected' : '' }}>Aktif</option>
                                            <option value="Tidak Aktif"
                                                {{ $row->aktif_tidak_aktif == 'Tidak Aktif' ? 'selected' : '' }}>Tidak
                                                Aktif</option>
                                        </select>
                                    </div>
                                    <div>
                                        <label class="form-label">Keterangan EURO</label>
                                        <select name="keterangan_euro" class="form-select select2-field" required>
                                            <option value="">-- Pilih --</option>
                                            @foreach ($options['keterangan_euro'] ?? [] as $opt)
                                                <option value="{{ $opt->value }}"
                                                    {{ $row->keterangan_euro == $opt->value ? 'selected' : '' }}>
                                                    {{ $opt->value }}</option>
                                            @endforeach
                                            <option value="Euro IV"
                                                {{ $row->keterangan_euro == 'Euro IV' ? 'selected' : '' }}>Euro IV</option>
                                            <option value="Euro V"
                                                {{ $row->keterangan_euro == 'Euro V' ? 'selected' : '' }}>Euro V</option>
                                        </select>
                                    </div>
                                    <div>
                                        <label class="form-label">Tanggal Operasi Awal</label>
                                        <input type="date" name="tanggal_operasi_awal" class="form-input" 
    value="{{ $row->tanggal_operasi_awal ? \Carbon\Carbon::parse($row->tanggal_operasi_awal)->format('Y-m-d') : '' }}">
                                    </div>
                                    <div>
                                        <label class="form-label">Kompensator Fifth Wheel</label>
                                        <input type="text" name="kompensator_fifth_wheel" class="form-input"
                                            value="{{ $row->kompensator_fifth_wheel }}">
                                    </div>
                                    <div>
                                        <label class="form-label">Ket. Dispen</label>
                                        <input type="text" name="keterangan_dispen" class="form-input"
                                            value="{{ $row->keterangan_dispen }}">
                                    </div>
                                    <div class="md:col-span-3">
                                        <label class="form-label">Keterangan</label>
                                        <input type="text" name="keterangan" class="form-input"
                                            value="{{ $row->keterangan }}">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn-cancel modal-close">Batal</button>
                            <button type="submit" class="btn-submit">
                                <i class="fas fa-save mr-2"></i> Perbarui Data
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach

    <div id="modalTambah" class="modal fixed inset-0 z-[9999] hidden overflow-y-auto" role="dialog" aria-modal="true">
        <div class="flex min-h-screen items-center justify-center px-4 py-8">
            <div class="modal-backdrop fixed inset-0 bg-gray-900/60"></div>

            <div class="modal-content relative z-10 w-full max-w-6xl overflow-hidden rounded-xl bg-white shadow-2xl">
                <div class="modal-header">
                    <div>
                        <h5 class="text-lg font-bold text-gray-800"><i class="fas fa-plus-circle mr-2 text-blue-600"></i>
                            Tambah Armada Baru</h5>
                        <p class="mt-1 text-sm text-gray-500">Masukkan data armada sesuai data kendaraan</p>
                    </div>
                    <button type="button" class="modal-close modal-close-button">
                        <i class="fas fa-times text-xl"></i>
                    </button>
                </div>

                <form method="POST" action="{{ route('bank-data.store') }}">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <h6 class="section-title text-blue-600"><i class="fas fa-truck-moving mr-2"></i> Informasi
                                Umum</h6>
                            <div class="form-section bg-gray-50 border-gray-100">
                                <div>
                                    <label class="form-label">No. Polisi</label>
                                    <input type="text" name="nopol" class="form-input" required>
                                </div>
                                <div>
                                    <label class="form-label">Kapasitas (KL)</label>
                                    <input type="number" name="kapasitas" class="form-input" required>
                                </div>
                                <div>
                                    <label class="form-label">Transportir</label>
                                    <select name="transportir" class="form-select select2-field" required>
                                        <option value="">-- Pilih Transportir --</option>
                                        @foreach ($listTransportir as $transportir)
                                            <option value="{{ $transportir->nama }}">{{ $transportir->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div>
                                    <label class="form-label">Status</label>
                                    <select name="status" class="form-select select2-field" required>
                                        <option value="">-- Pilih Status --</option>
                                        @foreach ($options['status'] ?? [] as $opt)
                                            <option value="{{ $opt->value }}">{{ $opt->value }}</option>
                                        @endforeach
                                        <option value="All In Lokal">All In Lokal</option>
                                        <option value="Pola Tarif">Pola Tarif</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <h6 class="section-title text-yellow-500"><i class="fas fa-trailer mr-2"></i> Gandengan /
                                Trailer</h6>
                            <div class="form-section bg-yellow-50 border-yellow-100 trailer-section">
                                <div>
                                    <label class="form-label">Tahun Pembuatan Trailer</label>
                                    <input type="date" name="tahun_pembuatan_trailer" class="form-input" required>
                                </div>
                                <div>
                                    <label class="form-label">Pabrikan</label>
                                    <select name="pabrikan_trailer" class="form-select select2-field" required>
                                        <option value="">-- Pilih Pabrikan --</option>
                                        @foreach ($options['pabrikan_trailer'] ?? [] as $opt)
                                            <option value="{{ $opt->value }}">{{ $opt->value }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div>
                                    <label class="form-label">Material Tangki</label>
                                    <select name="material_tangki" class="form-select select2-field" required>
                                        <option value="">-- Pilih Material --</option>
                                        @foreach ($options['material_tangki'] ?? [] as $opt)
                                            <option value="{{ $opt->value }}">{{ $opt->value }}</option>
                                        @endforeach
                                        <option value="Carbon Steel">Carbon Steel</option>
                                        <option value="Mild Steel">Mild Steel</option>
                                        <option value="Aluminium Alloy">Aluminium Alloy</option>
                                    </select>
                                </div>
                                <div>
                                    <label class="form-label">Jumlah Kompartemen</label>
                                    <input type="number" name="jumlah_kompartemen" class="form-input" min="1"
                                        required>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <h6 class="section-title text-gray-600"><i class="fas fa-truck mr-2"></i> Head Truck</h6>
                            <div class="form-section bg-gray-50 border-gray-200 head-section">
                                <div>
                                    <label class="form-label">Merek</label>
                                    <select name="merek" class="form-select select2-field" required>
                                        <option value="">-- Pilih Merek --</option>
                                        @foreach ($merekList ?? [] as $merek)
                                            <option value="{{ $merek->nama }}">{{ $merek->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                              <div>
                                        <label class="form-label">Type</label>
                                        <select name="type" class="form-select select2-field" required>
                                            <option value="">-- Pilih Type --</option>
                                            @foreach ($typeKendaran as $type)
                                                <option value="{{ $type->nama_kendaraan }}"
                                                    {{ old('type', $row->type ?? '') == $type->nama_kendaraan ? 'selected' : '' }}>
                                                    {{ $type->nama_kendaraan }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                
                                <div>
                                    <label class="form-label">Nomor Mesin</label>
                                    <input type="text" name="nomor_mesin" class="form-input" required>
                                </div>
                                <div>
                                    <label class="form-label">Nomor Rangka</label>
                                    <input type="text" name="nomor_rangka" class="form-input" required>
                                </div>
                                <div>
                                    <label class="form-label">Kategori</label>
                                    <select name="kategori" class="form-select select2-field" required>
                                        <option value="">-- Pilih Kategori --</option>
                                        @foreach ($options['kategori'] ?? [] as $opt)
                                            <option value="{{ $opt->value }}">{{ $opt->value }}</option>
                                        @endforeach
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                    </select>
                                </div>
                                <div>
                                    <label class="form-label">Tahun STNK (Head)</label>
                                    <input type="date" name="tahun_stnk_head" class="form-input" required>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <h6 class="section-title text-green-600"><i class="fas fa-file-contract mr-2"></i> Legalitas &
                                Lainnya</h6>
                            <div class="form-section bg-green-50 border-green-100 legal-section">
                                <div>
                                    <label class="form-label">Status Asuransi</label>
                                    <select name="status_asuransi" class="form-select select2-field" required>
                                        <option value="">-- Pilih --</option>
                                        @foreach ($options['status_asuransi'] ?? [] as $opt)
                                            <option value="{{ $opt->value }}">{{ $opt->value }}</option>
                                        @endforeach
                                        <option value="TUGU (MANDIRI)">TUGU (MANDIRI)</option>
                                        <option value="TUGU">TUGU</option>
                                        <option value="ASTRA">ASTRA</option>
                                        <option value="ASTRA BUANA">ASTRA BUANA</option>
                                        <option value="AVRIST">AVRIST</option>
                                        <option value="ACA (Mandiri)">ACA (Mandiri)</option>
                                        <option value="Lippo (Mandiri)">Lippo (Mandiri)</option>
                                        <option value="Sunday">Sunday</option>
                                        <option value="MAG">MAG</option>
                                    </select>
                                </div>
                                <div>
                                    <label class="form-label">Aktif / Tidak Aktif</label>
                                    <select name="aktif_tidak_aktif" class="form-select" required>
                                        <option value="">-- Pilih --</option>
                                        <option value="Aktif">Aktif</option>
                                        <option value="Tidak Aktif">Tidak Aktif</option>
                                    </select>
                                </div>
                                <div>
                                    <label class="form-label">Keterangan EURO</label>
                                    <select name="keterangan_euro" class="form-select select2-field" required>
                                        <option value="">-- Pilih --</option>
                                        @foreach ($options['keterangan_euro'] ?? [] as $opt)
                                            <option value="{{ $opt->value }}">{{ $opt->value }}</option>
                                        @endforeach
                                        <option value="Euro IV">Euro IV</option>
                                        <option value="Euro V">Euro V</option>
                                    </select>
                                </div>
                                <div>
                                    <label class="form-label">Tanggal Operasi Awal</label>
                                    <input type="date" name="tanggal_operasi_awal" class="form-input">
                                </div>
                                <div>
                                    <label class="form-label">Kompensator Fifth Wheel</label>
                                    <input type="text" name="kompensator_fifth_wheel" class="form-input">
                                </div>
                                <div>
                                    <label class="form-label">Ket. Dispen</label>
                                    <input type="text" name="keterangan_dispen" class="form-input">
                                </div>
                                <div class="md:col-span-3">
                                    <label class="form-label">Keterangan</label>
                                    <input type="text" name="keterangan" class="form-input">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn-cancel modal-close">Batal</button>
                        <button type="submit" class="btn-submit">
                            <i class="fas fa-save mr-2"></i> Simpan Data
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet">
    <style>
        .table-scroll-wrapper {
            width: 100%;
            max-width: 100%;
            overflow-x: auto;
            overflow-y: hidden;
            -webkit-overflow-scrolling: touch;
            scrollbar-width: thin;
            scrollbar-color: #cbd5e1 #f8fafc;
        }

        .table-scroll-wrapper::-webkit-scrollbar {
            height: 9px;
        }

        .table-scroll-wrapper::-webkit-scrollbar-track {
            background: #f8fafc;
            border-top: 1px solid #e2e8f0;
        }

        .table-scroll-wrapper::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 999px;
            border: 2px solid #f8fafc;
        }

        .table-scroll-wrapper::-webkit-scrollbar-thumb:hover {
            background: #94a3b8;
        }

        .bank-data-table {
            width: max-content;
            min-width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            font-size: 0.875rem;
        }

        .bank-data-table thead th {
            position: sticky;
            top: 0;
            z-index: 20;
            padding: 0.85rem 1rem;
            background: #f8fafc;
            color: #475569;
            font-size: 0.72rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.045em;
            white-space: nowrap;
            text-align: left;
            border-right: 1px solid #e2e8f0;
            border-bottom: 2px solid #cbd5e1;
        }

        .bank-data-table tbody td {
            padding: 0.85rem 1rem;
            background: #ffffff;
            color: #475569;
            white-space: nowrap;
            border-right: 1px solid #eef2f7;
            border-bottom: 1px solid #e2e8f0;
            vertical-align: middle;
            transition: background-color 0.15s ease;
        }

        .bank-data-table tbody tr:nth-child(even) td {
            background: #fcfdff;
        }

        .bank-data-table tbody tr:hover td {
            background: #f1f5f9;
        }

        .number-column {
            width: 60px;
            min-width: 60px;
        }

        .nopol-column {
            font-weight: 700 !important;
            color: #0f172a !important;
        }

        .bank-data-table .action-column {
            position: sticky;
            right: 0;
            z-index: 25;
            width: 105px;
            min-width: 105px;
            text-align: center;
            background: #ffffff !important;
            border-left: 1px solid #e2e8f0;
            box-shadow: -6px 0 14px rgba(15, 23, 42, 0.07);
        }

        .bank-data-table thead .action-column {
            z-index: 30;
            background: #f8fafc !important;
        }

        .bank-data-table tbody tr:hover .action-column {
            background: #f1f5f9 !important;
        }

        .action-wrapper {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
        }

        .action-button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 34px;
            height: 34px;
            border-radius: 9px;
            border: 1px solid;
            background: #ffffff;
            cursor: pointer;
            transition: all 0.15s ease;
        }

        .action-edit {
            color: #2563eb;
            border-color: #bfdbfe;
        }

        .action-edit:hover {
            background: #eff6ff;
            border-color: #93c5fd;
            transform: translateY(-1px);
            box-shadow: 0 3px 8px rgba(37, 99, 235, 0.12);
        }

        .action-delete {
            color: #dc2626;
            border-color: #fecaca;
        }

        .action-delete:hover {
            background: #fef2f2;
            border-color: #fca5a5;
            transform: translateY(-1px);
            box-shadow: 0 3px 8px rgba(220, 38, 38, 0.12);
        }

        .table-scroll-info {
            display: flex;
            align-items: center;
            justify-content: flex-end;
            padding: 8px 18px;
            background: #f8fafc;
            border-bottom: 1px solid #e2e8f0;
            color: #94a3b8;
            font-size: 0.72rem;
        }

        .table-scroll-info i {
            font-size: 0.7rem;
        }

        .badge {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-height: 26px;
            padding: 0.25rem 0.65rem;
            font-size: 0.72rem;
            line-height: 1;
            font-weight: 600;
            border-radius: 9999px;
            white-space: nowrap;
        }

        .badge-gray {
            background: #f1f5f9;
            color: #475569;
            border: 1px solid #e2e8f0;
        }

        .badge-green {
            background: #dcfce7;
            color: #166534;
        }

        .badge-yellow {
            background: #fef9c3;
            color: #854d0e;
        }

        .badge-red {
            background: #fee2e2;
            color: #991b1b;
        }

        .bank-data-table .empty-data {
            padding: 0 !important;
            border-right: none;
            text-align: center;
        }

        .empty-icon {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 58px;
            height: 58px;
            border-radius: 16px;
            background: #f1f5f9;
            color: #94a3b8;
            font-size: 1.4rem;
        }

        .form-label {
            display: block;
            margin-bottom: 0.35rem;
            font-size: 0.875rem;
            font-weight: 600;
            color: #4b5563;
        }

        .form-input,
        .form-select {
            width: 100%;
            min-height: 38px;
            background-color: #ffffff;
            border: 1px solid #d1d5db;
            color: #1f2937;
            padding: 0.5rem 0.75rem;
            border-radius: 0.375rem;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
            transition: all 0.2s ease;
        }

        .form-input:focus,
        .form-select:focus {
            border-color: #3b82f6;
            outline: none;
            box-shadow: 0 0 0 2px rgba(59, 130, 246, 0.15);
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .section-title {
            margin-bottom: 0.75rem;
            display: flex;
            align-items: center;
            font-weight: 700;
            font-size: 0.95rem;
        }

        .form-section {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 1rem;
            padding: 1rem;
            border-width: 1px;
            border-style: solid;
            border-radius: 0.5rem;
        }

        .trailer-section {
            border-left-width: 4px;
            border-left-color: #eab308;
        }

        .head-section {
            border-left-width: 4px;
            border-left-color: #6b7280;
        }

        .legal-section {
            grid-template-columns: repeat(3, minmax(0, 1fr));
            border-left-width: 4px;
            border-left-color: #22c55e;
        }

        .modal {
            z-index: 9999 !important;
        }

        .modal-backdrop {
            position: fixed;
            inset: 0;
            z-index: 0 !important;
        }

        .modal-content {
            position: relative;
            z-index: 10 !important;
            background: #ffffff;
        }

        .modal-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 1rem 1.5rem;
            background: #f9fafb;
            border-bottom: 1px solid #e5e7eb;
        }

        .modal-close-button {
            color: #9ca3af;
            background: transparent;
            border: none;
            padding: 0.4rem;
            border-radius: 0.375rem;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .modal-close-button:hover {
            color: #111827;
            background: #f3f4f6;
        }

        .modal-body {
            padding: 1.5rem;
            max-height: 70vh;
            overflow-y: auto;
        }

        .modal-footer {
            display: flex;
            justify-content: flex-end;
            gap: 0.75rem;
            padding: 1rem 1.5rem;
            background: #f9fafb;
            border-top: 1px solid #e5e7eb;
        }

        .btn-cancel {
            padding: 0.5rem 1.25rem;
            font-size: 0.875rem;
            font-weight: 500;
            color: #374151;
            background: #ffffff;
            border: 1px solid #d1d5db;
            border-radius: 0.375rem;
            transition: all 0.2s ease;
        }

        .btn-cancel:hover {
            background: #f9fafb;
        }

        .btn-submit {
            display: inline-flex;
            align-items: center;
            padding: 0.5rem 1.25rem;
            font-size: 0.875rem;
            font-weight: 500;
            color: #ffffff;
            background: #2563eb;
            border: none;
            border-radius: 0.375rem;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
            transition: all 0.2s ease;
        }

        .btn-submit:hover {
            background: #1d4ed8;
        }

        .select2-container {
            width: 100% !important;
        }

        .select2-container--default .select2-selection--single {
            height: 38px !important;
            min-height: 38px !important;
            background-color: #ffffff !important;
            border: 1px solid #d1d5db !important;
            border-radius: 0.375rem !important;
            display: flex !important;
            align-items: center !important;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05) !important;
        }

        .select2-container--default .select2-selection--single .select2-selection__rendered {
            color: #1f2937 !important;
            font-size: 0.875rem !important;
            line-height: 38px !important;
            padding-left: 0.75rem !important;
            padding-right: 2rem !important;
        }

        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: 38px !important;
            right: 8px !important;
        }

        .select2-dropdown {
            border: 1px solid #d1d5db !important;
            border-radius: 0.375rem !important;
            overflow: hidden;
            z-index: 10000 !important;
        }

        .select2-container--default .select2-results__option--highlighted[aria-selected] {
            background-color: #2563eb !important;
            color: #ffffff !important;
        }

        .form-input:-webkit-autofill,
        .form-input:-webkit-autofill:hover,
        .form-input:-webkit-autofill:focus,
        .form-input:-webkit-autofill:active {
            -webkit-box-shadow: 0 0 0 30px white inset !important;
            -webkit-text-fill-color: #1f2937 !important;
        }

        @media (max-width: 1024px) {
            .form-section {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }

            .legal-section {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }
        }

        @media (max-width: 768px) {

            .form-section,
            .legal-section {
                grid-template-columns: 1fr;
            }

            .md\:col-span-3 {
                grid-column: span 1;
            }

            .modal-body {
                max-height: 75vh;
            }

            .table-scroll-info {
                justify-content: center;
                padding: 7px 12px;
                font-size: 0.68rem;
            }

            .bank-data-table thead th {
                padding: 0.75rem 0.85rem;
                font-size: 0.68rem;
            }

            .bank-data-table tbody td {
                padding: 0.75rem 0.85rem;
                font-size: 0.8rem;
            }
        }
    </style>
@endpush

@push('scripts')
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('[data-modal-target]').forEach(function(button) {
                button.addEventListener('click', function() {
                    const targetId = this.getAttribute('data-modal-target');
                    const modal = document.getElementById(targetId);
                    if (!modal) {
                        console.error('Modal tidak ditemukan:', targetId);
                        return;
                    }
                    document.querySelectorAll('.modal').forEach(function(item) {
                        item.classList.add('hidden');
                    });
                    modal.classList.remove('hidden');
                    document.body.classList.add('overflow-hidden');
                    $(modal).find('.select2-field').trigger('change.select2');
                });
            });

            document.querySelectorAll('.modal-close').forEach(function(button) {
                button.addEventListener('click', function() {
                    const modal = this.closest('.modal');
                    if (!modal) return;
                    modal.classList.add('hidden');
                    document.body.classList.remove('overflow-hidden');
                });
            });

            document.querySelectorAll('.modal-backdrop').forEach(function(backdrop) {
                backdrop.addEventListener('click', function() {
                    const modal = this.closest('.modal');
                    if (!modal) return;
                    modal.classList.add('hidden');
                    document.body.classList.remove('overflow-hidden');
                });
            });

            document.addEventListener('keydown', function(event) {
                if (event.key !== 'Escape') return;
                document.querySelectorAll('.modal:not(.hidden)').forEach(function(modal) {
                    modal.classList.add('hidden');
                });
                document.body.classList.remove('overflow-hidden');
            });

            if (typeof jQuery === 'undefined') {
                console.error('jQuery gagal dimuat. Select2 tidak dapat digunakan.');
                return;
            }

            $('.select2-field').each(function() {
                const $select = $(this);
                if ($select.hasClass('select2-hidden-accessible')) return;
                const $modal = $select.closest('.modal');
                $select.select2({
                    width: '100%',
                    dropdownParent: $modal.length ? $modal : $(document.body),
                    placeholder: '-- Pilih --',
                    allowClear: true
                });
            });
        });
    </script>
@endpush
