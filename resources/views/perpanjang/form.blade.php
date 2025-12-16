@extends('template.admin')

@section('title', 'halaman | Perpanjang')

@section('content')

    <div class="container-form-biodata">
        <div class="text-start p-3">
            <a> Perjanjian Mitra KAI DAOP 6 Yogyakarta</a>
        </div>
        <div class="card card-form">
            <div class="card-header-form text-center py-3">
                <h4 class="card-title-form mb-0">DATA KONTRAK</h4>
            </div>
            <hr>
            <div class="card-body p-2">
                <form class="biodata-form" method="POST" action="{{ route('perpanjang.store', $dataps->id_perjanjian) }}"
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
                    </div>



                    <!-- Tanggal Perjanjian -->
                    <div class="card mb-4">
                        <div class="card-header">
                            <h5 class="card-title">
                                <i class="bi bi-person-badge me-2"></i>Tanggal Kontrak
                            </h5>
                        </div>

                        <div class="card-body">
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="tanggal_perjanjian" class="form-label fw-medium">Tanggal
                                        Perjanjian</label>

                                    <div class="d-flex align-items-center gap-2">

                                        <div class="input-group flex-grow-1">
                                            <span class="input-group-text">
                                                <i class="bi bi-calendar3"></i>
                                            </span>
                                            <input type="text" class="form-control"
                                                value="{{ $dataps->dataMitra->tgl_perjanjian_formatted ?? '' }}" readonly>
                                        </div>

                                        <!-- Badge Status -->
                                        <span class="badge 
                                        @if(($dataps->dataMitra->status ?? '') === 'Diterima') bg-success 
                                        @elseif(($dataps->dataMitra->status ?? '') === 'Ditolak') bg-danger 
                                        @else bg-secondary 
                                        @endif
                                        px-3 py-2 text-uppercase">

                                            {{ $dataps->dataMitra->status ?? 'Tidak Ada Status' }}
                                        </span>

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
                                            value="{{ old('nama_lengkap', $dataps->dataMitra->nama ?? '') }}" readonly>

                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label for="penyewa_berdasarkan" class="form-label fw-medium">Penyewa
                                            Berdasarkan</label>
                                        <input type="text" id="penyewa_berdasarkan" name="penyewa_berdasarkan"
                                            class="form-control" placeholder="Berdasarkan"
                                            value="{{ old('penyewa_berdasarkan', $dataps->dataMitra->penyewa_berdasarkan ?? '') }}"
                                            readonly>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label for="alamat" class="form-label fw-medium">Alamat</label>
                                        <textarea id="alamat" name="alamat" class="form-control" rows="3"
                                            placeholder="Masukkan alamat lengkap"
                                            readonly>{{ old('alamat', $dataps->dataMitra->alamat ?? '') }}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label for="no_telepon" class="form-label fw-medium">Kode Pos</label>
                                        <input type="tel" id="no_telepon" name="no_telepon" class="form-control"
                                            placeholder="08xxxxxxxxxx"
                                            value="{{ old('no_tlpn', $dataps->dataMitra->no_tlpn ?? '') }}" readonly>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <div class="form-group">
                                            <label for="no_telepon" class="form-label fw-medium">No Telepon/WA</label>
                                            <input type="tel" id="no_telepon" name="no_telepon" class="form-control"
                                                placeholder="08xxxxxxxxxx"
                                                value="{{ old('no_tlpn', $dataps->dataMitra->no_tlpn ?? '') }}" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <div class="form-group">
                                            <label for="email" class="form-label fw-medium">Alamat E-mail</label>
                                            <input type="email" id="email" name="email" class="form-control"
                                                placeholder="email@contoh.com"
                                                value="{{ old('email', $dataps->dataMitra->email ?? '') }}" readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Dokumen Penyewa -->
                    <div class="card mb-4">
                        <div class="card-header">
                            <h5 class="card-title">
                                <i class="bi bi-person-badge me-2"></i>Dokumen Penyewa
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label for="nik" class="form-label fw-medium">NIK</label>
                                        <input type="text" id="nik" name="nik" class="form-control"
                                            placeholder="Masukkan NIK"
                                            value="{{ old('no_identitas', $dataps->dataMitra->no_identitas ?? '') }}"
                                            readonly>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label for="masa_berlaku_ktp" class="form-label fw-medium">Masa Berlaku
                                            KTP</label>
                                        <div class="input-group">
                                            <span class="input-group-text">
                                                <i class="bi bi-calendar3"></i>
                                            </span>
                                            <input type="date" id="Masa_Berlaku_KTP" name="Masa_Berlaku_KTP"
                                                class="form-control"
                                                value="{{ $dataps->dataMitra->masa_berlaku_identitas_formatted ?? '' }}"
                                                readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label for="nik" class="form-label fw-medium">NPWP</label>
                                        <input type="text" id="nik" name="nik" class="form-control"
                                            placeholder="Masukkan NIK"
                                            value="{{ old('no_identitas', $dataps->dataMitra->no_identitas ?? '') }}"
                                            readonly>
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
                                <label for="foto_ktp" class="form-label fw-medium">Foto KTP</label>
                                <input type="file" id="foto_ktp" name="foto_ktp" class="form-control"
                                    accept=".jpg,.jpeg,.pdf" value="340413140998788001" readonly>
                                <div class="form-text">
                                    <small class="text-muted">*Isi sesuai dengan data diri yang benar</small><br>
                                    <small class="text-muted">**File yang bisa di upload berupa jpg, jpeg, pdf</small>
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
                                        <label for="nama_perwakilan" class="form-label fw-medium">Nama
                                            Perwakilan</label>
                                        <input type="text" id="nama_perwakilan" name="nama_perwakilan" class="form-control"
                                            placeholder="-"
                                            value="{{ old('nama_perwakilan', $dataps->dataMitra->nama_perwakilan ?? '') }}"
                                            readonly>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label for="perwakilan_selaku" class="form-label fw-medium">Perwakilan
                                            Selaku</label>
                                        <input type="text" id="perwakilan_selaku" name="perwakilan_selaku"
                                            class="form-control" placeholder="-"
                                            value="{{ old('penyewa_selaku', $dataps->dataMitra->penyewa_selaku ?? '') }}"
                                            readonly>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label for="npwp" class="form-label fw-medium">NPWP</label>
                                        <input type="text" id="npwp" name="npwp" class="form-control" placeholder="-"
                                            value="{{ old('npwp', $dataps->dataMitra->npwp ?? '') }}" readonly>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label for="kota_penyewa" class="form-label fw-medium">Kota Penyewa</label>
                                        <input type="text" id="kota_penyewa" name="kota_penyewa" class="form-control"
                                            placeholder="-"
                                            value="{{ old('kota_penyewa', $dataps->dataMitra->kota_penyewa ?? '') }}"
                                            readonly>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label for="kode_pos" class="form-label fw-medium">Kode Pos</label>
                                        <input type="text" id="kode_pos" name="kode_pos" class="form-control"
                                            placeholder="-"
                                            value="{{ old('kode_pos', $dataps->dataMitra->kode_pos ?? '') }}" readonly>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label for="fax_penyewa" class="form-label fw-medium">FAX Penyewa</label>
                                        <input type="text" id="fax_penyewa" name="fax_penyewa" class="form-control"
                                            placeholder="-"
                                            value="{{ old('fax_penyewa', $dataps->dataMitra->fax_penyewa ?? '') }}"
                                            readonly>
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
                                            readonly>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label for="tanggal_anggaran_dasar" class="form-label fw-medium">Tanggal
                                            Anggaran
                                            Dasar</label>
                                        <div class="input-group">
                                            <span class="input-group-text">
                                                <i class="bi bi-calendar3"></i>
                                            </span>
                                            <input type="text" id="Tanggal_Anggaran_Dasar" name="Tanggal_Anggaran_Dasar"
                                                placeholder="-" class="form-control"
                                                value="{{ $dataps->dataMitra->tgl_anggaran_dasar_formatted ?? '' }}"
                                                readonly>
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
                                            readonly>
                                    </div>
                                </div>


                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label for="tanggal_kemenkumham" class="form-label fw-medium">Tanggal
                                            Persetujuan
                                            Kemenkum dan HAM</label>
                                        <div class="input-group">
                                            <span class="input-group-text">
                                                <i class="bi bi-calendar3"></i>
                                            </span>
                                            <input type="text" id="Tanggal_Persetujuan_Kemenkum_dan_HAM"
                                                name="Tanggal_Persetujuan_Kemenkum_dan_HAM" class="form-control"
                                                placeholder="-"
                                                value="{{ $dataps->dataMitra->tgl_persetujuan_kenmenhum_dan_ham_formatted ?? '' }}"
                                                readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label for="no_kemenkumham" class="form-label fw-medium">Nomor Kemenkum dan
                                            HAM</label>
                                        <input type="text" id="no_kemenkumham" name="no_kemenkumham" class="form-control"
                                            placeholder="-"
                                            value="{{ old('no_kenmenhum_dan_ham', $dataps->dataMitra->no_kenmenhum_dan_ham ?? '') }}"
                                            readonly>
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
                                            <input type="text" id="Tanggal_Penetapan_Pengadilan"
                                                name="Tanggal_Penetapan_Pengadilan" class="form-control" placeholder="-"
                                                value="{{ $dataps->dataMitra->tgl_penetapan_pengadilan_formatted ?? '' }}"
                                                readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label for="no_penetapan_pengadilan" class="form-label fw-medium">Nomor
                                            Penetapan
                                            Pengadilan (CV)</label>
                                        <input type="text" id="no_penetapan_pengadilan" name="no_penetapan_pengadilan"
                                            class="form-control" placeholder="-"
                                            value="{{ old('no_penetapan_pengadilan', $dataps->dataMitra->no_penetapan_pengadilan ?? '') }}"
                                            readonly>
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
                                            <input type="text" id="Tanggal_Nomor_Izin_Berusaha"
                                                name="Tanggal_Nomor_Izin_Berusaha" class="form-control" placeholder="-"
                                                value="{{ $dataps->dataMitra->tgl_izin_usaha_formatted ?? '' }}" readonly>
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
                                            readonly>
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
                                            <input type="text" id="Tanggal_Surat_Keterangan_Terdaftar_Dirjen_Pajak"
                                                name="Tanggal_Surat_Keterangan_Terdaftar_Dirjen_Pajak" class="form-control"
                                                placeholder="-"
                                                value="{{ $dataps->dataMitra->tgl_sk_dirjen_pajak_formatted ?? '' }}"
                                                readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label for="surat_keterangan_pajak" class="form-label fw-medium">Surat
                                            Keterangan
                                            Terdaftar Dirjen Pajak</label>
                                        <input type="text" id="surat_keterangan_pajak" name="surat_keterangan_pajak"
                                            class="form-control" placeholder="-"
                                            value="{{ old('sk_dirjen_pajak', $dataps->dataMitra->sk_dirjen_pajak ?? '') }}"
                                            readonly>
                                    </div>
                                </div>

                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label for="tanggal_surat_pengukuhan_pkp" class="form-label fw-medium">Tanggal
                                            Surat
                                            Pengukuhan Pengusaha Kena Pajak</label>
                                        <div class="input-group">
                                            <span class="input-group-text">
                                                <i class="bi bi-calendar3"></i>
                                            </span>
                                            <input type="text" id="Tanggal_Surat_Pengukuhan_Pengusaha_Kena_Pajak"
                                                name="Tanggal_Surat_Pengukuhan_Pengusaha_Kena_Pajak" class="form-control"
                                                placeholder="-"
                                                value="{{ $dataps->dataMitra->tgl_surat_pengukuhan_kena_pajak_formatted ?? '' }}"
                                                readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label for="surat_pengukuhan_pkp" class="form-label fw-medium">Surat Pengukuhan
                                            Pengusaha Kena Pajak</label>
                                        <input type="text" id="surat_pengukuhan_pkp" name="surat_pengukuhan_pkp"
                                            class="form-control" placeholder="-"
                                            value="{{ old('surat_pengukuhan_kena_pajak', $dataps->dataMitra->surat_pengukuhan_kena_pajak ?? '') }}"
                                            readonly>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


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
                                        <label for="nama_perwakilan" class="form-label fw-medium">Alamat Lokasi
                                            Asset</label>
                                        <textarea id="alamat_asset" name="alamat_asset" class="form-control" rows="3"
                                            placeholder="-" value="340413140998788001"
                                            readonly>{{ old('lokasi', $dataps->dataAset->lokasi ?? '') }}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label for="perwakilan_selaku" class="form-label fw-medium">Penggunaan Lokasi
                                            Asset</label>
                                        <textarea id="penggunaan_asset" name="penggunaan_asset" class="form-control"
                                            rows="3" placeholder="-" value="340413140998788001"
                                            readonly> {{ old('penggunaan_objek', $dataps->dataAset->penggunaan_objek ?? '') }}</textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label for="npwp" class="form-label fw-medium">Luas Tanah</label>
                                        <input type="text" id="luas_tanah" name="npwp" class="form-control"
                                            placeholder="Luas Tanah Dalan m"
                                            value="{{ old('luas_tanah', $dataps->dataAset->luas_tanah ?? '') }} m&sup2;"
                                            readonly>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label for="luas_bangunan" class="form-label fw-medium">Luas Bangunan</label>
                                        <input type="text" id="luas_bangunan" name="luas_bangunan" class="form-control"
                                            placeholder="Luas Bangunan Dalam m"
                                            value="{{ old('luas_bangunan', $dataps->dataAset->luas_bangunan ?? '') }} m&sup2;"
                                            readonly>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label for="kode_pos" class="form-label fw-medium">Jangka Waktu Sewa</label>
                                        <div class="row">
                                            <div class="col-4">
                                                <input type="text" id="tahun" name="tahun" class="form-control"
                                                    placeholder="Tahun"
                                                    value="{{ $dataps->jangka_waktu_tahun ?? '0' }} / Tahun" readonly>
                                            </div>
                                            <div class="col-4">
                                                <input type="text" id="bulan" name="bulan" class="form-control"
                                                    placeholder="Bulan"
                                                    value="{{ $dataps->jangka_waktu_bulan ?? '0' }} / Bulan" readonly>
                                            </div>
                                            <div class="col-4">
                                                <input type="text" id="hari" name="hari" class="form-control"
                                                    placeholder="Hari"
                                                    value="{{ $dataps->jangka_waktu_hari ?? '0' }} / Hari" readonly>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label for="tanggal_anggaran_dasar" class="form-label fw-medium">Massa Awal
                                            Perjanjian</label>
                                        <div class="input-group">
                                            <span class="input-group-text">
                                                <i class="bi bi-calendar3"></i>
                                            </span>
                                            <input type="text" id="masa_awal_perjanjian" name="masa_awal_perjanjian"
                                                class="form-control"
                                                value="{{ $dataps->masa_awal_perjanjian_formatted ?? '' }}" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label for="tanggal_anggaran_dasar" class="form-label fw-medium">Massa Akhir
                                            Perjanjian</label>
                                        <div class="input-group">
                                            <span class="input-group-text">
                                                <i class="bi bi-calendar3"></i>
                                            </span>
                                            <input type="text" id="masa_akhir_perjanjian" name="masa_akhir_perjanjian"
                                                class="form-control"
                                                value="{{ $dataps->masa_akhir_perjanjian_formatted ?? '' }}" readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label for="tanggal_anggaran_dasar" class="form-label fw-medium">Massa Awal
                                            Pemanfaatan</label>
                                        <div class="input-group">
                                            <span class="input-group-text">
                                                <i class="bi bi-calendar3"></i>
                                            </span>
                                            <input type="text" id="masa_awal_pemanfaatan" name="masa_awal_pemanfaatan"
                                                class="form-control"
                                                value="{{ $dataps->masa_awal_manfaat_formatted ?? '' }}" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label for="tanggal_anggaran_dasar" class="form-label fw-medium">Massa Akhir
                                            Pemanfaatan</label>
                                        <div class="input-group">
                                            <span class="input-group-text">
                                                <i class="bi bi-calendar3"></i>
                                            </span>
                                            <input type="date" id="massa_Akhir_pemanfaatan" name="massa_Akhir_pemanfaatan"
                                                class="form-control"
                                                value="{{ $dataps->masa_awal_manfaat_formatted ?? '' }}" readonly>
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
                                        <label for="nama_perwakilan" class="form-label fw-medium">Harga Sewa</label>
                                        <input type="text" id="harga_sewa" name="harga_sewa" class="form-control"
                                            placeholder="Rp."
                                            value="Rp.{{ number_format($dataps->harga_sewa ?? 0, 0, ',', '.') }}" readonly>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label for="perwakilan_selaku" class="form-label fw-medium">Harga
                                            Pemanfaatan</label>
                                        <input type="text" id="harga_pemanfaatan" name="harga_pemanfaatan"
                                            class="form-control" placeholder="Rp."
                                            value="Rp.{{ number_format($dataps->harga_pemanfaatan ?? 0, 0, ',', '.') }}"
                                            readonly>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label for="npwp" class="form-label fw-medium">Biaya Admin</label>
                                        <input type="text" id="biaya_admin" name="biaya_admin" class="form-control"
                                            placeholder="Rp."
                                            value="Rp.{{ number_format($dataps->biaya_admin_ukur ?? 0, 0, ',', '.') }}"
                                            readonly>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label for="com" class="form-label fw-medium">Cost Of Money</label>
                                        <input type="text" id="cost_of_money" name="cost_of_money" class="form-control"
                                            placeholder="Rp."
                                            value="Rp.{{ number_format($dataps->cost_of_money ?? 0, 0, ',', '.') }}"
                                            readonly>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label for="npwp" class="form-label fw-medium">Harga Sewa + Admin</label>
                                        <input type="text" id="harga_sewa_admin" name="harga_sewa_admin"
                                            class="form-control" placeholder="Rp."
                                            value="Rp.{{ number_format($dataps->harga_sewa_admin ?? 0, 0, ',', '.') }}"
                                            readonly>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label for="harga_sewa_admin" class="form-label fw-medium">Harga Sewa + Admin +
                                            COM</label>
                                        <input type="text" id="hagra_sewa_admin_com" name="hagra_sewa_admin_com"
                                            class="form-control" placeholder="Rp."
                                            value="Rp.{{ number_format($dataps->harga_sewa_admin_com ?? 0, 0, ',', '.') }}"
                                            readonly>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label for="npwp" class="form-label fw-medium">PPN 11%</label>
                                        <input type="text" id="ppn" name="ppn" class="form-control" placeholder="Rp."
                                            value="Rp.{{ number_format($dataps->ppn_11_persen ?? 0, 0, ',', '.') }}"
                                            readonly>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label for="total_harga" class="form-label fw-medium">Total Harga</label>
                                        <input type="text" id="total_harga" name="total_harga" class="form-control"
                                            placeholder="-"
                                            value="Rp.{{ number_format($dataps->total_harga ?? 0, 0, ',', '.') }}" readonly>
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
                                        <label for="npwp" class="form-label fw-medium">Terbilang</label>
                                        <textarea id="terbilang" name="terbilang" class="form-control" rows="3"
                                            placeholder="-"
                                            readonly>{{ old('terbilang', $dataps->terbilang ?? '') }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card mb-4 border-0 p-5">
                        <div class="card-bodyy text-center pt-0">
                            <a href="{{ url('pendaftaran/perjanjian_dokumen/' . $dataps->id_perjanjian) }}"
                                class="btn btn-dock px-5" target="_blank">
                                <i class="bi bi-file-earmark-text me-2"></i>DOKUMEN PERJANJIAN
                            </a>
                        </div>
                    </div>
                    <!-- Step lanjut perpanjang-->
                    <div class="card border-0 ">
                        <div class="card-body text-end pt-0">
                            <button type="button" class="btn px-5 prev-step" data-prev="1">
                                <i class="bi bi-arrow-left-circle me-2"></i>Kembali
                            </button>
                            <!-- Tombol Perpanjang -->
                            <button type="button" class="btn btn-primary" id="btnPerpanjang">
                                <i class="bi bi-arrow-right-circle me-2"></i>Perpanjang
                            </button>

                            <!-- Modal Konfirmasi -->
                            <div class="modal fade" id="confirmModal" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered"> <!-- center vertikal -->
                                    <div class="modal-content text-center"> <!-- center horizontal -->
                                        <div class="modal-header border-0">
                                            <h5 class="modal-title w-100">Konfirmasi</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <p class="mb-0">Apakah anda yakin?</p>
                                        </div>
                                        <div class="modal-footer justify-content-center border-0">
                                            <!-- tombol di tengah -->
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Tidak</button>
                                            <button type="button" class="btn btn-primary" id="confirmYes">Ya</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {

            // ==== FILTER DATA PERUSAHAAN ====
            const jenis = "{{ $dataps->dataMitra->Jenis }}";
            const dataPerusahaan = document.getElementById('data-perusahaan');

            // Hide / Show otomatis
            dataPerusahaan.style.display = (jenis === 'Perorangan') ? 'none' : 'block';


            // ==== KONFIRMASI PERPANJANG ====
            const btnPerpanjang = document.getElementById('btnPerpanjang');
            const confirmYes = document.getElementById('confirmYes');

            if (btnPerpanjang) {
                btnPerpanjang.addEventListener('click', function () {
                    const modal = new bootstrap.Modal(document.getElementById('confirmModal'));
                    modal.show();

                    confirmYes.onclick = function () {
                        window.location.href = "{{ url('perpanjang/formperpanjang/' . $dataps->id_perjanjian) }}";
                    }
                });
            }

        });
    </script>
@endsection