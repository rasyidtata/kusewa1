@extends('template.admin')

@section('title', 'halaman | List Data')

@section('content')
<div class="container-list-pendaftar">
    <div class="text-start p-3">
        <a>Data Sementara Penyewa Aset</a>
    </div>
    <div class="container">
        <div class="card card-list border">
            <div class="card-header">
                <div class="row">
                    <div class="col-10">
                        <p class="card-title">List Data Proses</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-2 filter-tahun">
                        <div class="form-filter">
                            <input type="text" id="filtertahun" name="filtertahun" class="form-control" placeholder="Tahun">
                        </div>
                    </div>
                    <div class="col-2 filter-bulan">
                        <div class="form-filter">
                            <input type="text" id="filterbulan" name="filterbulan" class="form-control" placeholder="bulan">
                        </div>
                    </div>
                    <div class="col-2 filter-jenis">
                        <div class="form-filter">
                            <input type="text" id="filterjenis" name="filterjenis" class="form-control" placeholder="jenis">
                        </div>
                    </div>
                    <div class="col-6 filter-search">
                        <div class="card-tools">
                            <div class="input-group input-group-sm" style="width: 250px;">
                                <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

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
                    <table class="table table-bordered">
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
                                <th> </th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($dataps as $key => $datmit)
                            <tr>
                                <td data-label="No" class="text-center">{{ $key + 1 }}</td>
                                <td data-label="Tanggal Sewa">{{ $datmit->tgl_perjanjian }}</td>
                                <td data-label="Id Mitra" class="text-center">{{ $datmit->id_mitra }}</td>
                                <td data-label="Jenis" class="text-center">{{ $datmit->Jenis }}</td>
                                <td data-label="Id Asset" class="text-center">{{ $datmit->id_aset }}</td>
                                <td data-label="Nama">{{ $datmit->nama }}</td>
                                <td data-label="Harga Asset">Rp. {{ number_format($datmit->harga_sewa ?? 0, 0,
                                    ',', '.') }}</td> {{-- Format currency --}}
                                <td data-label="Status" class="text-center">
                                    <span
                                        class="badge bg-{{ $datmit->status == 'Diterima' ? 'success' : ($datmit->status == 'Proses' ? 'warning' : 'secondary') }}">
                                        {{ $datmit->status }}
                                    </span>
                                </td>
                                <td data-label="Aksi" class="text-center"> 
                                    <div class="btn-aksi" role="group">
                                        <a href="{{ url('pendaftaran/form_edit/'.$datmit->id_perjanjian) }}"
                                            class="btn btn-sm btn-warning">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>
                                        <a href="{{ url('pendaftaran/detail/'.$datmit->id_perjanjian) }}" 
                                        class="btn btn-sm btn-success">
                                            <i class="bi bi-book"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="9" class="text-center">Tidak ada data ditemukan</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="text-start p-3">
        <a>Data Penyewa Asset</a>
    </div>
    <div class="container">
        <div class="card card-list-second border">
            <div class="card-header">
                <div class="row">
                    <div class="col-10">
                        <p class="card-title">List Data Diterima</p>
                    </div>
                    <div class="col-2">
                        <div class="card-tools">
                            <div class="input-group input-group-sm" style="width: 150px;">
                                <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

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
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tanggal</th>
                                <th>Id Mitra</th>
                                <th>Penyewa</th>
                                <th>Id Aset</th>
                                <th>Nama</th>
                                <th>Harga Aset</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td data-label="No" class="text-center">1</td>
                                <td data-label="Tanggal Sewa">14/09/2025</td>
                                <td data-label="Id Mitra">NPA202500001</td>
                                <td data-label="Penyewa">Perorangan</td>
                                <td data-label="Id Asset">KAI0600001</td>
                                <td data-label="Nama">Fernando</td>
                                <td data-label="Harga Asset">Rp.10.500.000</td>
                                <td data-label="Status" class="text-center"><span
                                        class="status-badge status-approved">Diterima</span></td>

                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection