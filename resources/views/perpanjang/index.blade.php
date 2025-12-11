@extends('template.admin')

@section('title', 'Halaman | Perpanjang Kontrak')

@section('content')

    <style>
        .table-row-clickable {
            cursor: pointer;
            transition: background-color 0.2s;
        }

        .table-row-clickable:hover {
            background-color: #f5f5f5;
        }
    </style>

    <div class="text-start p-3">
        <a>Data Penyewa Asset</a>
    </div>
    <div class="container">
        <div class="card card-list-second border">
            <div class="card-header">
                <div class="row">
                    <div class="col-10">
                        <p class="card-title">List Data Diterima & Ditolak</p>
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
                                <th>Id Mitra</th>
                                <th>Jenis</th>
                                <th>Id Aset</th>
                                <th>Nama</th>
                                <th>Harga Aset</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $selesaiData = $dataps;
                            @endphp

                            @forelse($selesaiData as $key => $m)
                                @php
                                    $perjanjian = $m->perjanjianSewa->first();
                                @endphp

                                <tr @if($perjanjian) class="table-row-clickable"
                                    onclick="window.location='{{ route('perpanjang.form', $perjanjian->id_perjanjian) }}'"
                                @endif>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $m->tgl_perjanjian }}</td>
                                    <td>{{ $m->id_mitra }}</td>
                                    <td>{{ $m->Jenis }}</td>
                                    <td>{{ $perjanjian->id_aset ?? '-' }}</td>
                                    <td>{{ $m->nama }}</td>
                                    <td>Rp. {{ number_format($perjanjian->harga_sewa ?? 0, 0, ',', '.') }}</td>
                                    <td>
                                        <span class="badge bg-{{ $m->status == 'Diterima' ? 'success' : 'danger' }}">
                                            {{ $m->status }}
                                        </span>
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
</div @endsection