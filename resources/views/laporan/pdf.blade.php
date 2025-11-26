<!DOCTYPE html>
<html>
<head>
    <title>Laporan Aset KAI</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        .header { text-align: center; margin-bottom: 20px; border-bottom: 2px solid #333; padding-bottom: 10px; }
        .header h2 { margin: 0; color: #1a202c; }
        .header p { margin: 5px 0 0; color: #555; }
        
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid #999; padding: 8px; text-align: left; }
        th { background-color: #e2e8f0; text-transform: uppercase; font-size: 11px; }
        tr:nth-child(even) { background-color: #f8fafc; }
        
        .text-right { text-align: right; }
        .text-center { text-align: center; }
        .badge { padding: 2px 5px; border-radius: 3px; font-size: 10px; color: white;}
        .bg-success { background-color: #1cc88a; }
        .bg-warning { background-color: #f6c23e; color: black; }
        .bg-danger { background-color: #e74a3b; }
        
        .total-row { background-color: #2d3748; color: white; font-weight: bold; }
    </style>
</head>
<body>
    <div class="header">
        <h2>LAPORAN PENYEWAAN ASET</h2>
        <p>PT KERETA API INDONESIA (PERSERO) - DAOP 6 YOGYAKARTA</p>
        @if($startDate && $endDate)
        <p>Periode: {{ \Carbon\Carbon::parse($startDate)->translatedFormat('d F Y') }} s/d {{ \Carbon\Carbon::parse($endDate)->translatedFormat('d F Y') }}</p>
        @endif
    </div>

    <table>
        <thead>
            <tr>
                <th width="5%">No</th>
                <th width="20%">Nama Mitra</th>
                <th width="25%">Lokasi Aset</th>
                <th width="20%">Masa Sewa</th>
                <th width="10%">Status</th>
                <th width="20%" class="text-right">Nilai Kontrak</th>
            </tr>
        </thead>
        <tbody>
            @forelse($transaksi as $t)
            <tr>
                <td class="text-center">{{ $loop->iteration }}</td>
                <td>{{ $t->dataMitra->nama ?? '-' }}</td>
                <td>{{ $t->dataAset->lokasi ?? '-' }}</td>
                <td>
                    {{ \Carbon\Carbon::parse($t->masa_awal_perjanjian)->format('d/m/y') }} - 
                    {{ \Carbon\Carbon::parse($t->masa_akhir_perjanjian)->format('d/m/y') }}
                </td>
                <td>
                    @if($t->status == 'aktif') <span class="badge bg-success">Aktif</span>
                    @elseif($t->status == 'peringatan') <span class="badge bg-warning">Peringatan</span>
                    @else <span class="badge bg-danger">Mati</span>
                    @endif
                </td>
                <td class="text-right">Rp {{ number_format($t->total_harga, 0, ',', '.') }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="text-center">Tidak ada data pada periode ini.</td>
            </tr>
            @endforelse
        </tbody>
        <tfoot>
            <tr class="total-row">
                <td colspan="5" class="text-right">TOTAL PENDAPATAN</td>
                <td class="text-right">Rp {{ number_format($transaksi->sum('total_harga'), 0, ',', '.') }}</td>
            </tr>
        </tfoot>
    </table>
</body>
</html>