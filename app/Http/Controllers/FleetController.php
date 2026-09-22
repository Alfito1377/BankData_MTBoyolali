<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\BankData;
use App\Models\MtAfkirDanDispen;
use App\Models\ListTransportir;
use App\Models\FieldOption;
use App\Models\MerekKendaraan;
use App\Models\TypeKendaran;

class FleetController extends Controller
{
public function indexBankData(Request $request)
{
    // =========================================================
    // DATA BANK DATA
    // =========================================================

    $bankData = BankData::query()

        // Filter berdasarkan transportir
        ->when($request->transportir, function ($query, $transportir) {
            $query->where('transportir', $transportir);
        })

        // Search
        ->when($request->search, function ($query, $search) {

            $query->where(function ($q) use ($search) {

                $q->where('nopol', 'like', "%{$search}%")
                    ->orWhere('transportir', 'like', "%{$search}%")
                    ->orWhere('merek', 'like', "%{$search}%")
                    ->orWhere('type', 'like', "%{$search}%")
                    ->orWhere('kategori', 'like', "%{$search}%")
                    ->orWhere('status', 'like', "%{$search}%")
                    ->orWhere('kelompok', 'like', "%{$search}%");
            });
        })

        ->orderBy('id', 'asc')
        ->paginate(20)
        ->withQueryString();


    // =========================================================
    // LIST TRANSPORTIR
    // =========================================================

    $listTransportir = ListTransportir::orderBy('nama', 'asc')
        ->get();


    // =========================================================
    // FIELD OPTIONS
    // =========================================================

    $options = FieldOption::orderBy('value', 'asc')
        ->get()
        ->groupBy('field_name');


    // =========================================================
    // MEREK KENDARAAN
    // =========================================================

    $merekList = MerekKendaraan::orderBy('nama', 'asc')
        ->get();


    // =========================================================
    // TYPE KENDARAAN
    // =========================================================

    $typeKendaran = TypeKendaran::orderBy('nama_kendaraan', 'asc')
        ->get();


    // =========================================================
    // JUMLAH ARMADA PER TRANSPORTIR
    // =========================================================

    $jumlahArmada = BankData::select(
            'transportir',
            DB::raw('COUNT(*) as total')
        )
        ->whereNotNull('transportir')
        ->where('transportir', '!=', '')
        ->groupBy('transportir')
        ->pluck('total', 'transportir');


    // =========================================================
    // RETURN VIEW
    // =========================================================

    return view('fleet.bank-data', compact(
        'bankData',
        'listTransportir',
        'options',
        'merekList',
        'jumlahArmada',
        'typeKendaran'
    ));
}



    public function storeBankData(Request $request)
    {
        $validatedData = $request->validate([
            'nopol'                   => 'required|unique:bank_data,nopol',
            'kelompok'                => 'nullable|string|max:255',
            'kapasitas'               => 'required|numeric',
            'kategori'                => 'required|string|max:255',
            'status'                  => 'required|string|max:255',
            'transportir'             => 'required|string|max:255',
            'tahun_pembuatan_trailer' => 'required|date',
            'pabrikan_trailer'        => 'required|string|max:255',
            'material_tangki'         => 'required|string|max:255',
            'jumlah_kompartemen'      => 'required|integer|min:1',
            'merek'                   => 'required|string|max:255',
            'type'                    => 'required|string|max:255',
            'nomor_mesin'             => 'required|string|max:255',
            'nomor_rangka'            => 'required|string|max:255',
            'tahun_stnk_head'         => 'required|date',
            'status_asuransi'         => 'required|string|max:255',
            'aktif_tidak_aktif'       => 'required|string|max:255',
            'keterangan_euro'         => 'required|string|max:255',
            'tanggal_operasi_awal'    => 'nullable|date',
            'kompensator_fifth_wheel' => 'nullable|string|max:255',
            'keterangan_dispen'       => 'nullable|string|max:255',
            'keterangan'              => 'nullable|string',
        ], [
            'nopol.required'                   => 'Nomor polisi wajib diisi.',
            'nopol.unique'                     => "Gagal menambahkan data: Nopol '{$request->nopol}' sudah terdaftar.",
            'kapasitas.required'               => 'Kapasitas wajib diisi.',
            'transportir.required'             => 'Transportir wajib dipilih.',
            'tahun_pembuatan_trailer.required' => 'Tahun pembuatan trailer wajib diisi.',
            'tahun_stnk_head.required'         => 'Tahun STNK head wajib diisi.',
        ]);

        BankData::create($validatedData);

        return redirect()->route('bank-data.index')->with('success', 'Data berhasil ditambahkan');
    }

    public function updateBankData(Request $request, $id)
    {
        $data = BankData::findOrFail($id);

        $validatedData = $request->validate([
            'nopol'                   => 'required|unique:bank_data,nopol,' . $id,
            'kelompok'                => 'nullable|string|max:255',
            'kapasitas'               => 'required|numeric',
            'kategori'                => 'required|string|max:255',
            'status'                  => 'required|string|max:255',
            'transportir'             => 'required|string|max:255',
            'tahun_pembuatan_trailer' => 'required|date',
            'pabrikan_trailer'        => 'required|string|max:255',
            'material_tangki'         => 'required|string|max:255',
            'jumlah_kompartemen'      => 'required|integer|min:1',
            'merek'                   => 'required|string|max:255',
            'type'                    => 'required|string|max:255',
            'nomor_mesin'             => 'required|string|max:255',
            'nomor_rangka'            => 'required|string|max:255',
            'tahun_stnk_head'         => 'required|date',
            'status_asuransi'         => 'required|string|max:255',
            'aktif_tidak_aktif'       => 'required|string|max:255',
            'keterangan_euro'         => 'required|string|max:255',
            'tanggal_operasi_awal'    => 'nullable|date',
            'kompensator_fifth_wheel' => 'nullable|string|max:255',
            'keterangan_dispen'       => 'nullable|string|max:255',
            'keterangan'              => 'nullable|string',
        ], [
            'nopol.required'                   => 'Nomor polisi wajib diisi.',
            'nopol.unique'                     => "Gagal memperbarui data: Nopol '{$request->nopol}' sudah digunakan.",
            'kapasitas.required'               => 'Kapasitas wajib diisi.',
            'transportir.required'             => 'Transportir wajib dipilih.',
            'tahun_pembuatan_trailer.required' => 'Tahun pembuatan trailer wajib diisi.',
            'tahun_stnk_head.required'         => 'Tahun STNK head wajib diisi.',
        ]);

        $data->update($validatedData);

        return redirect()->route('bank-data.index')->with('success', 'Data armada berhasil diperbarui!');
    }

    public function destroyBankData($id)
    {
        BankData::findOrFail($id)->delete();
        return redirect()->route('bank-data.index')->with('success', 'Data armada berhasil dihapus!');
    }

    public function storeAfkir(Request $request)
    {
        $validatedData = $request->validate([
            'nopol'               => 'required|unique:mt_afkir_dan_dispen,nopol',
            'kapasitas'           => 'required|integer',
            'kepemilikan'         => 'required|string|max:255',
            'status'              => 'required|string|max:255',
            'tahun_pembuatan'     => 'required|date',
            'merek'               => 'required|string|max:255',
            'tmt_afkir'           => 'required|date',
            'status_peremajaan'   => 'required|string|max:255',
            'operasi'             => 'required|string|max:255',
            'lama_afkir'          => 'required|string|max:255',
            'keterangan'          => 'nullable|string',
            'timeline_peremajaan' => 'required|string|max:255',
            'kelompok'            => 'nullable|string|max:255',
        ], [
            'nopol.required'               => 'Nomor polisi wajib diisi.',
            'nopol.unique'                 => "Gagal menambahkan data: Nopol '{$request->nopol}' sudah terdaftar.",
            'kapasitas.required'           => 'Kapasitas wajib diisi.',
            'kepemilikan.required'         => 'Kepemilikan wajib diisi.',
            'tahun_pembuatan.required'     => 'Tahun pembuatan wajib diisi.',
            'tmt_afkir.required'           => 'TMT Afkir wajib diisi.',
            'status_peremajaan.required'   => 'Status peremajaan wajib diisi.',
            'operasi.required'             => 'Status operasi wajib diisi.',
            'lama_afkir.required'          => 'Lama afkir wajib diisi.',
            'timeline_peremajaan.required' => 'Timeline peremajaan wajib diisi.',
        ]);

        MtAfkirDanDispen::create($validatedData);

        return redirect()->route('afkir.index')->with('success', 'Data Afkir berhasil ditambahkan');
    }

    public function indexKategori()
    {
        $kelompokUrutan = [
            'MT REGULER (BOYOLALI)',
            'MT REGULER (CEPU)',
            'MT PTO'
        ];

        $kategoriRaw = DB::table('bank_data')
            ->select('kelompok', 'kategori', DB::raw('COUNT(*) as jumlah'))
            ->whereNotNull('kelompok')
            ->whereNotNull('kategori')
            ->groupBy('kelompok', 'kategori')
            ->get();

        $kategoriPivot = [];
        foreach ($kategoriRaw as $row) {
            $kelompokUpper = mb_strtoupper($row->kelompok);
            $kategoriPivot[$kelompokUpper][$row->kategori] = (int) $row->jumlah;
        }

        $kapRegRaw = DB::table('bank_data')
            ->select('kelompok', 'kapasitas', DB::raw('COUNT(*) as jumlah'))
            ->whereNotNull('kelompok')
            ->whereNotNull('kapasitas')
            ->groupBy('kelompok', 'kapasitas')
            ->get();

        $kapReg = [];
        $kapPerKelompok = [];

        foreach ($kapRegRaw as $row) {
            $kelompokUpper = mb_strtoupper($row->kelompok);
            $kapReg[$kelompokUpper][$row->kapasitas] = (int) $row->jumlah;
            $kapPerKelompok[$kelompokUpper][$row->kapasitas] = true;
        }

        $kapAfkir = [];

        return view('fleet.kategori-mt', compact(
            'kelompokUrutan',
            'kategoriPivot',
            'kapReg',
            'kapAfkir',
            'kapPerKelompok'
        ));
    }

    public function indexAfkir(Request $request)
    {
        $search = $request->input('search');
        $kepemilikan = $request->input('kepemilikan');

        $afkirData = MtAfkirDanDispen::query()

            ->when($kepemilikan, function ($query) use ($kepemilikan) {
                $query->where('kepemilikan', $kepemilikan);
            })
            ->when($search, function ($query) use ($search) {

                $query->where(function ($q) use ($search) {

                    $q->where('nopol', 'like', "%{$search}%")
                        ->orWhere('kapasitas', 'like', "%{$search}%")
                        ->orWhere('kepemilikan', 'like', "%{$search}%")
                        ->orWhere('status', 'like', "%{$search}%")
                        ->orWhere('merek', 'like', "%{$search}%")
                        ->orWhere('status_peremajaan', 'like', "%{$search}%")
                        ->orWhere('operasi', 'like', "%{$search}%")
                        ->orWhere('keterangan', 'like', "%{$search}%");
                });
            })
            ->orderBy('id', 'asc')
            ->paginate(20)

            ->withQueryString();

        $listTransportir = ListTransportir::orderBy('nama', 'asc')
            ->get();

        $options = FieldOption::orderBy('value', 'asc')
            ->get()
            ->groupBy('field_name');

        $merekList = MerekKendaraan::orderBy('nama', 'asc')
            ->get();

        $typeKendaran = TypeKendaran::orderBy('nama_kendaraan', 'asc')
            ->get();

        $jumlahPerTransportir = MtAfkirDanDispen::select(
            'kepemilikan',
            DB::raw('count(*) as total')
        )
            ->groupBy('kepemilikan')
            ->pluck('total', 'kepemilikan');
        $jumlahArmada = BankData::select(
            'transportir',
            DB::raw('count(*) as total')
        )
            ->groupBy('transportir')
            ->pluck('total', 'transportir');

        return view('fleet.mt-afkir', compact(
            'afkirData',
            'listTransportir',
            'options',
            'merekList',
            'jumlahPerTransportir',
            'jumlahArmada',
            'typeKendaran'
        ));
    }


    public function updateAfkir(Request $request, $id)
    {
        $data = MtAfkirDanDispen::findOrFail($id);

        $validatedData = $request->validate([
            'nopol'               => 'required|unique:mt_afkir_dan_dispen,nopol,' . $id,
            'kapasitas'           => 'required|integer',
            'kepemilikan'         => 'required|string|max:255',
            'status'              => 'required|string|max:255',
            'tahun_pembuatan'     => 'required|date',
            'merek'               => 'required|string|max:255',
            'tmt_afkir'           => 'required|date',
            'status_peremajaan'   => 'required|string|max:255',
            'operasi'             => 'required|string|max:255',
            'lama_afkir'          => 'required|string|max:255',
            'keterangan'          => 'nullable|string',
            'timeline_peremajaan' => 'required|string|max:255',
            'kelompok'            => 'nullable|string|max:255',
        ]);

        $data->update($validatedData);

        return redirect()->route('afkir.index')->with('success', 'Data Afkir berhasil diperbarui!');
    }

    public function destroyAfkir($id)
    {
        MtAfkirDanDispen::findOrFail($id)->delete();
        return redirect()->route('afkir.index')->with('success', 'Data Afkir berhasil dihapus!');
    }

    public function indexTransportir()
    {
        $transportir = ListTransportir::orderBy('nama', 'asc')->get();

        $jumlahArmada = \App\Models\BankData::select('transportir', \Illuminate\Support\Facades\DB::raw('count(*) as total'))
            ->groupBy('transportir')
            ->pluck('total', 'transportir');

        return view('fleet.transportir', compact('transportir', 'jumlahArmada'));
    }

    public function storeTransportir(Request $request)
    {
        $request->validate(['nama' => 'required|unique:list_transportir,nama']);

        ListTransportir::create(['nama' => mb_strtoupper($request->nama)]);

        return redirect()->route('transportir.index')->with('success', 'Transportir baru berhasil ditambahkan!');
    }

    public function destroyTransportir($id)
    {
        ListTransportir::findOrFail($id)->delete();
        return redirect()->route('transportir.index')->with('success', 'Data transportir berhasil dihapus!');
    }
}
