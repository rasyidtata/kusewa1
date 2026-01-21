@extends('template.admin')

@section('title', 'halaman | List Data')

@section('content')
<div class="container-list-data-perjanjian">
    <div class="text-start p-3">
        <a>List Data Perjanjian Penyewaan</a>
    </div>
    
    <form class="row row_filter mt-3" method="GET" action="{{ url('list_data/data_perjanjian') }}">
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
                <option value="Perorangan" {{ request('filterjenis')=='Perorangan' ? 'selected' : '' }}>Perorangan
                </option>
                <option value="Perusahaan" {{ request('filterjenis')=='Perusahaan' ? 'selected' : '' }}>Perusahaan
                </option>
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
            <a href="{{ url('list_data/data_perjanjian') }}" class="btn btn-secondary me-2">
                Reset
            </a>
        </div>
    </form>
    
    <div class="container card-list-data-perjanjian">
        <div class="row row-data-perjanjian">
            <div class="col-2">
                <a href="#">Copy /</a>
                <a href="{{ route('perjanjian.export.excel', request()->query()) }}">Exsel /</a>
            </div>
        </div>
        <div class="table-perjanjian-responsive">
            <table class="table table-perjanjian">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Tgl.Update</th>
                        <th>Kategori</th>
                        <th>Nama</th>
                        <th>Nama Perwakilan</th>
                        <th>Selaku</th>
                        <th>Jenis</th>
                        <th>Alamat</th>
                        <th>No.HP</th>
                        <th>No.Perjanjian</th>
                        <th>Lokasi Sewa</th>
                        <th>Total Harga</th>
                        <th>Statua</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($dataPerjanjian as $datmit)
                    <tr>
                        <td data-label="No" class="text-center">{{ $loop->iteration }}</td>
                        <td data-label="Tanggal" class="text-center">
                            {{ \Carbon\Carbon::parse($datmit->updated_at)->translatedFormat('d F Y') }}
                        </td>
                        <td data-label="Kategori" class="text-center">{{ $datmit->kategori }}</td>
                        <td data-label="Nama">{{ $datmit->nama }}</td>
                        <td data-label="Nama Perwakilan">{{ $datmit->nama_perwakilan }}</td>
                        <td data-label="Selaku" class="text-center">{{ $datmit->penyewa_selaku }}</td>
                        <td data-label="Jenis" class="text-center">{{ $datmit->Jenis }}</td>
                        <td data-label="Alamat">{{ $datmit->alamat }}</td>
                        <td data-label="No.HP" class="text-center">{{ $datmit->no_tlpn }}</td>
                        <td data-label="No.Perjanjian" class="text-center">{{ $datmit->kode_perjanjian }}</td>
                        <td data-label="Lokasi Sewa">{{ $datmit->lokasi }}</td>
                        <td data-label="Total Harga">
                            Rp. {{ number_format($datmit->total_harga ?? 0, 0, ',', '.') }}
                        </td>
                        <td data-label="Status" class="text-center">
                            <span class="badge bg-{{ 
                                $datmit->status == 'aktif' ? 'success' : 
                                ($datmit->status == 'Pending' ? 'warning' : 
                                ($datmit->status == 'mati' ? 'danger' : 'secondary'))
                            }}">
                                {{ $datmit->status }}
                            </span>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="12" class="text-center">Tidak ada data perjanjian ditemukan</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>


@endsection