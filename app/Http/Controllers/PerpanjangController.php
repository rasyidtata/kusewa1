<?php

namespace App\Http\Controllers;

use App\Models\DataMitra;
use App\Models\PerjanjianSewa;
use Illuminate\Http\Request;

class PerpanjangController extends Controller
{
    public function index()
    {
        // Ambil semua data dengan relasi
        $dataps = PerjanjianSewa::
            select(
                'perjanjian_sewa.*',
                'dm.tgl_perjanjian',
                'dm.kategori',
                'dm.nama',
                'dm.Jenis',
                'dm.updated_at',
            )
            ->join('data_mitra as dm', 'perjanjian_sewa.id_mitra', '=', 'dm.id_mitra')
            ->join('data_aset as da', 'perjanjian_sewa.id_aset', '=', 'da.id_aset')
            ->whereIn('dm.status', ['Diterima'])
            ->get();

        // Filter data yang statusnya 'mati' atau 'peringatan'
        $dataps = $dataps->filter(function($item) {
            return in_array($item->status_calculated, ['mati', 'peringatan']);
        });

        

        return view('perpanjang.index', compact('dataps'));
    }

    public function form($id)
    {
        $dataps = PerjanjianSewa::with('dataMitra', 'DataAset')->findOrFail($id);

        return view('perpanjang.form', compact('dataps'));
    }

    public function store(Request $request, $id)
    {
        $perjanjian = PerjanjianSewa::findOrFail($id);

        // Update status Mitra supaya masuk List Proses Pendaftaran
        $perjanjian->dataMitra->update([
            'status' => 'Proses' // atau 'Perpanjangan Diproses', sesuai filter List Proses
        ]);

        // Simpan data tambahan perpanjangan
        $perjanjian->update([
            'tgl_perpanjang' => now(),
            'keterangan' => 'Sedang diproses'
        ]);

        // Redirect ke list proses pendaftaran
        return redirect()->route('pendaftaran.list_data')
            ->with('success', 'Perpanjangan berhasil diajukan dan masuk ke list proses');
    }

    public function showForm($id)
    {
        $dataps = PerjanjianSewa::with([
            'dataMitra',
            'dataAset'
        ])->findOrFail($id);

        return view('perpanjang.formperpanjang', compact('dataps'));
    }

}


