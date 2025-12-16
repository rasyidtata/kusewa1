<?php

namespace App\Http\Controllers;

use App\Models\DataMitra;
use App\Models\PerjanjianSewa;
use Illuminate\Http\Request;

class PerpanjangController extends Controller
{
    public function index()
    {
        $dataps = DataMitra::with(['perjanjianSewa.DataAset'])
            ->whereIn('status', ['Diterima', 'Ditolak'])
            ->get();

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


