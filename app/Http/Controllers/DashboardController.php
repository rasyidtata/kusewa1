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
    public function index()
    {
        $chartData = $this->getChartData();
        return view('home.beranda', compact('chartData'));
    }

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

    private function getChartData()
    {
        // 1. Grafik Pendapatan
        $pendapatan = PerjanjianSewa::select(
            DB::raw('DATE_FORMAT(masa_awal_perjanjian, "%Y-%m") as bulan'),
            DB::raw('SUM(total_harga) as total')
        )
        ->groupBy('bulan')->orderBy('bulan')->limit(12)->get();

        // 2. Grafik Status
        $status = PerjanjianSewa::select('status', DB::raw('count(*) as total'))
            ->groupBy('status')->pluck('total', 'status')->toArray();
            
        // 3. Grafik Mitra
        $mitra = DataMitra::select('Jenis', DB::raw('count(*) as total'))
            ->groupBy('Jenis')->pluck('total', 'Jenis')->toArray();

        // --- UPDATE BARU ---
        
        // Menghitung TOTAL SEMUA DATA (Untuk Kartu Hijau)
        $totalPerjanjian = PerjanjianSewa::count();

        // Menghitung HANYA YANG AKTIF (Untuk Kartu Kuning)
        $perjanjianAktif = PerjanjianSewa::where('status', 'aktif')->count();

        return [
            'labels_pendapatan' => $pendapatan->pluck('bulan'),
            'data_pendapatan' => $pendapatan->pluck('total'),
            
            'status_aktif' => $status['aktif'] ?? 0,
            'status_peringatan' => $status['peringatan'] ?? 0,
            'status_mati' => $status['mati'] ?? 0,
            
            'mitra_perorangan' => $mitra['Perorangan'] ?? 0,
            'mitra_perusahaan' => $mitra['Perusahaan'] ?? 0,
            
            // Variabel Baru dikirim ke View
            'total_semua_perjanjian' => $totalPerjanjian,
            'jumlah_perjanjian_aktif' => $perjanjianAktif,
        ];
    }
}