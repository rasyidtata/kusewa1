<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin | Dashboard')</title>

    <link rel="stylesheet" type="text/css" href="{{ asset('asset/css/bootstrap-icons-1.8.3/bootstrap-icons.css') }}">
    <link href="{{ asset('asset/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('asset/css/style.css') }}" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <style>
        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15);
            /* Bayangan halus */
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
            box-shadow: 0 1px 1px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            color: #fff;
            padding: 20px;
        }

        .small-box>.inner {
            padding: 10px;
        }

        .small-box h3 {
            font-size: 2.2rem;
            font-weight: bold;
            margin: 0 0 10px 0;
            white-space: nowrap;
            padding: 0;
        }

        .small-box p {
            font-size: 1rem;
        }

        .small-box .icon {
            position: absolute;
            top: -10px;
            right: 10px;
            z-index: 0;
            font-size: 90px;
            color: rgba(0, 0, 0, 0.15);
            transition: transform 0.3s;
        }

        .small-box:hover .icon {
            transform: scale(1.1);
        }

        /* Warna-warni Khas Dashboard */
        .bg-gradient-primary {
            background: linear-gradient(45deg, #4e73df 10%, #224abe 90%);
        }

        .bg-gradient-success {
            background: linear-gradient(45deg, #1cc88a 10%, #13855c 90%);
        }

        .bg-gradient-warning {
            background: linear-gradient(45deg, #f6c23e 10%, #dda20a 90%);
        }

        .bg-gradient-danger {
            background: linear-gradient(45deg, #e74a3b 10%, #be2617 90%);
        }

        .btn-custom {
            border-radius: 50px;
            padding: 8px 20px;
            font-weight: 600;
            box-shadow: 0 4px 6px rgba(50, 50, 93, 0.11), 0 1px 3px rgba(0, 0, 0, 0.08);
        }
    </style>


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    @yield('css_custom')
</head>

<body>
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
                    <li class="list-group-item">
                        <a href="{{ route('dashboard') }}">Home</a>
                    </li>

                    <li class="list-group-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="mitraDropdown" role="button"
                            data-bs-toggle="dropdown">
                            Pendaftaran Mitra
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="mitraDropdown">
<<<<<<< HEAD
                            <li><a class="dropdown-item" href="{{ route('pendaftaran.form') }}">Form Pendaftaran</a>
                            </li>
                            <li><a class="dropdown-item" href="{{ route('pendaftaran.list') }}">List Data</a></li>
=======
                            <li><a class="dropdown-item" href="{{ route('pendaftaran.form') }}">Form Pendaftaran</a></li>
                            <li><a class="dropdown-item" href="{{ url('pendaftaran/fitur_filter') }}">List Data</a></li>
>>>>>>> d12f0bfcf70870f87ce8fc954d26b9ad211d52c0
                        </ul>
                    </li>
                    <li class="list-group-item">
                        <a href="{{ route('perpanjang.index') }}">Perpanjang Kontrak</a>
                    </li>
                    <li class="list-group-item"><a href="#">Putus Kontrak</a></li>

<<<<<<< HEAD
                    <li class="list-group-item"><a href="{{ url('list_data_perjanjian/data_perjanjian') }}">List Data perjanjian</a></li>

                    <li class="list-group-item"><a href="#">Data Mitra</a></li>

=======
                    <li class="list-group-item"><a href="{{ url('list_data/data_perjanjian') }}">List Data perjanjian</a></li>
                    
>>>>>>> d12f0bfcf70870f87ce8fc954d26b9ad211d52c0
                    <li class="list-group-item">
                        <a href="{{ url('laporan/index') }}">Laporan</a>
                    </li>

                    <li class="list-group-item"><a href="#">Logout</a></li>
                </ul>
            </div>
            <main class="col-10 col-md-10 p-4 ms-sm-auto col-lg-10 px-md-4">
                @yield('content')
            </main>
        </div>

    </div>
    <script src="{{ asset('asset/js/custom.js') }}"></script>
    <script src="{{ asset('asset/js/jquery-3.6.4.min.js') }}"></script>
    <script src="{{ asset('asset/js/bootstrap.bundle.min.js') }}"></script>

    @stack('scripts')

</body>

</html>