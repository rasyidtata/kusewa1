@extends('template.admin')

@section('title', 'halaman | detail')

@section('content')
<div class="container-form-detail">
    <div class="text-start p-3">
        <a> Perjanjian Mitra KAI DAOP 6 Yogyakarta</a>
    </div>
    <div class="card card-detail">
        <div class="card-header-form text- text-center py-3">
            <h4 class="card-title-form mb-0">Detail Perjanjian</h4>
        </div>
        <hr>
        <div class="card-body p-2">
            <div class="row">
                <div class="col-12">
                    @if($dataps->dataMitra->status == 'Diterima')
                    <div class="alert alert-success mt-2">
                        <i class="bi bi-check-circle me-2"></i>Status: Diterima
                    </div>
                    @elseif($dataps->dataMitra->status == 'Ditolak')
                    <div class="alert alert-danger mt-2">
                        <i class="bi bi-x-circle me-2"></i>Status: Ditolak
                        @if($dataps->dataMitra->alasan_penolakan)
                        <br><small>Alasan: {{ $dataps->dataMitra->alasan_penolakan }}</small>
                        @endif
                    </div>
                    @endif
                </div>
            </div>
            <div class="row row-detail-cetak ">
                <div class="col-4 col-kembali">
                    <a href="{{ url('pendaftaran/fitur_filter') }}" class="text text-kembali px-5">
                        <i class="bi bi-arrow-left-circle me-2"></i>kembali
                    </a>
                </div>
                <div class="col-4">
                    <div class="card-bodyy text-center pt-0">
                        <a href="{{ url('pendaftaran/perjanjian_dokumen/'.$dataps->id_perjanjian) }}"
                            class="btn btn-dock px-5" target="_blank">
                            <i class="fas fa-file-pdf fa-sm me-2"></i>UNDUH DOKUMEN
                        </a>
                    </div>
                </div>
                <div class="col-4 col-share">
                    <button type="button" class="btn btn-share ">
                        <i class="bi bi-share me-2"></i>Share
                    </button>
                    <a href="#" class="btn btn-download" download>
                        <i class="fas fa-file-pdf fa-sm me-2"></i>Download
                    </a>
                </div>
            </div>
            <div class="card mb-4 border-0 p-5">
                <form id="approvalForm" action="{{ route('pendaftaran.approve', $dataps->id_perjanjian) }}"
                    method="POST">
                    @csrf
                    <input type="hidden" id="formAction" name="action" value="">
                    <input type="hidden" id="rejectionReason" name="rejection_reason" value="">

                    <table class="table table-bordered">
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
                                    <input class="form-check-input setuju-checkbox" type="checkbox" name="approval[1]"
                                        value="setuju" data-row="1" {{ isset(session('approval_data_' .
                                        $dataps->id_perjanjian)[1]) && session('approval_data_' .
                                    $dataps->id_perjanjian)[1] == 'setuju' ? 'checked' : '' }}
                                    {{ $dataps->dataMitra->status == 'Diterima' || $dataps->dataMitra->status ==
                                    'Ditolak' ? 'disabled' : '' }}>
                                </td>
                                <td class="text-center">
                                    <input class="form-check-input tidak-setuju-checkbox" type="checkbox"
                                        name="approval[1]" value="tidak_setuju" data-row="1" {{
                                        isset(session('approval_data_' . $dataps->id_perjanjian)[1]) &&
                                    session('approval_data_' . $dataps->id_perjanjian)[1] == 'tidak_setuju' ? 'checked'
                                    : '' }}
                                    {{ $dataps->dataMitra->status == 'Diterima' || $dataps->dataMitra->status ==
                                    'Ditolak' ? 'disabled' : '' }}>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center">2</td>
                                <td>{{ $dataps->dataMitra->nama ?? 'N/A' }}</td>
                                <td>KAI20250001</td>
                                <td class="text-center">
                                    <input class="form-check-input setuju-checkbox" type="checkbox" name="approval[2]"
                                        value="setuju" data-row="2" {{ isset(session('approval_data_' .
                                        $dataps->id_perjanjian)[2]) && session('approval_data_' .
                                    $dataps->id_perjanjian)[2] == 'setuju' ? 'checked' : '' }}
                                    {{ $dataps->dataMitra->status == 'Diterima' || $dataps->dataMitra->status ==
                                    'Ditolak' ? 'disabled' : '' }}>
                                </td>
                                <td class="text-center">
                                    <input class="form-check-input tidak-setuju-checkbox" type="checkbox"
                                        name="approval[2]" value="tidak_setuju" data-row="2" {{
                                        isset(session('approval_data_' . $dataps->id_perjanjian)[2]) &&
                                    session('approval_data_' . $dataps->id_perjanjian)[2] == 'tidak_setuju' ? 'checked'
                                    : '' }}
                                    {{ $dataps->dataMitra->status == 'Diterima' || $dataps->dataMitra->status ==
                                    'Ditolak' ? 'disabled' : '' }}>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    <div class="row justify-content-end p-3">
                        <div class="col-12 ">
                            <div class="tombol-detail mt-3">
                                <button type="button" id="rejectBtn" class="btn btn-rejected px-5 me-2" {{
                                    $dataps->dataMitra->status == 'Diterima' || $dataps->dataMitra->status == 'Ditolak'
                                    ? 'disabled' : '' }}>
                                    <i class="bi bi-x-circle me-2"></i>Tolak
                                </button>
                                <button type="button" id="approveBtn" class="btn btn-approved px-5" {{
                                    $dataps->dataMitra->status == 'Diterima' || $dataps->dataMitra->status == 'Ditolak'
                                    ? 'disabled' : '' }}>
                                    <i class="bi bi-check-circle me-2"></i>Terima
                                </button>
                            </div>

                            <div class="inputan-detail mt-3">
                                <label for="alasan_penolakan" class="form-label">Alasan Penolakan:</label>
                                <textarea id="alasan_penolakan" name="rejection_reason"
                                    class="form-inputan-alasan form-control" rows="3" {{
                                    $dataps->dataMitra->status == 'Diterima' || $dataps->dataMitra->status == 'Ditolak' ? 'readonly' : '' }}>{{ $dataps->dataMitra->alasan_penolakan ?? '' }}</textarea>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- SweetAlert CDN -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Elemen-elemen yang diperlukan
        const approvalForm = document.getElementById('approvalForm');
        const checkboxes = document.querySelectorAll('.form-check-input');
        const rejectBtn = document.getElementById('rejectBtn');
        const approveBtn = document.getElementById('approveBtn');
        const alasanTextarea = document.getElementById('alasan_penolakan');

        // Cek jika status sudah final (Diterima/Ditolak)
        const isStatusFinal = {{ $dataps-> dataMitra -> status == 'Diterima' || $dataps -> dataMitra -> status == 'Ditolak' ? 'true' : 'false'
    }};

    // Notifikasi session
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

    // Fungsi untuk mengatur checkbox (hanya satu yang bisa dipilih per baris)
    function setupCheckboxes() {
        checkboxes.forEach(checkbox => {
            checkbox.addEventListener('change', function () {
                if (isStatusFinal) return;

                const row = this.getAttribute('data-row');
                const isSetuju = this.classList.contains('setuju-checkbox');

                // Reset semua checkbox di baris yang sama
                document.querySelectorAll(`.form-check-input[data-row="${row}"]`).forEach(cb => {
                    cb.checked = false;
                });

                // Centang checkbox yang dipilih
                this.checked = true;

                // Perbarui status tombol
                updateButtonStates();
            });
        });
    }

    // Fungsi untuk memperbarui status tombol
    function updateButtonStates() {
        if (isStatusFinal) return;

        const semuaTerisi = checkAllRowsFilled();

        // Nonaktifkan semua tombol jika belum semua baris terisi
        if (!semuaTerisi) {
            rejectBtn.disabled = true;
            approveBtn.disabled = true;
            return;
        }

        // Cek apakah ada yang tidak setuju
        const adaTidakSetuju = document.querySelectorAll('.tidak-setuju-checkbox:checked').length > 0;

        if (adaTidakSetuju) {
            // Jika ada yang tidak setuju, aktifkan tombol tolak, nonaktifkan tombol terima
            rejectBtn.disabled = false;
            approveBtn.disabled = true;
        } else {
            // Jika semua setuju, aktifkan tombol terima, nonaktifkan tombol tolak
            rejectBtn.disabled = true;
            approveBtn.disabled = false;
        }
    }

    // Fungsi untuk memeriksa apakah semua baris sudah dipilih
    function checkAllRowsFilled() {
        const rows = [1, 2]; // Sesuaikan dengan jumlah baris
        return rows.every(row => {
            return document.querySelector(`.form-check-input[data-row="${row}"]:checked`) !== null;
        });
    }

    // SweetAlert untuk konfirmasi Approve
    approveBtn.addEventListener('click', function () {
        if (isStatusFinal) return;

        const namaMitra = "{{ $dataps->dataMitra->nama ?? 'Mitra' }}";
        const kodePerjanjian = "{{ $dataps->kode_perjanjian ?? 'N/A' }}";

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
                    <h4 style="color: #1f2937;">Terima Perjanjian?</h4>
                    <p style="color: #4b5563;">
                        Anda akan menyetujui perjanjian dengan:<br>
                        <strong>${namaMitra}</strong><br>
                        <small>Kode: ${kodePerjanjian}</small>
                    </p>
                    <p style="color: #6b7280; font-size: 14px; margin-top: 10px;">
                        Status akan berubah menjadi <span class="badge bg-success">Diterima</span>
                    </p>
                </div>
            `,
            
            showCancelButton: true,
            confirmButtonColor: '#10b981',
            cancelButtonColor: '#6b7280',
            confirmButtonText: 'Ya, Terima',
            cancelButtonText: 'Batal',
            reverseButtons: true,
            customClass: {}
        }).then((result) => {
            if (result.isConfirmed) {
                // Set action dan submit form
                document.getElementById('formAction').value = 'approve';
                document.getElementById('rejectionReason').value = '';

                // Tampilkan loading
                Swal.fire({
                    title: 'Memproses...',
                    text: 'Sedang menyimpan data penerimaan',
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });

                // Submit form
                setTimeout(() => {
                    approvalForm.submit();
                }, 500);
            }
        });
    });

    // SweetAlert untuk konfirmasi Reject
    rejectBtn.addEventListener('click', function () {
        if (isStatusFinal) return;

        // Validasi apakah sudah mengisi alasan penolakan
        if (!alasanTextarea.value.trim()) {
            Swal.fire({
                icon: 'warning',
                title: 'Alasan Diperlukan',
                text: 'Harap isi alasan penolakan terlebih dahulu',
                confirmButtonColor: '#f59e0b'
            });
            alasanTextarea.focus();
            return;
        }

        const namaMitra = "{{ $dataps->dataMitra->nama ?? 'Mitra' }}";
        const alasan = alasanTextarea.value.substring(0, 100) + (alasanTextarea.value.length > 100 ? '...' : '');

        Swal.fire({
            title: '',
            html: `
                <div style="text-align: center;">
                    <div style="color: #dc2626; font-size: 48px; margin-bottom: 15px;">
                        <i class="bi bi-x-circle"></i>
                    </div>
                    <h4 style="color: #1f2937;">Tolak Perjanjian?</h4>
                    <p style="color: #4b5563;">
                        Anda akan menolak perjanjian dengan:<br>
                        <strong>${namaMitra}</strong>
                    </p>
                    <div style="background: #fee2e2; padding: 10px; border-radius: 5px; margin: 15px 0;">
                        <p style="color: #b91c1c; margin: 0; font-size: 14px;">
                            <i class="bi bi-exclamation-triangle me-1"></i>
                            <strong>Alasan Penolakan:</strong><br>
                            ${alasan}
                        </p>
                    </div>
                    <p style="color: #6b7280; font-size: 14px;">
                        Status akan berubah menjadi <span class="badge bg-danger">Ditolak</span>
                    </p>
                </div>
            `,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#dc2626',
            cancelButtonColor: '#6b7280',
            confirmButtonText: 'Ya, Tolak',
            cancelButtonText: 'Edit Alasan',
            reverseButtons: true,
            customClass: {
                
            }
        }).then((result) => {
            if (result.isConfirmed) {
                // Set action dan submit form
                document.getElementById('formAction').value = 'reject';
                document.getElementById('rejectionReason').value = alasanTextarea.value;

                // Tampilkan loading
                Swal.fire({
                    title: 'Memproses...',
                    text: 'Sedang menyimpan data penolakan',
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });

                // Submit form
                setTimeout(() => {
                    approvalForm.submit();
                }, 500);
            }
        });
    });

    // Event listener untuk input alasan penolakan
    alasanTextarea.addEventListener('input', function () {
        if (isStatusFinal) return;

        // Validasi panjang alasan
        const maxLength = 500;
        const currentLength = this.value.length;

        if (currentLength > maxLength) {
            this.value = this.value.substring(0, maxLength);
            Swal.fire({
                icon: 'warning',
                title: 'Maksimal Karakter',
                text: `Alasan penolakan maksimal ${maxLength} karakter`,
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000
            });
        }

        updateButtonStates();
    });

    // Pencegahan submit form secara langsung
    approvalForm.addEventListener('submit', function (e) {
        if (!document.getElementById('formAction').value) {
            e.preventDefault();
            Swal.fire({
                icon: 'error',
                title: 'Aksi Tidak Valid',
                text: 'Silakan pilih aksi terlebih dahulu',
                confirmButtonColor: '#dc2626'
            });
        }
    });

    // Inisialisasi
    setupCheckboxes();
    updateButtonStates();

    // Jika sudah ada status, nonaktifkan semua input
    if (isStatusFinal) {
        const status = "{{ $dataps->dataMitra->status }}";
        const alasan = "{{ $dataps->dataMitra->alasan_penolakan ?? '' }}";

        // Tampilkan info status final
        console.log(`Status final: ${status}${alasan ? ` - Alasan: ${alasan}` : ''}`);
    }
});
</script>

<style>
    /* Style tambahan untuk SweetAlert */
    .swal2-popup {
        border-radius: 12px;
        font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
    }

    .swal2-title {
        font-size: 1.25rem;
        font-weight: 600;
    }

    /* Style untuk tombol disabled */
    .btn:disabled {
        opacity: 0.5;
        cursor: not-allowed;
    }

    /* Style untuk textarea alasan */
    .form-inputan-alasan {
        resize: vertical;
        min-height: 80px;
    }

    .form-inputan-alasan:read-only {
        background-color: #f9fafb;
        border-color: #e5e7eb;
    }

    /* Badge untuk status */
    .badge {
        font-size: 0.75em;
        padding: 0.35em 0.65em;
    }

    /* Style untuk checkbox disabled */
    .form-check-input:disabled {
        background-color: #e5e7eb;
        border-color: #d1d5db;
    }

    .form-check-input:disabled:checked {
        background-color: #9ca3af;
        border-color: #6b7280;
    }
</style>

@endsection