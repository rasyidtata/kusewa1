@extends('template.admin')

@section('title', 'halaman | List Data')

@section('content')
<div class="container-list-pegawai">
    <div class="text-start p-3">
        <a>List Data Perjanjian Penyewaan</a>
    </div>

    <div class="container card-list-pegawai">
        <div class="card-header">
            <div class="row">
                <div class="col-10">
                    <p class="card-title">List Data Pegawai</p>
                </div>
            </div>
        </div>
        <div class="table-list-pegawai-responsive">
            <table class="table table-list-pegawai">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Password</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pegawai as $data)
                    <tr>
                        <td data-label="No" class="text-center">{{ $loop->iteration }}</td>
                        <td data-label="Nama" class="text-start">{{ $data->name }}</td>
                        <td data-label="Email" class="text-center">{{ $data->email }}</td>
                        <td data-label="password" class="text-center">**********</td>
                        <td data-label="Aksi" class="text-center">
                            <div class="btn-aksi" role="group">
                                <a href="#" class="btn btn-for-edit">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                                
                                <!-- Form dengan ID yang unik -->
                                <form action="{{ route('admin.pegawai.delete', $data->id) }}" 
                                      method="POST" 
                                      id="delete-form-{{ $data->id }}" 
                                      class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <!-- Tombol dengan class yang sesuai di JavaScript -->
                                    <button type="button" 
                                            class="btn btn-sm btn-for-delet btn-delete" 
                                            data-id="{{ $data->id }}" 
                                            data-nama="{{ $data->name }}">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center">Tidak ada data pegawai ditemukan</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    // Function delete dengan SweetAlert2
    document.addEventListener('DOMContentLoaded', function() {
        console.log('DOM loaded'); // Untuk debugging
        
        // Pilih semua tombol dengan class btn-delete
        const deleteButtons = document.querySelectorAll('.btn-delete');
        console.log('Found delete buttons:', deleteButtons.length); // Untuk debugging
        
        deleteButtons.forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault();
                e.stopPropagation();
                
                // Ambil data dari atribut tombol
                const id = this.getAttribute('data-id');
                const nama = this.getAttribute('data-nama');
                
                console.log('Delete button clicked:', id, nama); // Untuk debugging
                
                // Tampilkan konfirmasi SweetAlert
                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: `Data pegawai "${nama}" akan dihapus secara permanen!`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal',
                    reverseButtons: true,
                    showCloseButton: true,
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Tampilkan loading
                        Swal.fire({
                            title: 'Menghapus...',
                            text: 'Mohon tunggu sebentar',
                            allowOutsideClick: false,
                            allowEscapeKey: false,
                            showConfirmButton: false,
                            didOpen: () => {
                                Swal.showLoading();
                            }
                        });
                        
                        // Submit form
                        setTimeout(() => {
                            document.getElementById(`delete-form-${id}`).submit();
                        }, 500);
                    }
                });
            });
        });
    });

    // Notifikasi session
    @if(session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: '{{ session('success') }}',
            showConfirmButton: true,
            confirmButtonColor: '#28a745',
            timer: 3000,
            timerProgressBar: true
        });
    @endif

    @if(session('error'))
        Swal.fire({
            icon: 'error',
            title: 'Gagal!',
            text: '{{ session('error') }}',
            showConfirmButton: true,
            confirmButtonColor: '#dc3545'
        });
    @endif
</script>

<!-- Tambahkan CSS -->
<style>
    
    .alert {
        margin: 15px 20px;
        border-radius: 8px;
    }
</style>
@endsection