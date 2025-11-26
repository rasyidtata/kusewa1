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
                <div class="col-6">
                    <p class="card-title">Daftar Perjanjian</p>
                </div>
                <div class="col-6">
                    <form class="d-flex">
                        <input type="text" id="cari" class="form-control-cari"
                            placeholder="Masukkan nama untuk pencarian...">
                    </form>
                </div>
            </div>
        </div>

        <div class="table-container">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tanggal Mulai</th>
                            <th>Tanggal Akhir</th>
                            <th>ID Mitra</th>
                            <th>Nama Mitra</th>
                            <th>ID Aset</th>
                            <th>Nama Aset</th>
                            <th>Harga Sewa</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($data as $row)
                        <tr class="table-row-clickable"
                            onclick="window.location.href='{{ route('perpanjang.form', $row->id_perjanjian) }}'">

                            <td class="text-center">{{ $loop->iteration }}</td>

                            <td>{{ optional($row->masa_awal_perjanjian)->format('Y-m-d') ?? '-' }}</td>
                            <td>{{ optional($row->masa_akhir_perjanjian)->format('Y-m-d') ?? '-' }}</td>

                            <td>{{ $row->dataMitra->id_mitra ?? '-' }}</td>
                            <td>{{ $row->dataMitra->nama_mitra ?? '-' }}</td>

                            <td>{{ $row->dataAset->id_aset ?? '-' }}</td>
                            <td>{{ $row->dataAset->nama_aset ?? '-' }}</td>

                            <td>Rp {{ number_format($row->harga_sewa ?? 0, 0, ',', '.') }}</td>

                        </tr>
                        @endforeach
                    </tbody>

                </table>
            </div>
        </div>

    </div>
</div>

@endsection
