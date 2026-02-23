<?php

namespace App\Exports;

use App\Models\PerjanjianSewa;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithCustomValueBinder;
use PhpOffice\PhpSpreadsheet\Cell\Cell;
use PhpOffice\PhpSpreadsheet\Cell\DataType;
use PhpOffice\PhpSpreadsheet\Cell\DefaultValueBinder;
use Carbon\Carbon;

class DataPerjanjianExport extends DefaultValueBinder implements 
    FromCollection, 
    WithHeadings, 
    WithMapping, 
    ShouldAutoSize, 
    WithStyles, 
    WithColumnFormatting,
    WithCustomValueBinder
{
    protected $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function collection()
    {
        return $this->data;
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
            'Tanggal Perjanjian Mitra',
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
            'Kode Aset',
            'Lokasi Aset',
            'Penggunaan Aset',
            'Luas Tanah',
            'Luas Bangunan',
            
            // Data Perjanjian Sewa
            'Jangka Waktu',
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
        // Helper function untuk mendapatkan nilai numerik
        $getNumericValue = function($value) {
            return is_numeric($value) ? (float) $value : 0;
        };

        // Helper function untuk mengkonversi ke Excel serial date
        $toExcelDate = function($date) {
            if (!$date) return null;
            try {
                // Konversi ke Carbon jika belum
                if (!($date instanceof Carbon)) {
                    $date = Carbon::parse($date);
                }
                return $date;
            } catch (\Exception $e) {
                return null;
            }
        };

        return [
            // Placeholder untuk No (akan diisi di styles)
            '', 
             
            $perjanjian->kode_perjanjian ?? '',
            $toExcelDate($perjanjian->updated_at),
            
            // Data Mitra - Langsung dari hasil join (sesuai controller)
            $perjanjian->kategori ?? '',
            $perjanjian->Jenis ?? '',
            $perjanjian->nama ?? '',
            $perjanjian->no_identitas ?? '',
            $perjanjian->masa_berlaku_identitas ?? '',
            $perjanjian->email ?? '',
            $perjanjian->no_tlpn ?? '',
            $toExcelDate($perjanjian->tgl_perjanjian),
            $perjanjian->penyewa_berdasarkan ?? '',
            $perjanjian->alamat ?? '',
            $perjanjian->nama_perwakilan ?? '',
            $perjanjian->penyewa_selaku ?? '',
            $perjanjian->npwp ?? '',
            $perjanjian->kota_penyewa ?? '',
            $perjanjian->kode_pos ?? '',
            $perjanjian->fax_penyewa ?? '',
            $perjanjian->no_akta_pendirian ?? '',
            $perjanjian->no_anggaran_dasar ?? '',
            $toExcelDate($perjanjian->tgl_anggaran_dasar),
            $perjanjian->no_kenmenhum_dan_ham ?? '',
            $toExcelDate($perjanjian->tgl_persetujuan_kenmenhum_dan_ham),
            $perjanjian->no_penetapan_pengadilan ?? '',
            $toExcelDate($perjanjian->tgl_penetapan_pengadilan),
            $perjanjian->no_izin_berusaha ?? '',
            $toExcelDate($perjanjian->tgl_izin_usaha),
            $perjanjian->sk_dirjen_pajak ?? '',
            $toExcelDate($perjanjian->tgl_sk_dirjen_pajak),
            $perjanjian->surat_pengukuhan_kena_pajak ?? '',
            $toExcelDate($perjanjian->tgl_surat_pengukuhan_kena_pajak),
            
            // Data Aset - Langsung dari hasil join
            $perjanjian->kode_aset ?? '',
            $perjanjian->lokasi ?? '',
            $perjanjian->penggunaan_aset ?? '',
            $getNumericValue($perjanjian->luas_tanah ?? 0),
            $getNumericValue($perjanjian->luas_bangunan ?? 0),
            
            // Data Perjanjian
            $perjanjian->jangka_waktu ?? '',
            $toExcelDate($perjanjian->masa_awal_perjanjian),
            $toExcelDate($perjanjian->masa_akhir_perjanjian),
            $toExcelDate($perjanjian->masa_awal_manfaat),
            $toExcelDate($perjanjian->masa_akhir_manfaat),
            $getNumericValue($perjanjian->harga_sewa ?? 0),
            $getNumericValue($perjanjian->harga_pemanfaatan ?? 0),
            $getNumericValue($perjanjian->biaya_admin_ukur ?? 0),
            $getNumericValue($perjanjian->cost_of_money ?? 0),
            $getNumericValue($perjanjian->harga_sewa_admin ?? 0),
            $getNumericValue($perjanjian->harga_sewa_admin_com ?? 0),
            $getNumericValue($perjanjian->ppn_11_persen ?? 0),
            $getNumericValue($perjanjian->total_harga ?? 0),
            $perjanjian->terbilang ?? '',
            $perjanjian->status ?? ''
        ];
    }

    public function styles(Worksheet $sheet)
    {
        $rowCount = $this->data->count();
        $lastRow = $rowCount + 1;
        
        // Style header
        $sheet->getStyle('A1:' . $sheet->getHighestColumn() . '1')->applyFromArray([
            'font' => ['bold' => true, 'color' => ['rgb' => 'FFFFFF'], 'size' => 12],
            'fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '4472C4']],
            'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER, 'vertical' => Alignment::VERTICAL_CENTER]
        ]);
        
        // Auto filter
        $sheet->setAutoFilter('A1:' . $sheet->getHighestColumn() . '1');
        
        // Set nomor urut
        for ($i = 2; $i <= $lastRow; $i++) {
            $sheet->setCellValue('A' . $i, $i - 1);
        }
        
        // Set column widths
        $sheet->getColumnDimension('A')->setWidth(5); // No
        $sheet->getColumnDimension('B')->setWidth(20); // Kode Perjanjian
        
        return [];
    }

    public function columnFormats(): array
    {
        return [
            // Format untuk TANGGAL
            'C' => 'dd-mm-yyyy', // Tanggal Update
            'H' => 'dd-mm-yyyy', // Masa Berlaku Identitas
            'K' => 'dd-mm-yyyy', // Tanggal Perjanjian Mitra
            'U' => 'dd-mm-yyyy', // Tanggal Anggaran Dasar
            'W' => 'dd-mm-yyyy', // Tanggal Kemenkumham
            'Y' => 'dd-mm-yyyy', // Tanggal Penetapan Pengadilan
            'AA' => 'dd-mm-yyyy', // Tanggal Izin Usaha
            'AC' => 'dd-mm-yyyy', // Tanggal SK Dirjen Pajak
            'AE' => 'dd-mm-yyyy', // Tanggal Surat Pengukuhan Kena Pajak
            'AP' => 'dd-mm-yyyy', // Masa Awal Perjanjian
            'AQ' => 'dd-mm-yyyy', // Masa Akhir Perjanjian
            'AR' => 'dd-mm-yyyy', // Masa Awal Pemanfaatan
            'AS' => 'dd-mm-yyyy', // Masa Akhir Pemanfaatan
            
            // Format ANGKA
            'AI' => '#,##0', // Luas Tanah
            'AJ' => '#,##0', // Luas Bangunan
            'AL' => '#,##0', // Jangka Waktu (Tahun)
            'AM' => '#,##0', // Jangka Waktu (Bulan)
            'AN' => '#,##0', // Jangka Waktu (Hari)
            
            // Format CURRENCY
            'AT' => '"Rp" #,##0', // Harga Sewa
            'AU' => '"Rp" #,##0', // Harga Pemanfaatan
            'AV' => '"Rp" #,##0', // Biaya Admin Ukur
            'AW' => '"Rp" #,##0', // Cost of Money
            'AX' => '"Rp" #,##0', // Harga Sewa Admin
            'AY' => '"Rp" #,##0', // Harga Sewa Admin COM
            'AZ' => '"Rp" #,##0', // PPN 11%
            'BA' => '"Rp" #,##0', // Total Harga
        ];
    }

    public function bindValue(Cell $cell, $value)
    {
        if ($value instanceof Carbon) {
            $cell->setValueExplicit(\PhpOffice\PhpSpreadsheet\Shared\Date::PHPToExcel($value), DataType::TYPE_NUMERIC);
            return true;
        }
        
        return parent::bindValue($cell, $value);
    }
}