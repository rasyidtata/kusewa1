<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PerjanjianSewa;
use App\Models\DataMitra;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    // --- HALAMAN HOME (BERANDA) ---
    public function index()
    {
        $chartData = $this->getChartData();
        // Pastikan file view ada di: resources/views/home/beranda.blade.php
        return view('home.beranda', compact('chartData'));
    }

    // --- HALAMAN LAPORAN ---
    public function laporan(Request $request)
    {
        $startDate = $request->input('start_date', Carbon::now()->startOfYear()->toDateString());
        $endDate = $request->input('end_date', Carbon::now()->endOfYear()->toDateString());

        $transaksi = PerjanjianSewa::with(['dataMitra', 'dataAset'])
            ->whereBetween('masa_awal_perjanjian', [$startDate, $endDate])
            ->orderBy('masa_awal_perjanjian', 'desc')
            ->get();

        $chartData = $this->getChartData();

        return view('laporan.laporan', compact('transaksi', 'startDate', 'endDate', 'chartData'));
    }

    // --- DOWNLOAD PDF ---
    public function downloadPdf(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        $transaksi = PerjanjianSewa::with(['dataMitra', 'dataAset'])
            ->whereBetween('masa_awal_perjanjian', [$startDate, $endDate])
            ->get();

        $pdf = Pdf::loadView('laporan.pdf', compact('transaksi', 'startDate', 'endDate'));
        
        return $pdf->download('laporan_aset_kai.pdf');
    }

    // --- LOGIKA GRAFIK (PRIVATE) ---
    private function getChartData()
    {
        $pendapatan = PerjanjianSewa::select(
            DB::raw('DATE_FORMAT(masa_awal_perjanjian, "%Y-%m") as bulan'),
            DB::raw('SUM(total_harga) as total')
        )
        ->groupBy('bulan')
        ->orderBy('bulan')
        ->limit(12)
        ->get();

        $status = PerjanjianSewa::select('status', DB::raw('count(*) as total'))
            ->groupBy('status')
            ->pluck('total', 'status')->toArray();
            
        $mitra = DataMitra::select('Jenis', DB::raw('count(*) as total'))
            ->groupBy('Jenis')
            ->pluck('total', 'Jenis')->toArray();

        return [
            'labels_pendapatan' => $pendapatan->pluck('bulan'),
            'data_pendapatan' => $pendapatan->pluck('total'),
            'status_aktif' => $status['aktif'] ?? 0,
            'status_peringatan' => $status['peringatan'] ?? 0,
            'status_mati' => $status['mati'] ?? 0,
            'mitra_perorangan' => $mitra['Perorangan'] ?? 0,
            'mitra_perusahaan' => $mitra['Perusahaan'] ?? 0,
        ];
    }
}