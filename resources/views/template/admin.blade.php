<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin | Dashboard')</title>

    <!-- CSS Assets -->
    <link rel="stylesheet" type="text/css" href="{{ asset('asset/css/bootstrap-icons-1.8.3/bootstrap-icons.css') }}">
    <link href="{{ asset('asset/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('asset/css/style.css') }}" rel="stylesheet">
    @yield('css_custom')
</head>

<body>
    <!-- Header Section -->
    <header class="header header-utama">
        <div class="container-fluid">
            <div class="row row-hider align-items-center ">
                <div class="col-12 col-md-5">
                    <div class="logo">
                        <img src="{{ asset('asset/img/kusewa.png') }}" height="30px" class="logo-img">
                    </div>
                </div>
                <div class="col-12 col-md-4">
                    <div class="header-content">
                        <h1 class="header-title">Penyewaan Aset KAI Non Lokomotif</h1>
                        <p class="header-subtitle">DAOP 6 Yogyakarta</p>
                    </div>
                </div>
                <div class="col-12 col-md-3">
                    <div class="header-actions">
                        <div class="logo-secondary">
                            <img src="{{ asset('asset/img/logo_kai.png') }}" height="100px" class="logo-img">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <div class="container-fluid-konten">
        <div class="row row-konten ">
            <div class="col-2 col-md-2 bg-light p-0">
                <ul class="list-group sidebar-menu">
                    <li class="list-group-item"><a href="{{ url('home/beranda') }}">Home</a></li>
                    <li class="list-group-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="mitraDropdown" role="button" data-bs-toggle="dropdown">
                            Pendaftaran Mitra
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="mitraDropdown">
                            <li><a class="dropdown-item" href="{{ url('pendaftaran/form_data_diri') }}">Form Pendaftaran</a></li>
                            <li><a class="dropdown-item" href="{{ url('pendaftaran/list_data') }}">List Data</a></li>
                        </ul>
                    </li>
                    <li class="list-group-item"><a href="#">Perpanjang Mitra</a></li>
                    <li class="list-group-item"><a href="#">Putus Kontrak</a></li>
                    <li class="list-group-item"><a href="{{ url('list_data_perjanjian/data_perjanjian') }}">List Data perjanjian</a></li>
                    <li class="list-group-item"><a href="#">Laporan</a></li>
                    <li class="list-group-item"><a href="#">Logout</a></li>
                </ul>
            </div>
            <main class="col-10 col-md-10 p-4 ms-sm-auto col-lg-10 px-md-4">
                @yield('content')
            </main>
        </div>

    </div>
    <!-- JS Assets -->
    <script src="{{ asset('asset/js/custom.js') }}"></script>
    <script src="{{ asset('asset/js/jquery-3.6.4.min.js') }}"></script>
    <script src="{{ asset('asset/js/bootstrap.bundle.min.js') }}"></script>

</body>

</html>