<?php

namespace App\Exports;

use App\Models\PerjanjianSewa;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Carbon\Carbon;

class DataPerjanjianExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize, WithStyles
{
    protected $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function collection()
    {
        // Load relasi untuk semua data
        return $this->data->load(['mitra', 'aset']);
    }

    public function headings(): array
    {
        return [
            'No',
            'Kode Perjanjian',
            'Tanggal Update',
            
            // Data Mitra
            'Kategori',
            'Jenis Penyewa',
            'Nama Lengkap',
            'NIK/No. Identitas',
            'Masa Berlaku Identitas',
            'Email',
            'No. Telepon',
            'Tanggal Perjanjian',
            'Penyewa Berdasarkan',
            'Alamat Mitra',
            'Nama Perwakilan',
            'Perwakilan Selaku',
            'NPWP',
            'Kota Penyewa',
            'Kode Pos',
            'Fax Penyewa',
            'No. Akta Pendirian',
            'No. Anggaran Dasar',
            'Tanggal Anggaran Dasar',
            'No. Kemenkumham',
            'Tanggal Kemenkumham',
            'No. Penetapan Pengadilan',
            'Tanggal Penetapan Pengadilan',
            'No. Izin Berusaha',
            'Tanggal Izin Usaha',
            'SK Dirjen Pajak',
            'Tanggal SK Dirjen Pajak',
            'Surat Pengukuhan Kena Pajak',
            'Tanggal Surat Pengukuhan Kena Pajak',
            
            // Data Aset
            'Lokasi Aset',
            'Penggunaan Objek',
            'Luas Tanah',
            'Luas Bangunan',
            
            // Data Perjanjian Sewa
            'Jangka Waktu',
            'Jangka Waktu (Tahun)',
            'Jangka Waktu (Bulan)',
            'Jangka Waktu (Hari)',
            'Masa Awal Perjanjian',
            'Masa Akhir Perjanjian',
            'Masa Awal Pemanfaatan',
            'Masa Akhir Pemanfaatan',
            'Harga Sewa',
            'Harga Pemanfaatan',
            'Biaya Admin Ukur',
            'Cost of Money',
            'Harga Sewa Admin',
            'Harga Sewa Admin COM',
            'PPN 11%',
            'Total Harga',
            'Terbilang',
            'Status'
        ];
    }

    public function map($perjanjian): array
    {
        return [
            // ID dan informasi dasar
            $perjanjian->id,
            $perjanjian->kode_perjanjian,
            \Carbon\Carbon::parse($perjanjian->updated_at)->format('d-m-Y'),
            
            // Data Mitra (relasi)
            $perjanjian->kategori ?? $perjanjian->mitra->kategori ?? '',
            $perjanjian->Jenis ?? $perjanjian->mitra->Jenis ?? '',
            $perjanjian->nama ?? $perjanjian->mitra->nama ?? '',
            $perjanjian->mitra->no_identitas ?? '',
            $perjanjian->mitra->masa_berlaku_identitas ?? '',
            $perjanjian->mitra->email ?? '',
            $perjanjian->no_tlpn ?? $perjanjian->mitra->no_tlpn ?? '',
            $perjanjian->mitra->tgl_perjanjian ?? '',
            $perjanjian->mitra->penyewa_berdasarkan ?? '',
            $perjanjian->alamat ?? $perjanjian->mitra->alamat ?? '',
            $perjanjian->nama_perwakilan ?? $perjanjian->mitra->nama_perwakilan ?? '',
            $perjanjian->penyewa_selaku ?? $perjanjian->mitra->penyewa_selaku ?? '',
            $perjanjian->mitra->npwp ?? '',
            $perjanjian->mitra->kota_penyewa ?? '',
            $perjanjian->mitra->kode_pos ?? '',
            $perjanjian->mitra->fax_penyewa ?? '',
            $perjanjian->mitra->no_akta_pendirian ?? '',
            $perjanjian->mitra->no_anggaran_dasar ?? '',
            \Carbon\Carbon::parse($perjanjian->mitra->tgl_anggaran_dasar ?? null)->format('d-m-Y'),
            $perjanjian->mitra->no_kenmenhum_dan_ham ?? '',
            \Carbon\Carbon::parse($perjanjian->mitra->tgl_persetujuan_kenmenhum_dan_ham ?? null)->format('d-m-Y'),
            $perjanjian->mitra->no_penetapan_pengadilan ?? '',
            \Carbon\Carbon::parse($perjanjian->mitra->tgl_penetapan_pengadilan ?? null)->format('d-m-Y'),
            $perjanjian->mitra->no_izin_berusaha ?? '',
            \Carbon\Carbon::parse($perjanjian->mitra->tgl_izin_usaha ?? null)->format('d-m-Y'),
            $perjanjian->mitra->sk_dirjen_pajak ?? '',
            \Carbon\Carbon::parse($perjanjian->mitra->tgl_sk_dirjen_pajak ?? null)->format('d-m-Y'),
            $perjanjian->mitra->surat_pengukuhan_kena_pajak ?? '',
            \Carbon\Carbon::parse($perjanjian->mitra->tgl_surat_pengukuhan_kena_pajak ?? null)->format('d-m-Y'),
            
            // Data Aset (relasi)
            $perjanjian->lokasi ?? $perjanjian->aset->lokasi ?? '',
            $perjanjian->aset->penggunaan_objek ?? '',
            $perjanjian->aset->luas_tanah ?? '',
            $perjanjian->aset->luas_bangunan ?? '',
            
            // Data Perjanjian Sewa
            $perjanjian->jangka_waktu ?? '',
            $perjanjian->jangka_waktu_tahun ?? 0,
            $perjanjian->jangka_waktu_bulan ?? 0,
            $perjanjian->jangka_waktu_hari ?? 0,
            \Carbon\Carbon::parse($perjanjian->masa_awal_perjanjian ?? null)->format('d-m-Y'),
            \Carbon\Carbon::parse($perjanjian->masa_akhir_perjanjian ?? null)->format('d-m-Y'),
            \Carbon\Carbon::parse($perjanjian->masa_awal_manfaat ?? null)->format('d-m-Y'),
            \Carbon\Carbon::parse($perjanjian->masa_akhir_manfaat ?? null)->format('d-m-Y'),
            'Rp ' . number_format($perjanjian->harga_sewa ?? 0, 0, ',', '.'),
            'Rp ' . number_format($perjanjian->harga_pemanfaatan ?? 0, 0, ',', '.'),
            'Rp ' . number_format($perjanjian->biaya_admin_ukur ?? 0, 0, ',', '.'),
            'Rp ' . number_format($perjanjian->cost_of_money ?? 0, 0, ',', '.'),
            'Rp ' . number_format($perjanjian->harga_sewa_admin ?? 0, 0, ',', '.'),
            'Rp ' . number_format($perjanjian->harga_sewa_admin_com ?? 0, 0, ',', '.'),
            'Rp ' . number_format($perjanjian->ppn_11_persen ?? 0, 0, ',', '.'),
            'Rp ' . number_format($perjanjian->total_harga ?? 0, 0, ',', '.'),
            $perjanjian->terbilang ?? '',
            $perjanjian->status ?? ''
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            // Style untuk header
            1 => [
                'font' => ['bold' => true, 'color' => ['rgb' => 'FFFFFF']],
                'fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '4472C4']]
            ],
            
            // Auto filter untuk semua kolom
            'A1' . ':' . $sheet->getHighestColumn() . '1' => [
                'autoFilter' => true
            ],
        ];
    }
}