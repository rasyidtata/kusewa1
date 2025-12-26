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
                                        <a href="{{ url('pendaftaran/form_edit/'.encrypt($datmit->id_perjanjian)) }}"
                                            class="btn  btn-for-edit">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>
                                         <a href="{{ url('pendaftaran/detail/'.encrypt($datmit->id_perjanjian)) }}" 
                                        class="btn  btn-for-detail">
                                            <i class="bi bi-book"></i>
                                        </a>
                                        <form action="{{ url('produk/delete/'.$datmit->id_perjanjian) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-for-delet"
                                                data-nama="{{ $datmit->nama }}">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
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
                                        <a href="{{ url('pendaftaran/detail/'.encrypt($datmit->id_perjanjian)) }}" 
                                        class="btn btn-for-detail">
                                            <i class="bi bi-book"></i>
                                        </a>
                                        <form action="{{ route('perjanjian.destroy', $datmit->id_perjanjian) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-for-delet"
                                                data-nama="{{ $datmit->nama }}">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
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
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Handle semua form delete dengan sweetalert
    const deleteForms = document.querySelectorAll('form[action*="delete"]');
    
    deleteForms.forEach(form => {
        const deleteBtn = form.querySelector('.btn-for-delet');
        
        if (deleteBtn) {
            deleteBtn.addEventListener('click', function(e) {
                e.preventDefault();

                const nama = this.getAttribute('data-nama');
                
                Swal.fire({
                    title: '',
                    html: `
                        <div style="text-align: center;">
                            <h4 style="color: #1f2937;">Hapus Data ?</h4>
                            
                            <p style="color: #a11212ff; font-size: 18px;"><strong>${nama || 'N/A'}</strong></p>
                            <div style="background: #ffefefff; padding: 10px; border-radius: 5px; margin: 15px 0;">
                                <p style="color: #af1e1eff; margin: 0; font-size: 14px;">
                                    <i class="bi bi-info-circle me-1"></i>
                                    <strong>Data yang dihapus tidak dapat dikembalikan!</strong>
                                </p>
                            </div>
                            <p style="color: #6b7280; margin-bottom: 5px; font-size: 14px; font-style: italic;">
                                Apakah anda yakin?
                            </p>
                        </div>
                    `,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Hapus Sekarang',
                    cancelButtonText: 'Batalkan',
                    confirmButtonColor: '#dc2626',
                    cancelButtonColor: '#6b7280',
                    focusCancel: true,
                    customClass: {}
                })
                .then((result) => {
                    if (result.isConfirmed) {
                        // Tampilkan loading indicator
                        Swal.fire({
                            title: 'Menghapus...',
                            text: 'Sedang memproses permintaan',
                            allowOutsideClick: false,
                            didOpen: () => {
                                Swal.showLoading();
                            }
                        });
                        
                        // Submit form setelah 500ms delay
                        setTimeout(() => {
                            form.submit();
                        }, 500);
                    }
                });
            });
        }
    });
    
    // Toast untuk notifikasi sukses/error
    @if(session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: '{{ session('success') }}',
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            background: '#10b981',
            color: 'white',
            iconColor: 'white'
        });
    @endif
    @if(session('error'))
        Swal.fire({
            icon: 'error',
            title: 'Gagal!',
            text: '{{ session('error') }}',
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 4000,
            timerProgressBar: true,
            background: '#dc2626',
            color: 'white',
            iconColor: 'white'
        });
    @endif
    @if (session('warning'))
        Swal.fire({
            icon: 'warning',
            title: 'Peringatan!',
            text: '{{ session('warning') }}',
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 4000,
            timerProgressBar: true,
            background: '#f59e0b',
            color: 'white',
            iconColor: 'white'
        });
    @endif
});
</script>
<style>
    .swal2-popup {
        border-radius: 12px;
        font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
    }

    .swal2-title {
        font-size: 1.25rem;
        font-weight: 600;
    }

</style>

@endsection