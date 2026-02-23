@extends('template.admin')

@section('title', 'halaman | Pendaftaran')

@section('content')
<div class="container-form-biodata">
    <div class="text-start p-3">
        <a>Pendaftaran Akun Mitra Penyewaan Aset</a>
    </div>
    <div class="card card-form">
        <div class="card-header-form text- text-center py-3">
            <h4 class="card-title-form mb-0">FORM TAMBAH DATA PENYEWAAN</h4>
        </div>
        <hr>
        <div class="card-body p-2">
            <!-- Progress Bar -->
            <div class="progress mb-4" style="height: 8px;">
                <div class="progress-bar" id="form-progress" role="progressbar" style="width: 0%;" aria-valuenow="0"
                    aria-valuemin="0" aria-valuemax="100"></div>
            </div>


            <form id="multi-step-form" class="biodata-form" method="POST" action="{{ url('pendaftaran/create') }}" 
                enctype="multipart/form-data">
                @csrf
                <!-- Step 1: Data Diri -->
                <div class="form-step active" id="step-1">
                    <!-- Radio Button Group -->
                    <div class="row justify-content-start p-3">
                        <div class="col-md-4">
                            <div class="form-group text-center">
                                <label for="jenis" class="form-label fw-medium">Jenis Persewaan</label>                                <div class="btn-group" role="group" aria-label="Jenis Penyewa">
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
                        <div class="col-md-3 mb-2">
                            <div class="form-group text-center position-relative">
                                <label for="kategori" class="form-label fw-medium">Kategori</label>
                                <select id="kategori" name="kategori"
                                        class="form-control kategori-border pe-5"required>
                                    <option value="" disabled selected>-- Pilih Kategori --</option>
                                    <option value="Aset">Aset</option>
                                    <option value="Event">Event</option>
                                </select>
                                <i id="iconKategori" class="bi bi-chevron-left dropdown-icon"></i>
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
                                    <div class="form-group position-relative">
                                        <label for="nama_lengkap" class="form-label fw-medium">Nama Lengkap</label>
                                        <input type="text" id="nama_lengkap" name="nama_lengkap" class="form-control mitra-autocomplete"
                                            placeholder="-- Masukkan nama lengkap --" autocomplete="off" required>
                                        <input type="hidden" id="id_mitra" name="id_mitra">
                                        <div id="mitra-suggestions" class="suggestions-box"></div>
                                        <small class="text-muted">*Ketik untuk mencari data mitra yang sudah terdaftar</small>
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
                                        <label for="tanggal_perjanjian" class="form-label fw-medium">Tanggal
                                            Perjanjian</label>
                                        <div class="input-group">
                                            <span class="input-group-text">
                                                <i class="bi bi-calendar3"></i>
                                            </span>
                                            <input type="date" id="tanggal_perjanjian" name="tanggal_perjanjian"
                                                class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label for="alamat" class="form-label fw-medium">Alamat</label>
                                        <textarea id="alamat" name="alamat" class="form-control" rows="3"
                                            placeholder="-- Masukkan alamat lengkap --" required></textarea>
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
                                            placeholder="-- Masukan No.Hp/Wa --">
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label for="penyewa_berdasarkan" class="form-label fw-medium">Penyewa
                                            Berdasarkan</label>
                                        <input type="text" id="penyewa_berdasarkan" name="penyewa_berdasarkan"
                                            class="form-control" placeholder="-- Masukan tanda bukti KTP/dll --" required>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label for="masa_berlaku_ktp" class="form-label fw-medium">Masa Berlaku
                                            Kartu Identitas</label>
                                        <input type="text" id="masa_berlaku_ktp" name="masa_berlaku_ktp"
                                            class="form-control" placeholder="-- Masukan Masa Berlaku Identitas --">
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label for="nik" class="form-label fw-medium">Nomor Identitas/NIK</label>
                                        <input type="text" id="nik" name="nik" class="form-control"
                                            placeholder="-- Masukan Identitas/NIK --" required>
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
                                    <small class="text-muted">* Isi sesuai dengan data diri yang benar</small><br>
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
                                            class="form-control" placeholder="-- Nama perwakilan perusahaan --">
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label for="perwakilan_selaku" class="form-label fw-medium">Perwakilan
                                            Selaku</label>
                                        <input type="text" id="perwakilan_selaku" name="perwakilan_selaku"
                                            class="form-control" placeholder="-- Jabatan perwakilan --">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label for="npwp" class="form-label fw-medium">NPWP</label>
                                        <input type="text" id="npwp" name="npwp" class="form-control"
                                            placeholder="-- Nomor NPWP perusahaan --">
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label for="kota_penyewa" class="form-label fw-medium">Kota Penyewa</label>
                                        <input type="text" id="kota_penyewa" name="kota_penyewa" class="form-control"
                                            placeholder="-- Kota domisili perusahaan --">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label for="kode_pos" class="form-label fw-medium">Kode Pos</label>
                                        <input type="text" id="kode_pos" name="kode_pos" class="form-control"
                                            placeholder="-- Kode pos --">
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label for="fax_penyewa" class="form-label fw-medium">FAX Penyewa</label>
                                        <input type="text" id="fax_penyewa" name="fax_penyewa" class="form-control"
                                            placeholder="-- Nomor fax perusahaan --">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label for="no_akte_pendirian" class="form-label fw-medium">Nomor Akte
                                            Pendirian</label>
                                        <input type="text" id="no_akte_pendirian" name="no_akte_pendirian"
                                            class="form-control" placeholder="-- Nomor akte pendirian --">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label for="no_anggaran_dasar" class="form-label fw-medium">Nomor Anggaran Dasar
                                            Terakhir</label>
                                        <input type="text" id="no_anggaran_dasar" name="no_anggaran_dasar"
                                            class="form-control" placeholder="-- Nomor anggaran dasar --">
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
                                            class="form-control" placeholder="-- Nomor Kemenkumham --">
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
                                            class="form-control" placeholder="-- Nomor penetapan pengadilan --">
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
                                            class="form-control" placeholder="-- Nomor izin berusaha --">
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
                                            class="form-control" placeholder="-- Nomor surat keterangan --">
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
                                            class="form-control" placeholder="-- Nomor surat pengukuhan PKP --">
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
                    <div class="card-tombol border-0">
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
                                        <label for="nama_aset" class="form-label fw-medium">Nama Aset</label>
                                        <div class="position-relative">
                                            <input type="text" id="nama_aset" name="nama_aset" class="form-control aset-autocomplete"
                                                placeholder="-- Ketik nama aset --" autocomplete="off" required>
                                            <input type="hidden" id="id_aset" name="id_aset">
                                            <div id="aset-suggestions" class="suggestions-box"></div>
                                        </div>
                                        <small class="text-muted">*Ketik untuk mencari aset yang tersedia</small>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label for="alamat_asset_display" class="form-label fw-medium">Alamat Lokasi Aset</label>
                                        <textarea id="alamat_asset_display" class="form-control" rows="3" 
                                            placeholder="Alamat akan muncul otomatis" readonly></textarea>
                                        <input type="hidden" id="alamat_asset" name="alamat_asset">
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label for="penggunaan_asset" class="form-label fw-medium">Penggunaan Lokasi
                                            Aset</label>
                                        <textarea id="penggunaan_asset" name="penggunaan_asset" class="form-control"
                                            rows="3" placeholder="-- Masukkan alamat lengkap --" required></textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label for="luas_tanah_display" class="form-label fw-medium">Luas Tanah</label>
                                        <input type="text" id="luas_tanah_display" class="form-control" 
                                            placeholder="-- Luas Tanah Dalam m&sup2; --" readonly>
                                        <input type="hidden" id="luas_tanah" name="luas_tanah">
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label for="luas_bangunan_display" class="form-label fw-medium">Luas Bangunan</label>
                                        <input type="text" id="luas_bangunan_display" class="form-control" 
                                            placeholder="-- Luas Bangunan Dalam m&sup2; --" readonly>
                                        <input type="hidden" id="luas_bangunan" name="luas_bangunan">
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
                                                    placeholder="-- Tahun --">
                                            </div>
                                            <div class="col-4">
                                                <input type="text" id="bulan" name="bulan" class="form-control"
                                                    placeholder="-- Bulan --">
                                            </div>
                                            <div class="col-4">
                                                <input type="text" id="hari" name="hari" class="form-control"
                                                    placeholder="-- Hari --">
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
                                                class="form-control">
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
                                                name="masa_akhir_pemanfaatan" class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Step 2 Actions -->
                    <div class="card-tombol border-0 ">
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
                                        <input type="text" id="harga_sewa_display" class="form-control"
                                            placeholder="-- Masukan harga sewa --" required>
                                        <input type="hidden" id="harga_sewa" name="harga_sewa" >
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label for="harga_pemanfaatan" class="form-label fw-medium">Harga
                                            Pemanfaatan</label>
                                        <input type="text" id="harga_pemanfaatan_display"class="form-control" 
                                            placeholder="-- Masukan harga pemanfaatan --" >
                                        <input type="hidden" id="harga_pemanfaatan" name="harga_pemanfaatan" >
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label for="biaya_admin" class="form-label fw-medium">Biaya Admin</label>
                                        <input type="text" id="biaya_admin_display" class="form-control"
                                            placeholder="-- Masukan biaya admin --" >
                                        <input type="hidden" id="biaya_admin" name="biaya_admin" >
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label for="cost_of_money" class="form-label fw-medium">Cost Of Money</label>
                                        <input type="text" id="cost_of_money_display" class="form-control"
                                            placeholder="-- Masukan biaya COM --" >
                                        <input type="hidden" id="cost_of_money" name="cost_of_money">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label for="harga_sewa_admin" class="form-label fw-medium">Harga Sewa + Admin</label>
                                        <input type="text" id="harga_sewa_admin_display"
                                            class="form-control" placeholder="Rp." readonly>
                                        <input type="hidden" id="harga_sewa_admin" name="harga_sewa_admin" required>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label for="harga_sewa_admin_com" class="form-label fw-medium">Harga Sewa + Admin +
                                            COM</label>
                                        <input type="text" id="harga_sewa_admin_com_display"
                                            class="form-control" placeholder="Rp." readonly>
                                        <input type="hidden" id="harga_sewa_admin_com" name="harga_sewa_admin_com" required>
                                    </div>
                                </div>
                            </div>

                            <div class="row"> 
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label for="ppn" class="form-label fw-medium">PPN 11%</label>
                                        <input type="text" id="ppn_display" class="form-control" placeholder="Rp." readonly>
                                        <input type="hidden" id="ppn" name="ppn" required>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label for="total_harga" class="form-label fw-medium">Total Harga</label>
                                        <input type="text" id="total_harga_display" class="form-control"
                                            placeholder="Rp." readonly>
                                        <input type="hidden" id="total_harga" name="total_harga" required>
                                    </div>
                                </div>
                            </div>

                            <div class="row ">
                                <div class="col-md-6 mb-3">
                                    <div class="form-group p-4 text-warning">
                                        <p>*cek kembali nominal yang anda masukan<br>
                                            **pastikan nomor terbilang ditulis dengan benar
                                        </p>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3 ">
                                    <div class="form-group ">
                                        <label for="terbilang" class="form-label fw-medium">Terbilang</label>
                                        <textarea id="terbilang" name="terbilang" class="form-control" rows="3"
                                            placeholder="Tujuh ratus limapuluh ribu rupiah" readonly></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Step 3 Actions -->
                    <div class="card-tombol border-0 ">
                        <div class="card-body text-end pt-0">
                            <button type="button" class="btn px-5 prev-step" data-prev="2">
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

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="{{ asset('asset/js/pendaftaran.js') }}"></script>
<script src="{{ asset('asset/js/mitra_autocomplete.js') }}"></script>
<style>
    .swal2-popup {
        border-radius: 12px;
        font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
    }

    .swal2-title {
        font-size: 1.25rem;
        font-weight: 600;
    }


    /* Custom styles for autocomplete suggestions*/
    .position-relative {
        position: relative;
    }
    
    .suggestions-box {
        position: absolute;
        top: 100%;
        left: 0;
        right: 0;
        max-height: 200px;
        overflow-y: auto;
        background: white;
        border: 1px solid #ddd;
        border-radius: 4px;
        z-index: 1000;
        display: none;
        box-shadow: 0 4px 6px rgba(0,0,0,0.1);
    }
    
    .suggestion-item {
        padding: 10px 15px;
        cursor: pointer;
        border-bottom: 1px solid #eee;
    }
    
    .suggestion-item:hover {
        background-color: #f8f9fa;
    }
    
    .suggestion-item strong {
        font-size: 12px;
        color: #0e9db6;
    }
    
    .suggestion-item small {
        display: block;
        color: #6c757d;
        font-size: 12px;
        margin-top: 3px;
    }

</style>

<script>
    const select = document.getElementById('kategori');
    const icon   = document.getElementById('iconKategori');

    let isOpen = false;
    select.addEventListener('click', () => {
        isOpen = !isOpen;

        if (isOpen) {
            icon.classList.remove('bi-chevron-left');
            icon.classList.add('bi-chevron-down');
        } else {
            icon.classList.remove('bi-chevron-down');
            icon.classList.add('bi-chevron-left');
        }
    });
</script>

<script>
$(document).ready(function() {
    console.log('Document ready - Autocomplete initialized');
    
    let searchTimeout;
    const asetInput = $('#nama_aset');
    const suggestionsBox = $('#aset-suggestions');
    const idAsetInput = $('#id_aset');
    const alamatAsetDisplay = $('#alamat_asset_display');
    const alamatAsetHidden = $('#alamat_asset');

    // Tambahkan selector untuk display field dan hidden field
    const luasTanahDisplay = $('#luas_tanah_display');
    const luasTanahHidden = $('#luas_tanah');
    const luasBangunanDisplay = $('#luas_bangunan_display');
    const luasBangunanHidden = $('#luas_bangunan');

    // Cek apakah elemen ditemukan
    console.log('asetInput length:', asetInput.length);
    console.log('suggestionsBox length:', suggestionsBox.length);
    console.log('luasTanahDisplay length:', luasTanahDisplay.length);
    console.log('luasTanahHidden length:', luasTanahHidden.length);
    console.log('luasBangunanDisplay length:', luasBangunanDisplay.length);
    console.log('luasBangunanHidden length:', luasBangunanHidden.length);

    // Fungsi pencarian aset
    function searchAset(query) {
        console.log('Searching for:', query);
        
        if (query.length < 2) {
            suggestionsBox.hide();
            return;
        }

        const url = '{{ route("api.aset.search") }}';
        console.log('Search URL:', url);

        $.ajax({
            url: url,
            data: { q: query },
            method: 'GET',
            success: function(data) {
                console.log('Search results:', data);
                if (data.length > 0) {
                    displaySuggestions(data);
                } else {
                    suggestionsBox.html('<div class="suggestion-item text-muted">Aset tidak ditemukan</div>').show();
                }
            },
            error: function(xhr, status, error) {
                console.error('AJAX Error:', error);
                console.error('Status:', status);
                console.error('Response:', xhr.responseText);
            }
        });
    }

    // Tampilkan suggestions (HANYA NAMA DAN ALAMAT)
    function displaySuggestions(asets) {
        let html = '';
        asets.forEach(aset => {
            console.log('Processing aset:', aset);
            html += `
                <div class="suggestion-item" 
                     data-id="${aset.id_aset}" 
                     data-nama="${aset.nama_aset}" 
                     data-alamat="${aset.alamat_asset || ''}"
                     data-luas-tanah="${aset.luas_tanah || ''}"
                     data-luas-bangunan="${aset.luas_bangunan || ''}">
                    <strong>${highlightText(aset.nama_aset, asetInput.val())}</strong>
                    <small>${aset.alamat_asset || 'Alamat tidak tersedia'}</small>
                </div>
            `;
        });
        suggestionsBox.html(html).show();
        console.log('Suggestions displayed');
    }

    // Highlight teks yang dicari
    function highlightText(text, search) {
        if (!text) return '';
        const regex = new RegExp(`(${search})`, 'gi');
        return text.replace(regex, '<mark>$1</mark>');
    }

    // Event listener untuk input pencarian
    asetInput.on('input', function() {
        const query = $(this).val();
        console.log('Input changed:', query);
        
        clearTimeout(searchTimeout);
        searchTimeout = setTimeout(() => {
            searchAset(query);
        }, 300);
    });

    // Event listener untuk memilih suggestion
    suggestionsBox.on('click', '.suggestion-item', function() {
        const id = $(this).data('id');
        const nama = $(this).data('nama');
        const alamat = $(this).data('alamat');
        const luasTanah = $(this).data('luas-tanah');
        const luasBangunan = $(this).data('luas-bangunan');
        
        console.log('Selected:', {id, nama, alamat, luasTanah, luasBangunan});
        
        // Isi form dengan data yang dipilih
        asetInput.val(nama);
        idAsetInput.val(id);
        
        // Alamat
        alamatAsetDisplay.val(alamat);
        alamatAsetHidden.val(alamat);
        
        // LUAS TANAH - isi display dan hidden
        if (luasTanahDisplay.length) {
            if (luasTanah) {
                luasTanahDisplay.val(luasTanah + ' m²');
            } else {
                luasTanahDisplay.val('-');
            }
            console.log('Luas tanah display diisi:', luasTanahDisplay.val());
        }
        
        if (luasTanahHidden.length) {
            luasTanahHidden.val(luasTanah);
            console.log('Luas tanah hidden diisi:', luasTanahHidden.val());
        }
        
        // LUAS BANGUNAN - isi display dan hidden
        if (luasBangunanDisplay.length) {
            if (luasBangunan) {
                luasBangunanDisplay.val(luasBangunan + ' m²');
            } else {
                luasBangunanDisplay.val('-');
            }
            console.log('Luas bangunan display diisi:', luasBangunanDisplay.val());
        }
        
        if (luasBangunanHidden.length) {
            luasBangunanHidden.val(luasBangunan);
            console.log('Luas bangunan hidden diisi:', luasBangunanHidden.val());
        }
        
        suggestionsBox.hide();
    });

    // Sembunyikan suggestions saat klik di luar
    $(document).on('click', function(e) {
        if (!$(e.target).closest('.position-relative').length) {
            suggestionsBox.hide();
        }
    });

    // Keyboard navigation
    asetInput.on('keydown', function(e) {
        const items = suggestionsBox.find('.suggestion-item');
        const current = suggestionsBox.find('.suggestion-item.hover');
        
        if (e.key === 'ArrowDown') {
            e.preventDefault();
            if (current.length) {
                current.removeClass('hover').next().addClass('hover');
            } else if (items.length) {
                items.first().addClass('hover');
            }
        } else if (e.key === 'ArrowUp') {
            e.preventDefault();
            if (current.length) {
                current.removeClass('hover').prev().addClass('hover');
            }
        } else if (e.key === 'Enter') {
            e.preventDefault();
            if (current.length) {
                current.click();
            }
        }
    });

    // Tambahkan style untuk hover
    $('<style>.suggestion-item.hover{background-color:#e9ecef;}</style>').appendTo('head');
});
</script>

<script>
    console.log('File mitra_autocomplete.js loaded!');
console.log('jQuery version:', $.fn.jquery);

$(document).ready(function () {
    console.log('Document ready - Mitra Autocomplete initialized');
    console.log('Nama lengkap element exists:', $('#nama_lengkap').length > 0);
    console.log('Suggestions box exists:', $('#mitra-suggestions').length > 0);

    // Cek apakah variable URL tersedia
    if (typeof MITRA_SEARCH_URL === 'undefined') {
        console.error('MITRA_SEARCH_URL is not defined! Make sure it is set in the Blade template.');
        // Fallback URL
        var MITRA_SEARCH_URL = '{{ route("api.mitra.search") }}';
    }

    let mitraSearchTimeout;
    const namaLengkapInput = $('#nama_lengkap');
    const mitraSuggestionsBox = $('#mitra-suggestions');
    const idMitraInput = $('#id_mitra');

    // Elemen-elemen form yang akan diisi otomatis
    const formFields = {
        // Data Pribadi
        email: $('#email'),
        alamat: $('#alamat'),
        no_telepon: $('#no_telepon'),
        penyewa_berdasarkan: $('#penyewa_berdasarkan'),
        masa_berlaku_ktp: $('#masa_berlaku_ktp'),
        nik: $('#nik'),

        // Data Perusahaan
        nama_perwakilan: $('#nama_perwakilan'),
        perwakilan_selaku: $('#perwakilan_selaku'),
        npwp: $('#npwp'),
        kota_penyewa: $('#kota_penyewa'),
        kode_pos: $('#kode_pos'),
        fax_penyewa: $('#fax_penyewa'),
        no_akte_pendirian: $('#no_akte_pendirian'),
        no_anggaran_dasar: $('#no_anggaran_dasar'),
        tanggal_anggaran_dasar: $('#tanggal_anggaran_dasar'),
        no_kemenkumham: $('#no_kemenkumham'),
        tanggal_kemenkumham: $('#tanggal_kemenkumham'),
        no_penetapan_pengadilan: $('#no_penetapan_pengadilan'),
        tanggal_penetapan_pengadilan: $('#tanggal_penetapan_pengadilan'),
        no_izin_berusaha: $('#no_izin_berusaha'),
        tanggal_izin_berusaha: $('#tanggal_izin_berusaha'),
        surat_keterangan_pajak: $('#surat_keterangan_pajak'),
        tanggal_surat_keterangan_pajak: $('#tanggal_surat_keterangan_pajak'),
        surat_pengukuhan_pkp: $('#surat_pengukuhan_pkp'),
        tanggal_surat_pengukuhan_pkp: $('#tanggal_surat_pengukuhan_pkp'),

        // Radio button dan select
        jenis_penyewa: $('input[name="jenis_penyewa"]'),
        kategori: $('#kategori')
    };

    // Fungsi pencarian mitra berdasarkan nama
    function searchMitra(query) {
        console.log('Searching mitra for name:', query);

        if (query.length < 2) {
            mitraSuggestionsBox.hide();
            return;
        }

        console.log('Search URL:', MITRA_SEARCH_URL);

        $.ajax({
            url: MITRA_SEARCH_URL,
            data: { q: query },
            method: 'GET',
            success: function (data) {
                console.log('Mitra search results:', data);
                console.log('Number of results:', data.length);

                if (data.length > 0) {
                    displayMitraSuggestions(data);
                } else {
                    // Jika tidak ada data, tampilkan opsi buat baru
                    let html = `
                        <div class="suggestion-item text-muted">Data mitra tidak ditemukan</div>
                        <div class="suggestion-item new-mitra-item" data-id="new" data-nama="${query}">
                            <strong><i class="bi bi-plus-circle"></i> Buat Mitra Baru: "${query}"</strong>
                            <small class="text-primary">Klik untuk membuat data mitra baru</small>
                        </div>
                    `;
                    mitraSuggestionsBox.html(html).show();
                }
            },
            error: function (xhr, status, error) {
                console.error('AJAX Error:', error);
                console.error('Status:', status);
                console.error('Status Code:', xhr.status);
                console.error('Response:', xhr.responseText);

                let errorMsg = 'Error: ';
                if (xhr.status === 404) {
                    errorMsg += 'URL tidak ditemukan (404) - ' + MITRA_SEARCH_URL;
                } else {
                    errorMsg += error;
                }

                mitraSuggestionsBox.html('<div class="suggestion-item text-danger">' + errorMsg + '</div>').show();
            }
        });
    }

    // Tampilkan suggestions mitra
    function displayMitraSuggestions(mitras) {
        let html = '';

        // Tampilkan data mitra yang ada
        mitras.forEach(mitra => {
            console.log('Processing mitra:', mitra);

            html += `
                <div class="suggestion-item existing-mitra" 
                     data-id="${mitra.id_mitra || ''}"
                     data-nama="${mitra.nama || ''}"
                     data-email="${mitra.email || ''}"
                     data-alamat="${mitra.alamat || ''}"
                     data-no-telepon="${mitra.no_tlpn || ''}"
                     data-nik="${mitra.no_identitas || ''}"
                     data-masa-berlaku-ktp="${mitra.masa_berlaku_identitas || ''}"
                     data-penyewa-berdasarkan="${mitra.penyewa_berdasarkan || ''}"
                     data-jenis-penyewa="${mitra.Jenis || ''}"
                     data-kategori="${mitra.kategori || ''}"
                     data-nama-perwakilan="${mitra.nama_perwakilan || ''}"
                     data-perwakilan-selaku="${mitra.penyewa_selaku || ''}"
                     data-npwp="${mitra.npwp || ''}"
                     data-kota="${mitra.kota_penyewa || ''}"
                     data-kode-pos="${mitra.kode_pos || ''}"
                     data-fax="${mitra.fax_penyewa || ''}"
                     data-no-akte="${mitra.no_akta_pendirian || ''}"
                     data-no-anggaran="${mitra.no_anggaran_dasar || ''}"
                     data-tgl-anggaran="${mitra.tgl_anggaran_dasar || ''}"
                     data-no-kemenkumham="${mitra.no_kenmenhum_dan_ham || ''}"
                     data-tgl-kemenkumham="${mitra.tgl_persetujuan_kenmenhum_dan_ham || ''}"
                     data-no-penetapan="${mitra.no_penetapan_pengadilan || ''}"
                     data-tgl-penetapan="${mitra.tgl_penetapan_pengadilan || ''}"
                     data-no-izin="${mitra.no_izin_berusaha || ''}"
                     data-tgl-izin="${mitra.tgl_izin_usaha || ''}"
                     data-surat-pajak="${mitra.sk_dirjen_pajak || ''}"
                     data-tgl-pajak="${mitra.tgl_sk_dirjen_pajak || ''}"
                     data-surat-pkp="${mitra.surat_pengukuhan_kena_pajak || ''}"
                     data-tgl-pkp="${mitra.tgl_surat_pengukuhan_kena_pajak || ''}">
                    <strong>${highlightMitraText(mitra.nama || '', namaLengkapInput.val())}</strong>
                    <small>${mitra.email || 'Email tidak tersedia'}</small>
                    
                </div>
            `;
        });

        // Tambahkan opsi untuk membuat mitra baru
        html += `
            <div class="suggestion-item new-mitra-item" data-id="new" data-nama="${namaLengkapInput.val()}">
                <strong><i class="bi bi-plus-circle"></i> Buat Mitra Baru: "${namaLengkapInput.val()}"</strong>
                <small class="text-primary">Klik untuk membuat data mitra baru</small>
            </div>
        `;

        mitraSuggestionsBox.html(html).show();
        console.log('Mitra suggestions displayed');
    }

    // Highlight teks yang dicari
    function highlightMitraText(text, search) {
        if (!text || !search) return text || '';
        try {
            const regex = new RegExp(`(${search})`, 'gi');
            return text.replace(regex, '<mark>$1</mark>');
        } catch (e) {
            return text;
        }
    }

    // Fungsi untuk memilih mitra yang sudah ada
    function selectExistingMitra($element) {
        const mitraData = {
            id: $element.data('id'),
            nama: $element.data('nama'),
            email: $element.data('email'),
            alamat: $element.data('alamat'),
            no_telepon: $element.data('no-telepon'),
            nik: $element.data('nik'),
            masa_berlaku_ktp: $element.data('masa-berlaku-ktp'),
            penyewa_berdasarkan: $element.data('penyewa-berdasarkan'),
            jenis_penyewa: $element.data('jenis-penyewa'),
            kategori: $element.data('kategori'),
            nama_perwakilan: $element.data('nama-perwakilan'),
            perwakilan_selaku: $element.data('perwakilan-selaku'),
            npwp: $element.data('npwp'),
            kota: $element.data('kota'),
            kode_pos: $element.data('kode-pos'),
            fax: $element.data('fax'),
            no_akte: $element.data('no-akte'),
            no_anggaran: $element.data('no-anggaran'),
            tgl_anggaran: $element.data('tgl-anggaran'),
            no_kemenkumham: $element.data('no-kemenkumham'),
            tgl_kemenkumham: $element.data('tgl-kemenkumham'),
            no_penetapan: $element.data('no-penetapan'),
            tgl_penetapan: $element.data('tgl-penetapan'),
            no_izin: $element.data('no-izin'),
            tgl_izin: $element.data('tgl-izin'),
            surat_pajak: $element.data('surat-pajak'),
            tgl_pajak: $element.data('tgl-pajak'),
            surat_pkp: $element.data('surat-pkp'),
            tgl_pkp: $element.data('tgl-pkp')
        };

        console.log('Selected existing mitra:', mitraData);

        // Isi input nama lengkap
        namaLengkapInput.val(mitraData.nama);
        idMitraInput.val(mitraData.id);

        // Isi form Data Pribadi
        if (mitraData.email && formFields.email.length) formFields.email.val(mitraData.email);
        if (mitraData.alamat && formFields.alamat.length) formFields.alamat.val(mitraData.alamat);
        if (mitraData.no_telepon && formFields.no_telepon.length) formFields.no_telepon.val(mitraData.no_telepon);
        if (mitraData.nik && formFields.nik.length) formFields.nik.val(mitraData.nik);
        if (mitraData.masa_berlaku_ktp && formFields.masa_berlaku_ktp.length) formFields.masa_berlaku_ktp.val(mitraData.masa_berlaku_ktp);
        if (mitraData.penyewa_berdasarkan && formFields.penyewa_berdasarkan.length) formFields.penyewa_berdasarkan.val(mitraData.penyewa_berdasarkan);

        // Set radio button jenis penyewa
        if (mitraData.jenis_penyewa && formFields.jenis_penyewa.length) {
            formFields.jenis_penyewa.each(function () {
                if ($(this).val().toLowerCase() === mitraData.jenis_penyewa.toLowerCase()) {
                    $(this).prop('checked', true);
                }
            });
        }

        // Set select kategori
        if (mitraData.kategori && formFields.kategori.length) {
            formFields.kategori.val(mitraData.kategori);
        }

        // Isi form Data Perusahaan
        if (mitraData.nama_perwakilan && formFields.nama_perwakilan.length) formFields.nama_perwakilan.val(mitraData.nama_perwakilan);
        if (mitraData.perwakilan_selaku && formFields.perwakilan_selaku.length) formFields.perwakilan_selaku.val(mitraData.perwakilan_selaku);
        if (mitraData.npwp && formFields.npwp.length) formFields.npwp.val(mitraData.npwp);
        if (mitraData.kota && formFields.kota_penyewa.length) formFields.kota_penyewa.val(mitraData.kota);
        if (mitraData.kode_pos && formFields.kode_pos.length) formFields.kode_pos.val(mitraData.kode_pos);
        if (mitraData.fax && formFields.fax_penyewa.length) formFields.fax_penyewa.val(mitraData.fax);
        if (mitraData.no_akte && formFields.no_akte_pendirian.length) formFields.no_akte_pendirian.val(mitraData.no_akte);
        if (mitraData.no_anggaran && formFields.no_anggaran_dasar.length) formFields.no_anggaran_dasar.val(mitraData.no_anggaran);
        if (mitraData.tgl_anggaran && formFields.tanggal_anggaran_dasar.length) formFields.tanggal_anggaran_dasar.val(mitraData.tgl_anggaran);
        if (mitraData.no_kemenkumham && formFields.no_kemenkumham.length) formFields.no_kemenkumham.val(mitraData.no_kemenkumham);
        if (mitraData.tgl_kemenkumham && formFields.tanggal_kemenkumham.length) formFields.tanggal_kemenkumham.val(mitraData.tgl_kemenkumham);
        if (mitraData.no_penetapan && formFields.no_penetapan_pengadilan.length) formFields.no_penetapan_pengadilan.val(mitraData.no_penetapan);
        if (mitraData.tgl_penetapan && formFields.tanggal_penetapan_pengadilan.length) formFields.tanggal_penetapan_pengadilan.val(mitraData.tgl_penetapan);
        if (mitraData.no_izin && formFields.no_izin_berusaha.length) formFields.no_izin_berusaha.val(mitraData.no_izin);
        if (mitraData.tgl_izin && formFields.tanggal_izin_berusaha.length) formFields.tanggal_izin_berusaha.val(mitraData.tgl_izin);
        if (mitraData.surat_pajak && formFields.surat_keterangan_pajak.length) formFields.surat_keterangan_pajak.val(mitraData.surat_pajak);
        if (mitraData.tgl_pajak && formFields.tanggal_surat_keterangan_pajak.length) formFields.tanggal_surat_keterangan_pajak.val(mitraData.tgl_pajak);
        if (mitraData.surat_pkp && formFields.surat_pengukuhan_pkp.length) formFields.surat_pengukuhan_pkp.val(mitraData.surat_pkp);
        if (mitraData.tgl_pkp && formFields.tanggal_surat_pengukuhan_pkp.length) formFields.tanggal_surat_pengukuhan_pkp.val(mitraData.tgl_pkp);

        // Tampilkan notifikasi
        if (typeof Swal !== 'undefined') {
            Swal.fire({
                icon: 'success',
                title: 'Data Mitra Ditemukan',
                text: 'Data mitra "' + mitraData.nama + '" berhasil dimuat. Anda dapat mengubah data jika diperlukan.',
                timer: 2000,
                showConfirmButton: false
            });
        }
    }

    // Fungsi untuk membuat mitra baru
    function createNewMitra(nama) {
        console.log('Membuat mitra baru dengan nama:', nama);

        // Kosongkan ID mitra (set ke 'new' sebagai penanda)
        idMitraInput.val('new');

        // Reset form ke kondisi default (kosongkan semua field kecuali nama)
        resetFormFields();

        // Isi field nama saja
        namaLengkapInput.val(nama);

        // Tampilkan notifikasi
        if (typeof Swal !== 'undefined') {
            Swal.fire({
                icon: 'info',
                title: 'Data Mitra Baru',
                text: 'Data dengan nama "' + nama + '" belum terdaftar. Silakan lengkapi data di bawah ini.',
                timer: 3000,
                showConfirmButton: true
            });
        }

        console.log('Silakan lengkapi data untuk mitra baru');
    }

    // Fungsi untuk mereset form fields
    function resetFormFields() {
        formFields.email.val('');
        formFields.alamat.val('');
        formFields.no_telepon.val('');
        formFields.nik.val('');
        formFields.masa_berlaku_ktp.val('');
        formFields.penyewa_berdasarkan.val('');

        // Reset radio button
        formFields.jenis_penyewa.prop('checked', false);

        // Reset select
        formFields.kategori.val('');

        // Reset data perusahaan
        formFields.nama_perwakilan.val('');
        formFields.perwakilan_selaku.val('');
        formFields.npwp.val('');
        formFields.kota_penyewa.val('');
        formFields.kode_pos.val('');
        formFields.fax_penyewa.val('');
        formFields.no_akte_pendirian.val('');
        formFields.no_anggaran_dasar.val('');
        formFields.tanggal_anggaran_dasar.val('');
        formFields.no_kemenkumham.val('');
        formFields.tanggal_kemenkumham.val('');
        formFields.no_penetapan_pengadilan.val('');
        formFields.tanggal_penetapan_pengadilan.val('');
        formFields.no_izin_berusaha.val('');
        formFields.tanggal_izin_berusaha.val('');
        formFields.surat_keterangan_pajak.val('');
        formFields.tanggal_surat_keterangan_pajak.val('');
        formFields.surat_pengukuhan_pkp.val('');
        formFields.tanggal_surat_pengukuhan_pkp.val('');
    }

    // Event listener untuk input nama lengkap
    namaLengkapInput.on('input', function () {
        const query = $(this).val();
        console.log('Nama lengkap input changed:', query);

        clearTimeout(mitraSearchTimeout);
        mitraSearchTimeout = setTimeout(() => {
            searchMitra(query);
        }, 300);
    });

    // Event listener untuk memilih suggestion
    mitraSuggestionsBox.on('click', '.suggestion-item', function () {
        const $this = $(this);
        const isNewMitra = $this.data('id') === 'new'; // Cek apakah ini opsi "Buat Baru"

        if (isNewMitra) {
            // User memilih untuk membuat mitra baru
            createNewMitra($this.data('nama'));
        } else {
            // User memilih mitra yang sudah ada
            selectExistingMitra($this);
        }

        mitraSuggestionsBox.hide();
    });

    // Sembunyikan suggestions saat klik di luar
    $(document).on('click', function (e) {
        if (!$(e.target).closest('#nama_lengkap, #mitra-suggestions').length) {
            mitraSuggestionsBox.hide();
        }
    });

    // Keyboard navigation
    namaLengkapInput.on('keydown', function (e) {
        const items = mitraSuggestionsBox.find('.suggestion-item');
        const current = mitraSuggestionsBox.find('.suggestion-item.hover');

        if (e.key === 'ArrowDown') {
            e.preventDefault();
            if (current.length) {
                current.removeClass('hover').next().addClass('hover');
            } else if (items.length) {
                items.first().addClass('hover');
            }
        } else if (e.key === 'ArrowUp') {
            e.preventDefault();
            if (current.length) {
                current.removeClass('hover').prev().addClass('hover');
            }
        } else if (e.key === 'Enter') {
            e.preventDefault();
            if (current.length) {
                current.click();
            }
        }
    });

    // Tambahkan CSS untuk styling
    const style = `
        <style>
            .suggestion-item.hover {
                background-color: #e9ecef;
            }
            .suggestion-item .badge {
                font-size: 10px;
                margin-left: 5px;
                padding: 2px 5px;
                background-color: #28a745;
                color: white;
                border-radius: 3px;
            }
            .new-mitra-item {
                background-color: #f0f9ff;
                color: #0e9db6;
                border-top: 2px dashed #0e9db6;
            }
            .new-mitra-item:hover {
                background-color: #e1f3fa !important;
            }
            .new-mitra-item strong i {
                margin-right: 5px;
            }
            .suggestion-item strong mark {
                background-color: #fff3cd;
                padding: 0;
                font-weight: bold;
            }
        </style>
    `;
    $(style).appendTo('head');

    console.log('Mitra autocomplete initialization complete');
});
</script>


@endsection