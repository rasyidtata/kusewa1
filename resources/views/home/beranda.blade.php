@extends('template.admin')

@section('title', 'Dashboard | Utama')

@section('content')
<div class="container-fluid">
    
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800 font-weight-bold">Dashboard Monitoring Aset</h1>
    </div>

    <div class="row">
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

        <div class="col-lg-3 col-6">
            <div class="small-box bg-gradient-success">
                <div class="inner">
                    <h3>{{ $chartData['status_aktif'] ?? 0 }}</h3>
                    <p>Aset Aktif</p>
                </div>
                <div class="icon">
                    <i class="fas fa-check-circle"></i>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-6">
            <div class="small-box bg-gradient-warning">
                <div class="inner">
                    <h3 style="color: white;">{{ $chartData['status_peringatan'] ?? 0 }}</h3>
                    <p style="color: white;">Perlu Perhatian</p>
                </div>
                <div class="icon">
                    <i class="fas fa-exclamation-triangle"></i>
                </div>
            </div>
        </div>
    </div>

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
                options: { maintainAspectRatio: false, plugins: { legend: { display: false } } }
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