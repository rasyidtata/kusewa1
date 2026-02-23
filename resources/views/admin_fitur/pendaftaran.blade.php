@extends('template.admin')

@section('title', 'halaman | Pendaftaran Akun Pegawai')

@section('content')
<div class="container-form-biodata">
    <div class="text-start p-3">
        <a> Halaman tambah akun kusewa pegawai lapangan DAOP 6 YK</a>
    </div>
    <div class="card card-form">
        <div class="card-header-form text- text-center py-3">
            <h4 class="card-title-form mb-0">FORM TAMBAH AKUN PEGAWAI</h4>
        </div>
        <hr>

        <div class="card-body p-2">
            <form id="updateForm" method="POST" action="{{ url('/admin_fitur/pendaftaran/create') }}" enctype="form-data">
                @csrf
                <!-- Data Pribadi -->
                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="card-title">
                            <i class="bi bi-person-badge me-2"></i>Masukan Data Akun Baru
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="nama" class="form-label fw-medium">Nama Lengkap</label>
                                    <input type="text" id="nama" name="nama" class="form-control"
                                        placeholder="-- Masukkan nama lengkap --" required>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="email" class="form-label fw-medium">Alamat E-mail</label>
                                    <input type="email" id="email" name="email" class="form-control"
                                        placeholder="-- Masukan alamat email --" required>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                <label for="role" class="form-label fw-medium">Role Pegawai</label>
                                <select id="role" name="role"
                                        class="form-control kategori-border pe-5"required>
                                    <option value="" disabled selected>-- Pilih Role Pegawai --</option>
                                    <option value="pegawai">pegawai</option>
                                    <option value="admin">admin</option>
                                </select>
                                <i id="iconKategori" class="bi bi-chevron-left dropdown-icon"></i>
                            </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="password" class="form-label fw-medium">Password</label>
                                    <input type="password" id="password" name="password" class="form-control"
                                        placeholder="-- Masukan password --" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-tombol border-0 ">
                        <div class="card-body text-end pt-0">
                            <button type="button" class="btn px-5 prev-step" onclick="window.location.href='{{ url('/') }}';">
                                <i class="bi bi-arrow-left-circle me-2"></i>Kembali
                            </button>
                            <button type="submit" id="submitFormBtn" class="btn btn-simpan-data px-5">
                                <i class="bi bi-check-circle me-2"></i>Simpan Data
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection