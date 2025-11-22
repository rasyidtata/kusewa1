<?php

namespace App\Http\Controllers;

use App\Models\PerjanjianSewa;
use App\Models\DataMitra;
use App\Models\DataAset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;

class PerjanjianSewaController extends Controller
{
    public function perjanjian_sewa()
    {
        $dataps = PerjanjianSewa::select(
            'perjanjian_sewa.*',
            'dm.tgl_perjanjian',
            'dm.id_mitra',
            'dm.nama',
            'dm.Jenis',
            'da.id_aset',
            'dm.status'
        )
        ->join('data_mitra as dm', 'perjanjian_sewa.id_mitra', '=', 'dm.id_mitra')
        ->join('data_aset as da', 'perjanjian_sewa.id_aset', '=', 'da.id_aset')
        ->get();

        return view('pendaftaran.list_data', compact('dataps'));
    }











    public function edit($id_perjanjian)
    {
        $dataps = PerjanjianSewa::with(['dataMitra', 'dataAset'])->findOrFail($id_perjanjian);
        return view('pendaftaran.form_edit', compact('dataps'));
    }
    public function update(Request $request, $id_perjanjian)
    {
        $validator = Validator::make($request->all(), [
            // Data Diri - Step 1
            'jenis_penyewa' => 'required|in:Perorangan,Perusahaan',
            'kategori' => 'required|in:Aset,Event',
            'nama_lengkap' => 'required|string|max:255',
            'nik' => 'required|string|max:20',
            'masa_berlaku_ktp' => 'required|date',
            'email' => 'required|email',
            'no_telepon' => 'required|string|max:15',
            'tanggal_perjanjian' => 'required|date',
            'penyewa_berdasarkan' => 'required|string|max:255',
            'alamat' => 'required|string',
            'foto_identitas' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',

            // Data Perusahaan (kondisional)
            'nama_perwakilan' => 'nullable|string|max:255',
            'perwakilan_selaku' => 'nullable|string|max:255',
            'npwp' => 'nullable|string|max:20',
            'kota_penyewa' => 'nullable|string|max:100',
            'kode_pos' => 'nullable|string|max:10',
            'fax_penyewa' => 'nullable|string|max:20',
            'no_akte_pendirian' => 'nullable|string|max:50',
            'no_anggaran_dasar' => 'nullable|string|max:50',
            'tanggal_anggaran_dasar' => 'nullable|date',
            'no_kemenkumham' => 'nullable|string|max:50',
            'tanggal_kemenkumham' => 'nullable|date',
            'no_penetapan_pengadilan' => 'nullable|string|max:50',
            'tanggal_penetapan_pengadilan' => 'nullable|date',
            'no_izin_berusaha' => 'nullable|string|max:50',
            'tanggal_izin_berusaha' => 'nullable|date',
            'surat_keterangan_pajak' => 'nullable|string|max:50',
            'tanggal_surat_keterangan_pajak' => 'nullable|date',
            'surat_pengukuhan_pkp' => 'nullable|string|max:50',
            'tanggal_surat_pengukuhan_pkp' => 'nullable|date',

            // Data Aset - Step 2
            'alamat_asset' => 'required|string',
            'penggunaan_asset' => 'required|string',
            'luas_tanah' => 'required|integer|min:0',
            'luas_bangunan' => 'required|integer|min:0',
            'tahun' => 'nullable|integer|min:0',
            'bulan' => 'nullable|integer|min:0|max:11',
            'hari' => 'nullable|integer|min:0|max:30',
            'masa_awal_perjanjian' => 'required|date',
            'masa_akhir_perjanjian' => 'required|date',
            'masa_awal_pemanfaatan' => 'required|date',
            'masa_akhir_pemanfaatan' => 'required|date',

            // Harga Aset - Step 3
            'harga_sewa' => 'nullable|numeric|min:0',
            'harga_pemanfaatan' => 'nullable|numeric|min:0',
            'biaya_admin' => 'nullable|numeric|min:0',
            'cost_of_money' => 'nullable|numeric|min:0',
            'harga_sewa_admin' => 'nullable|numeric|min:0',
            'harga_sewa_admin_com' => 'nullable|numeric|min:0',
            'ppn' => 'nullable|numeric|min:0',
            'total_harga' => 'nullable|numeric|min:0',
            'terbilang' => 'nullable|string'
        ]);

        // Validasi gagal
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        DB::beginTransaction();

        try {
            // Ambil data perjanjian sewa
            $perjanjianSewa = PerjanjianSewa::with(['dataMitra', 'dataAset'])->findOrFail($id_perjanjian);

            // Step 1: Update Data Mitra
            $this->updateDataMitra($request, $perjanjianSewa->id_mitra);
            
            // Step 2: Update Data Aset
            $this->updateDataAset($request, $perjanjianSewa->id_aset);
            
            // Step 3: Update Perjanjian Sewa
            $this->updatePerjanjianSewa($request, $id_perjanjian);

            DB::commit();

            return redirect('pendaftaran/form_edit', $id_perjanjian)
                ->with('success', 'Data perjanjian sewa berhasil diperbarui.');
                
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage())
                ->withInput();
        }
    }
    private function updateDataMitra(Request $request, $id_mitra)
    {
        $data = [
            'Jenis' => $request->jenis_penyewa,
            'kategori' => $request->kategori,
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

        // Upload foto identitas jika ada
        if ($request->hasFile('foto_identitas')) {
            $file = $request->file('foto_identitas');
            $fileName = time() . '_' . $file->getClientOriginalName();
            
            // Hapus foto lama jika ada
            $dataMitra = DataMitra::find($id_mitra);
            if ($dataMitra->foto_identitas && file_exists(public_path($dataMitra->foto_identitas))) {
                unlink(public_path($dataMitra->foto_identitas));
            }
            
            // Simpan file baru
            $filePath = 'asset/img/identitas/' . $fileName;
            $file->move(public_path('asset/img/identitas'), $fileName);
            $data['foto_identitas'] = $filePath;
        }

        return DataMitra::where('id_mitra', $id_mitra)->update($data);
    }
    private function updateDataAset(Request $request, $id_aset)
    {
        $data = [
            'lokasi' => $request->alamat_asset,
            'penggunaan_objek' => $request->penggunaan_asset,
            'luas_tanah' => $request->luas_tanah,
            'luas_bangunan' => $request->luas_bangunan,
        ];

        return DataAset::where('id_aset', $id_aset)->update($data);
    }
    private function updatePerjanjianSewa(Request $request, $id_perjanjian)
    {
        $t = (int) ($request->tahun ?? 0);
        $b = (int) ($request->bulan ?? 0);
        $h = (int) ($request->hari ?? 0);

        $parts = [];
        if ($t > 0) $parts[] = "$t Tahun";
        if ($b > 0) $parts[] = "$b Bulan"; 
        if ($h > 0) $parts[] = "$h Hari";

        $jangkawaktu = implode(' ', $parts) ?: '0 Hari';

        $data = [
            'jangka_waktu' => $jangkawaktu,
            'jangka_waktu_tahun' => $t,
            'jangka_waktu_bulan' => $b,
            'jangka_waktu_hari' => $h,
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

        return PerjanjianSewa::where('id_perjanjian', $id_perjanjian)->update($data);
    }
    public function showFoto($id_mitra)
    {
        $dataMitra = DataMitra::findOrFail($id_mitra);
        
        if (!$dataMitra->foto_identitas || !file_exists(public_path($dataMitra->foto_identitas))) {
            abort(404);
        }

        return response()->file(public_path($dataMitra->foto_identitas));
    }
    public function deleteFoto($id_mitra)
    {
        DB::beginTransaction();
        
        try {
            $dataMitra = DataMitra::findOrFail($id_mitra);
            
            if ($dataMitra->foto_identitas && file_exists(public_path($dataMitra->foto_identitas))) {
                unlink(public_path($dataMitra->foto_identitas));
            }
            
            $dataMitra->update(['foto_identitas' => null]);
            
            DB::commit();
            
            return redirect()->back()->with('success', 'Foto identitas berhasil dihapus.');
            
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Gagal menghapus foto: ' . $e->getMessage());
        }
    }










    public function showPerjanjianDokumen($id_perjanjian)
    {
        $dataps = PerjanjianSewa::with(['dataMitra', 'dataAset'])->findOrFail($id_perjanjian);
        $kategori = $dataps->dataMitra->kategori ?? '';
        
        if ($kategori === 'Aset') {
            return view('pendaftaran.perjanjian_aset', compact('dataps'));
        } else {
            return view('pendaftaran.perjanjian_event', compact('dataps'));
        }
    }







    public function previewPerjanjianPDF($id_perjanjian)
    {
        $dataps = PerjanjianSewa::with(['dataMitra', 'dataAset'])->findOrFail($id_perjanjian);

        $kategori = $dataps->dataMitra->kategori ?? '';
        $kategoriText = strtolower($kategori) === 'event' ? 'Event' : 'Aset';
        $fileName = "Perjanjian_{$kategoriText}_KAI_{$dataps->id_perjanjian}.pdf";

        // Tentukan view berdasarkan kategori
        if ($kategori === 'Event') {
            $viewName = 'pendaftaran.perjanjian_event';
        } else {
            $viewName = 'pendaftaran.perjanjian_aset';
        }

        return view('pendaftaran.perjanjian_event', compact('dataps', 'viewName', 'fileName'));
    }






    public function detail_perjanjian($id_perjanjian)
    {
        
        // Ambil data dengan relasi yang lengkap
        $dataps = PerjanjianSewa::with(['dataMitra', 'dataAset'])->findOrFail($id_perjanjian);
        
        return view('pendaftaran.detail', compact('dataps'));
    }


    
}