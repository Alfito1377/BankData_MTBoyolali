<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Pemberitahuan Armada Afkir</title>
</head>
<body style="background-color: #f8fafc; font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; padding: 20px; margin: 0; color: #334155;">
    
    <div style="max-width: 800px; margin: 0 auto; background-color: #ffffff; border-radius: 12px; overflow: hidden; border: 1px solid #e2e8f0; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);">
        
        <!-- HEADER -->
        <div style="background-color: #1e3a8a; padding: 25px 20px; text-align: center;">
            <h2 style="margin: 0; color: #ffffff; font-size: 20px; font-weight: 600; letter-spacing: 0.5px;">
                Pemberitahuan Sistem Monitoring
            </h2>
            <p style="margin: 5px 0 0 0; color: #93c5fd; font-size: 14px;">
                Pertamina Patra Logistik
            </p>
        </div>

        <!-- BODY -->
        <div style="padding: 30px 25px;">
            <p style="margin-top: 0; font-size: 15px; line-height: 1.6;">Halo Admin,</p>
            <p style="font-size: 15px; line-height: 1.6; margin-bottom: 25px;">
                Sistem mendeteksi adanya armada aktif yang berstatus <strong>Mendekati Afkir</strong> atau sudah melewati batas <strong>Afkir</strong>. Berikut adalah rincian detail kendaraan tersebut:
            </p>

            <!-- TABEL DATA -->
            <div style="overflow-x: auto;">
                <table style="width: 100%; border-collapse: collapse; font-size: 13px; text-align: left;">
                    <thead>
                        <tr>
                            <th style="padding: 12px 15px; background-color: #f1f5f9; border: 1px solid #cbd5e1; color: #475569; font-weight: bold; white-space: nowrap;">No. Polisi</th>
                            <th style="padding: 12px 15px; background-color: #f1f5f9; border: 1px solid #cbd5e1; color: #475569; font-weight: bold;">Transportir</th>
                            <th style="padding: 12px 15px; background-color: #f1f5f9; border: 1px solid #cbd5e1; color: #475569; font-weight: bold;">Trailer (Batas 15 Thn)</th>
                            <th style="padding: 12px 15px; background-color: #f1f5f9; border: 1px solid #cbd5e1; color: #475569; font-weight: bold;">Head Truck (Batas 10 Thn)</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($armadaMendekatiAfkir as $armada)
                        <tr>
                            <td style="padding: 12px 15px; border: 1px solid #e2e8f0; font-weight: bold; color: #0f172a; white-space: nowrap;">
                                {{ $armada->nopol }}
                            </td>
                            
                            <td style="padding: 12px 15px; border: 1px solid #e2e8f0; color: #334155;">
                                {{ $armada->transportir }}
                            </td>
                            
                            <!-- KOLOM TRAILER -->
                            <td style="padding: 12px 15px; border: 1px solid #e2e8f0;">
                                @php
                                    $statusTrailer = $armada->peringatan_afkir_trailer;
                                    $warnaTrailer = $statusTrailer['class'] == 'danger' ? '#dc2626' : ($statusTrailer['class'] == 'warning' ? '#d97706' : '#16a34a');
                                    $bgTrailer = $statusTrailer['class'] == 'danger' ? '#fef2f2' : ($statusTrailer['class'] == 'warning' ? '#fffbeb' : 'transparent');
                                @endphp
                                
                                <div style="display: inline-block; padding: 4px 8px; border-radius: 4px; background-color: {{ $bgTrailer }};">
                                    <strong style="color: {{ $warnaTrailer }}; display: block;">{{ $statusTrailer['label'] }}</strong>
                                    @if($armada->tahun_pembuatan_trailer)
                                        <span style="font-size: 11px; color: #64748b;">
                                            Tahun: {{ \Carbon\Carbon::parse($armada->tahun_pembuatan_trailer)->format('Y') }}
                                        </span>
                                    @else
                                        <span style="font-size: 11px; color: #94a3b8;">Tahun: -</span>
                                    @endif
                                </div>
                            </td>

                            <!-- KOLOM HEAD TRUCK -->
                            <td style="padding: 12px 15px; border: 1px solid #e2e8f0;">
                                @php
                                    $statusHead = $armada->peringatan_afkir_head;
                                    $warnaHead = $statusHead['class'] == 'danger' ? '#dc2626' : ($statusHead['class'] == 'warning' ? '#d97706' : '#16a34a');
                                    $bgHead = $statusHead['class'] == 'danger' ? '#fef2f2' : ($statusHead['class'] == 'warning' ? '#fffbeb' : 'transparent');
                                @endphp
                                
                                <div style="display: inline-block; padding: 4px 8px; border-radius: 4px; background-color: {{ $bgHead }};">
                                    <strong style="color: {{ $warnaHead }}; display: block;">{{ $statusHead['label'] }}</strong>
                                    @if($armada->tahun_stnk_head)
                                        <span style="font-size: 11px; color: #64748b;">
                                            Tahun: {{ \Carbon\Carbon::parse($armada->tahun_stnk_head)->format('Y') }}
                                        </span>
                                    @else
                                        <span style="font-size: 11px; color: #94a3b8;">Tahun: -</span>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- TOMBOL CALL TO ACTION -->
            <div style="margin-top: 35px; text-align: center;">
                <a href="{{ route('bank-data.index') }}" style="display: inline-block; background-color: #2563eb; color: #ffffff; padding: 12px 28px; text-decoration: none; border-radius: 8px; font-weight: 600; font-size: 14px; box-shadow: 0 2px 4px rgba(37, 99, 235, 0.2);">
                    Lihat Detail di Bank Data
                </a>
            </div>
            
        </div>

        <!-- FOOTER -->
        <div style="background-color: #f8fafc; padding: 20px; border-top: 1px solid #e2e8f0; text-align: center;">
            <p style="margin: 0; font-size: 12px; color: #64748b;">
                Pesan ini dibuat secara otomatis oleh sistem.<br>
                Mohon tidak membalas email ini.
            </p>
        </div>

    </div>
</body>
</html>