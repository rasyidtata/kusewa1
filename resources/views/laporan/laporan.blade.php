@extends('template.admin') 

@section('title', 'Laporan & Rekapitulasi')

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800 font-weight-bold">Laporan & Rekapitulasi</h1>

    <div class="card shadow mb-4 border-left-primary">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-filter me-2"></i>Filter Data Laporan</h6>
        </div>
        <div class="card-body">
            <form method="GET" action="{{ route('laporan.index') }}">
                <div class="row align-items-end">
                    <div class="col-md-4">
                        <div class="form-group mb-2">
                            <label class="font-weight-bold small text-uppercase text-gray-600">Dari Tanggal</label>
                            <input type="date" name="start_date" class="form-control" value="{{ $startDate }}">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group mb-2">
                            <label class="font-weight-bold small text-uppercase text-gray-600">Sampai Tanggal</label>
                            <input type="date" name="end_date" class="form-control" value="{{ $endDate }}">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group mb-2 d-flex gap-2">
                            <button type="submit" class="btn btn-primary btn-custom shadow-sm me-2">
                                <i class="fas fa-search fa-sm"></i> Tampilkan
                            </button>
                            <a href="{{ route('laporan.download', ['start_date' => $startDate, 'end_date' => $endDate]) }}" class="btn btn-danger btn-custom shadow-sm">
                                <i class="fas fa-file-pdf fa-sm"></i> Export PDF
                            </a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">
                <i class="fas fa-table me-2"></i>Detail Data ({{ \Carbon\Carbon::parse($startDate)->format('d M Y') }} - {{ \Carbon\Carbon::parse($endDate)->format('d M Y') }})
            </h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover table-bordered" width="100%" cellspacing="0">
                    <thead class="bg-light text-dark">
                        <tr>
                            <th>No</th>
                            <th>Nama Mitra</th>
                            <th>Lokasi Aset</th>
                            <th>Periode Sewa</th>
                            <th>Status</th>
                            <th>Nilai Kontrak</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($transaksi as $key => $t)
                        <tr>
                            <td class="text-center">{{ $key + 1 }}</td>
                            <td class="font-weight-bold">{{ $t->dataMitra->nama ?? '-' }}</td>
                            <td>{{ $t->dataAset->lokasi ?? '-' }}</td>
                            <td>
                                <small class="d-block text-muted">Mulai: {{ \Carbon\Carbon::parse($t->masa_awal_perjanjian)->format('d/m/Y') }}</small>
                                <small class="d-block text-muted">Akhir: {{ \Carbon\Carbon::parse($t->masa_akhir_perjanjian)->format('d/m/Y') }}</small>
                            </td>
                            <td data-label="Status Perjanjian" class="text-center">
                                <span class="badge bg-{{ 
                                    $t->status == 'aktif' ? 'success' : 
                                    ($t->status == 'peringatan' ? 'secondary' : 
                                    ($t->status == 'mati' ? 'danger' : 'warning')) 
                                }}">
                                    {{ $t->status }}
                                </span>
                            </td>
                            <td class="text-right font-weight-bold text-primary">Rp {{ number_format($t->total_harga, 0, ',', '.') }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted py-4">
                                <i class="fas fa-folder-open fa-3x mb-3 text-gray-300"></i><br>
                                Tidak ada data pada periode ini.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                    <tfoot>
                        <tr class="bg-light font-weight-bold">
                            <td colspan="5" class="text-right text-uppercase">Total Pendapatan:</td>
                            <td class="text-right text-success h5 mb-0">Rp {{ number_format($transaksi->sum('total_harga'), 0, ',', '.') }}</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection