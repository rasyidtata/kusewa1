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
            <form class="biodata-form" method="POST" action="{{ url('pendaftaran/update/'.$dataps->id_perjanjian) }}" enctype="multipart/form-data">
                @csrf
                <div class="row justify-content-start p-3">
                    <div class="col-md-4">
                        <div class="form-group text-center">
                            <div class="btn-group" role="group" aria-label="Jenis Penyewa">
                                <input type="radio" class="btn-check" name="jenis_penyewa" id="perorangan"
                                    value="perorangan" checked>
                                <label class="btn" for="perorangan">
                                    <i class="bi bi-person-fill "></i>
                                    Perorangan
                                </label>

                                <input type="radio" class="btn-check" name="jenis_penyewa" id="instansi"
                                    value="instansi">
                                <label class="btn" for="instansi">
                                    <i class="bi bi-building "></i>
                                    Instansi
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
                                        placeholder="Masukkan nama lengkap" value="{{ $dataps->$nama }}" readonly>

                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="nik" class="form-label fw-medium">NIK</label>
                                    <input type="text" id="nik" name="nik" class="form-control"
                                        placeholder="Masukkan NIK" value="340413140998788001" readonly>
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
                                        <input type="date" id="Masa_Berlaku_KTP" name="Masa_Berlaku_KTP"
                                            class="form-control" value="340413140998788001" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="email" class="form-label fw-medium">Alamat E-mail</label>
                                    <input type="email" id="email" name="email" class="form-control"
                                        placeholder="email@contoh.com" value="340413140998788001" readonly>
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
                                        placeholder="08xxxxxxxxxx" value="340413140998788001" readonly>
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
                                            class="form-control" value="340413140998788001" readonly>
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
                                        class="form-control" placeholder="Berdasarkan..." value="340413140998788001"
                                        readonly>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="alamat" class="form-label fw-medium">Alamat</label>
                                    <textarea id="alamat" name="alamat" class="form-control" rows="3"
                                        placeholder="Masukkan alamat lengkap" value="340413140998788001"
                                        readonly></textarea>
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
                                    <label for="nama_perwakilan" class="form-label fw-medium">Nama Perwakilan</label>
                                    <input type="text" id="nama_perwakilan" name="nama_perwakilan" class="form-control"
                                        placeholder="Nama perwakilan perusahaan" value="340413140998788001" readonly>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="perwakilan_selaku" class="form-label fw-medium">Perwakilan
                                        Selaku</label>
                                    <input type="text" id="perwakilan_selaku" name="perwakilan_selaku"
                                        class="form-control" placeholder="Jabatan perwakilan" value="340413140998788001"
                                        readonly>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="npwp" class="form-label fw-medium">NPWP</label>
                                    <input type="text" id="npwp" name="npwp" class="form-control"
                                        placeholder="Nomor NPWP perusahaan" value="340413140998788001" readonly>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="kota_penyewa" class="form-label fw-medium">Kota Penyewa</label>
                                    <input type="text" id="kota_penyewa" name="kota_penyewa" class="form-control"
                                        placeholder="Kota domisili perusahaan" value="340413140998788001" readonly>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="kode_pos" class="form-label fw-medium">Kode Pos</label>
                                    <input type="text" id="kode_pos" name="kode_pos" class="form-control"
                                        placeholder="Kode pos" value="340413140998788001" readonly>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="fax_penyewa" class="form-label fw-medium">FAX Penyewa</label>
                                    <input type="text" id="fax_penyewa" name="fax_penyewa" class="form-control"
                                        placeholder="Nomor fax perusahaan" value="340413140998788001" readonly>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="no_akte_pendirian" class="form-label fw-medium">Nomor Akte
                                        Pendirian</label>
                                    <input type="text" id="no_akte_pendirian" name="no_akte_pendirian"
                                        class="form-control" placeholder="Nomor akte pendirian"
                                        value="340413140998788001" readonly>
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
                                        <input type="date" id="Tanggal_Anggaran_Dasar" name="Tanggal_Anggaran_Dasar"
                                            class="form-control" value="340413140998788001" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="no_anggaran_dasar" class="form-label fw-medium">Nomor Anggaran Dasar
                                        Terakhir</label>
                                    <input type="text" id="no_anggaran_dasar" name="no_anggaran_dasar"
                                        class="form-control" placeholder="Nomor anggaran dasar"
                                        value="340413140998788001" readonly>
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
                                        <input type="date" id="Tanggal_Persetujuan_Kemenkum_dan_HAM"
                                            name="Tanggal_Persetujuan_Kemenkum_dan_HAM" class="form-control"
                                            value="340413140998788001" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="no_kemenkumham" class="form-label fw-medium">Nomor Kemenkum dan
                                        HAM</label>
                                    <input type="text" id="no_kemenkumham" name="no_kemenkumham" class="form-control"
                                        placeholder="Nomor Kemenkumham" value="340413140998788001" readonly>
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
                                        <input type="date" id="Tanggal_Penetapan_Pengadilan_(CV)"
                                            name="Tanggal_Penetapan_Pengadilan_(CV)" class="form-control"
                                            value="340413140998788001" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="no_penetapan_pengadilan" class="form-label fw-medium">Nomor Penetapan
                                        Pengadilan (CV)</label>
                                    <input type="text" id="no_penetapan_pengadilan" name="no_penetapan_pengadilan"
                                        class="form-control" placeholder="Nomor penetapan pengadilan"
                                        value="340413140998788001" readonly>
                                </div>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="tanggal_izin_berusaha" class="form-label fw-medium">Tanggal Nomor Izin
                                        Berusaha</label>
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <i class="bi bi-calendar3"></i>
                                        </span>
                                        <input type="date" id="Tanggal_Nomor_Izin_Berusaha"
                                            name="Tanggal_Nomor_Izin_Berusaha" class="form-control"
                                            value="340413140998788001" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="no_izin_berusaha" class="form-label fw-medium">Nomor Izin
                                        Berusaha</label>
                                    <input type="text" id="no_izin_berusaha" name="no_izin_berusaha"
                                        class="form-control" placeholder="Nomor izin berusaha"
                                        value="340413140998788001" readonly>
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
                                        <input type="date" id="Tanggal_Surat_Keterangan_Terdaftar_Dirjen_Pajak"
                                            name="Tanggal_Surat_Keterangan_Terdaftar_Dirjen_Pajak" class="form-control"
                                            value="340413140998788001" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="surat_keterangan_pajak" class="form-label fw-medium">Surat Keterangan
                                        Terdaftar Dirjen Pajak</label>
                                    <input type="text" id="surat_keterangan_pajak" name="surat_keterangan_pajak"
                                        class="form-control" placeholder="Nomor surat keterangan"
                                        value="340413140998788001" readonly>
                                </div>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="tanggal_surat_pengukuhan_pkp" class="form-label fw-medium">Tanggal Surat
                                        Pengukuhan Pengusaha Kena Pajak</label>
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <i class="bi bi-calendar3"></i>
                                        </span>
                                        <input type="date" id="Tanggal_Surat_Pengukuhan_Pengusaha_Kena_Pajak"
                                            name="Tanggal_Surat_Pengukuhan_Pengusaha_Kena_Pajak" class="form-control"
                                            value="340413140998788001" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="surat_pengukuhan_pkp" class="form-label fw-medium">Surat Pengukuhan
                                        Pengusaha Kena Pajak</label>
                                    <input type="text" id="surat_pengukuhan_pkp" name="surat_pengukuhan_pkp"
                                        class="form-control" placeholder="Nomor surat pengukuhan PKP"
                                        value="340413140998788001" readonly>
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
                                    <label for="nama_perwakilan" class="form-label fw-medium">Alamat Lokasi
                                        Asset</label>
                                    <textarea id="alamat_asset" name="alamat_asset" class="form-control" rows="3"
                                        placeholder="Masukkan alamat lengkap" value="340413140998788001"
                                        readonly></textarea>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="perwakilan_selaku" class="form-label fw-medium">Penggunaan Lokasi
                                        Asset</label>
                                    <textarea id="penggunaan_asset" name="penggunaan_asset" class="form-control"
                                        rows="3" placeholder="Masukkan alamat lengkap" value="340413140998788001"
                                        readonly></textarea>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="npwp" class="form-label fw-medium">Luas Tanah</label>
                                    <input type="text" id="luas_tanah" name="npwp" class="form-control"
                                        placeholder="Luas Tanah Dalan m" value="340413140998788001" readonly>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="kota_penyewa" class="form-label fw-medium">Luas Bangunan</label>
                                    <input type="text" id="luas_bangunan" name="luas_bangunan" class="form-control"
                                        placeholder="Luas Bangunan Dalam m" value="340413140998788001" readonly>
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
                                                placeholder="Tahun" value="340413140998788001" readonly>
                                        </div>
                                        <div class="col-4">
                                            <input type="text" id="bulan" name="bulan" class="form-control"
                                                placeholder="Bulan" value="340413140998788001" readonly>
                                        </div>
                                        <div class="col-4">
                                            <input type="text" id="hari" name="hari" class="form-control"
                                                placeholder="Hari" value="340413140998788001" readonly>
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
                                        <input type="date" id="masa_awal_perjanjian" name="masa_awal_perjanjian"
                                            class="form-control" value="340413140998788001" readonly>
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
                                        <input type="date" id="massa_akhir_perjanjian" name="massa_akhir_perjanjian"
                                            class="form-control" value="340413140998788001" readonly>
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
                                        <input type="date" id="massa_awal_pemanfaatan" name="massa_awal_pemanfaatan"
                                            class="form-control" value="340413140998788001" readonly>
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
                                            class="form-control" value="340413140998788001" readonly>
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
                                        placeholder="Rp." value="340413140998788001" readonly>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="perwakilan_selaku" class="form-label fw-medium">Harga
                                        Pemanfaatan</label>
                                    <input type="text" id="harga_pemanfaatan" name="harga_pemanfaatan"
                                        class="form-control" placeholder="Rp." value="340413140998788001" readonly>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="npwp" class="form-label fw-medium">Biaya Admin</label>
                                    <input type="text" id="biaya_admin" name="biaya_admin" class="form-control"
                                        placeholder="Rp." value="340413140998788001" readonly>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="kota_penyewa" class="form-label fw-medium">Cost Of Money</label>
                                    <input type="text" id="cost_of_money" name="cost_of_money" class="form-control"
                                        placeholder="Rp." value="340413140998788001" readonly>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="npwp" class="form-label fw-medium">Harga Sewa + Admin</label>
                                    <input type="text" id="harga_sewa_admin" name="harga_sewa_admin"
                                        class="form-control" placeholder="Rp." value="340413140998788001" readonly>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="kota_penyewa" class="form-label fw-medium">Harga Sewa + Admin +
                                        COM</label>
                                    <input type="text" id="hagra_sewa_admin_com" name="hagra_sewa_admin_com"
                                        class="form-control" placeholder="Rp." value="340413140998788001" readonly>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="npwp" class="form-label fw-medium">PPN 11%</label>
                                    <input type="text" id="ppn" name="ppn" class="form-control" placeholder="Rp."
                                        value="340413140998788001" readonly>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="kota_penyewa" class="form-label fw-medium">Total Harga</label>
                                    <input type="text" id="total_harga" name="total_harga" class="form-control"
                                        placeholder="Rp." value="340413140998788001" readonly>
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
                                        placeholder="Tujuh ratus limapuluh ribu rupiah" value="340413140998788001"
                                        readonly></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card mb-4 border-0 p-5">
                    <div class="card-bodyy text-center pt-0"> 
                        <a href="{{ url('pendaftaran/perjanjian') }}" class="btn btn-dock px-5">
                            <i class="bi bi-file-earmark-text me-2"></i>DOKUMEN PERJANJIAN
                        </a>
                    </div>
                </div>
                <div class="card mb-4 border-0 p-5">
                    <table class="table table-perjanjian table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Mitra</th>
                                <th>Nomor Kontrak</th>
                                <th>Setuju</th>
                                <th>Tidak Setuju</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="text-center">1</td>
                                <td>Petugas KAI DAOP 6 DIY</td>
                                <td>KAI20250001</td>
                                <td class="text-center">
                                    <input class="form-check-input" type="checkbox" id="setuju">
                                </td>
                                <td class="text-center">
                                    <input class="form-check-input" type="checkbox" id="tidak_setuju">
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center">2</td>
                                <td>Rasyid tata d</td>
                                <td>KAI20250001</td>
                                <td class="text-center">
                                    <input class="form-check-input" type="checkbox" id="setuju">
                                </td>
                                <td class="text-center">
                                    <input class="form-check-input" type="checkbox" id="tidak_setuju">
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="card mb-4 border-0 p-5">
                    <div class="row row-list-perjanjian">
                        <div class="col-3">
                            <a href="{{ url('pendaftaran/list_data') }}" class="btn btn-kembali px-5 text-decoration-none">
                                <i class="bi bi-arrow-left-circle me-2"></i>kembali
                            </a>
                        </button>
                        </div>
                        <div class="col-3">
                            <button type="button" class="btn btn-download px-5">
                            <i class="bi bi-download me-2"></i>Download
                        </button>
                        </div>
                        <div class="col-3">
                            <button type="button" class="btn btn-share px-5">
                            <i class="bi bi-share me-2"></i>Share
                        </button>
                        </div>
                        <div class="col-3">
                            <button type="button" class="btn btn-approved px-5">
                            <i class="bi bi-check-circle me-2"></i>Approved
                        </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>


@endsection