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
            <form id="updateForm" method="POST" action="{{ url('pendaftaran/update/'.encrypt($dataps->id_perjanjian)) }}"
                enctype="multipart/form-data">
                @csrf
                <!-- Tampilkan error validasi dengan SweetAlert -->
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <div class="row justify-content-star">
                    <div class="col-md-6 mb-3">
                        <div class="form-group">
                            <label for="jenis penyewaan" class="form-label fw-medium"></label>
                            <div class="row">
                                <div class="col-4">
                                    <input type="text" id="jenis_penyewa" name="jenis_penyewa" class="form-control"
                                        placeholder="-" value="{{ old('Jenis', $dataps->dataMitra->Jenis ?? '') }}" readonly>
                                </div>
                                <div class="col-4">
                                    <input type="text" id="kategori" name="kategori" class="form-control"
                                        placeholder="-"
                                        value="{{ old('kategori', $dataps->dataMitra->kategori ?? '') }}" readonly>
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
                                        value="{{ old('nama', $dataps->dataMitra->nama ?? '') }}">

                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="email" class="form-label fw-medium">Alamat E-mail</label>
                                    <input type="email" id="email" name="email" class="form-control"
                                        placeholder="email@contoh.com"
                                        value="{{ old('email', $dataps->dataMitra->email ?? '') }}">
                                </div>
                            </div>
                        </div>

                        <div class="row">
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
                                            value="{{ $dataps->dataMitra->tgl_perjanjian_formatted ?? ''}}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="alamat" class="form-label fw-medium">Alamat</label>
                                    <textarea id="alamat" name="alamat" class="form-control" rows="3"
                                        placeholder="Masukkan alamat lengkap">{{ old('alamat', $dataps->dataMitra->alamat ?? '') }}</textarea>
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
                                        value="{{ old('no_tlpn', $dataps->dataMitra->no_tlpn ?? '') }}">
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="penyewa_berdasarkan" class="form-label fw-medium">Penyewa
                                        Berdasarkan</label>
                                    <input type="text" id="penyewa_berdasarkan" name="penyewa_berdasarkan"
                                        class="form-control" placeholder="Berdasarkan"
                                        value="{{ old('penyewa_berdasarkan', $dataps->dataMitra->penyewa_berdasarkan ?? '') }}"
                                        required.>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="masa_berlaku_ktp" class="form-label fw-medium">Masa Berlaku KTP</label>
                                    <input type="text" id="masa_berlaku_ktp" name="masa_berlaku_ktp"
                                        class="form-control" value="{{ $dataps->dataMitra->masa_berlaku_identitas}}">
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="nik" class="form-label fw-medium">Nomor Identitas/NIK</label>
                                    <input type="text" id="nik" name="nik" class="form-control"
                                        placeholder="Masukkan NIK"
                                        value="{{ old('no_identitas', $dataps->dataMitra->no_identitas ?? '') }}">
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
                            <input type="file" id="foto_identitas" name="foto_identitas" class="form-control"
                                accept="image/*,.pdf">

                            @if($dataps->dataMitra->foto_identitas)
                            <div class="mt-3">
                                <label class="form-label">Foto Saat Ini:</label><br>
                                @if(pathinfo($dataps->dataMitra->foto_identitas, PATHINFO_EXTENSION) === 'pdf')
                                <div class="alert alert-info">
                                    <i class="bi bi-file-pdf me-2"></i>File PDF:
                                    <a href="{{ asset($dataps->dataMitra->foto_identitas) }}" target="_blank"
                                        class="ms-2">
                                        Lihat Dokumen
                                    </a>
                                </div>
                                @else
                                <img src="{{ asset($dataps->dataMitra->foto_identitas) }}" alt="Foto Identitas"
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
                                    <i class="bi bi-exclamation-triangle me-2"></i>Belum ada foto identitas yang
                                    diupload
                                </div>
                            </div>
                            @endif

                            <div class="form-text">
                                <small class="text-muted">*Isi sesuai dengan data diri yang benar</small><br>
                                <small class="text-muted">**File yang bisa di upload berupa jpg, jpeg, png, pdf (maks.
                                    2MB)</small>
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
                                        value="{{ old('nama_perwakilan', $dataps->dataMitra->nama_perwakilan ?? '') }}">
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="perwakilan_selaku" class="form-label fw-medium">Perwakilan
                                        Selaku</label>
                                    <input type="text" id="perwakilan_selaku" name="perwakilan_selaku"
                                        class="form-control" placeholder="-"
                                        value="{{ old('penyewa_selaku', $dataps->dataMitra->penyewa_selaku ?? '') }}">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="npwp" class="form-label fw-medium">NPWP</label>
                                    <input type="text" id="npwp" name="npwp" class="form-control" placeholder="-"
                                        value="{{ old('npwp', $dataps->dataMitra->npwp ?? '') }}">
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="kota_penyewa" class="form-label fw-medium">Kota Penyewa</label>
                                    <input type="text" id="kota_penyewa" name="kota_penyewa" class="form-control"
                                        placeholder="-"
                                        value="{{ old('kota_penyewa', $dataps->dataMitra->kota_penyewa ?? '') }}">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="kode_pos" class="form-label fw-medium">Kode Pos</label>
                                    <input type="text" id="kode_pos" name="kode_pos" class="form-control"
                                        placeholder="-"
                                        value="{{ old('kode_pos', $dataps->dataMitra->kode_pos ?? '') }}">
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="fax_penyewa" class="form-label fw-medium">FAX Penyewa</label>
                                    <input type="text" id="fax_penyewa" name="fax_penyewa" class="form-control"
                                        placeholder="-"
                                        value="{{ old('fax_penyewa', $dataps->dataMitra->fax_penyewa ?? '') }}">
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
                                        value="{{ old('no_akta_pendirian', $dataps->dataMitra->no_akta_pendirian ?? '') }}">
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
                                            value="{{ $dataps->dataMitra->tgl_anggaran_dasar_formatted ?? '' }}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="no_anggaran_dasar" class="form-label fw-medium">Nomor Anggaran Dasar
                                        Terakhir</label>
                                    <input type="text" id="no_anggaran_dasar" name="no_anggaran_dasar"
                                        class="form-control" placeholder="-"
                                        value="{{ old('no_anggaran_dasar', $dataps->dataMitra->no_anggaran_dasar ?? '') }}">
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
                                            value="{{ $dataps->dataMitra->tgl_persetujuan_kenmenhum_dan_ham_formatted ?? '' }}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="no_kenmenhum_dan_ham" class="form-label fw-medium">Nomor Kemenkum dan
                                        HAM</label>
                                    <input type="text" id="no_kenmenhum_dan_ham" name="no_kenmenhum_dan_ham"
                                        class="form-control" placeholder="-"
                                        value="{{ old('no_kenmenhum_dan_ham', $dataps->dataMitra->no_kenmenhum_dan_ham ?? '') }}">
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
                                        <input type="date" id="tgl_penetapan_pengadilan" name="tgl_penetapan_pengadilan"
                                            class="form-control" placeholder="-"
                                            value="{{ $dataps->dataMitra->tgl_penetapan_pengadilan_formatted ?? '' }}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="no_penetapan_pengadilan" class="form-label fw-medium">Nomor Penetapan
                                        Pengadilan (CV)</label>
                                    <input type="text" id="no_penetapan_pengadilan" name="no_penetapan_pengadilan"
                                        class="form-control" placeholder="-"
                                        value="{{ old('no_penetapan_pengadilan', $dataps->dataMitra->no_penetapan_pengadilan ?? '') }}">
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
                                        <input type="date" id="tgl_izin_usaha" name="tgl_izin_usaha"
                                            class="form-control" placeholder="-"
                                            value="{{ $dataps->dataMitra->tgl_izin_usaha_formatted ?? '' }}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="no_izin_berusaha" class="form-label fw-medium">Nomor Izin
                                        Berusaha</label>
                                    <input type="text" id="no_izin_berusaha" name="no_izin_berusaha"
                                        class="form-control" placeholder="-"
                                        value="{{ old('no_izin_berusaha', $dataps->dataMitra->no_izin_berusaha ?? '') }}">
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
                                        <input type="date" id="tgl_sk_dirjen_pajak" name="tgl_sk_dirjen_pajak"
                                            class="form-control" placeholder="-"
                                            value="{{ $dataps->dataMitra->tgl_sk_dirjen_pajak_formatted ?? '' }}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="sk_dirjen_pajak" class="form-label fw-medium">Surat Keterangan
                                        Terdaftar Dirjen Pajak</label>
                                    <input type="text" id="sk_dirjen_pajak" name="sk_dirjen_pajak" class="form-control"
                                        placeholder="-"
                                        value="{{ old('sk_dirjen_pajak', $dataps->dataMitra->sk_dirjen_pajak ?? '') }}">
                                </div>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="tgl_surat_pengukuhan_kena_pajak" class="form-label fw-medium">Tanggal
                                        Surat
                                        Pengukuhan Pengusaha Kena Pajak</label>
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <i class="bi bi-calendar3"></i>
                                        </span>
                                        <input type="date" id="tgl_surat_pengukuhan_kena_pajak"
                                            name="tgl_surat_pengukuhan_kena_pajak" class="form-control" placeholder="-"
                                            value="{{ $dataps->dataMitra->tgl_surat_pengukuhan_kena_pajak_formatted ?? '' }}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="surat_pengukuhan_kena_pajak" class="form-label fw-medium">Surat
                                        Pengukuhan
                                        Pengusaha Kena Pajak</label>
                                    <input type="text" id="surat_pengukuhan_kena_pajak"
                                        name="surat_pengukuhan_kena_pajak" class="form-control" placeholder="-"
                                        value="{{ old('surat_pengukuhan_kena_pajak', $dataps->dataMitra->surat_pengukuhan_kena_pajak ?? '') }}">
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
                                        placeholder="-"
                                        value="340413140998788001">{{ old('lokasi', $dataps->dataAset->lokasi ?? '') }}</textarea>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="penggunaan_asset" class="form-label fw-medium">Penggunaan Lokasi
                                        Asset</label>
                                    <textarea id="penggunaan_asset" name="penggunaan_asset" class="form-control"
                                        rows="3" placeholder="-"
                                        value="340413140998788001"> {{ old('penggunaan_objek', $dataps->dataAset->penggunaan_objek ?? '') }}</textarea>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="luas_tanah" class="form-label fw-medium">Luas Tanah (m²)</label>
                                    <input type="" id="luas_tanah" name="luas_tanah" class="form-control"
                                        placeholder="Luas Tanah Dalan m"
                                        value="{{ old('luas_tanah', $dataps->dataAset->luas_tanah ?? '') }}">
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
                                            class="form-control"
                                            value="{{ $dataps->masa_awal_perjanjian_formatted ?? '' }}">
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
                                            class="form-control"
                                            value="{{ $dataps->masa_akhir_perjanjian_formatted ?? '' }}">
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
                                            class="form-control"
                                            value="{{ $dataps->masa_awal_manfaat_formatted ?? '' }}">
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
                                            class="form-control"
                                            value="{{ $dataps->masa_akhir_manfaat_formatted ?? '' }}">
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
                                        placeholder="-- Masukan harga sewa --"
                                        value="{{ number_format($dataps->harga_sewa ?? 0, 0, ',', '.') }}">
                                    <input type="hidden" id="harga_sewa" name="harga_sewa" value="{{ $dataps->harga_sewa ?? 0 }}">
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="harga_pemanfaatan" class="form-label fw-medium">Harga
                                        Pemanfaatan (Rp.)</label>
                                    <input type="text" id="harga_pemanfaatan_display" class="form-control"
                                        placeholder="-- Masukan harga pemanfaatan --"
                                        value="{{ number_format($dataps->harga_pemanfaatan ?? 0, 0, ',', '.') }}">
                                    <input type="hidden" id="harga_pemanfaatan" name="harga_pemanfaatan" value="{{ $dataps->harga_pemanfaatan ?? 0 }}">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="biaya_admin" class="form-label fw-medium">Biaya Admin (Rp.)</label>
                                    <input type="text" id="biaya_admin_display" class="form-control"
                                        placeholder="-- Masukan biaya admin --"
                                        value="{{ number_format($dataps->biaya_admin_ukur ?? 0, 0, ',', '.') }}">
                                    <input type="hidden" id="biaya_admin" name="biaya_admin" value="{{ $dataps->biaya_admin_ukur ?? 0 }}">
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="cost_of_money" class="form-label fw-medium">Cost Of Money (Rp.)</label>
                                    <input type="text" id="cost_of_money_display" class="form-control"
                                        placeholder="-- Masukan biaya COM --"
                                        value="{{ number_format($dataps->cost_of_money ?? 0, 0, ',', '.') }}">
                                    <input type="hidden" id="cost_of_money" name="cost_of_money" value="{{ $dataps->cost_of_money ?? 0 }}">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="harga_sewa_admin" class="form-label fw-medium">Harga Sewa + Admin
                                        (Rp.)</label>
                                    <input type="text" id="harga_sewa_admin_display" class="form-control"
                                        placeholder="Rp."
                                        value="{{ number_format($dataps->harga_sewa_admin ?? 0, 0, ',', '.') }}" readonly>
                                    <input type="hidden" id="harga_sewa_admin" name="harga_sewa_admin" value="{{ $dataps->harga_sewa_admin ?? 0 }}">
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="harga_sewa_admin_com" class="form-label fw-medium">Harga Sewa + Admin +
                                        COM (Rp.)</label>
                                    <input type="text" id="harga_sewa_admin_com_display" class="form-control"
                                        placeholder="Rp."
                                        value="{{ number_format($dataps->harga_sewa_admin_com ?? 0, 0, ',', '.') }}" readonly>
                                    <input type="hidden" id="harga_sewa_admin_com" name="harga_sewa_admin_com" value="{{ $dataps->harga_sewa_admin_com ?? 0 }}">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="ppn" class="form-label fw-medium">PPN 11% (Rp.)</label>
                                    <input type="text" id="ppn_display" class="form-control" placeholder="Rp."
                                        value="{{ number_format($dataps->ppn_11_persen ?? 0, 0, ',', '.') }}" readonly>
                                    <input type="hidden" id="ppn" name="ppn" value="{{ $dataps->ppn_11_persen ?? 0 }}">
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="total_harga" class="form-label fw-medium">Total Harga (Rp.)</label>
                                    <input type="text" id="total_harga_display" class="form-control" placeholder="-"
                                        value="{{ number_format($dataps->total_harga ?? 0, 0, ',', '.') }}" readonly>
                                    <input type="hidden" id="total_harga" name="total_harga" value="{{ $dataps->total_harga ?? 0 }}">
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
                                        placeholder="-" readonly>{{ old('terbilang', $dataps->terbilang ?? '') }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="card border-0">
                    <div class="row row-list-perjanjian">
                        <div class="col-5">
                            <a href="{{ url('pendaftaran/fitur_filter') }}"
                                class="btn btn-kembali px-5 text-decoration-none">
                                <i class="bi bi-arrow-left-circle me-2"></i>kembali
                            </a>
                            </button>
                        </div>
                        <div class="col-7 text-end">
                            <button type="button" id="submitBtn" class="btn btn-share px-5">
                                <i class="bi bi-share "></i>Update
                            </button>
                        </div>

                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- SweetAlert CDN -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="{{ asset('asset/js/CurrencyCalculator.js') }}"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Notifikasi session dengan SweetAlert
        @if (session('success'))
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
        @if (session('error'))
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

        // Format input harga
        function formatCurrency(number) {
            return new Intl.NumberFormat('id-ID').format(number);
        }

        function unformatCurrency(formatted) {
            return formatted.replace(/\./g, '');
        }

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
                // Format tampilan saat input
                displayInput.addEventListener('input', function (e) {
                    let value = e.target.value.replace(/[^\d]/g, '');
                    hiddenInput.value = value;
                    displayInput.value = formatCurrency(value);
                });

                // Format saat keluar dari input
                displayInput.addEventListener('blur', function (e) {
                    if (this.value) {
                        let value = this.value.replace(/[^\d]/g, '');
                        hiddenInput.value = value;
                        this.value = formatCurrency(value);
                    }
                });

                // Inisialisasi nilai
                if (hiddenInput.value) {
                    displayInput.value = formatCurrency(hiddenInput.value);
                }
            }
        });

        // Validasi form sebelum submit
        const submitBtn = document.getElementById('submitBtn');
        const updateForm = document.getElementById('updateForm');

        submitBtn.addEventListener('click', function () {
            // Validasi field wajib
            const requiredFields = [
                'nama_lengkap', 'email', 'tanggal_perjanjian', 'alamat',
                'penyewa_berdasarkan', 'nik',
                'alamat_asset', 'penggunaan_asset'
            ];

            let emptyFields = [];
            requiredFields.forEach(fieldId => {
                const field = document.getElementById(fieldId);
                if (field && !field.value.trim()) {
                    emptyFields.push(fieldId);
                }
            });

            // Validasi file upload
            const fileInput = document.getElementById('foto_identitas');
            if (fileInput && fileInput.files.length > 0) {
                const file = fileInput.files[0];
                const validTypes = ['image/jpeg', 'image/jpg', 'image/png', 'application/pdf'];
                const maxSize = 2 * 1024 * 1024; // 2MB

                if (!validTypes.includes(file.type)) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Format File Tidak Valid',
                        text: 'File harus berupa JPG, JPEG, PNG, atau PDF',
                        confirmButtonColor: '#dc2626'
                    });
                    return;
                }

                if (file.size > maxSize) {
                    Swal.fire({
                        icon: 'error',
                        title: 'File Terlalu Besar',
                        text: 'Ukuran file maksimal 2MB',
                        confirmButtonColor: '#dc2626'
                    });
                    return;
                }
            }

            if (emptyFields.length > 0) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Data Belum Lengkap',
                    html: `
                    <div style="text-align: left;">
                        <p>Mohon lengkapi field berikut:</p>
                        <ul>
                            ${emptyFields.map(field => `<li>${getFieldLabel(field)}</li>`).join('')}
                        </ul>
                    </div>
                `,
                    confirmButtonColor: '#f59e0b'
                });
                return;
            }

            // Konfirmasi update dengan SweetAlert
            Swal.fire({
                title: '',
                html: `
                <div style="text-align: center;">
                    <img src="{{ asset('asset/img/kusewa.png') }}" 
                        alt="Logo KAI" 
                        style="width: 100px; height: auto; margin-bottom: 15px;">
                    
                    <div style="color: #6b7280; font-size: 48px; margin: 10px 0;">
                        <i class="bi bi-question-circle"></i> 
                    </div>
                    <h4 style="color: #1f2937;">Update Data</h4>
                    <p style="color: #4b5563;">
                        Anda akan memperbarui data perjanjian dengan:<br>
                        <strong>{{ $dataps->dataMitra->nama ?? 'N/A' }}</strong>
                    </p>
                    <div style="background: #eff6ff; padding: 10px; border-radius: 5px; margin: 15px 0;">
                        <p style="color: #1e40af; margin: 0; font-size: 14px;">
                            <i class="bi bi-info-circle me-1"></i>
                            <strong>Pastikan semua data sudah benar!</strong>
                        </p>
                    </div>
                    <p style="color: #6b7280; font-size: 14px;">
                        Data yang sudah diupdate tidak dapat dikembalikan
                    </p>
                </div>
            `,  
                showCancelButton: true,
                confirmButtonText: 'Update Sekarang',
                cancelButtonText: 'Batalkan',
                confirmButtonColor: '#3b82f6',
                cancelButtonColor: '#6b7280',
                reverseButtons: true,
                customClass: {}
            }).then((result) => {
                if (result.isConfirmed) {
                    // Tampilkan loading
                    Swal.fire({
                        title: 'Memproses...',
                        text: 'Sedang menyimpan perubahan data',
                        allowOutsideClick: false,
                        didOpen: () => {
                            Swal.showLoading();
                        }
                    });

                    // Submit form
                    updateForm.submit();
                }
            });
        });

        function getFieldLabel(fieldId) {
            const labels = {
                'nama_lengkap': 'Nama Lengkap',
                'email': 'Alamat Email',
                'tanggal_perjanjian': 'Tanggal Perjanjian',
                'alamat': 'Alamat',
                'penyewa_berdasarkan': 'Penyewa Berdasarkan',
                'nik': 'NIK',
                'alamat_asset': 'Alamat Asset',
                'penggunaan_asset': 'Penggunaan Asset'
            };
            return labels[fieldId] || fieldId;
        }

        // Konfirmasi hapus foto dengan SweetAlert
        window.confirmDeleteFoto = function (idMitra) {
            Swal.fire({
                title: 'Konfirmasi Hapus Foto',
                html: `
                <div style="text-align: center;">
                    <div style="color: #dc2626; font-size: 48px; margin-bottom: 15px;">
                        <i class="bi bi-trash"></i>
                    </div>
                    <h4 style="color: #1f2937;">Hapus Foto Identitas?</h4>
                    <p style="color: #4b5563;">
                        Anda akan menghapus foto identitas yang terupload
                    </p>
                    <div style="background: #fee2e2; padding: 10px; border-radius: 5px; margin: 15px 0;">
                        <p style="color: #b91c1c; margin: 0; font-size: 14px;">
                            <i class="bi bi-exclamation-triangle me-1"></i>
                            <strong>Data yang dihapus tidak dapat dikembalikan</strong>
                        </p>
                    </div>
                </div>
            `,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#dc2626',
                cancelButtonColor: '#6b7280',
                confirmButtonText: '<i class="bi bi-trash me-1"></i>Ya, Hapus',
                cancelButtonText: '<i class="bi bi-x-circle me-1"></i>Batal',
                reverseButtons: true,
                buttonsStyling: false,
                customClass: {
                    confirmButton: 'btn btn-danger px-4 py-2',
                    cancelButton: 'btn btn-secondary px-4 py-2'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    // Tampilkan loading
                    Swal.fire({
                        title: 'Menghapus...',
                        text: 'Sedang menghapus foto identitas',
                        allowOutsideClick: false,
                        didOpen: () => {
                            Swal.showLoading();
                        }
                    });

                    // Kirim request delete
                    fetch(`/pendaftaran/foto/${idMitra}`, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Content-Type': 'application/json',
                            'Accept': 'application/json'
                        }
                    })
                        .then(response => {
                            if (!response.ok) {
                                throw new Error('Network response was not ok');
                            }
                            return response.json();
                        })
                        .then(data => {
                            Swal.close();
                            if (data.success) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Berhasil!',
                                    text: data.message || 'Foto berhasil dihapus',
                                    confirmButtonColor: '#10b981'
                                }).then(() => {
                                    location.reload();
                                });
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Gagal!',
                                    text: data.message || 'Gagal menghapus foto',
                                    confirmButtonColor: '#dc2626'
                                });
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            Swal.fire({
                                icon: 'error',
                                title: 'Kesalahan',
                                text: 'Terjadi kesalahan saat menghapus foto',
                                confirmButtonColor: '#dc2626'
                            });
                        });
                }
            });
        }

        // Validasi input file
        const fileInput = document.getElementById('foto_identitas');
        if (fileInput) {
            fileInput.addEventListener('change', function (e) {
                const file = e.target.files[0];
                if (file) {
                    const validTypes = ['image/jpeg', 'image/jpg', 'image/png', 'application/pdf'];
                    const maxSize = 2 * 1024 * 1024; // 2MB

                    if (!validTypes.includes(file.type)) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Format File Tidak Valid',
                            text: 'File harus berupa JPG, JPEG, PNG, atau PDF',
                            confirmButtonColor: '#dc2626'
                        });
                        this.value = '';
                        return;
                    }

                    if (file.size > maxSize) {
                        Swal.fire({
                            icon: 'error',
                            title: 'File Terlalu Besar',
                            text: 'Ukuran file maksimal 2MB',
                            confirmButtonColor: '#dc2626'
                        });
                        this.value = '';
                        return;
                    }

                    // Tampilkan preview untuk gambar
                    if (file.type.startsWith('image/')) {
                        const reader = new FileReader();
                        reader.onload = function (e) {
                            const preview = document.createElement('img');
                            preview.src = e.target.result;
                            preview.className = 'img-thumbnail mt-2';
                            preview.style.maxWidth = '300px';
                            preview.style.maxHeight = '200px';
                            preview.style.objectFit = 'cover';

                            const existingPreview = document.querySelector('#foto_identitas + .mt-3');
                            if (existingPreview) {
                                existingPreview.querySelector('img')?.remove();
                                existingPreview.querySelector('.alert-info')?.remove();
                                existingPreview.prepend(preview);
                            }
                        };
                        reader.readAsDataURL(file);
                    }
                }
            });
        }
    });
</script>
<style>
    /* Style untuk SweetAlert */
    .swal2-popup {
        border-radius: 12px;
        font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
    }

    .swal2-title {
        font-size: 1.25rem;
        font-weight: 600;
    }

    /* Style untuk input currency */
    input[type="text"][id$="_display"] {
        font-family: 'Courier New', monospace;
        font-weight: 600;
        font-size: 14px;
        color: #059669;
    }

    /* Style untuk tombol */
    .btn-share {
        background-color: #3b82f6;
        color: white;
        border: none;
        transition: all 0.2s ease;
    }

    .btn-share:hover {
        background-color: #2563eb;
        transform: translateY(-1px);
        box-shadow: 0 4px 6px rgba(37, 99, 235, 0.1);
    }

    .btn-share:disabled {
        background-color: #9ca3af;
        cursor: not-allowed;
        transform: none;
        box-shadow: none;
    }

    .btn-kembali {
        background-color: #e5e7eb;
        color: #374151;
        border: none;
        transition: all 0.2s ease;
    }

    .btn-kembali:hover {
        background-color: #d1d5db;
        transform: translateY(-1px);
        box-shadow: 0 4px 6px rgba(107, 114, 128, 0.1);
    }

    /* Style untuk card */
    .card {
        border: 1px solid #e5e7eb;
        border-radius: 8px;
        overflow: hidden;
    }

    .card-header {
        background-color: #f9fafb;
        border-bottom: 1px solid #e5e7eb;
        padding: 1rem 1.25rem;
    }

    
    /* Style untuk form */
    .form-control {
        border: 1px solid #d1d5db;
        border-radius: 6px;
        padding: 0.5rem 0.75rem;
        transition: all 0.2s ease;
    }

    .form-control:focus {
        border-color: #3b82f6;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        outline: none;
    }

    .form-label {
        color: #374151;
        font-weight: 500;
        margin-bottom: 0.5rem;
    }

    /* Style untuk alert */
    .alert {
        border-radius: 6px;
        border: none;
        padding: 0.75rem 1rem;
    }

    .alert-danger {
        background-color: #fee2e2;
        color: #991b1b;
    }

    .alert-success {
        background-color: #d1fae5;
        color: #065f46;
    }

    .alert-warning {
        background-color: #fef3c7;
        color: #92400e;
    }

    .alert-info {
        background-color: #dbeafe;
        color: #1e40af;
    }
</style>

@endsection