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
                    <a href="#" 
                        class="btn btn-download" 
                        download>
                        <i class="fas fa-file-pdf fa-sm me-2"></i>Download
                    </a>
                </div>
            </div>
            <div class="card mb-4 border-0 p-5">
                <form id="approvalForm" action="{{ route('pendaftaran.approve', $dataps->id_perjanjian) }}"
                    method="POST">
                    @csrf
                    <input type="hidden" id="formAction" name="action" value="approve">
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
                                    'Ditolak' ? '' : '' }}>
                                </td>
                                <td class="text-center">
                                    <input class="form-check-input tidak-setuju-checkbox" type="checkbox"
                                        name="approval[1]" value="tidak_setuju" data-row="1" {{
                                        isset(session('approval_data_' . $dataps->id_perjanjian)[1]) &&
                                    session('approval_data_' . $dataps->id_perjanjian)[1] == 'tidak_setuju' ? 'checked'
                                    : '' }}
                                    {{ $dataps->dataMitra->status == 'Diterima' || $dataps->dataMitra->status ==
                                    'Ditolak' ? '' : '' }}>
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
                                    'Ditolak' ? '' : '' }}>
                                </td>
                                <td class="text-center">
                                    <input class="form-check-input tidak-setuju-checkbox" type="checkbox"
                                        name="approval[2]" value="tidak_setuju" data-row="2" {{
                                        isset(session('approval_data_' . $dataps->id_perjanjian)[2]) &&
                                    session('approval_data_' . $dataps->id_perjanjian)[2] == 'tidak_setuju' ? 'checked'
                                    : '' }}
                                    {{ $dataps->dataMitra->status == 'Diterima' || $dataps->dataMitra->status ==
                                    'Ditolak' ? '' : '' }}>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    <div class="row justify-content-end p-3">
                        <div class="col-12 ">
                            <div class="tombol-detail mt-3">
                                <button type="submit" class="btn btn-rejected px-5 me-2" name="action" value="reject">
                                    <i class="bi bi-x-circle me-2"></i>Tolak
                                </button>
                                <button type="submit" class="btn btn-approved px-5" name="action" value="approve">
                                    <i class="bi bi-check-circle me-2"></i>Terima
                                </button>
                            </div>

                            <div class="inputan-detail mt-3">
                                <label for="alasan_penolakan" class="form-label">Alasan Penolakan:</label>
                                <input type="text" id="alasan_penolakan" name="rejection_reason" class="form-inputan-alasan form-control">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Elemen-elemen yang diperlukan
    const approvalForm = document.getElementById('approvalForm');
    const checkboxes = document.querySelectorAll('.form-check-input');
    const rejectBtn = document.querySelector('button[value="reject"]');
    const approveBtn = document.querySelector('button[value="approve"]');
    const alasanInput = document.getElementById('alasan_penolakan');
    
    // Fungsi untuk mengatur checkbox (hanya satu yang bisa dipilih per baris)
    function setupCheckboxes() {
        checkboxes.forEach(checkbox => {
            checkbox.addEventListener('change', function() {
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
            
            // Wajibkan alasan penolakan
            alasanInput.required = true;
        } else {
            // Jika semua setuju, aktifkan tombol terima, nonaktifkan tombol tolak
            rejectBtn.disabled = true;
            approveBtn.disabled = false;
            
            // Tidak wajibkan alasan penolakan
            alasanInput.required = false;
        }
    }
    
    // Fungsi untuk memeriksa apakah semua baris sudah dipilih
    function checkAllRowsFilled() {
        const rows = [1, 2]; // Sesuaikan dengan jumlah baris
        return rows.every(row => {
            return document.querySelector(`.form-check-input[data-row="${row}"]:checked`) !== null;
        });
    }
    
    // Event listener untuk input alasan penolakan
    alasanInput.addEventListener('input', function() {
        updateButtonStates();
    });
    
    // Event listener untuk submit form
    approvalForm.addEventListener('submit', function(e) {
        const action = document.activeElement.value;
        
        if (action === 'reject') {
            // Validasi untuk penolakan
            if (!alasanInput.value.trim()) {
                e.preventDefault();
                alert('Harap isi alasan penolakan!');
                alasanInput.focus();
                return;
            }
        }
        
        // Set nilai form action
        document.getElementById('formAction').value = action;
        document.getElementById('rejectionReason').value = alasanInput.value;
    });
    
    // Inisialisasi
    setupCheckboxes();
    updateButtonStates();
});
</script>


@endsection