<?php

namespace App\Http\Controllers;

use App\Models\DataMitra;
use App\Models\DataAset;
use App\Models\PerjanjianSewa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class PendaftaranController extends Controller
{
    public function create()
    {
        return view('pendaftaran.form_data_diri');
    }

    public function store(Request $request)
    {
        // Validasi data
        $validator = Validator::make($request->all(), [
            // Data Diri - Step 1
            'jenis_penyewa' => 'required|in:Perorangan,Perusahaan',
            'nama_lengkap' => 'required|string|max:255',
            'nik' => 'required|string|max:20',
            'masa_berlaku_ktp' => 'required|date',
            'email' => 'required|email',
            'no_telepon' => 'required|string|max:15',
            'tanggal_perjanjian' => 'required|date',
            'penyewa_berdasarkan' => 'required|string|max:255',
            'alamat' => 'required|string',
            'foto_identitas' => 'required|file|mimes:jpg,jpeg,pdf|max:2048',

            // Data Perusahaan (kondisional)
            'nama_perwakilan' => 'required_if:jenis_penyewa,Perusahaan|nullable|string|max:255',
            'perwakilan_selaku' => 'required_if:jenis_penyewa,Perusahaan|nullable|string|max:255',
            'npwp' => 'required_if:jenis_penyewa,Perusahaan|nullable|string|max:20',
            'kota_penyewa' => 'required_if:jenis_penyewa,Perusahaan|nullable|string|max:100',
            'kode_pos' => 'required_if:jenis_penyewa,Perusahaan|nullable|string|max:10',
            'fax_penyewa' => 'nullable|string|max:20',
            'no_akte_pendirian' => 'required_if:jenis_penyewa,Perusahaan|nullable|string|max:50',
            'no_anggaran_dasar' => 'required_if:jenis_penyewa,Perusahaan|nullable|string|max:50',
            'tanggal_anggaran_dasar' => 'required_if:jenis_penyewa,Perusahaan|nullable|date',
            'no_kemenkumham' => 'required_if:jenis_penyewa,Perusahaan|nullable|string|max:50',
            'tanggal_kemenkumham' => 'required_if:jenis_penyewa,Perusahaan|nullable|date',
            'no_penetapan_pengadilan' => 'nullable|string|max:50',
            'tanggal_penetapan_pengadilan' => 'nullable|date',
            'no_izin_berusaha' => 'required_if:jenis_penyewa,Perusahaan|nullable|string|max:50',
            'tanggal_izin_berusaha' => 'required_if:jenis_penyewa,Perusahaan|nullable|date',
            'surat_keterangan_pajak' => 'required_if:jenis_penyewa,Perusahaan|nullable|string|max:50',
            'tanggal_surat_keterangan_pajak' => 'required_if:jenis_penyewa,Perusahaan|nullable|date',
            'surat_pengukuhan_pkp' => 'required_if:jenis_penyewa,Perusahaan|nullable|string|max:50',
            'tanggal_surat_pengukuhan_pkp' => 'required_if:jenis_penyewa,Perusahaan|nullable|date',

            // Data Aset - Step 2
            'alamat_asset' => 'required|string',
            'penggunaan_asset' => 'required|string',
            'luas_tanah' => 'required|numeric|min:0',
            'luas_bangunan' => 'required|numeric|min:0',
            'tahun' => 'nullable|integer|min:0',
            'bulan' => 'nullable|integer|min:0|max:11',
            'hari' => 'nullable|integer|min:0|max:30',
            'masa_awal_perjanjian' => 'required|date',
            'masa_akhir_perjanjian' => 'required|date',
            'masa_awal_pemanfaatan' => 'required|date',
            'masa_akhir_pemanfaatan' => 'required|date',

            // Harga Aset - Step 3
            'harga_sewa' => 'required|numeric|min:0',
            'harga_pemanfaatan' => 'required|numeric|min:0',
            'biaya_admin' => 'required|numeric|min:0',
            'cost_of_money' => 'required|numeric|min:0',
            'harga_sewa_admin' => 'required|numeric|min:0',
            'harga_sewa_admin_com' => 'required|numeric|min:0',
            'ppn' => 'required|numeric|min:0',
            'total_harga' => 'required|numeric|min:0',
            'terbilang' => 'required|string'
        ]);

        
        DB::beginTransaction();

        try {
            // Step 1: Simpan Data Mitra
            $dataMitra = $this->simpanDataMitra($request);
            // Step 2: Simpan Data Aset
            $dataAset = $this->simpanDataAset($request, $dataMitra->id_mitra);
            // Step 3: Simpan Perjanjian Sewa
            $perjanjianSewa = $this->simpanPerjanjianSewa($request, $dataMitra->id_mitra, $dataAset->id_aset);

            DB::commit();
 
            return redirect('pendaftaran/list_data')->with('success', 'Produk berhasil ditambahkan');

        } 
        
        catch (\Exception $e) {
            DB::rollBack();
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Terjadi kesalahan sistem: ' . $e->getMessage()
                ], 500);
            }
            
            return redirect()->back()->with('error', 'Terjadi kesalahan sistem: ' . $e->getMessage())->withInput();
        }
    }

    
    private function simpanDataMitra(Request $request)
    {
        $data = [
            'Jenis' => $request->jenis_penyewa,
            'nama' => $request->nama_lengkap,
            'no_identitas' => $request->nik,
            'masa_berlaku_identitas' => $request->masa_berlaku_ktp,
            'email' => $request->email,
            'no_tlpn' => $request->no_telepon,
            'tgl_perjanjian' => $request->tanggal_perjanjian,
            'penyewa_berdasarkan' => $request->penyewa_berdasarkan,
            'alamat' => $request->alamat,
            'nama_perwakilan' => $request->nama_perwakilan,
            'penyewa_selaku' => $request->perwakilan_selaku,
            'npwp' => $request->npwp,
            'kota_penyewa' => $request->kota_penyewa,
            'kode_pos' => $request->kode_pos,
            'fax_penyewa' => $request->fax_penyewa,
            'no_akta_pendirian' => $request->no_akte_pendirian,
            'no_anggaran_dasar' => $request->no_anggaran_dasar,
            'tgl_anggaran_dasar' => $request->tanggal_anggaran_dasar,
            'no_kenmenhum_dan_ham' => $request->no_kemenkumham,
            'tgl_persetujuan_kenmenhum_dan_ham' => $request->tanggal_kemenkumham,
            'no_penetapan_pengadilan' => $request->no_penetapan_pengadilan,
            'tgl_penetapan_pengadilan' => $request->tanggal_penetapan_pengadilan,
            'no_izin_berusaha' => $request->no_izin_berusaha,
            'tgl_izin_usaha' => $request->tanggal_izin_berusaha,
            'sk_dirjen_pajak' => $request->surat_keterangan_pajak,
            'tgl_sk_dirjen_pajak' => $request->tanggal_surat_keterangan_pajak,
            'surat_pengukuhan_kena_pajak' => $request->surat_pengukuhan_pkp,
            'tgl_surat_pengukuhan_kena_pajak' => $request->tanggal_surat_pengukuhan_pkp,
            
        ];

        // Upload foto identitas
        if ($request->hasFile('foto_identitas')) {
        $file = $request->file('foto_identitas');
        $fileName = time() . '_' . $file->getClientOriginalName();
        $file->move(public_path('asset/img/identitas'), $fileName);
        $data['foto_identitas'] = 'asset/img/identitas/' . $fileName;
        }

        return DataMitra::create($data);
    }  

    
    private function simpanDataAset(Request $request, $idMitra)
    {
        $data = [
            'id_mitra' => $idMitra,
            'lokasi' => $request->alamat_asset,
            'penggunaan_objek' => $request->penggunaan_asset,
            'luas_tanah' => $request->luas_tanah,
            'luas_bangunan' => $request->luas_bangunan,
        ];

        return DataAset::create($data);
    }

    
    private function simpanPerjanjianSewa(Request $request, $idMitra, $idAset )
    {
        $t = (int) ($request->tahun ?? 0);
        $b = (int) ($request->bulan ?? 0);
        $h = (int) ($request->hari ?? 0);

        $parts = [];
        if ($t) $parts[] = "$t Tahun";
        if ($b) $parts[] = "$b Bulan";
        if ($h) $parts[] = "$h Hari";

        $jangkawaktu = implode(' ', $parts) ?: '0 Hari';

        $data = [
            'id_mitra' => $idMitra,
            'id_aset' => $idAset,
            'jangka_waktu' => $jangkawaktu,
            'masa_awal_perjanjian' => $request->masa_awal_perjanjian,
            'masa_akhir_perjanjian' => $request->masa_akhir_perjanjian,
            'masa_awal_manfaat' => $request->masa_awal_pemanfaatan,
            'masa_akhir_manfaat' => $request->masa_akhir_pemanfaatan,
            'harga_sewa' => $request->harga_sewa,
            'harga_pemanfaatan' => $request->harga_pemanfaatan,
            'biaya_admin_ukur' => $request->biaya_admin,
            'cost_of_money' => $request->cost_of_money,
            'harga_sewa_admin' => $request->harga_sewa_admin,
            'harga_sewa_admin_com' => $request->harga_sewa_admin_com,
            'ppn_11_persen' => $request->ppn,
            'total_harga' => $request->total_harga,
            'terbilang' => $request->terbilang
        ];

        return PerjanjianSewa::create($data);
    }

}