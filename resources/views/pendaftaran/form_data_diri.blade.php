@extends('template.admin')

@section('title', 'halaman | Pendaftaran')

@section('content')
<div class="container-form-biodata">
    <div class="text-start p-3">
        <a>Pendaftaran Akun Mitra Penyewaan Aset</a>
    </div>
    <div class="card card-form">
        <div class="card-header-form text- text-center py-3">
            <h4 class="card-title-form mb-0">FORM DATA PENYEWAAN</h4>
        </div>
        <hr>
        <div class="card-body p-2">
            <!-- Progress Bar -->
            <div class="progress mb-4" style="height: 8px;">
                <div class="progress-bar" id="form-progress" role="progressbar" style="width: 0%;" aria-valuenow="0"
                    aria-valuemin="0" aria-valuemax="100"></div>
            </div>


            <form class="biodata-form" method="POST" action="{{ url('pendaftaran/create') }}" enctype="multipart/form-data">
                @csrf
                <!-- Step 1: Data Diri -->
                <div class="form-step active" id="step-1">
                    <!-- Radio Button Group -->
                    <div class="row justify-content-start p-3">
                        <div class="col-md-4">
                            <div class="form-group text-center">
                                <div class="btn-group" role="group" aria-label="Jenis Penyewa">
                                    <input type="radio" class="btn-check" name="jenis_penyewa" id="Perorangan"
                                        value="Perorangan" >
                                    <label class="btn" for="Perorangan">
                                        <i class="bi bi-person-fill "></i>
                                        Perorangan
                                    </label>

                                    <input type="radio" class="btn-check" name="jenis_penyewa" id="Perusahaan"
                                        value="Perusahaan">
                                    <label class="btn" for="Perusahaan">
                                        <i class="bi bi-building "></i>
                                        Perusahaan
                                    </label>
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
                                            placeholder="Masukkan nama lengkap" required>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label for="nik" class="form-label fw-medium">NIK</label>
                                        <input type="text" id="nik" name="nik" class="form-control"
                                            placeholder="Masukkan NIK" required>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label for="masa_berlaku_ktp" class="form-label fw-medium">Masa Berlaku
                                            Kartu Identitas</label>
                                        <div class="input-group">
                                            <span class="input-group-text">
                                                <i class="bi bi-calendar3"></i>
                                            </span>
                                            <input type="date" id="masa_berlaku_ktp" name="masa_berlaku_ktp"
                                                class="form-control" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label for="email" class="form-label fw-medium">Alamat E-mail</label>
                                        <input type="email" id="email" name="email" class="form-control"
                                            placeholder="email@contoh.com" required>
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
                                            placeholder="08xxxxxxxxxx" required>
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
                                                class="form-control" required>
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
                                            class="form-control" placeholder="Berdasarkan..." required>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label for="alamat" class="form-label fw-medium">Alamat</label>
                                        <textarea id="alamat" name="alamat" class="form-control" rows="3"
                                            placeholder="Masukkan alamat lengkap" required></textarea>
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
                                <label for="foto_identitas" class="form-label fw-medium">Foto Identitas</label>
                                <input type="file" id="foto_identitas" name="foto_identitas" class="form-control"
                                    accept=".jpg,.jpeg,.pdf">
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
                                        <input type="text" id="nama_perwakilan" name="nama_perwakilan"
                                            class="form-control" placeholder="Nama perwakilan perusahaan">
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label for="perwakilan_selaku" class="form-label fw-medium">Perwakilan
                                            Selaku</label>
                                        <input type="text" id="perwakilan_selaku" name="perwakilan_selaku"
                                            class="form-control" placeholder="Jabatan perwakilan">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label for="npwp" class="form-label fw-medium">NPWP</label>
                                        <input type="text" id="npwp" name="npwp" class="form-control"
                                            placeholder="Nomor NPWP perusahaan">
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label for="kota_penyewa" class="form-label fw-medium">Kota Penyewa</label>
                                        <input type="text" id="kota_penyewa" name="kota_penyewa" class="form-control"
                                            placeholder="Kota domisili perusahaan">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label for="kode_pos" class="form-label fw-medium">Kode Pos</label>
                                        <input type="text" id="kode_pos" name="kode_pos" class="form-control"
                                            placeholder="Kode pos">
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label for="fax_penyewa" class="form-label fw-medium">FAX Penyewa</label>
                                        <input type="text" id="fax_penyewa" name="fax_penyewa" class="form-control"
                                            placeholder="Nomor fax perusahaan">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label for="no_akte_pendirian" class="form-label fw-medium">Nomor Akte
                                            Pendirian</label>
                                        <input type="text" id="no_akte_pendirian" name="no_akte_pendirian"
                                            class="form-control" placeholder="Nomor akte pendirian">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label for="no_anggaran_dasar" class="form-label fw-medium">Nomor Anggaran Dasar
                                            Terakhir</label>
                                        <input type="text" id="no_anggaran_dasar" name="no_anggaran_dasar"
                                            class="form-control" placeholder="Nomor anggaran dasar">
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label for="tanggal_anggaran_dasar" class="form-label fw-medium">Tanggal
                                            Anggaran Dasar</label>
                                        <div class="input-group">
                                            <span class="input-group-text">
                                                <i class="bi bi-calendar3"></i>
                                            </span>
                                            <input type="date" id="tanggal_anggaran_dasar" name="tanggal_anggaran_dasar"
                                                class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label for="no_kemenkumham" class="form-label fw-medium">Nomor Kemenkum dan
                                            HAM</label>
                                        <input type="text" id="no_kemenkumham" name="no_kemenkumham"
                                            class="form-control" placeholder="Nomor Kemenkumham">
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label for="tanggal_kemenkumham" class="form-label fw-medium">Tanggal
                                            Persetujuan Kemenkum dan HAM</label>
                                        <div class="input-group">
                                            <span class="input-group-text">
                                                <i class="bi bi-calendar3"></i>
                                            </span>
                                            <input type="date" id="tanggal_kemenkumham"
                                                name="tanggal_kemenkumham" class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label for="no_penetapan_pengadilan" class="form-label fw-medium">Nomor
                                            Penetapan Pengadilan (CV)</label>
                                        <input type="text" id="no_penetapan_pengadilan" name="no_penetapan_pengadilan"
                                            class="form-control" placeholder="Nomor penetapan pengadilan">
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label for="tanggal_penetapan_pengadilan" class="form-label fw-medium">Tanggal
                                            Penetapan Pengadilan (CV)</label>
                                        <div class="input-group">
                                            <span class="input-group-text">
                                                <i class="bi bi-calendar3"></i>
                                            </span>
                                            <input type="date" id="tanggal_penetapan_pengadilan"
                                                name="tanggal_penetapan_pengadilan" class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label for="no_izin_berusaha" class="form-label fw-medium">Nomor Izin
                                            Berusaha</label>
                                        <input type="text" id="no_izin_berusaha" name="no_izin_berusaha"
                                            class="form-control" placeholder="Nomor izin berusaha">
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label for="tanggal_izin_berusaha" class="form-label fw-medium">Tanggal Nomor
                                            Izin Berusaha</label>
                                        <div class="input-group">
                                            <span class="input-group-text">
                                                <i class="bi bi-calendar3"></i>
                                            </span>
                                            <input type="date" id="tanggal_izin_berusaha"
                                                name="tanggal_izin_berusaha" class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label for="surat_keterangan_pajak" class="form-label fw-medium">Surat
                                            Keterangan Terdaftar Dirjen Pajak</label>
                                        <input type="text" id="surat_keterangan_pajak" name="surat_keterangan_pajak"
                                            class="form-control" placeholder="Nomor surat keterangan">
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label for="tanggal_surat_keterangan_pajak" class="form-label fw-medium">Tanggal
                                            Surat Keterangan Terdaftar Dirjen Pajak</label>
                                        <div class="input-group">
                                            <span class="input-group-text">
                                                <i class="bi bi-calendar3"></i>
                                            </span>
                                            <input type="date" id="tanggal_surat_keterangan_pajak"
                                                name="tanggal_surat_keterangan_pajak"
                                                class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label for="surat_pengukuhan_pkp" class="form-label fw-medium">Surat Pengukuhan
                                            Pengusaha Kena Pajak</label>
                                        <input type="text" id="surat_pengukuhan_pkp" name="surat_pengukuhan_pkp"
                                            class="form-control" placeholder="Nomor surat pengukuhan PKP">
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label for="tanggal_surat_pengukuhan_pkp" class="form-label fw-medium">Tanggal
                                            Surat Pengukuhan Pengusaha Kena Pajak</label>
                                        <div class="input-group">
                                            <span class="input-group-text">
                                                <i class="bi bi-calendar3"></i>
                                            </span>
                                            <input type="date" id="tanggal_surat_pengukuhan_pkp"
                                                name="tanggal_surat_pengukuhan_pkp"
                                                class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Step 1 Actions -->
                    <div class="card border-0 ">
                        <div class="card-body text-end pt-0">
                            <button type="reset" class="btn px-5">
                                <i class="bi bi-arrow-clockwise"></i>Reset
                            </button>
                            <button type="button" class="btn px-5 next-step" data-next="2">
                                <i class="bi bi-arrow-right-circle me-2"></i>Next
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
                                <i class="bi bi-house-door me-2"></i>Data Aset
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label for="alamat_asset" class="form-label fw-medium">Alamat Lokasi
                                            Aset</label>
                                        <textarea id="alamat_asset" name="alamat_asset" class="form-control" rows="3"
                                            placeholder="Masukkan alamat lengkap" required></textarea>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label for="penggunaan_asset" class="form-label fw-medium">Penggunaan Lokasi
                                            Aset</label>
                                        <textarea id="penggunaan_asset" name="penggunaan_asset" class="form-control"
                                            rows="3" placeholder="Masukkan alamat lengkap" required></textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label for="luas_tanah" class="form-label fw-medium">Luas Tanah</label>
                                        <input type="text" id="luas_tanah" name="luas_tanah" class="form-control"
                                            placeholder="Luas Tanah Dalan m" required>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label for="luas_bangunan" class="form-label fw-medium">Luas Bangunan</label>
                                        <input type="text" id="luas_bangunan" name="luas_bangunan" class="form-control"
                                            placeholder="Luas Bangunan Dalam m" required>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label for="jangka_waktu_sewa" class="form-label fw-medium">Jangka Waktu Sewa</label>
                                        <div class="row">
                                            <div class="col-4">
                                                <input type="text" id="tahun" name="tahun" class="form-control"
                                                    placeholder="Tahun">
                                            </div>
                                            <div class="col-4">
                                                <input type="text" id="bulan" name="bulan" class="form-control"
                                                    placeholder="Bulan">
                                            </div>
                                            <div class="col-4">
                                                <input type="text" id="hari" name="hari" class="form-control"
                                                    placeholder="Hari">
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
                                            <input type="date" id="masa_awal_perjanjian" name="masa_awal_perjanjian"
                                                class="form-control" required>
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
                                                class="form-control" required>
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
                                                class="form-control" required>
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
                                            <input type="date" id="masa_akhir_pemanfaatan"
                                                name="masa_akhir_pemanfaatan" class="form-control" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Step 2 Actions -->
                    <div class="card border-0 ">
                        <div class="card-body text-end pt-0">
                            <button type="button" class="btn px-5 prev-step" data-prev="1">
                                <i class="bi bi-arrow-left-circle me-2"></i>Kembali
                            </button>
                            <button type="button" class="btn px-5 next-step" data-next="3">
                                <i class="bi bi-arrow-right-circle me-2"></i>Next
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
                                <i class="bi bi-calculator me-2"></i>Harga Aset
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label for="harga_sewa" class="form-label fw-medium">Harga Sewa</label>
                                        <input type="text" id="harga_sewa" name="harga_sewa" class="form-control"
                                            placeholder="Rp." required>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label for="harga_pemanfaatan" class="form-label fw-medium">Harga
                                            Pemanfaatan</label>
                                        <input type="text" id="harga_pemanfaatan" name="harga_pemanfaatan"
                                            class="form-control" placeholder="Rp.">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label for="biaya_admin" class="form-label fw-medium">Biaya Admin</label>
                                        <input type="text" id="biaya_admin" name="biaya_admin" class="form-control"
                                            placeholder="Rp." required>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label for="cost_of_money" class="form-label fw-medium">Cost Of Money</label>
                                        <input type="text" id="cost_of_money" name="cost_of_money" class="form-control"
                                            placeholder="Rp.">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label for="harga_sewa_admin" class="form-label fw-medium">Harga Sewa + Admin</label>
                                        <input type="text" id="harga_sewa_admin" name="harga_sewa_admin"
                                            class="form-control" placeholder="Rp.">
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label for="harga_sewa_admin_com" class="form-label fw-medium">Harga Sewa + Admin +
                                            COM</label>
                                        <input type="text" id="harga_sewa_admin_com" name="harga_sewa_admin_com"
                                            class="form-control" placeholder="Rp.">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label for="ppn" class="form-label fw-medium">PPN 11%</label>
                                        <input type="text" id="ppn" name="ppn" class="form-control" placeholder="Rp.">
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label for="total_harga" class="form-label fw-medium">Total Harga</label>
                                        <input type="text" id="total_harga" name="total_harga" class="form-control"
                                            placeholder="Rp.">
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
                                            placeholder="Tujuh ratus limapuluh ribu rupiah"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Step 3 Actions -->
                    <div class="card border-0 ">
                        <div class="card-body text-end pt-0">
                            <button type="button" class="btn px-5 prev-step" data-prev="2">
                                <i class="bi bi-arrow-left-circle me-2"></i>Kembali
                            </button>
                            <button type="submit" class="btn px-5">
                                <i class="bi bi-check-circle me-2"></i>Simpan Data
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>


<script src="{{ asset('asset/js/pendaftaran.js') }}"></script>
@endsection