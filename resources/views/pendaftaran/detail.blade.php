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
                                <td>{{ $dataps->dataMitra->nama ?? $mitra->nama ?? 'N/A' }}</td>
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
                    <div class="row justify-content-center p-3">
                        <div class="col-3">
                            <button type="button" class="btn btn-approved px-5">
                                <i class="bi bi-check-circle me-2"></i>Approved
                            </button>
                        </div>
                    </div>
                </div>
                <div class="card mb-4 border-0 p-5">
                    <div class="row row-dokumen p-4">
                        <div class="card-bodyy text-center pt-0">
                        <a href="{{ url('pendaftaran/perjanjian_dokumen/'.$dataps->id_perjanjian) }}" class="btn btn-dock px-5" target="_blank">
                            <i class="bi bi-file-earmark-text me-2"></i>DOKUMEN PERJANJIAN
                        </a>
                    </div>
                    </div>
                    <div class="row row-list-perjanjian p-4">
                        <div class="col-4">
                            <a href="{{ url('pendaftaran/list_data') }}"
                                class="btn btn-kembali px-5 text-decoration-none">
                                <i class="bi bi-arrow-left-circle me-2"></i>kembali
                            </a>
                            </button>
                        </div>
                        <div class="col-4">
                            <a href="{{ url('perjanjian/preview', $dataps->id_perjanjian) }}" 
                            rel="noopener" 
                            target="_blank" 
                            class="btn btn-default">
                                <i class="fas fa-print"></i> Print
                            </a>
                        </div>
                        <div class="col-4">
                            <button type="button" class="btn btn-share px-5">
                                <i class="bi bi-share me-2"></i>Share
                            </button>
                        </div>
                        
                    </div>
                </div>
        </div>
    </div>
</div>


@endsection