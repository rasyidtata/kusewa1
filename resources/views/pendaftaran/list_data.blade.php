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
            </div>
            <div class="table-container">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tanggal</th>
                                <th>Nama</th>
                                <th>Jenis</th>
                                <th>Kategori</th>
                                <th>Lokasi Sewa</th>
                                <th>Penggunaan</th>
                                <th>Total Harga</th>
                                <th>Status</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($dataProses as $datmit)
                            <tr>
                                <td data-label="No" class="text-center">{{ $loop->iteration }}</td>
                                <td data-label="Tanggal Sewa">{{ $datmit->tgl_perjanjian }}</td>
                                <td data-label="Nama">{{ $datmit->nama }}</td>
                                <td data-label="Jenis" class="text-center">{{ $datmit->Jenis }}</td>
                                <td data-label="kategori" class="text-center">{{ $datmit->kategori }}</td>
                                <td data-label="Lokasi Sewa">{{ $datmit->lokasi }}</td>
                                <td data-label="Penggunaan">{{ $datmit->penggunaan_objek }}</td>
                                <td data-label="Total Harga">Rp. {{ number_format($datmit->total_harga ?? 0, 0,
                                    ',', '.') }}</td> 

                                <td data-label="Status status-pending" class="text-center">
                                    <span class="badge bg-warning">
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
                                <td colspan="9" class="text-center">Tidak ada data proses ditemukan</td>
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
                        <p class="card-title">List Data Diterima & Ditolak</p>
                    </div>
                </div>
                <form class="row row_filter mt-3" method="GET" action="{{ url('pendaftaran/fitur_filter') }}">
                    <div class="col-2 filter-kategori">
                        <select id="filterkategori" name="filterkategori" class="form-control">
                            <option value="">-- All Kategori --</option>
                            <option value="Aset" {{ request('filterkategori')=='Aset' ? 'selected' : '' }}>Aset</option>
                            <option value="Event" {{ request('filterkategori')=='Event' ? 'selected' : '' }}>Event</option>
                        </select>
                    </div>
                    <div class="col-2 filter-jenis">
                        <select id="filterjenis" name="filterjenis" class="form-control">
                            <option value="">-- All Jenis --</option>
                            <option value="Perorangan" {{ request('filterjenis')=='Perorangan' ? 'selected' : '' }}>Perorangan</option>
                            <option value="Perusahaan" {{ request('filterjenis')=='Perusahaan' ? 'selected' : '' }}>Perusahaan</option>
                        </select>
                    </div>
                    <div class="col-4 filter-search">
                        <div class="input-group input-group-sm">
                            <input type="text" name="table_search" class="form-control" placeholder="Cari nama, kode aset, dll..."
                                value="{{ request('table_search') }}">
                        </div>
                    </div>
                    <!-- Tombol Terapkan -->
                    <div class="col-4 col-tombol-filter">
                        <button type="submit" class="btn btn-primary ">
                            <i class="bi bi-funnel me-1"></i>Terapkan
                        </button>
                        <a href="{{ route('pendaftaran.fitur_filter') }}" class="btn btn-secondary me-2">
                            Reset
                        </a>
                    </div>
                </form>
            </div>
            <div class="table-container">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tanggal</th>
                                <th>Nama</th>
                                <th>Jenis</th>
                                <th>Kategori</th>
                                <th>Lokasi Sewa</th>
                                <th>Penggunaan</th>
                                <th>Total Harga</th>
                                <th>Status</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($dataSelesai as $datmit)
                            <tr>
                                <td data-label="No" class="text-center">{{ $loop->iteration }}</td>
                                <td data-label="Tanggal Sewa">{{ $datmit->tgl_perjanjian }}</td>
                                <td data-label="Nama">{{ $datmit->nama }}</td>
                                <td data-label="jenis"class="text-center">{{ $datmit->Jenis }}</td>
                                <td data-label="katerori"class="text-center">{{ $datmit->kategori }}</td>
                                <td data-label="Lokasi">{{ $datmit->lokasi }}</td>
                                <td data-label="penggunaan">{{ $datmit->penggunaan_objek }}</td>
                                <td data-label="Total Harga">Rp. {{ number_format($datmit->total_harga ?? 0, 0,
                                    ',', '.') }}</td>
                                <td data-label="Status" class="text-center">
                                    <span
                                        class="badge bg-{{ 
                                        $datmit->status == 'Diterima' ? 'success' : 'danger' }}">
                                        {{ $datmit->status }}
                                    </span>
                                </td>
                                <td data-label="Aksi" class="text-center"> 
                                    <div class="btn-aksi" role="group">
                                        <a href="{{ url('pendaftaran/detail/'.$datmit->id_perjanjian) }}" 
                                        class="btn btn-sm btn-success">
                                            <i class="bi bi-book"></i>
                                        </a>
                                    </div>
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
    </div>
</div>

@endsection