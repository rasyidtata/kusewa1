@extends('template.admin')

@section('title', 'Halaman | Perpanjang Kontrak')

@section('content')

<style>
    .table-row-clickable:hover {
        background-color: #f5f5f5;
    }
</style>

<div class="text-start p-3">
    <a>Halaman Perpanjang kontrak</a>
</div>
<div class="container">
    <div class="card card-list-second border">
        <div class="card-header">
            <div class="row">
                <div class="col-10">
                    <p class="card-title">List Kontrak Data Habis</p>
                </div>
                <div class="col-2">
                    <div class="card-tools">
                        <div class="input-group input-group-sm" style="width: 150px;">
                            <input type="text" name="table_search" class="form-control float-right"
                                placeholder="Search">

                            <div class="input-group-append">
                                <button type="submit" class="btn btn-search">
                                    <i class="bi bi-search"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="table-container">
            <div class="table-responsive">
                <table class="table table-bordered table-hover custom-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tanggal</th>
                            <th>Nama</th>
                            <th>Jenis</th>
                            <th>Kategoti</th>
                            <th>Masa Akhir Perjanjian</th>
                            <th>Harga Aset</th>
                            <th>Status</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>

                        @forelse($dataps as $m)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                {{ \Carbon\Carbon::parse($m->updated_at)->translatedFormat('d F Y') }}
                            </td>
                            <td>{{ $m->nama }}</td>
                            <td>{{ $m->Jenis }}</td>
                            <td>{{ $m->kategori ?? '-' }}</td>
                            <td>
                                <small class="d-block text-muted">Mulai: {{ \Carbon\Carbon::parse($m->masa_awal_perjanjian ?? '')->translatedFormat('d F Y') }}</small>
                                <small class="d-block text-muted">Akhir: {{ \Carbon\Carbon::parse($m->masa_akhir_perjanjian ?? '')->translatedFormat('d F Y') }}</small>
                            </td>
                            <td>Rp. {{ number_format($m->harga_sewa ?? 0, 0, ',', '.') }}</td>
                            <td data-label="Status" class="text-center">
                                <span class="badge bg-{{ 
                                            $m->status_calculated ?? '' == 'mati' ? 'danger' : 
                                            ($m->status_calculated ?? '' == 'peringatan' ? 'warning' : 
                                            ($m->status_calculated ?? '' == 'aktif' ? 'success' : 'secondary'))
                                        }}">
                                    {{ $m->status_calculated ?? '' }}
                                </span>
                            </td>
                            <td class="text-center">
                                <a href="{{ route('perpanjang.formperpanjang', $m->id_perjanjian) }}"
                                    class="btn btn-sm btn-primary">
                                    <i class="bi bi-arrow-repeat"></i>
                                </a>
                            </td>
                        </tr>

                        @empty
                        <tr>
                            <td colspan="8" class="text-center">Tidak ada data diterima/ditolak ditemukan</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div 


@endsection