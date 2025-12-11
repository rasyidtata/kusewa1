@extends('template.admin')

@section('title', 'halaman | Perjanjian')

@section('content')
<div class="container-form-biodata">
    <div class="text-start p-3">
        <a> Perjanjian Mitra KAI DAOP 6 Yogyakarta</a>
    </div>
    <div class="card card-form">
        <div class="card-header-form text- text-center py-3">
            <h4 class="card-title-form mb-0">DATA DIRI</h4>
        </div>
        <hr>
        <div class="card-body p-2">
            <form method="POST" action="{{ url('pendaftaran/update/'.$dataps->id_perjanjian) }}" enctype="multipart/form-data">
                @csrf
                <!-- Tampilkan error validasi -->
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <!-- Tampilkan pesan sukses -->
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                <div class="row justify-content-star">
                    <div class="col-md-6 mb-3">
                        <div class="form-group">
                            <label for="jenis penyewaan" class="form-label fw-medium"></label>
                            <div class="row">
                                <div class="col-4">
                                    <input type="text" id="jenis_penyewa" name="jenis_penyewa" class="form-control"
                                        placeholder="-" value="{{ old('Jenis', $dataps->dataMitra->Jenis ?? '') }}">
                                </div>
                                <div class="col-4">
                                    <input type="text" id="kategori" name="kategori" class="form-control"
                                        placeholder="-" value="{{ old('kategori', $dataps->dataMitra->kategori ?? '') }}">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <!-- Data Pribadi -->
                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="card-title">
                            <i class="bi bi-person-badge me-2"></i>Data Pribadi
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="nama_lengkap" class="form-label fw-medium">Nama Lengkap</label>
                                    <input type="text" id="nama_lengkap" name="nama_lengkap" class="form-control"
                                        placeholder="Masukkan nama lengkap"
                                        value="{{ old('nama', $dataps->dataMitra->nama ?? '') }}" >

                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="nik" class="form-label fw-medium">NIK</label>
                                    <input type="text" id="nik" name="nik" class="form-control"
                                        placeholder="Masukkan NIK"
                                        value="{{ old('no_identitas', $dataps->dataMitra->no_identitas ?? '') }}">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="masa_berlaku_ktp" class="form-label fw-medium">Masa Berlaku KTP</label>
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <i class="bi bi-calendar3"></i>
                                        </span>
                                        <input type="date" id="masa_berlaku_ktp" name="masa_berlaku_ktp"
                                            class="form-control"
                                            value="{{ $dataps->dataMitra->masa_berlaku_identitas_formatted ?? '' }}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="email" class="form-label fw-medium">Alamat E-mail</label>
                                    <input type="email" id="email" name="email" class="form-control"
                                        placeholder="email@contoh.com"
                                        value="{{ old('email', $dataps->dataMitra->email ?? '') }}" >
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Kontak Informasi -->
                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="card-title">
                            <i class="bi bi-whatsapp me-2"></i>Kontak Informasi
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="no_telepon" class="form-label fw-medium">No Telepon/WA</label>
                                    <input type="tel" id="no_telepon" name="no_telepon" class="form-control"
                                        placeholder="08xxxxxxxxxx"
                                        value="{{ old('no_tlpn', $dataps->dataMitra->no_tlpn ?? '') }}" >
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="tanggal_perjanjian" class="form-label fw-medium">Tanggal
                                        Perjanjian</label>
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <i class="bi bi-calendar3"></i>
                                        </span>
                                        <input type="date" id="tanggal_perjanjian" name="tanggal_perjanjian"
                                            class="form-control"
                                            value="{{ $dataps->dataMitra->tgl_perjanjian_formatted ?? '' }}" >
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="penyewa_berdasarkan" class="form-label fw-medium">Penyewa
                                        Berdasarkan</label>
                                    <input type="text" id="penyewa_berdasarkan" name="penyewa_berdasarkan"
                                        class="form-control" placeholder="Berdasarkan" 
                                        value="{{ old('penyewa_berdasarkan', $dataps->dataMitra->penyewa_berdasarkan ?? '') }}" required.>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="alamat" class="form-label fw-medium">Alamat</label>
                                    <textarea id="alamat" name="alamat" class="form-control" rows="3"
                                        placeholder="Masukkan alamat lengkap"
                                        >{{ old('alamat', $dataps->dataMitra->alamat ?? '') }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Upload KTP -->
                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="card-title">
                            <i class="bi bi-cloud-upload me-2"></i>Upload Dokumen
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="foto_identitas" class="form-label fw-medium">Foto Identitas (KTP/SIM)</label>
                            <input type="file" id="foto_identitas" name="foto_identitas" class="form-control" accept="image/*,.pdf">
                            
                            @if($dataps->dataMitra->foto_identitas)
                                <div class="mt-3">
                                    <label class="form-label">Foto Saat Ini:</label><br>
                                    @if(pathinfo($dataps->dataMitra->foto_identitas, PATHINFO_EXTENSION) === 'pdf')
                                        <div class="alert alert-info">
                                            <i class="bi bi-file-pdf me-2"></i>File PDF: 
                                            <a href="{{ asset($dataps->dataMitra->foto_identitas) }}" target="_blank" class="ms-2">
                                                Lihat Dokumen
                                            </a>
                                        </div>
                                    @else
                                        <img src="{{ asset($dataps->dataMitra->foto_identitas) }}" 
                                            alt="Foto Identitas" 
                                            class="img-thumbnail mt-2"
                                            style="max-width: 300px; max-height: 200px; object-fit: cover;">
                                    @endif
                                    
                                    <!-- Tombol hapus foto -->
                                    <div class="mt-2">
                                        <button type="button" class="btn btn-danger btn-sm" 
                                            onclick="confirmDeleteFoto('{{ $dataps->dataMitra->id_mitra }}')">
                                            <i class="bi bi-trash me-1"></i>Hapus Foto
                                        </button>
                                    </div>
                                </div>
                            @else
                                <div class="mt-2">
                                    <div class="alert alert-warning">
                                        <i class="bi bi-exclamation-triangle me-2"></i>Belum ada foto identitas yang diupload
                                    </div>
                                </div>
                            @endif
                            
                            <div class="form-text">
                                <small class="text-muted">*Isi sesuai dengan data diri yang benar</small><br>
                                <small class="text-muted">**File yang bisa di upload berupa jpg, jpeg, png, pdf (maks. 2MB)</small>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Data Perusahaan -->
                <div class="card mb-4" id="data-perusahaan">
                    <div class="card-header">
                        <h5 class="card-title">
                            <i class="bi bi-building me-2"></i>Data Perusahaan
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="nama_perwakilan" class="form-label fw-medium">Nama Perwakilan</label>
                                    <input type="text" id="nama_perwakilan" name="nama_perwakilan" class="form-control"
                                        placeholder="-"
                                        value="{{ old('nama_perwakilan', $dataps->dataMitra->nama_perwakilan ?? '') }}"
                                        >
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="perwakilan_selaku" class="form-label fw-medium">Perwakilan
                                        Selaku</label>
                                    <input type="text" id="perwakilan_selaku" name="perwakilan_selaku"
                                        class="form-control" placeholder="-"
                                        value="{{ old('penyewa_selaku', $dataps->dataMitra->penyewa_selaku ?? '') }}"
                                        >
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="npwp" class="form-label fw-medium">NPWP</label>
                                    <input type="text" id="npwp" name="npwp" class="form-control" placeholder="-"
                                        value="{{ old('npwp', $dataps->dataMitra->npwp ?? '') }}" >
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="kota_penyewa" class="form-label fw-medium">Kota Penyewa</label>
                                    <input type="text" id="kota_penyewa" name="kota_penyewa" class="form-control"
                                        placeholder="-"
                                        value="{{ old('kota_penyewa', $dataps->dataMitra->kota_penyewa ?? '') }}"
                                        >
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="kode_pos" class="form-label fw-medium">Kode Pos</label>
                                    <input type="text" id="kode_pos" name="kode_pos" class="form-control"
                                        placeholder="-"
                                        value="{{ old('kode_pos', $dataps->dataMitra->kode_pos ?? '') }}" >
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="fax_penyewa" class="form-label fw-medium">FAX Penyewa</label>
                                    <input type="text" id="fax_penyewa" name="fax_penyewa" class="form-control"
                                        placeholder="-"
                                        value="{{ old('fax_penyewa', $dataps->dataMitra->fax_penyewa ?? '') }}"
                                        >
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="no_akte_pendirian" class="form-label fw-medium">Nomor Akte
                                        Pendirian</label>
                                    <input type="text" id="no_akte_pendirian" name="no_akte_pendirian"
                                        class="form-control" placeholder="-"
                                        value="{{ old('no_akta_pendirian', $dataps->dataMitra->no_akta_pendirian ?? '') }}"
                                        >
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="tanggal_anggaran_dasar" class="form-label fw-medium">Tanggal Anggaran
                                        Dasar</label>
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <i class="bi bi-calendar3"></i>
                                        </span>
                                        <input type="date" id="tanggal_anggaran_dasar" name="tanggal_anggaran_dasar"
                                            placeholder="-" class="form-control"
                                            value="{{ $dataps->dataMitra->tgl_anggaran_dasar_formatted ?? '' }}"
                                            >
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="no_anggaran_dasar" class="form-label fw-medium">Nomor Anggaran Dasar
                                        Terakhir</label>
                                    <input type="text" id="no_anggaran_dasar" name="no_anggaran_dasar"
                                        class="form-control" placeholder="-"
                                        value="{{ old('no_anggaran_dasar', $dataps->dataMitra->no_anggaran_dasar ?? '') }}"
                                        >
                                </div>
                            </div>
                            

                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="tanggal_kemenkumham" class="form-label fw-medium">Tanggal Persetujuan
                                        Kemenkum dan HAM</label>
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <i class="bi bi-calendar3"></i>
                                        </span>
                                        <input type="date" id="tgl_persetujuan_kenmenhum_dan_ham"
                                            name="tgl_persetujuan_kenmenhum_dan_ham" class="form-control"
                                            placeholder="-"
                                            value="{{ $dataps->dataMitra->tgl_persetujuan_kenmenhum_dan_ham_formatted ?? '' }}"
                                            >
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="no_kenmenhum_dan_ham" class="form-label fw-medium">Nomor Kemenkum dan
                                        HAM</label>
                                    <input type="text" id="no_kenmenhum_dan_ham" name="no_kenmenhum_dan_ham" class="form-control"
                                        placeholder="-"
                                        value="{{ old('no_kenmenhum_dan_ham', $dataps->dataMitra->no_kenmenhum_dan_ham ?? '') }}"
                                        >
                                </div>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="tgl_penetapan_pengadilan" class="form-label fw-medium">Tanggal
                                        Penetapan Pengadilan (CV)</label>
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <i class="bi bi-calendar3"></i>
                                        </span>
                                        <input type="date" id="tgl_penetapan_pengadilan"
                                            name="tgl_penetapan_pengadilan" class="form-control" placeholder="-"
                                            value="{{ $dataps->dataMitra->tgl_penetapan_pengadilan_formatted ?? '' }}"
                                            >
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="no_penetapan_pengadilan" class="form-label fw-medium">Nomor Penetapan
                                        Pengadilan (CV)</label>
                                    <input type="text" id="no_penetapan_pengadilan" name="no_penetapan_pengadilan"
                                        class="form-control" placeholder="-"
                                        value="{{ old('no_penetapan_pengadilan', $dataps->dataMitra->no_penetapan_pengadilan ?? '') }}"
                                        >
                                </div>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="tgl_izin_usaha" class="form-label fw-medium">Tanggal Izin
                                        Berusaha</label>
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <i class="bi bi-calendar3"></i>
                                        </span>
                                        <input type="date" id="tgl_izin_usaha"
                                            name="tgl_izin_usaha" class="form-control" placeholder="-"
                                            value="{{ $dataps->dataMitra->tgl_izin_usaha_formatted ?? '' }}" >
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="no_izin_berusaha" class="form-label fw-medium">Nomor Izin
                                        Berusaha</label>
                                    <input type="text" id="no_izin_berusaha" name="no_izin_berusaha"
                                        class="form-control" placeholder="-"
                                        value="{{ old('no_izin_berusaha', $dataps->dataMitra->no_izin_berusaha ?? '') }}"
                                        >
                                </div>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="tanggal_surat_keterangan_pajak" class="form-label fw-medium">Tanggal
                                        Surat Keterangan Terdaftar Dirjen Pajak</label>
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <i class="bi bi-calendar3"></i>
                                        </span>
                                        <input type="date" id="tgl_sk_dirjen_pajak"
                                            name="tgl_sk_dirjen_pajak" class="form-control"
                                            placeholder="-"
                                            value="{{ $dataps->dataMitra->tgl_sk_dirjen_pajak_formatted ?? '' }}"
                                            >
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="sk_dirjen_pajak" class="form-label fw-medium">Surat Keterangan
                                        Terdaftar Dirjen Pajak</label>
                                    <input type="text" id="sk_dirjen_pajak" name="sk_dirjen_pajak"
                                        class="form-control" placeholder="-"
                                        value="{{ old('sk_dirjen_pajak', $dataps->dataMitra->sk_dirjen_pajak ?? '') }}"
                                        >
                                </div>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="tgl_surat_pengukuhan_kena_pajak" class="form-label fw-medium">Tanggal Surat
                                        Pengukuhan Pengusaha Kena Pajak</label>
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <i class="bi bi-calendar3"></i>
                                        </span>
                                        <input type="date" id="tgl_surat_pengukuhan_kena_pajak"
                                            name="tgl_surat_pengukuhan_kena_pajak" class="form-control"
                                            placeholder="-"
                                            value="{{ $dataps->dataMitra->tgl_surat_pengukuhan_kena_pajak_formatted ?? '' }}"
                                            >
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="surat_pengukuhan_kena_pajak" class="form-label fw-medium">Surat Pengukuhan
                                        Pengusaha Kena Pajak</label>
                                    <input type="text" id="surat_pengukuhan_kena_pajak" name="surat_pengukuhan_kena_pajak"
                                        class="form-control" placeholder="-"
                                        value="{{ old('surat_pengukuhan_kena_pajak', $dataps->dataMitra->surat_pengukuhan_kena_pajak ?? '') }}"
                                        >
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card mb-4" id="data-asset">
                    <div class="card-header">
                        <h5 class="card-title">
                            <i class="bi bi-house-door me-2"></i>Data Asset
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="alamat_asset" class="form-label fw-medium">Alamat Lokasi
                                        Asset</label>
                                    <textarea id="alamat_asset" name="alamat_asset" class="form-control" rows="3"
                                        placeholder="-" value="340413140998788001"
                                        >{{ old('lokasi', $dataps->dataAset->lokasi ?? '') }}</textarea>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="penggunaan_asset" class="form-label fw-medium">Penggunaan Lokasi
                                        Asset</label>
                                    <textarea id="penggunaan_asset" name="penggunaan_asset" class="form-control"
                                        rows="3" placeholder="-" value="340413140998788001"
                                        > {{ old('penggunaan_objek', $dataps->dataAset->penggunaan_objek ?? '') }}</textarea>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="luas_tanah" class="form-label fw-medium">Luas Tanah (m²)</label>
                                    <input type="" id="luas_tanah" name="luas_tanah" class="form-control"
                                        placeholder="Luas Tanah Dalan m"
                                        value="{{ old('luas_tanah', $dataps->dataAset->luas_tanah ?? '') }}" >
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="luas_bangunan" class="form-label fw-medium">Luas Bangunan (m²)</label>
                                    <input type="" id="luas_bangunan" name="luas_bangunan" class="form-control"
                                        placeholder="Luas Bangunan Dalam m"
                                        value="{{ old('luas_bangunan', $dataps->dataAset->luas_bangunan ?? '') }}">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label class="form-label fw-medium">Jangka Waktu Sewa</label>
                                    <div class="row">
                                        <div class="col-4">
                                            <label class="form-label small">Tahun</label>
                                            <input type="number" id="tahun" name="tahun" class="form-control"
                                                placeholder="0" min="0"
                                                value="{{ old('tahun', $dataps->jangka_waktu_tahun ?? 0) }}">
                                        </div>
                                        <div class="col-4">
                                            <label class="form-label small">Bulan</label>
                                            <input type="number" id="bulan" name="bulan" class="form-control"
                                                placeholder="0" min="0" max="11"
                                                value="{{ old('bulan', $dataps->jangka_waktu_bulan ?? 0) }}">
                                        </div>
                                        <div class="col-4">
                                            <label class="form-label small">Hari</label>
                                            <input type="number" id="hari" name="hari" class="form-control"
                                                placeholder="0" min="0" max="30"
                                                value="{{ old('hari', $dataps->jangka_waktu_hari ?? 0) }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="masa_awal_perjanjian" class="form-label fw-medium">Massa Awal
                                        Perjanjian</label>
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <i class="bi bi-calendar3"></i>
                                        </span>
                                        <input type="text" id="masa_awal_perjanjian" name="masa_awal_perjanjian"
                                            class="form-control" value="{{ $dataps->masa_awal_perjanjian_formatted ?? '' }}" >
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="masa_akhir_perjanjian" class="form-label fw-medium">Massa Akhir
                                        Perjanjian</label>
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <i class="bi bi-calendar3"></i>
                                        </span>
                                        <input type="text" id="masa_akhir_perjanjian" name="masa_akhir_perjanjian"
                                            class="form-control" value="{{ $dataps->masa_akhir_perjanjian_formatted ?? '' }}" >
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="masa_awal_pemanfaatan" class="form-label fw-medium">Massa Awal
                                        Pemanfaatan</label>
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <i class="bi bi-calendar3"></i>
                                        </span>
                                        <input type="date" id="masa_awal_pemanfaatan" name="masa_awal_pemanfaatan"
                                            class="form-control" value="{{ $dataps->masa_awal_manfaat_formatted ?? '' }}" >
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="masa_akhir_pemanfaatan" class="form-label fw-medium">Massa Akhir
                                        Pemanfaatan</label>
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <i class="bi bi-calendar3"></i>
                                        </span>
                                        <input type="date" id="masa_akhir_pemanfaatan" name="masa_akhir_pemanfaatan"
                                            class="form-control" value="{{ $dataps->masa_akhir_manfaat_formatted ?? '' }}" >
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <!-- Harga Asset -->
                <div class="card mb-4" id="data-asset">
                    <div class="card-header">
                        <h5 class="card-title">
                            <i class="bi bi-calculator me-2"></i>Harga Asset
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="harga_sewa" class="form-label fw-medium">Harga Sewa (Rp.)</label>
                                    <input type="text" id="harga_sewa_display" class="form-control"
                                        placeholder="-- Masukan harga sewa --" value="{{ number_format($dataps->harga_sewa ?? 0, 0, ',', '.') }}">
                                    <input type="hidden" id="harga_sewa" name="harga_sewa" >
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="harga_pemanfaatan" class="form-label fw-medium">Harga
                                        Pemanfaatan (Rp.)</label>
                                    <input type="text" id="harga_pemanfaatan_display"class="form-control" 
                                        placeholder="-- Masukan harga pemanfaatan --" value="{{ number_format($dataps->harga_pemanfaatan ?? 0, 0, ',', '.') }}">
                                    <input type="hidden" id="harga_pemanfaatan" name="harga_pemanfaatan">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="biaya_admin" class="form-label fw-medium">Biaya Admin (Rp.)</label>
                                    <input type="text" id="biaya_admin_display" class="form-control"
                                        placeholder="-- Masukan biaya admin --" value="{{ number_format($dataps->biaya_admin_ukur ?? 0, 0, ',', '.') }}">
                                    <input type="hidden" id="biaya_admin" name="biaya_admin" >
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="cost_of_money" class="form-label fw-medium">Cost Of Money (Rp.)</label>
                                    <input type="text" id="cost_of_money_display" class="form-control"
                                        placeholder="-- Masukan biaya COM --" value="{{ number_format($dataps->cost_of_money ?? 0, 0, ',', '.') }}">
                                    <input type="hidden" id="cost_of_money" name="cost_of_money" >
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="harga_sewa_admin" class="form-label fw-medium">Harga Sewa + Admin (Rp.)</label>
                                    <input type="text" id="harga_sewa_admin_display"
                                        class="form-control" placeholder="Rp." value="{{ number_format($dataps->harga_sewa_admin ?? 0, 0, ',', '.') }}" >
                                    <input type="hidden" id="harga_sewa_admin" name="harga_sewa_admin" >
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="harga_sewa_admin_com" class="form-label fw-medium">Harga Sewa + Admin +
                                        COM (Rp.)</label>
                                    <input type="text" id="harga_sewa_admin_com_display"
                                        class="form-control" placeholder="Rp." value="{{ number_format($dataps->harga_sewa_admin_com ?? 0, 0, ',', '.') }}" >
                                    <input type="hidden" id="harga_sewa_admin_com" name="harga_sewa_admin_com" >
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="ppn" class="form-label fw-medium">PPN 11% (Rp.)</label>
                                    <input type="text" id="ppn_display" class="form-control" placeholder="Rp."
                                        value="{{ number_format($dataps->ppn_11_persen ?? 0, 0, ',', '.') }}">
                                    <input type="hidden" id="ppn" name="ppn" >
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="total_harga" class="form-label fw-medium">Total Harga (Rp.)</label>
                                    <input type="text" id="total_harga_display" class="form-control"
                                        placeholder="-" value="{{ number_format($dataps->total_harga ?? 0, 0, ',', '.') }}">
                                    <input type="hidden" id="total_harga" name="total_harga" >
                                </div>
                            </div>
                        </div>

                        <div class="row ">
                            <div class="col-md-6 mb-3">
                                <div class="form-group p-4 text-warning">
                                    <p>* cek kembali nominal yang anda masukan<br>
                                        ** pastikan nomor terbilang ditulis dengan benar
                                    </p>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3 ">
                                <div class="form-group ">
                                    <label for="terbilang" class="form-label fw-medium">Terbilang</label>
                                    <textarea id="terbilang" name="terbilang" class="form-control" rows="3"
                                        placeholder="-">{{ old('terbilang', $dataps->terbilang ?? '') }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="card mb-4 border-0 p-5">
                    <div class="row row-list-perjanjian p-4">
                        <div class="col-4">
                            <a href="{{ url('pendaftaran/fitur_filter') }}"
                                class="btn btn-kembali px-5 text-decoration-none">
                                <i class="bi bi-arrow-left-circle me-2"></i>kembali
                            </a>
                            </button>
                        </div>
                        <div class="col-4">
                            <button type="submit" class="btn btn-share px-5">
                                <i class="bi bi-share me-2"></i>Update
                            </button>
                        </div>
                        
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function confirmDeleteFoto(idMitra) {
    if (confirm('Apakah Anda yakin ingin menghapus foto identitas?')) {
        fetch(`/pendaftaran/foto/${idMitra}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Foto berhasil dihapus');
                location.reload();
            } else {
                alert('Gagal menghapus foto: ' + data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Terjadi kesalahan saat menghapus foto');
        });
    }
}

// Format input harga
document.addEventListener('DOMContentLoaded', function() {
    // Format currency untuk input harga
    const currencyInputs = [
        'harga_sewa_display', 'harga_pemanfaatan_display', 'biaya_admin_display',
        'cost_of_money_display', 'harga_sewa_admin_display', 'harga_sewa_admin_com_display',
        'ppn_display', 'total_harga_display'
    ];

    currencyInputs.forEach(inputId => {
        const displayInput = document.getElementById(inputId);
        const hiddenInput = document.getElementById(inputId.replace('_display', ''));
        
        if (displayInput && hiddenInput) {
            // Format tampilan
            displayInput.addEventListener('input', function(e) {
                let value = e.target.value.replace(/[^\d]/g, '');
                hiddenInput.value = value;
                displayInput.value = formatCurrency(value);
            });

            // Inisialisasi nilai
            if (hiddenInput.value) {
                displayInput.value = formatCurrency(hiddenInput.value);
            }
        }
    });

    function formatCurrency(number) {
        return new Intl.NumberFormat('id-ID').format(number);
    }
});
</script>
@endsection