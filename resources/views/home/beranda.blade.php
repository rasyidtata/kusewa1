@extends('template.admin')

@section('title', 'Dashboard | Utama')

@section('content')
<div class="container-fluid">
    
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800 font-weight-bold">Dashboard Monitoring Aset</h1>
    </div>

    <div class="row">
        <!-- KARTU 1: TOTAL PENDAPATAN (BIRU) -->
        <div class="col-lg-6 col-12">
            <div class="small-box bg-gradient-primary">
                <div class="inner">
                    <h3>Rp {{ isset($chartData['data_pendapatan']) ? number_format($chartData['data_pendapatan']->sum(), 0, ',', '.') : 0 }}</h3>
                    <p>Total Pendapatan (Tahun Ini)</p>
                </div>
                <div class="icon">
                    <i class="fas fa-money-bill-wave"></i>
                </div>
            </div>
        </div>

        <!-- KARTU 2: JUMLAH TOTAL (HIJAU) -->
        <div class="col-lg-3 col-6">
            <div class="small-box bg-gradient-success">
                <div class="inner">
                    <!-- Mengambil data total semua -->
                    <h3>{{ $chartData['total_semua_perjanjian'] ?? 0 }}</h3>
                    <p>Jumlah Total Perjanjian</p>
                </div>
                <div class="icon">
                    <i class="fas fa-file-contract"></i>
                </div>
            </div>
        </div>

        <!-- KARTU 3: PERJANJIAN AKTIF (KUNING) -->
        <div class="col-lg-3 col-6">
            <div class="small-box bg-gradient-warning">
                <div class="inner">
                    <!-- Mengambil data yang aktif saja -->
                    <h3 style="color: white;">{{ $chartData['jumlah_perjanjian_aktif'] ?? 0 }}</h3>
                    <p style="color: white;">Perjanjian Sedang Aktif</p>
                </div>
                <div class="icon">
                    <i class="fas fa-check-circle"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Grafik -->
    <div class="row">
        <div class="col-xl-8 col-lg-7">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-chart-line me-2"></i>Tren Pendapatan Sewa</h6>
                </div>
                <div class="card-body">
                    <div class="chart-area" style="height: 350px;">
                        <canvas id="incomeChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-lg-5">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-chart-pie me-2"></i>Status Aset</h6>
                </div>
                <div class="card-body">
                    <div class="chart-pie pt-4 pb-2" style="height: 300px;">
                        <canvas id="statusChart"></canvas>
                    </div>
                    <div class="mt-4 text-center small">
                        <span class="mr-2"><i class="fas fa-circle text-success"></i> Aktif</span>
                        <span class="mr-2"><i class="fas fa-circle text-warning"></i> Peringatan</span>
                        <span class="mr-2"><i class="fas fa-circle text-danger"></i> Mati</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<style>
    /* Styling Tambahan untuk Card dan Small Box */
    .card {
        border: none;
        border-radius: 10px;
        box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15);
        margin-bottom: 20px;
    }
    .card-header {
        background-color: #f8f9fc;
        border-bottom: 1px solid #e3e6f0;
        font-weight: bold;
        color: #4e73df; 
        border-radius: 10px 10px 0 0 !important;
        padding: 15px 20px;
    }

    .small-box {
        border-radius: 10px;
        position: relative;
        display: block;
        margin-bottom: 20px;
        box-shadow: 0 1px 1px rgba(0,0,0,0.1);
        overflow: hidden;
        color: #fff;
        padding: 20px;
    }
    .small-box > .inner { padding: 10px; }
    .small-box h3 { font-size: 2.2rem; font-weight: bold; margin: 0 0 10px 0; white-space: nowrap; padding: 0; }
    .small-box p { font-size: 1rem; margin-bottom: 0; }
    
    .small-box .icon {
        position: absolute;
        top: -10px;
        right: 10px;
        z-index: 0;
        font-size: 90px;
        color: rgba(0, 0, 0, 0.15);
        transition: transform 0.3s;
    }
    .small-box:hover .icon { transform: scale(1.1); }
    
    .bg-gradient-primary { background: linear-gradient(45deg, #4e73df 10%, #224abe 90%); }
    .bg-gradient-success { background: linear-gradient(45deg, #1cc88a 10%, #13855c 90%); }
    .bg-gradient-warning { background: linear-gradient(45deg, #f6c23e 10%, #dda20a 90%); }
    .bg-gradient-danger { background: linear-gradient(45deg, #e74a3b 10%, #be2617 90%); }
</style>

<script>
    const cData = {!! json_encode($chartData ?? []) !!};

    if (Object.keys(cData).length > 0) {
        // Grafik Pendapatan
        const ctxIncome = document.getElementById('incomeChart');
        if (ctxIncome) {
            new Chart(ctxIncome, {
                type: 'line',
                data: {
                    labels: cData.labels_pendapatan,
                    datasets: [{
                        label: 'Pendapatan (Rp)',
                        data: cData.data_pendapatan,
                        borderColor: '#4e73df',
                        backgroundColor: 'rgba(78, 115, 223, 0.05)',
                        pointRadius: 3,
                        pointBackgroundColor: '#4e73df',
                        pointBorderColor: '#4e73df',
                        pointHoverRadius: 3,
                        tension: 0.3,
                        fill: true
                    }]
                },
                options: { 
                    maintainAspectRatio: false, 
                    plugins: { legend: { display: false } },
                    scales: {
                        y: {
                            ticks: {
                                callback: function(value) { return 'Rp ' + new Intl.NumberFormat('id-ID').format(value); }
                            }
                        }
                    }
                }
            });
        }

        // Grafik Status
        const ctxStatus = document.getElementById('statusChart');
        if (ctxStatus) {
            new Chart(ctxStatus, {
                type: 'doughnut',
                data: {
                    labels: ['Aktif', 'Peringatan', 'Mati'],
                    datasets: [{
                        data: [cData.status_aktif, cData.status_peringatan, cData.status_mati],
                        backgroundColor: ['#1cc88a', '#f6c23e', '#e74a3b'],
                        hoverBorderColor: "rgba(234, 236, 244, 1)",
                    }]
                },
                options: { maintainAspectRatio: false, cutout: '70%' }
            });
        }
    }
</script>
@endsection