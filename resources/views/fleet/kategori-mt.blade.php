@extends('layouts.app')

@section('title', 'Kategori MT')
@section('subtitle', 'Rekapitulasi jumlah unit berdasarkan kategori & kapasitas')

@push('styles')

<style>
    /* =====================================================
       KATEGORI MT — MINIMAL & COMPACT
    ====================================================== */

    .kategori-mt {
        color: #334155;
    }

    /* =========================
       SECTION TITLE
    ========================== */
    .section-title {
        display: flex;
        align-items: center;
        gap: 7px;
        margin: 2px 0 10px;
        color: #334155;
        font-size: 13px;
        font-weight: 600;
    }

    .section-title i {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 24px;
        height: 24px;
        border-radius: 6px;
        background: #f1f5f9;
        color: #64748b;
        font-size: 11px;
    }

    /* =========================
       GRID
    ========================== */
    .kategori-mt .row {
        --bs-gutter-x: 12px;
        --bs-gutter-y: 12px;
    }

    /* =========================
       CARD
    ========================== */
    .rekap-card {
        position: relative;
        height: 100%;
        overflow: hidden;
        background: #fff;
        border: 1px solid #e5e7eb;
        border-radius: 8px;
        box-shadow: 0 1px 4px rgba(15, 23, 42, .035);
        transition: box-shadow .15s ease, transform .15s ease;
    }

    .rekap-card:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 10px rgba(15, 23, 42, .06);
    }

    /* =========================
       CARD HEADER
    ========================== */
    .rekap-card-header {
        display: flex;
        align-items: center;
        justify-content: center;
        min-height: 36px;
        padding: 8px 10px;
        background: #f8fafc;
        border-bottom: 1px solid #edf0f3;
    }

    .rekap-card-header h6 {
        margin: 0;
        color: #475569;
        font-size: 11.5px;
        font-weight: 600;
        letter-spacing: .3px;
    }

    /* Garis kecil sebagai aksen */
    .rekap-card-header::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 2px;
        background: #94a3b8;
    }

    .rekap-card-header.kapasitas::before {
        background: #7892aa;
    }

    /* =========================
       CARD BODY
    ========================== */
    .rekap-card-body {
        padding: 8px;
    }

    /* =========================
       TABLE WRAPPER
    ========================== */
    .table-wrapper {
        width: 100%;
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
    }

    /* =========================
       TABLE
    ========================== */
    .rekap-table {
        width: 100%;
        min-width: 300px;
        margin: 0;
        border-collapse: separate;
        border-spacing: 0;
        color: #64748b;
        font-size: 11.5px;
        line-height: 1.25;
    }

    .rekap-table th {
        padding: 6px 6px;
        color: #64748b;
        font-size: 10.5px;
        font-weight: 600;
        background: #f8fafc;
        border-top: 1px solid #e5e7eb;
        border-bottom: 1px solid #e5e7eb;
        white-space: nowrap;
        vertical-align: middle;
    }

    .rekap-table th:first-child {
        border-left: 1px solid #e5e7eb;
        border-top-left-radius: 5px;
    }

    .rekap-table th:last-child {
        border-right: 1px solid #e5e7eb;
        border-top-right-radius: 5px;
    }

    .rekap-table td {
        padding: 6px 6px;
        background: #fff;
        border-bottom: 1px solid #f0f2f5;
        vertical-align: middle;
        white-space: nowrap;
    }

    .rekap-table td:first-child {
        border-left: 1px solid #f0f2f5;
    }

    .rekap-table td:last-child {
        border-right: 1px solid #f0f2f5;
    }

    .rekap-table tbody tr:hover td {
        background: #fafafa;
    }

    /* =========================
       TOTAL
    ========================== */
    .total-row td {
        background: #f8fafc !important;
        color: #475569;
        font-weight: 600;
        border-bottom: 1px solid #e5e7eb !important;
    }

    .total-row td:first-child {
        border-bottom-left-radius: 5px;
    }

    .total-row td:last-child {
        border-bottom-right-radius: 5px;
    }

    .total-value {
        color: #4f7190 !important;
        font-weight: 700 !important;
    }

    /* =========================
       VALUE
    ========================== */
    .number-value {
        color: #475569;
        font-weight: 600;
    }

    .kap-value {
        color: #475569;
        font-weight: 600;
    }

    /* =========================
       EMPTY
    ========================== */
    .empty-data {
        padding: 10px 6px !important;
        color: #94a3b8;
        font-size: 11px;
        text-align: center;
        background: #fff !important;
    }

    /* =========================
       SPACING
    ========================== */
    .section-space {
        margin-bottom: 20px;
    }

    /* =========================
       BOOTSTRAP COLUMN
    ========================== */
    .kategori-mt .col-md-4 {
        margin-bottom: 0 !important;
    }

    /* =========================
       MOBILE
    ========================== */
    @media (max-width: 767.98px) {

        .section-title {
            margin: 3px 0 9px;
            font-size: 12.5px;
        }

        .section-title i {
            width: 22px;
            height: 22px;
            font-size: 10px;
        }

        .rekap-card-header {
            min-height: 34px;
            padding: 7px 9px;
        }

        .rekap-card-header h6 {
            font-size: 11px;
        }

        .rekap-card-body {
            padding: 7px;
        }

        .rekap-table {
            min-width: 310px;
            font-size: 11px;
        }

        .rekap-table th {
            padding: 5px;
            font-size: 10px;
        }

        .rekap-table td {
            padding: 5px;
        }

        .section-space {
            margin-bottom: 17px;
        }
    }
</style>

@endpush

@section('content')

<div class="kategori-mt">

```
{{-- =====================================================
     BAGIAN 1 : REKAPITULASI KATEGORI
====================================================== --}}

<div class="section-title">
    <i class="fas fa-layer-group"></i>
    <span>Rekapitulasi Kategori</span>
</div>

<div class="row section-space">

    @foreach($kelompokUrutan as $kelompok)

        @php
            $daftarKategori = $kategoriPivot[$kelompok] ?? [];

            if (is_array($daftarKategori)) {
                ksort($daftarKategori);
            }

            $totalKat = is_array($daftarKategori)
                ? array_sum($daftarKategori)
                : 0;
        @endphp

        <div class="col-md-4 mb-3">

            <div class="rekap-card">

                {{-- HEADER --}}
                <div class="rekap-card-header">
                    <h6>{{ mb_strtoupper($kelompok) }}</h6>
                </div>

                {{-- BODY --}}
                <div class="rekap-card-body">

                    <div class="table-wrapper">

                        <table class="rekap-table text-center">

                            <thead>
                                <tr>
                                    <th width="15%">No</th>
                                    <th>Kategori</th>
                                    <th width="25%">Jumlah</th>
                                </tr>
                            </thead>

                            <tbody>

                                @forelse($daftarKategori as $kat => $jml)

                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $kat }}</td>
                                        <td class="number-value">
                                            {{ $jml }}
                                        </td>
                                    </tr>

                                @empty

                                    <tr>
                                        <td colspan="3" class="empty-data">
                                            Belum ada data
                                        </td>
                                    </tr>

                                @endforelse

                                @if(count($daftarKategori) > 0)

                                    <tr class="total-row">
                                        <td colspan="2" class="text-end pe-3">
                                            TOTAL
                                        </td>

                                        <td class="total-value">
                                            {{ $totalKat }}
                                        </td>
                                    </tr>

                                @endif

                            </tbody>

                        </table>

                    </div>

                </div>

            </div>

        </div>

    @endforeach

</div>


{{-- =====================================================
     BAGIAN 2 : REKAPITULASI KAPASITAS
====================================================== --}}

<div class="section-title">
    <i class="fas fa-weight-hanging"></i>
    <span>Rekapitulasi Kapasitas</span>
</div>

<div class="row">

    @foreach($kelompokUrutan as $kelompok)

        @php

            $daftarKap = array_keys(
                $kapPerKelompok[$kelompok] ?? []
            );

            usort($daftarKap, function ($a, $b) {

                $aNum = (float) preg_replace(
                    '/[^0-9.]/',
                    '',
                    (string) $a
                );

                $bNum = (float) preg_replace(
                    '/[^0-9.]/',
                    '',
                    (string) $b
                );

                return $aNum <=> $bNum;
            });

            $totalReg = 0;
            $totalAfk = 0;

        @endphp

        <div class="col-md-4 mb-4">

            <div class="rekap-card">

                {{-- HEADER --}}
                <div class="rekap-card-header kapasitas">
                    <h6>{{ mb_strtoupper($kelompok) }}</h6>
                </div>

                {{-- BODY --}}
                <div class="rekap-card-body">

                    <div class="table-wrapper">

                        <table class="rekap-table text-center">

                            <thead>
                                <tr>
                                    <th width="10%">No</th>
                                    <th>Kap</th>
                                    <th>Jml Reg</th>
                                    <th>Jml Afkir</th>
                                    <th>Total</th>
                                </tr>
                            </thead>

                            <tbody>

                                @forelse($daftarKap as $kap)

                                    @php

                                        $jmlReg =
                                            $kapReg[$kelompok][$kap] ?? 0;

                                        $jmlAfk =
                                            $kapAfkir[$kelompok][$kap] ?? 0;

                                        $totalReg += $jmlReg;
                                        $totalAfk += $jmlAfk;

                                        $totalUnit =
                                            $jmlReg + $jmlAfk;

                                    @endphp

                                    <tr>

                                        <td>
                                            {{ $loop->iteration }}
                                        </td>

                                        <td class="kap-value">
                                            {{ $kap }}
                                        </td>

                                        <td>
                                            {{ $jmlReg > 0 ? $jmlReg : '-' }}
                                        </td>

                                        <td>
                                            {{ $jmlAfk > 0 ? $jmlAfk : '-' }}
                                        </td>

                                        <td class="fw-semibold text-dark">
                                            {{ $totalUnit }}
                                        </td>

                                    </tr>

                                @empty

                                    <tr>
                                        <td colspan="5" class="empty-data">
                                            Belum ada data
                                        </td>
                                    </tr>

                                @endforelse

                                @if(count($daftarKap) > 0)

                                    <tr class="total-row">

                                        <td colspan="2"
                                            class="text-end pe-3">
                                            TOTAL
                                        </td>

                                        <td>
                                            {{ $totalReg }}
                                        </td>

                                        <td>
                                            {{ $totalAfk }}
                                        </td>

                                        <td class="total-value">
                                            {{ $totalReg + $totalAfk }}
                                        </td>

                                    </tr>

                                @endif

                            </tbody>

                        </table>

                    </div>

                </div>

            </div>

        </div>

    @endforeach

</div>

</div>

@endsection
