@extends('template.admin')

@section('title', 'halaman | Form Perpanjang')

@section('content')
    <div class="container-form-biodata">
        <div class="text-start p-3">
            <span>Perpanjangan Akun Mitra Penyewaan Aset</span>
        </div>

        <div class="card card-form">
            <div class="card-header-form text-center py-3">
                <h4 class="card-title-form mb-0">FORM DATA PENYEWAAN</h4>
            </div>
            <hr>

            <div class="card-body p-2">
                <!-- Progress Bar -->
                <div class="progress mb-4" style="height: 8px;">
                    <div class="progress-bar" id="form-progress" role="progressbar" style="width: 0%;" aria-valuenow="0"
                        aria-valuemin="0" aria-valuemax="100">
                    </div>
                </div>

                <form class="biodata-form" method="POST" action="{{ url('pendaftaran/create') }}"
                    enctype="multipart/form-data">
                    @csrf

                    <!-- Step 1: Data Diri -->
                    <div class="form-step active" id="step-1">
                        <div class="row justify-content-start p-3">
                            <!-- Jenis Persewaan -->
                            <div class="col-md-4">
                                <div class="form-group text-center">
                                    <label class="form-label fw-medium">Jenis Persewaan</label>
                                    <div class="btn-group" role="group" aria-label="Jenis Penyewa">
                                        <!-- Perorangan -->
                                        <input type="radio" class="btn-check" id="Perorangan" name="jenis_penyewa"
                                            value="Perorangan" @checked($dataps->dataMitra->Jenis === 'Perorangan') disabled>
                                        <label class="btn" for="Perorangan">
                                            <i class="bi bi-person-fill"></i> Perorangan
                                        </label>

                                        <!-- Perusahaan -->
                                        <input type="radio" class="btn-check" id="Perusahaan" name="jenis_penyewa"
                                            value="Perusahaan" @checked($dataps->dataMitra->Jenis === 'Perusahaan') disabled>
                                        <label class="btn" for="Perusahaan">
                                            <i class="bi bi-building"></i> Perusahaan
                                        </label>
                                    </div>
                                    <!-- Kirim value meski radio disabled -->
                                    <input type="hidden" name="jenis_penyewa" value="{{ $dataps->dataMitra->Jenis }}">
                                </div>
                            </div>

                            <!-- Kategori -->
                            <div class="col-md-3 mb-2">
                                <div class="form-group text-center">
                                    <label class="form-label fw-medium">Kategori</label>
                                    <select id="kategori" name="kategori" class="form-control kategori-border" required>
                                        <option value="" disabled>-- Pilih Kategori --</option>
                                        <option value="Aset" @selected($dataps->dataMitra->kategori === 'Aset')>Aset</option>
                                        <option value="Event" @selected($dataps->dataMitra->kategori === 'Event')>Event
                                        </option>
                                    </select>
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
                                                <input type="date" id="tanggal_kemenkumham"
                                                    name="tanggal_kemenkumham" class="form-control"
                                                    placeholder="-"
                                                    value="{{ $dataps->dataMitra->tgl_persetujuan_kenmenhum_dan_ham_formatted ?? '' }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <div class="form-group">
                                            <label for="no_kemenkumham" class="form-label fw-medium">Nomor Kemenkum dan
                                                HAM</label>
                                            <input type="text" id="no_kemenkumham" name="no_kemenkumham"
                                                class="form-control" placeholder="-"
                                                value="{{ old('no_kenmenhum_dan_ham', $dataps->dataMitra->no_kenmenhum_dan_ham ?? '') }}">
                                        </div>
                                    </div>

                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <div class="form-group">
                                            <label for="tanggal_penetapan_pengadilan" class="form-label fw-medium">Tanggal
                                                Penetapan Pengadilan (CV)</label>
                                            <div class="input-group">
                                                <span class="input-group-text">
                                                    <i class="bi bi-calendar3"></i>
                                                </span>
                                                <input type="date" id="tanggal_penetapan_pengadilan" name="tanggal_penetapan_pengadilan"
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
                                            <label for="tanggal_izin_berusaha" class="form-label fw-medium">Tanggal Izin
                                                Berusaha</label>
                                            <div class="input-group">
                                                <span class="input-group-text">
                                                    <i class="bi bi-calendar3"></i>
                                                </span>
                                                <input type="date" id="tanggal_izin_berusaha" name="tanggal_izin_berusaha"
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

                        <!-- Step 1 Actions -->
                        <div class="card border-0">
                            <div class="card-body text-end pt-0">
                                <button type="reset" class="btn px-5">
                                    <i class="bi bi-arrow-clockwise"></i> Reset
                                </button>
                                <button type="button" class="btn px-5 next-step" data-next="2">
                                    <i class="bi bi-arrow-right-circle me-2"></i> Next
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Step 2: Data Asset -->
                    <div class="form-step" id="step-2">
                        <!-- Data Asset -->
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
                                            <label for="nama_aset" class="form-label fw-medium">Nama
                                                Aset</label>
                                            <input type="text" id="nama_aset" name="nama_aset" class="form-control"
                                                placeholder="-- Masukkan nama aset --" 
                                                value="{{ old('nama_aset', $dataps->dataAset->nama_aset ?? '') }}">
                                            <input type="hidden" name="id_aset" value="{{ old('id_aset', $dataps->dataAset->id_aset ?? '') }}">
                                        </div>
                                    </div>
                                </div>
                                <!-- Baris 1 -->
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
                                                value="340413140998788001"> {{ old('penggunaan_objek', $dataps->penggunaan_aset ?? '') }}</textarea>
                                        </div>
                                    </div>
                                </div>

                                <!-- Baris 2 -->
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

                                <!-- Baris 3 -->
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

                                <!-- Baris 4 -->
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <div class="form-group">
                                            <label for="masa_awal_perjanjian" class="form-label fw-medium">Massa Awal
                                                Perjanjian</label>
                                            <div class="input-group">
                                                <span class="input-group-text">
                                                    <i class="bi bi-calendar3"></i>
                                                </span>
                                                <input type="date" id="masa_awal_perjanjian" name="masa_awal_perjanjian"
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
                                                <input type="date" id="masa_akhir_perjanjian" name="masa_akhir_perjanjian"
                                                    class="form-control"
                                                    value="{{ $dataps->masa_akhir_perjanjian_formatted ?? '' }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Baris 5 -->
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

                        <!-- Step 2 Actions -->
                        <div class="card border-0">
                            <div class="card-body text-end pt-0">
                                <button type="button" class="btn px-5 prev-step" data-prev="1">
                                    <i class="bi bi-arrow-left-circle me-2"></i> Kembali
                                </button>
                                <button type="button" class="btn px-5 next-step" data-next="3">
                                    <i class="bi bi-arrow-right-circle me-2"></i> Next
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Step 3: Harga Asset -->
                    <div class="form-step" id="step-3">
                        <!-- Harga Asset -->
                        <div class="card mb-4" id="data-asset">
                            <div class="card-header">
                                <h5 class="card-title">
                                    <i class="bi bi-calculator me-2"></i>Harga Asset
                                </h5>
                            </div>
                            <div class="card-body">
                                <!-- Baris 1 -->
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <div class="form-group">
                                            <label for="harga_sewa" class="form-label fw-medium">Harga Sewa (Rp.)</label>
                                            <input type="text" id="harga_sewa_display" class="form-control"
                                                placeholder="-- Masukan harga sewa --"
                                                value="{{ number_format($dataps->harga_sewa ?? 0, 0, ',', '.') }}">
                                            <input type="hidden" id="harga_sewa" name="harga_sewa"
                                                value="{{ $dataps->harga_sewa ?? 0 }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <div class="form-group">
                                            <label for="harga_pemanfaatan" class="form-label fw-medium">Harga Pemanfaatan
                                                (Rp.)</label>
                                            <input type="text" id="harga_pemanfaatan_display" class="form-control"
                                                placeholder="-- Masukan harga pemanfaatan --"
                                                value="{{ number_format($dataps->harga_pemanfaatan ?? 0, 0, ',', '.') }}">
                                            <input type="hidden" id="harga_pemanfaatan" name="harga_pemanfaatan"
                                                value="{{ $dataps->harga_pemanfaatan ?? 0 }}">
                                        </div>
                                    </div>
                                </div>

                                <!-- Baris 2 -->
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <div class="form-group">
                                            <label for="biaya_admin" class="form-label fw-medium">Biaya Admin (Rp.)</label>
                                            <input type="text" id="biaya_admin_display" class="form-control"
                                                placeholder="-- Masukan biaya admin --"
                                                value="{{ number_format($dataps->biaya_admin_ukur ?? 0, 0, ',', '.') }}">
                                            <input type="hidden" id="biaya_admin" name="biaya_admin"
                                                value="{{ $dataps->biaya_admin_ukur ?? 0 }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <div class="form-group">
                                            <label for="cost_of_money" class="form-label fw-medium">Cost Of Money
                                                (Rp.)</label>
                                            <input type="text" id="cost_of_money_display" class="form-control"
                                                placeholder="-- Masukan biaya COM --"
                                                value="{{ number_format($dataps->cost_of_money ?? 0, 0, ',', '.') }}">
                                            <input type="hidden" id="cost_of_money" name="cost_of_money"
                                                value="{{ $dataps->cost_of_money ?? 0 }}">
                                        </div>
                                    </div>
                                </div>

                                <!-- Baris 3 -->
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <div class="form-group">
                                            <label for="harga_sewa_admin" class="form-label fw-medium">Harga Sewa + Admin
                                                (Rp.)</label>
                                            <input type="text" id="harga_sewa_admin_display" class="form-control"
                                                placeholder="Rp."
                                                value="{{ number_format($dataps->harga_sewa_admin ?? 0, 0, ',', '.') }}"
                                                readonly>
                                            <input type="hidden" id="harga_sewa_admin" name="harga_sewa_admin"
                                                value="{{ $dataps->harga_sewa_admin ?? 0 }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <div class="form-group">
                                            <label for="harga_sewa_admin_com" class="form-label fw-medium">Harga Sewa +
                                                Admin + COM (Rp.)</label>
                                            <input type="text" id="harga_sewa_admin_com_display" class="form-control"
                                                placeholder="Rp."
                                                value="{{ number_format($dataps->harga_sewa_admin_com ?? 0, 0, ',', '.') }}"
                                                readonly>
                                            <input type="hidden" id="harga_sewa_admin_com" name="harga_sewa_admin_com"
                                                value="{{ $dataps->harga_sewa_admin_com ?? 0 }}">
                                        </div>
                                    </div>
                                </div>

                                <!-- Baris 4 -->
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <div class="form-group">
                                            <label for="ppn" class="form-label fw-medium">PPN 11% (Rp.)</label>
                                            <input type="text" id="ppn_display" class="form-control" placeholder="Rp."
                                                value="{{ number_format($dataps->ppn_11_persen ?? 0, 0, ',', '.') }}"
                                                readonly>
                                            <input type="hidden" id="ppn" name="ppn"
                                                value="{{ $dataps->ppn_11_persen ?? 0 }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <div class="form-group">
                                            <label for="total_harga" class="form-label fw-medium">Total Harga (Rp.)</label>
                                            <input type="text" id="total_harga_display" class="form-control" placeholder="-"
                                                value="{{ number_format($dataps->total_harga ?? 0, 0, ',', '.') }}"
                                                readonly>
                                            <input type="hidden" id="total_harga" name="total_harga"
                                                value="{{ $dataps->total_harga ?? 0 }}">
                                        </div>
                                    </div>
                                </div>

                                <!-- Baris 5 -->
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <div class="form-group p-4 text-warning">
                                            <p>* cek kembali nominal yang anda masukan<br>
                                                ** pastikan nomor terbilang ditulis dengan benar</p>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <div class="form-group">
                                            <label for="terbilang" class="form-label fw-medium">Terbilang</label>
                                            <textarea id="terbilang" name="terbilang" class="form-control" rows="3"
                                                placeholder="-"
                                                readonly>{{ old('terbilang', $dataps->terbilang ?? '') }}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Step 3 Actions -->
                        <div class="card border-0">
                            <div class="card-body text-end pt-0">
                                <button type="button" class="btn px-5 prev-step" data-prev="2">
                                    <i class="bi bi-arrow-left-circle me-2"></i> Kembali
                                </button>
                                <button type="submit" class="btn btn-simpan-data px-5">
                                    <i class="bi bi-check-circle me-2"></i> Simpan Data
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('asset/js/pendaftaran.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const form = document.querySelector('.biodata-form');

            form.addEventListener('submit', function (e) {
                e.preventDefault();

                // Tampilkan loading
                Swal.fire({
                    title: 'Menyimpan Data...',
                    text: 'Mohon tunggu sebentar',
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });

                // Kirim form via AJAX
                const formData = new FormData(form);

                fetch(form.action, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            // Success alert
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil!',
                                html: `
                            <div class="text-start">
                                <p>${data.message}</p>
                                <div class="mt-3 p-2 bg-light rounded">
                                    <small class="d-block"><strong>Nama Mitra:</strong> ${data.data.nama}</small>
                                </div>
                            </div>
                        `,
                                confirmButtonText: 'Lanjutkan',
                                confirmButtonColor: '#3085d6',
                                allowOutsideClick: false
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    window.location.href = data.redirect_url;
                                }
                            });
                        } else {
                            // Error alert
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal!',
                                text: data.message,
                                confirmButtonText: 'Tutup',
                                confirmButtonColor: '#d33'
                            });
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        Swal.fire({
                            icon: 'error',
                            title: 'Terjadi Kesalahan!',
                            text: 'Terjadi kesalahan pada sistem. Silakan coba lagi.',
                            confirmButtonText: 'Tutup',
                            confirmButtonColor: '#d33'
                        });
                    });
            });
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

        .swal2-html-container {
            text-align: left !important;
        }

        .swal2-confirm {
            padding: 0.5rem 2rem;
        }
    </style>
@endsection