<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perjanjian_Event_{{ $dataps->dataMitra->nama }}</title>

    <link rel="stylesheet" type="text/css" href="{{ asset('asset/css/bootstrap-icons-1.8.3/bootstrap-icons.css') }}">
    <link href="{{ asset('asset/css/bootstrap.min.css') }}" rel="stylesheet">

    <style>
        @page {
            size: A4;
            margin: 1.5cm;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Times New Roman', Times, serif;
            font-size: 12px;
            line-height: 1.4;
            margin: 0;
            padding: 0;
            color: #000;
            background-color: #ffffff;
        }

        .container {
            width: 21cm;
            margin: 0 auto;
            padding: 0;
        }

        .page {
            width: 21cm;
            min-height: 29.7cm;
            height: auto;
            padding: 1.5cm;
            position: relative;
            background: white;
            page-break-after: always;
        }

        .page:last-child {
            page-break-after: auto;
        }

        /* Konten Cover */
        .konten-cover {
            text-align: center;
            padding-top: 1cm;
        }

        .cover-img {
            margin-bottom: 30px;
            text-align: center;
        }

        .cover-img img {
            height: 170px;
            max-width: 100%;
        }

        .cover-table {
            margin: 30px auto;
            width: 80%;
        }

        .table-cover {
            width: 100%;
            border: 1px solid #000;
            border-collapse: collapse;
            margin: 0 auto;
        }

        .table-cover td {
            padding: 10px 8px;
            border: 1px solid #000;
        }

        .table-cover .no {
            width: 30%;
            font-weight: bold;
        }

        .table-cover .ti {
            width: 5%;
            font-weight: bold;
        }

        .table-cover .isi {
            text-align: left;
        }

        .konten-cover h6 {
            margin: 20px 0;
            font-weight: bold;
            font-size: 14px;
        }

        /* Header Dokumen */
        .header-dokumen {
            text-align: center;
            margin-bottom: 30px;
            padding-bottom: 10px;
        }

        .header-dokumen h1 {
            font-size: 16px;
            margin: 5px 0;
            text-transform: uppercase;
            font-weight: bold;
        }

        .header-dokumen h2 {
            font-size: 14px;
            margin: 5px 0;
            font-weight: bold;
        }

        .header-dokumen p {
            font-size: 13px;
            margin: 3px 0;
            text-transform: uppercase;
            font-weight: bold;
        }

        /* Konten Utama */
        .konten {
            width: 100%;
        }

        .konten h2 {
            font-size: 14px;
            margin: 15px 0;
            font-weight: bold;
            text-align: center;
        }

        .konten p {
            font-size: 13px;
            margin: 10px 0;
            text-align: justify;
        }

        /* Layout Dua Kolom */
        .row-isi-konten {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            width: 100%;
            margin-bottom: 20px;
        }

        .col-md-6 {
            flex: 1;
            min-width: 0;
        }

        /* Pasal */
        .pasal {
            margin-bottom: 15px;
            text-align: justify;
        }

        .pasal-title {
            font-weight: bold;
            margin-bottom: 8px;
            text-align: center;
            font-size: 13px;
        }

        .pasal-content p {
            margin-bottom: 6px;
        }

        .definition-list {
            margin-left: 15px;
        }

        .definition-item {
            margin-bottom: 8px;
            text-align: justify;
        }

        .definition-term {
            font-weight: bold;
        }

        /* Tabel */
        .konten-table1 {
            margin: 20px 0;
        }

        .table-konten1 {
            border: 1px solid #919191;
            font-size: 11px;
            width: 100%;
            border-collapse: collapse;
        }

        .table-konten1 th,
        .table-konten1 td {
            border: 1px solid #919191;
            padding: 6px;
            vertical-align: top;
        }

        .table-konten1 .no {
            width: 5%;
            text-align: center;
        }

        .table-konten1 .sub {
            width: 35%;
        }

        .table-konten1 .ket {
            width: 60%;
        }

        /* Tanda Tangan Checkbox */
        .row-ttd {
            margin-top: 20px;
        }

        .kotak-table {
            border: 1px solid #797979;
            border-collapse: collapse;
            width: 150px;
            height: 40px;
            margin-left: auto;
        }

        .kotak-table th,
        .kotak-table td {
            border: 1px solid #797979;
            padding: 4px;
            text-align: center;
            font-size: 10px;
        }

        .simple-checkbox {
            width: 14px;
            height: 14px;
            border: 1px solid #000;
        }

        .checkbox-cell {
            text-align: center;
        }

    

        .col-4, .col-3 {
            padding: 0 10px;
        }

        /* Tanda Tangan Akhir */
        .ttd-section {
            margin-top: 60px;
        }

        .ttd-section .row {
            display: flex;
            justify-content: space-between;
        }

        .ttd-section .col-6 {
            text-align: center;
            width: 45%;
        }

        .ttd-section .col-6 p {
            text-align: center;
            margin: 10px 0;
        }

        /* Helper Classes */
        .mt-4 {
            margin-top: 20px !important;
        }

        .mt-5 {
            margin-top: 30px !important;
        }

        .text-align-justify {
            text-align: justify;
        }

        .text-bold {
            font-weight: bold;
        }

        .text-center {
            text-align: center;
        }

        /* Nomor Halaman */
        .page-number {
            position: absolute;
            bottom: 1cm;
            right: 1cm;
            font-size: 12px;
        }
        .table-konten1 thead {
            background: #ffbb54ff !important;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }
        .table-konten1 thead th {
            padding: 8px 5px;
            text-align: center;
            font-size: 13px;
            font-weight: bold;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }
            .table-konten1 tbody tr:nth-child(odd) { /* Baris ganjil: 1, 3, 5, 7, 9 dst */
            background-color: #ffeaccff !important;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }
        
        .table-konten1 tbody tr:nth-child(even) { /* Baris genap: 2, 4, 6, 8, 10 dst */
            background-color: #fffdf9ff !important;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }
        .table-konten1 tbody td[rowspan] {
            background: #fffdf9ff !important;
            text-align: center !important;
            vertical-align: middle !important;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }

        /* Aturan untuk Cetak */
        @media print {
            @page {
                margin: 1cm;
            }

            body {
                background: white !important;
                font-size: 12px !important;
                margin: 0 !important;
                padding: 0 !important;
                -webkit-print-color-adjust: exact !important;
                print-color-adjust: exact !important;
                width: 100% !important;
            }

            .container {
                max-width: 100% !important;
                margin: 0 !important;
                padding: 0 !important;
                width: 100% !important;
                box-shadow: none !important;
            }
            .tombol, 
            .btn, 
            button,
            .no-print {
                display: none !important;
            }

            .page {
                box-shadow: none !important;
                margin: 0 !important;
                padding: 1.5cm !important;
                min-height: 29.7cm !important;
                height: auto !important;
                width: 21cm !important;
                page-break-after: always !important;
            }

            .page:last-child {
                page-break-after: auto !important;
            }

            /* Layout dua kolom untuk print */
            .row-isi-konten {
                display: flex !important;
                flex-wrap: nowrap !important;
                width: 100% !important;
                gap: 20px !important;
            }

            .col-md-6 {
                flex: 1 !important;
                min-width: 0 !important;
                width: calc(50% - 10px) !important;
            }


            /* Pastikan logo tetap muncul */
            .cover-img img {
                display: block !important;
                height: 170px !important;
                margin: 0 auto !important;
            }

            /* Perbaikan untuk checkbox */
            .simple-checkbox {
                border: 1px solid #000 !important;
                -webkit-appearance: none !important;
                appearance: none !important;
                width: 16px !important;
                height: 16px !important;
                display: inline-block !important;
            }

            .simple-checkbox:checked {
                background-color: #000 !important;
            }
        }

        /* Untuk tampilan screen */
        @media screen {
            .page {
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                margin: 20px auto;
            }

            body {
                background-color: #f5f5f5;
                padding: 20px;
            }
        }

        /* Untuk layar kecil */
        @media screen and (max-width: 768px) {
            .col-md-6 {
                flex: 0 0 100% !important;
                width: 100% !important;
            }

            .row-isi-konten {
                flex-direction: column;
            }

            .page {
                width: 100%;
                margin: 10px 0;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <button class="print-button" onclick="window.print()">Cetak Dokumen</button>
        <div class="page">
            <div class="konten-cover">
                <div class="cover-img">
                    <img src="{{ asset('asset/img/logo_kai.png') }}" alt="Logo PT KAI">
                </div>
                <h6 class="text-bold">PERJANJIAN</h6>
                <div class="cover-table">
                    <table class="table-cover">
                        <tr>
                            <td class="no text-bold">NOMOR</td>
                            <td class="ti text-bold">:</td>
                            <td class="isi">{{ $nomor_kontrak ?? '...........................................' }}</td>
                        </tr>
                        <tr>
                            <td class="no text-bold">NOMOR ASET</td>
                            <td class="ti text-bold">:</td>
                            <td class="isi">{{ $nomor_aset ?? '...........................................' }}</td>
                        </tr>
                        <tr>
                            <td class="no text-bold">TANGGAL</td>
                            <td class="ti text-bold">:</td>
                            <td class="isi text-bold">{{ $dataps->masa_awal_perjanjian ?
                                strtoupper(\Carbon\Carbon::parse($dataps->dataMitra->tgl_perjanjian)
                                ->translatedFormat('d F Y')) : '' }}</td>
                        </tr>
                    </table>
                </div>
                <h6 class="mt-4 text-bold">ANTARA</h6>
                <h6 class="mt-4 text-bold">PT. KERETA API INDONESIA (Persero)</h6>
                <h6 class="mt-4 text-bold">DENGAN</h6>
                <h6 class="mt-4 text-bold">{{ strtoupper($dataps->dataMitra->nama ?? '') }}</h6>
                <h6 class="mt-4 text-bold">{{ strtoupper($dataps->dataMitra->alamat ?? '') }}</h6>
                <h6 class="mt-4 text-bold">TENTANG :<br>
                    PERSEWAAN ASET MILIK PT. KERETA API INDONESIA (Persero)
                    DI {{ strtoupper($dataps->dataAset->lokasi ?? '') }}
                    UNTUK {{ strtoupper($dataps->dataAset->penggunaan_objek ?? '') }}
                </h6>
                <h6 class="mt-5 text-bold">MASA BERLAKU :<br>
                    {{ $dataps->masa_awal_perjanjian ?
                    strtoupper(\Carbon\Carbon::parse($dataps->masa_awal_perjanjian)->translatedFormat('d F Y')) : '' }}
                    s.d
                    {{ $dataps->masa_akhir_perjanjian ?
                    strtoupper(\Carbon\Carbon::parse($dataps->masa_akhir_perjanjian)->translatedFormat('d F Y')) : '' }}
                </h6>
                <h6 class="mt-5 text-bold">2025</h6>
            </div>
        </div>

        <!-- Halaman 2: Lampiran I -->
        <div class="page">
            <div class="header-dokumen">
                <h1>LAMPIRAN I</h1>
                <h1>PERJANJIAN SEWA MENYEWA ASET PT KAI</h1>
                <p>NO. KAI :...........................................</p>
                <p>NO. PENYEWA :...........................................</p>
                <p>TANGGAL : <strong>{{ $dataps->masa_awal_perjanjian ?
                        strtoupper(\Carbon\Carbon::parse($dataps->dataMitra->tgl_perjanjian)
                        ->translatedFormat('d F Y')) : '' }}</strong></p>
            </div>
            <div class="konten">
                <h2>SYARAT DAN KETENTUAN PERJANJIAN SEWA MENYEWA<br>ASET
                    PT KERETA API INDONESIA (PERSERO) UNTUK EVENT</h2>
                <p>Syarat dan Ketentuan Sewa Menyewa Aset PT Kereta Api Indonesia (Persero) Untuk Event selanjutnya
                    disebut "Syarat dan Ketentuan" ini telah disetujui dan disepakati oleh dan antara KAI dan PENYEWA
                    yang merupakan bagian yang tidak terpisahkan dengan Perjanjian.</p>

                <div class="row-isi-konten">
                    <!-- Kolom Kiri -->
                    <div class="col-md-6">
                        <div class="pasal">
                            <div class="pasal-title">PASAL 1<br>DEFINISI</div>
                            <div class="pasal-content">
                                <p>Jika konteks dan kata-katanya tidak mensyaratkan lain, maka semua istilah dalam huruf
                                    besar yang belum ditetapkan dalam Syarat dan Ketentuan ini tetapi sudah ditetapkan
                                    dalam Perjanjian akan memiliki arti sebagaimana ditetapkan dalam Perjanjian dan semua
                                    istilah yang dimulai dengan huruf besar dalam Syarat dan Ketentuan ini akan mempunyai arti
                                    sebagaimana yang ditetapkan di bawah ini:</p>
                                <div class="definition-list">
                                    <div class="definition-item">
                                        <span class="definition-term">1. Aset</span> adalah tanah, lahan, bangunan,
                                        ruang udara yang berada di atas lahan, fasilitas penunjang, termasuk namun tidak
                                        terbatas pada Tower, Reklame dan Utilitas lainnya yang berada di bawah penguasaan
                                        dan/atau kepemilikan KAI.
                                    </div>
                                    <div class="definition-item">
                                        <span class="definition-term">2. Event</span> adalah aktivitas sementara yang
                                        diselenggarakan oleh PENYEWA di Aset dan/atau Sarana milik KAI.
                                    </div>
                                    <div class="definition-item">
                                        <span class="definition-term">3. Fasilitas</span> adalah fasilitas pendukung
                                        meliputi instalasi air, listrik, telepon, dan APAR (Alat Pemadam Api Ringan) dan
                                        fasilitas penunjang lainnya.
                                    </div>
                                    <div class="definition-item">
                                        <span class="definition-term">4. Hak Retensi</span> adalah hak KAI untuk menahan
                                        dan menguasai barang-barang termasuk Sarana Milik Penyewa yang berada di atas Objek
                                        Sewa, bila PENYEWA belum melaksanakan kewajibannya termasuk namun tidak terbatas
                                        pada mengembalikan Objek Sewa berdasarkan Perjanjian.
                                    </div>
                                    <div class="definition-item">
                                        <span class="definition-term">5. Hari</span> adalah hari kalender.
                                    </div>
                                    <div class="definition-item">
                                        <span class="definition-term">6. Hari Kerja</span> adalah hari selain hari
                                        sabtu, minggu atau hari libur nasional yang ditetapkan oleh pemerintah.
                                    </div>
                                    <div class="definition-item">
                                        <span class="definition-term">7. Nilai Sewa</span> adalah segala kewajiban
                                        pembayaran meliputi tarif sewa dan/atau cost of money yang harus dibayar oleh
                                        PENYEWA.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Kolom Kanan -->
                    <div class="col-md-6">
                        <div class="definition-list">
                            <div class="definition-item">
                                <span class="definition-term">8. Objek Sewa</span> adalah Aset dan Sarana KAI yang
                                menjadi Objek dalam Perjanjian ini dengan rincian lokasi, luas dan
                                peruntukan/penggunaan/pemanfaatan sebagaimana diatur dalam Perjanjian.
                            </div>
                            <div class="definition-item">
                                <span class="definition-term">9. Perjanjian</span> adalah Perjanjian Sewa Menyewa Aset
                                PT Kereta Api Indonesia (Persero) Untuk Event yang dibuat oleh dan antara KAI dengan PENYEWA
                                beserta seluruh lampirannya.
                            </div>
                            <div class="definition-item">
                                <span class="definition-term">10. Sarana Milik Penyewa</span> adalah segala
                                sesuatu/benda yang ditempatkan/dipasang/dibangun oleh PENYEWA pada Objek Sewa setelah
                                mendapat izin tertulis dari KAI sebagaimana diatur dalam Perjanjian ini.
                            </div>
                            <div class="definition-item">
                                <span class="definition-term">11. Total Harga</span> adalah seluruh nilai yang harus
                                dibayarkan oleh PENYEWA, meliputi Nilai Sewa dan PPN.
                            </div>
                            <div class="definition-item">
                                <span class="definition-term">12. Virtual Account</span> adalah nomor rekening virtual
                                yang dibuat oleh bank untuk diberikan kepada PENYEWA (badan usaha atau perorangan) sebagai
                                rekening tujuan untuk melakukan pembayaran Harga Sewa sebagaimana dimaksud dalam Lampiran IV
                                Perjanjian.
                            </div>
                        </div>
                        <div class="pasal">
                            <div class="pasal-title">PASAL 2<br>RUANG LINGKUP</div>
                            <div class="pasal-content">
                                <p>(1) KAI memiliki dan/atau menguasai Objek Sewa, dengan ini sepakat untuk menyewakan
                                    Objek Sewa tersebut kepada PENYEWA.</p>
                                <p>(2) PENYEWA akan menggunakan Objek Sewa sesuai dengan Penggunaannya.</p>
                                <p>(3) PENYEWA dapat memanfaatkan Objek Sewa setelah Perjanjian ditandatangani dan
                                    melakukan pembayaran sewa sebagaimana dimaksud dalam Perjanjian.</p>
                                <p>(4) PENYEWA akan mengembalikan Objek Sewa kepada KAI setelah berakhirnya Perjanjian.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row-ttd">
                    <div class="table-perjanjian">
                        <table class="kotak-table">
                            <thead>
                                <tr>
                                    <th>KAI</th>
                                    <th>PENYEWA</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="checkbox-cell">
                                        <input type="checkbox" class="simple-checkbox">
                                    </td>
                                    <td class="checkbox-cell">
                                        <input type="checkbox" class="simple-checkbox">
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Halaman 3: Pasal 3 & 4 -->
        <div class="page">
            <div class="row-isi-konten">
                <!-- Kolom Kiri -->
                <div class="col-md-6">
                    <div class="pasal">
                        <div class="pasal-title">PASAL 3<br>HAK DAN KEWAJIBAN KAI DAN PENYEWA</div>
                        <div class="pasal-content">
                            <p>(1) HAK KAI :</p>
                            <p>a. menagih dan menerima pembayaran Total Harga dan/atau denda dari PENYEWA;</p>
                            <p>b. mendapatkan jaminan dari PENYEWA, bahwa Objek Sewa tidak dipergunakan untuk hal-hal
                                yang melanggar kesusilaan, kepatutan, ketertiban dan kepentingan umum;</p>
                            <p>c. memutus Perjanjian secara sepihak dalam hal terjadi kondisi sebagaimana diatur dalam
                                Perjanjian;</p>
                            <p>d. menerima kembali Objek Sewa pada saat berakhirnya Perjanjian, sesuai dengan Syarat dan
                                Ketentuan sebagaimana diatur dalam Perjanjian ini; dan</p>
                            <p>e. melaksanakan Hak Retensi terhadap PENYEWA apabila, PENYEWA belum melaksanakan
                                kewajibannya termasuk namun tidak terbatas pada mengembalikan Objek Sewa berdasarkan
                                Perjanjian.</p>

                            <p>(2) KEWAJIBAN KAI:</p>
                            <p>Menyerahkan pemanfaatan Objek Sewa kepada PENYEWA setelah pembayaran diterima.</p>

                            <p>(3) HAK PENYEWA:</p>
                            <p>Menggunakan Objek Sewa sesuai dengan Penggunaan sebagaimana diatur dalam Perjanjian.</p>
                            <p>(4) KEWAJIBAN PENYEWA:</p>
                            <p>a. membayar Total Harga, denda, ganti rugi dan/atau biaya lain sebagaimana dimaksud dalam
                                Perjanjian kepada KAI;</p>
                            <p>b. mendahulukan pembayaran-pembayaran apapun yang terhutang berdasarkan Perjanjian
                                daripada pembayaran lainnya yang karena apapun juga wajib dibayar oleh PENYEWA terhadap
                                siapapun;</p>
                            <p>c. memiliki segala perizinan, pendaftaran, pelaporan dan/atau pemberitahuan secara
                                berkesinambungan dari Pihak yang berwenang yang berkaitan dengan kegiatan usaha pada
                                dan/atau penggunaan Objek Sewa dengan biaya sepenuhnya merupakan tanggung jawab PENYEWA,
                                dan bertanggung jawab sepenuhnya apabila timbul tuntutan pihak lain terkait perizinan
                                dimaksud;</p>
                            <p>d. memelihara, merawat, menjaga keamanan, ketertiban, dan mengamankan Objek Sewa;</p>
                            <p>e. membayar pajak-pajak dan biaya-biaya lainnya sesuai peraturan yang berlaku atas
                                penggunaan Objek Sewa terhitung sejak berlakunya Perjanjian sampai dengan berakhirnya
                                Perjanjian, termasuk namun tidak terbatas pada listrik dan iuran lainnya;</p>
                        </div>
                    </div>
                </div>

                <!-- Kolom Kanan -->
                <div class="col-md-6">
                    <div class="pasal">
                        <div class="pasal-content">
                            <p>f. memasang perlengkapan standar keamanan dan keselamatan pada Objek Sewa;</p>
                            <p>g. bertanggung jawab apabila terjadi kerusakan/gangguan yang ditimbulkan dari penggunaan
                                Objek Sewa oleh PENYEWA;</p>
                            <p>h. bertanggung jawab dan membebaskan KAI dari segala tanggung jawab dan biaya yang
                                timbul, dalam hal adanya tuntutan dan/atau gugatan kepada KAI dari pihak lain akibat
                                dari perbuatan dan/atau penggunaan PENYEWA atas Objek Sewa;</p>
                            <p>i. mengembalikan Objek Sewa sebagaimana diatur dalam Perjanjian; dan</p>
                            <p>j. menaati segala ketentuan dalam Perjanjian dan peraturan perundang-undangan yang
                                berlaku, termasuk tapi tidak terbatas pada peraturan yang berlaku di lingkungan KAI yang
                                berkaitan dengan sewa-menyewa.</p>
                        </div>
                    </div>
                    <div class="pasal">
                        <div class="pasal-title">PASAL 4<br>LARANGAN</div>
                        <div class="pasal-content">
                            <p>(1) PENYEWA dilarang melakukan hal-hal sebagai berikut:</p>
                            <p>a. menggunakan Objek Sewa untuk hal-hal yang melanggar peraturan perundang-undangan yang
                                berlaku;</p>
                            <p>b. melakukan tindakan apapun dengan maksud untuk mengalihkan kepemilikan Objek Sewa;</p>
                            <p>c. menjaminkan atau membebani Objek Sewa, Fasilitas dan Sarana milik Penyewa dengan Hak
                                Tanggungan atau jaminan kebendaan lainnya;</p>
                            <p>d. melakukan kegiatan yang dapat mengganggu operasional Kereta Api dan/atau
                                memanfaatkan/merusak Sarana, Prasarana KAI yang berada di sekitar Objek Sewa;</p>
                            <p>e. melakukan kegiatan yang dapat mengganggu pelayanan penumpang sehingga menimbulkan
                                komplain dari pihak lain dan/atau penumpang, dalam hal Objek Sewa berlokasi di area
                                stasiun; dan/atau</p>
                            <p>f. menggunakan kompor gas/Kompor BBM/kayu bakar/arang dalam hal Objek Sewa berlokasi di
                                area stasiun dan kantor KAI.</p>
                            <p>(2) Tanpa Persetujuan tertulis dari KAI, PENYEWA dilarang melakukan hal-hal sebagai
                                berikut:</p>
                            <p>a. menyerahkan/mengalihkan, menyewakan kembali atau dengan kata lain melepaskan seluruh
                                atau sebagian dari penguasaan Objek Sewa atau bagian darinya;</p>
                            <p>b. menggunakan Objek Sewa tidak sesuai dengan Penggunaan sebagaimana dimaksud dalam
                                Perjanjian;</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row-ttd">
                <div class="table-perjanjian">
                    <table class="kotak-table">
                        <thead>
                            <tr>
                                <th>KAI</th>
                                <th>PENYEWA</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="checkbox-cell">
                                    <input type="checkbox" class="simple-checkbox">
                                </td>
                                <td class="checkbox-cell">
                                    <input type="checkbox" class="simple-checkbox">
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Halaman 4: Pasal 4 (lanjutan) & 5-6 -->
        <div class="page">
            <div class="row-isi-konten">
                <!-- Kolom Kiri -->
                <div class="col-md-6">
                    <div class="pasal">
                        <div class="pasal-content">
                            <p>c. menambah, mengubah dan/atau mendirikan bangunan dan/atau Fasilitas; dan/atau</p>
                            <p>d. melakukan komersialisasi periklanan dan sejenisnya pada seluruh Objek Sewa.</p>
                        </div>
                    </div>
                    <div class="pasal">
                        <div class="pasal-title">PASAL 5<br>TATA CARA PEMBAYARAN</div>
                        <div class="pasal-content">
                            <p>(1) KAI akan menerbitkan tagihan/invoice setelah penandatanganan Perjanjian.</p>
                            <p>(2) Untuk pembayaran lunas di muka dilakukan paling lambat 1 (satu) Hari Kerja sejak
                                tagihan/invoice diterbitkan.</p>
                            <p>(3) Untuk pembayaran secara bertahap:</p>
                            <p>a. pembayaran tahap pertama dilakukan paling lambat 1 (satu) Hari Kerja sejak
                                tagihan/invoice diterbitkan;</p>
                            <p>b. pembayaran tahap kedua dan selanjutnya dilakukan sesuai dengan tanggal pembayaran
                                sebagaimana ditentukan dalam Lampiran III Perjanjian; dan</p>
                            <p>c. tagihan/invoice akan diterbitkan sebelum tanggal pembayaran sebagaimana diatur dalam
                                Lampiran III Perjanjian.</p>
                            <p>(4) Apabila PENYEWA melakukan pembayaran tidak sesuai dengan ketentuan sebagaimana diatur
                                dalam Perjanjian, maka pembayaran tersebut dianggap tidak sah, PENYEWA bertanggung jawab
                                sepenuhnya atas segala akibat yang timbul karena hal tersebut, dan PENYEWA tetap melakukan
                                pembayaran kembali kepada KAI sebagaimana ditentukan dalam Perjanjian.</p>
                            <p>(5) Seluruh biaya transfer terkait dengan pembayaran Total Harga menjadi beban dan
                                tanggung jawab PENYEWA.</p>
                        </div>
                    </div>
                    <div class="pasal">
                        <div class="pasal-title">PASAL 6<br>PAJAK DAN BIAYA LAINNYA</div>
                        <div class="pasal-content">
                            <p>(1) PARA PIHAK memahami dan sepakat untuk mematuhi peraturan perundang-undangan yang
                                berlaku dibidang perpajakan terkait dengan ruang lingkup Perjanjian dan bertanggung jawab atas
                                kewajiban pembayaran pajak masing-masing dan/atau persyaratan administrasi lainnya yang
                                berkaitan dengan pajak tersebut secara tepat waktu.</p>
                            <p>(2) PENYEWA harus telah melunasi semua hutang pajak yang menjadi beban PENYEWA pada saat
                                berakhirnya Perjanjian.</p>
                            <p>(3) Seluruh ongkos dan biaya-biaya Fasilitas lainnya yang bertalian dengan penggunaan
                                Objek Sewa termasuk namun tidak terbatas pada biaya-biaya lain untuk penataan/relokasi,</p>
                        </div>
                    </div>
                </div>

                <!-- Kolom Kanan -->
                <div class="col-md-6">
                    <div class="pasal">
                        <div class="pasal-content">
                            <p>berperkara di Pengadilan maupun untuk eksekusi, biaya untuk menagih
                                hutang serta seluruh biaya yang menjadi
                                tanggungan PENYEWA, dibayar oleh PENYEWA.</p>
                            <p>(4) Apabila KAI telah membayar terlebih dahulu untuk semua biaya sebagaimana dimaksud
                                pada ayat (2), maka PENYEWA mengakui segala jumlah tersebut sebagai tambahan atas kewajiban
                                pembayaran.</p>
                        </div>
                    </div>
                    <div class="pasal">
                        <div class="pasal-title">PASAL 7<br>SARANA MILIK PENYEWA</div>
                        <div class="pasal-content">
                            <p>(1) PENYEWA dengan biaya dan tanggung jawabnya sendiri dapat melengkapi Objek Sewa dengan
                                Sarana Milik Penyewa yang sesuai dengan sifat usaha, setelah mendapatkan persetujuan
                                dari KAI.</p>
                            <p>(2) Semua material Sarana Milik Penyewa yang dipasang harus dibuat dari bahan berkualitas
                                baik, dan tetap memperhatikan aspek keselamatan dan keindahan, sekurang-kurangnya sesuai
                                dengan standar yang ditetapkan oleh KAI, serta memenuhi perizinan yang dipersyaratkan
                                peraturan perundang-undangan dan/atau persyaratan yang diwajibkan oleh instansi yang berwenang.</p>
                        </div>
                    </div>
                    <div class="pasal">
                        <div class="pasal-title">PASAL 8<br>PERAWATAN DAN PEMELIHARAAN OBJEK SEWA</div>
                        <div class="pasal-content">
                            <p>(1) Selama berlakunya Perjanjian PENYEWA berkewajiban untuk menjaga kebersihan memelihara
                                Objek Sewa sebaik-baiknya dari segala kerusakan yang timbul sebagai akibat dari
                                kesalahan PENYEWA
                                dan/atau orang lain yang menjadi tanggungannya dan pula kerusakan-kerusakan yang menurut
                                hukum
                                dan kebiasaan menjadi tanggungan PENYEWA terkecuali kerusakan-kerusakan itu bukan
                                disebabkan
                                oleh kelalaiannya atau kesalahan PENYEWA dan/atau orang lain.</p>
                            <p>(2) Apabila PENYEWA tidak melakukan pemeliharaan sebagaimana dimaksud ayat (1) KAI akan
                                menunjuk pihak lain dan biaya atas pemeliharaan tersebut menjadi tanggung jawab PENYEWA.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row-ttd">
                <div class="table-perjanjian">
                    <table class="kotak-table">
                        <thead>
                            <tr>
                                <th>KAI</th>
                                <th>PENYEWA</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="checkbox-cell">
                                    <input type="checkbox" class="simple-checkbox">
                                </td>
                                <td class="checkbox-cell">
                                    <input type="checkbox" class="simple-checkbox">
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Halaman 5: Pasal 9 & 10 -->
        <div class="page">
            <div class="row-isi-konten">
                <!-- Kolom Kiri -->
                <div class="col-md-6">
                    <div class="pasal">
                        <div class="pasal-title">PASAL 9<br>PENGAWASAN DAN PEMERIKSAAN</div>
                        <div class="pasal-content">
                            <p>(1) KAI dapat melakukan pengawasan dan pemeriksaan atas pelaksanaan Perjanjian, termasuk
                                namun tidak terbatas pada hal-hal:</p>
                            <p>a. melakukan pengawasan atas pelaksanaan kewajiban PENYEWA berdasarkan Perjanjian;</p>
                            <p>b. melakukan pemeriksaan atas dokumen perizinan dan/atau kondisi fisik Objek Sewa baik
                                secara berkala maupun sewaktu-waktu; dan/atau</p>
                            <p>c. melakukan pengecekan pada Objek Sewa pada saat berakhirnya Perjanjian.</p>
                            <p>(2) Pengawasan atas pelaksanaan Perjanjian dilaksanakan oleh KAI dalam hal ini dilakukan
                                oleh:</p>
                            <p>a. pimpinan unit yang membidangi komersialisasi Aset Daop/Divre/Subdivre/LRT Jabodebek
                                tempat kedudukan Objek Sewa; atau</p>
                            <p>b. pimpinan unit yang membidangi penjagaan Aset Daop/Divre/Subdivre/LRT Jabodebek tempat
                                kedudukan Objek Sewa.</p>
                            <p>Apabila setelah dilakukan pengawasan dan pemeriksaan ditemukan indikasi adanya
                                pelanggaran terhadap Perjanjian, KAI dapat melakukan hal-hal antara lain:</p>
                            <p>a. memberitahukan secara tertulis hasil pengawasan dan pemeriksaan, berupa saran dan
                                masukan untuk perbaikan; dan/atau</p>
                            <p>b. memberikan surat peringatan sebagaimana dimaksud pada Pasal 10, apabila saran dan
                                masukan sebagaimana dimaksud huruf a tidak dilakukan oleh PENYEWA.</p>
                        </div>
                    </div>
                    <div class="pasal">
                        <div class="pasal-title">PASAL 10<br>SANKSI</div>
                        <div class="pasal-content">
                            <p>(1) Apabila PENYEWA tidak memenuhi ketentuan Perjanjian, maka:</p>
                            <p>a. KAI memberikan surat peringatan sebanyak 1 (satu) kali;</p>
                            <p>b. apabila setelah diberikan surat peringatan sebagaimana dimaksud huruf a di atas,
                                tetapi PENYEWA tetap tidak memenuhi kewajiban dan/atau tetap melanggar larangan, maka
                                KAI berhak untuk
                                memutus Perjanjian secara sepihak dan menuntut pembayaran sekaligus lunas kepada PENYEWA
                                atas
                                Total Harga, denda dan ganti rugi yang masih terhutang.</p>
                            <p>(2) Dalam hal adanya keterlambatan pembayaran Total Harga, maka PENYEWA dikenakan denda
                                sebesar 2‰ (dua perseribu) per hari dari Total Harga terutang yang telah jatuh tempo
                                tidak
                                termasuk PPN.</p>
                        </div>
                    </div>
                </div>

                <!-- Kolom Kanan -->
                <div class="col-md-6">
                    <div class="pasal">
                        <div class="pasal-content">
                            <p>(3) PENYEWA wajib membayar denda keterlambatan pembayaran tersebut diatas, meskipun
                                PENYEWA telah melakukan pembayaran Total Harga dalam masa pemberian surat peringatan
                                sebagaimana dimaksud pada ayat (1) huruf a.</p>
                            <p>(4) Selain pengenaan denda sebagaimana dimaksud, KAI juga dapat menutup sementara akses
                                masuk Objek Sewa dan PENYEWA dengan cara apapun dilarang untuk masuk dan memanfaatkan
                                Objek Sewa.</p>
                            <p>(5) Dengan adanya penutupan sementara sebagaimana dimaksud pada ayat (4) diatas, tidak
                                menambah Jangka Waktu Perjanjian.</p>
                            <p>(6) PENYEWA wajib membayar ganti rugi kepada KAI, apabila terjadi kerusakan/gangguan yang
                                ditimbulkan atas tindakan PENYEWA, antara lain sebagai berikut:</p>
                            <p>a. kegiatan pembangunan/penempatan/pemasangan dan/atau penanaman Sarana Milik Penyewa
                                pada Objek Sewa;</p>
                            <p>b. penggunaan Objek Sewa oleh PENYEWA;</p>
                            <p>c. kesalahan dan/atau kelalaian PENYEWA; dan/atau</p>
                            <p>d. pengosongan/pembongkaran Sarana Milik Penyewa dan barang-barang lain yang berada di
                                atas Objek Sewa.</p>
                            <p>(7) Atas kerusakan/gangguan sebagaimana dimaksud pada ayat (6) diatas, KAI akan melakukan
                                investigasi dan perhitungan untuk menentukan besaran ganti rugi yang harus dipenuhi
                                PENYEWA.</p>
                            <p>(8) Dalam hal kerusakan/gangguan sebagaimana dimaksud pada ayat (6) diatas mengakibatkan
                                kerugian bagi pihak lain, maka PENYEWA bertanggung jawab dan membebaskan KAI dari segala
                                klaim, gugatan, dan/atau tuntutan dari Pihak manapun kepada KAI.</p>
                            <p>(9) Seluruh biaya serta akibat yang timbul dari dikenakannya denda dan ganti rugi,
                                menjadi tanggung jawab PENYEWA sepenuhnya.</p>
                            <p>(10) Pembayaran denda dan/atau ganti rugi, dibayarkan oleh PENYEWA dengan cara transfer
                                ke rekening Virtual Account berdasarkan tagihan yang diterbitkan KAI.</p>
                            <p>(11) Seluruh biaya transfer atas denda dan/atau ganti rugi menjadi beban dan tanggung
                                jawab PENYEWA.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row-ttd">
                <div class="table-perjanjian">
                    <table class="kotak-table">
                        <thead>
                            <tr>
                                <th>KAI</th>
                                <th>PENYEWA</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="checkbox-cell">
                                    <input type="checkbox" class="simple-checkbox">
                                </td>
                                <td class="checkbox-cell">
                                    <input type="checkbox" class="simple-checkbox">
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Halaman 6: Pasal 11 & 12 -->
        <div class="page">
            <div class="row-isi-konten">
                <!-- Kolom Kiri -->
                <div class="col-md-6">
                    <div class="pasal">
                        <div class="pasal-title">PASAL 11<br>BERAKHIRNYA PERJANJIAN</div>
                        <div class="pasal-content">
                            <p>(1) Perjanjian dapat berakhir antara lain disebabkan oleh hal-hal sebagai berikut:</p>
                            <p>a. berakhirnya jangka waktu Perjanjian;</p>
                            <p>b. PARA PIHAK sepakat untuk mengakhiri Perjanjian sebelum Jangka Waktu Perjanjian
                                berakhir;</p>
                            <p>c. salah satu PIHAK mengalami force majeure dan hasil perundingan memutuskan Perjanjian
                                tidak dapat dilanjutkan, dengan ketentuan sebagaimana diatur dalam Perjanjian; dan/atau</p>
                            <p>d. pengakhiran Perjanjian secara sepihak oleh KAI.</p>
                            <p>(2) Pengakhiran Perjanjian sebagaimana dimaksud pada ayat (1) huruf b dan c diatas
                                dituangkan dalam Berita Acara yang ditandatangani oleh KAI dan PENYEWA.</p>
                            <p>(3) Perjanjian dapat diakhiri secara sepihak oleh KAI sebagaimana dimaksud pada ayat (1)
                                huruf d apabila PENYEWA telah melanggar Perjanjian atau peraturan perundang-undangan
                                yang berlaku.</p>
                            <p>(4) Pengakhiran Perjanjian sebagaimana dimaksud pada ayat (1) huruf d dilaksanakan dengan
                                surat pemutusan Perjanjian dari KAI dengan tata cara sebagaimana dimaksud Perjanjian.</p>
                            <p>(5) Berakhirnya Perjanjian sebagaimana dimaksud pada ayat (1) diatas, tidak menghilangkan
                                kewajiban pembayaran sewa, pajak-pajak, denda dan/atau ganti rugi dari bekas PENYEWA
                                yang akan dihitung secara proporsional, dan selanjutnya KAI akan menerbitkan surat penagihan atas
                                kewajiban tersebut kepada bekas PENYEWA.</p>
                            <p>(6) Dalam hal terjadi pengakhiran Perjanjian karena PENYEWA melakukan wanprestasi
                                dan/atau permintaan pengakhiran dari PENYEWA maka Total Harga yang telah dibayarkan
                                tetapi belum dijalani oleh PENYEWA menjadi milik KAI.</p>
                            <p>(7) KAI tidak memiliki kewajiban apapun untuk memenuhi/menaati Perjanjian dan/atau
                                kesepakatan yang dibuat antara PENYEWA dengan pihak lainnya terkait Objek Sewa oleh
                                karenanya PENYEWA bertanggung jawab sepenuhnya dan membebaskan KAI atas tuntutan, gugatan,
                                kerugian dari pihak manapun kepada KAI yang ditimbulkan karena pengakhiran Perjanjian secara sepihak
                                oleh KAI.</p>
                            <p>(8) PARA PIHAK sepakat untuk mengesampingkan ketentuan Pasal dalam 1266 dan 1267
                                KUHPerdata.</p>
                        </div>
                    </div>
                </div>

                <!-- Kolom Kanan -->
                <div class="col-md-6">
                    <div class="pasal">
                        <div class="pasal-title">PASAL 12<br>PENGEMBALIAN OBJEK SEWA</div>
                        <div class="pasal-content">
                            <p>(1) Dengan berakhirnya jangka waktu sewa yang telah ditetapkan, maka paling lambat pada
                                tanggal berakhirnya Perjanjian PENYEWA wajib mengosongkan Objek Sewa dari Sarana Milik
                                Penyewa dan barang-barang lain yang berada di atas Objek Sewa serta menyerahkan Objek Sewa
                                kepada KAI dalam keadaan baik dengan kondisi sekurang-kurangnya seperti saat dimulainya
                                Perjanjian.</p>
                            <p>(2) Pelaksanaan dan biaya pengosongan/pembongkaran Sarana Milik Penyewa dan barang-barang
                                lain yang berada di atas Objek Sewa dilakukan oleh PENYEWA sesuai dengan prosedur dan
                                ketentuan yang berlaku dilingkungan KAI dengan memperhatikan kondisi sarana, prasarana
                                dan aset KAI.</p>
                            <p>(3) Apabila pengosongan/pembongkaran Sarana Milik Penyewa dan barang-barang lain yang
                                berada di atas Objek Sewa tidak sesuai dengan ketentuan sebagaimana dimaksud pada ayat
                                (2) maka PENYEWA bertanggungjawab untuk mengganti segala kerugian KAI dan pihak lain yang timbul
                                dari kegiatan pengosongan dan pembongkaran Sarana Milik Penyewa sebagaimana diatur pada Pasal
                                10 ayat (6) dan (7).</p>
                            <p>(4) Apabila PENYEWA tidak melaksanakan ketentuan sebagaimana dimaksud pada ayat (1) dan
                                (2), maka PENYEWA menyerahkan haknya atas Sarana Milik Penyewa yang masih berada pada
                                Objek Sewa, dan dengan sendirinya menjadi milik KAI tanpa diperlukan dokumen/surat-surat lebih
                                lanjut.</p>
                            <p>(5) KAI dapat mengalihkan, menggunakan dan membongkar Sarana milik Penyewa sebagaimana
                                dimaksud pada ayat (4) diatas dan PENYEWA tidak dapat menuntut ganti rugi atas hal
                                tersebut.</p>
                            <p>(6) Hak KAI untuk melakukan sendiri pengosongan Objek Sewa berikut segala sesuatu yang
                                berada di atas Objek Sewa adalah merupakan bagian yang tidak terpisahkan dari
                                Perjanjian, sehingga untuk itu suatu Surat Kuasa Khusus tidak diperlukan lagi.</p>
                            <p>(7) Setelah penyerahan Objek Sewa atau sesudahnya PENYEWA tidak berhak untuk mengajukan
                                tuntutan pembayaran pengganti lainnya dari biaya-biaya yang mungkin telah dikeluarkannya
                                selama berlangsungnya Perjanjian untuk hal apa pun terkait Objek Sewa.</p>
                            <p>(8) Kewajiban pengembalian Objek Sewa sebagaimana diatur pada ayat-ayat tersebut di atas
                                akan tetap berlaku meskipun Perjanjian telah berakhir atau diakhiri.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row-ttd">
                <div class="table-perjanjian">
                    <table class="kotak-table">
                        <thead>
                            <tr>
                                <th>KAI</th>
                                <th>PENYEWA</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="checkbox-cell">
                                    <input type="checkbox" class="simple-checkbox">
                                </td>
                                <td class="checkbox-cell">
                                    <input type="checkbox" class="simple-checkbox">
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Halaman 7: Pasal 13-15 -->
        <div class="page">
            <div class="row-isi-konten">
                <!-- Kolom Kiri -->
                <div class="col-md-6">
                    <div class="pasal">
                        <div class="pasal-title">PASAL 13<br>HUKUM YANG BERLAKU DAN PENYELESAIAN PERSELISIHAN</div>
                        <div class="pasal-content">
                            <p>(1) Perjanjian diatur dan ditafsirkan sesuai dengan hukum yang berlaku di Republik
                                Indonesia.</p>
                            <p>(2) Apabila terjadi perselisihan atau perbedaan pendapat dalam pelaksanaan Perjanjian,
                                akan diselesaikan melalui musyawarah untuk mufakat.</p>
                            <p>(3) Apabila penyelesaian sebagaimana dimaksud pada ayat (2) gagal, maka PARA PIHAK
                                sepakat untuk menyelesaikan dengan melalui Pengadilan Negeri sebagaimana dimaksud dalam
                                Perjanjian.</p>
                            <p>(4) Dalam hal PARA PIHAK, sedang dalam proses penyelesaian perselisihan sebagaimana
                                dimaksud pada ayat (2) atau ayat (3) maka PARA PIHAK tetap melaksanakan segala ketentuan
                                sebagaimana diatur dalam Perjanjian kecuali disepakati lain oleh PARA PIHAK.</p>
                        </div>
                    </div>
                    <div class="pasal">
                        <div class="pasal-title">PASAL 14<br>FORCE MAJEURE</div>
                        <div class="pasal-content">
                            <p>(1) Tidak satu PIHAK pun bertanggung jawab atas keterlambatan atau kegagalan pelaksanaan
                                suatu kewajiban yang ditentukan dalam Perjanjian jika hal itu disebabkan oleh atau
                                timbul karena sesuatu kejadian atau keadaan yang memaksa (force majeure) yakni
                                peristiwa-peristiwa di luar kekuasaan manusia yang menghambat pelaksanaan Perjanjian antara lain bencana alam,
                                Pandemi, blockade, keadaan perang, pemogokan atau gangguan perburuhan lain, kerusuhan
                                atau kegaduhan masyarakat yang tidak disebabkan oleh kelalaian dari PIHAK yang menuntut suatu
                                keuntungan dari Pasal ini atau oleh Kebijakan Pemerintah atau oleh suatu sebab yang
                                berada di luar kekuasaan PIHAK yang terkena, baik keadaan yang serupa atau tidak, dengan
                                sebab-sebab tertentu.</p>
                            <p>(2) PIHAK yang mengalami keadaan force majeure wajib memberitahukan kepada pihak lainnya
                                dalam Perjanjian selambat-lambatnya 1 (satu) Hari setelah terjadinya force majeure,
                                disertai Pernyataan tertulis dari instansi yang berwenang/Pemerintah Setempat.</p>
                            <p>(3) Apabila dalam jangka waktu sebagaimana ditetapkan pada ayat (2), PIHAK yang tertimpa
                                force majeure tidak memberitahukan kepada pihak lainnya force majeure yang dialaminya,
                                maka force majeure tersebut dianggap tidak pernah ada, dan PARA PIHAK tetap menjalankan hak
                                dan kewajibannya sebagaimana diatur dalam Perjanjian.</p>
                        </div>
                    </div>
                </div>

                <!-- Kolom Kanan -->
                <div class="col-md-6">
                    <div class="pasal">
                        <div class="pasal-content">
                            <p>(4) Apabila dalam waktu 1 (satu) Hari setelah pihak lainnya menerima pemberitahuan
                                tentang terjadinya force majeure tersebut atau menerima surat keterangan dari instansi
                                berwenang, belum memberikan tanggapan, maka PIHAK yang menerima pemberitahuan dianggap
                                telah menyetujui keadaan force majeure tersebut.</p>
                            <p>(5) PIHAK yang tertimpa force majeure sedapat mungkin untuk berusaha memperbaiki keadaan
                                yang menjadi penyebab kegagalan atau penundaan pemenuhan kewajiban dan akan melanjutkan
                                pemenuhan kewajiban berdasarkan Perjanjian, selanjutnya dalam waktu 7 (tujuh) Hari.</p>
                            <p>(6) Sejak disetujuinya force majeure oleh pihak lainnya PARA PIHAK segera berunding untuk
                                menentukan penyelesaian selanjutnya yang dituangkan dalam Addendum Perjanjian yang
                                merupakan satu kesatuan dan bagian tak terpisahkan dari Perjanjian.</p>
                            <p>(7) Dalam hal keadaan force majeure tersebut tidak dapat diselesaikan dengan perundingan
                                antara PARA PIHAK, maka Perjanjian dapat diakhiri sesuai ketentuan tentang Berakhirnya Perjanjian.</p>
                            <p>(8) Segala biaya dan/atau kerugian yang diderita oleh PIHAK yang mengalami force majeure
                                tidak menjadi beban dan/atau tanggung jawab pihak lainnya.</p>
                        </div>
                    </div>
                    <div class="pasal">
                        <div class="pasal-title">PASAL 15<br>ANTI SUAP, ANTI KORUPSI DAN PENCUCIAN UANG</div>
                        <div class="pasal-content">
                            <p>(1) PARA PIHAK dengan ini menyatakan dan menjamin bahwa tidak ada pembayaran atau bentuk
                                manfaat lain atau perlakuan khusus lainnya yang telah atau akan ditawarkan, dijanjikan
                                atau diberikan, baik secara langsung maupun tidak langsung, kepada pejabat publik, baik untuk
                                pejabat publik itu sendiri maupun untuk orang atau badan lain, dengan maksud untuk mempengaruhi
                                tindakan/keputusan resminya, atau agar ia menggunakan pengaruhnya terhadap suatu badan
                                atau institusi pemerintah, atau untuk memuluskan/memastikan diperolehnya suatu manfaat secara tidak
                                patut atau tidak sah terkait dengan bisnis PARA PIHAK.</p>
                            <p>(2) PARA PIHAK dengan ini menyatakan dan menjamin bahwa tidak ada pembayaran atau bentuk
                                manfaat lain atau perlakuan khusus yang telah atau akan dijanjikan, ditawarkan atau
                                diberikan kepada pihak swasta dengan maksud untuk mempengaruhi suatu tindakan, atau
                                memuluskan/memastikan diperolehnya suatu manfaat secara tidak patut terkait dengan bisnis PARA PIHAK.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row-ttd">
                <div class="table-perjanjian">
                    <table class="kotak-table">
                        <thead>
                            <tr>
                                <th>KAI</th>
                                <th>PENYEWA</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="checkbox-cell">
                                    <input type="checkbox" class="simple-checkbox">
                                </td>
                                <td class="checkbox-cell">
                                    <input type="checkbox" class="simple-checkbox">
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Halaman 8: Pasal 15 (lanjutan) & 16 -->
        <div class="page">
            <div class="row-isi-konten">
                <!-- Kolom Kiri -->
                <div class="col-md-6">
                    <div class="pasal">
                        <div class="pasal-content">
                            <p>(3) PARA PIHAK dengan ini menyatakan dan menjamin
                                bahwa di antara PARA PIHAK tidak ada pembayaran
                                atau bentuk manfaat lain atau perlakuan khusus yang
                                telah atau akan dijanjikan, ditawarkan atau diberikan
                                dari satu Pihak kepada Pihak lainnya (termasuk kepada
                                keluarga masing-masing Pihak) dengan maksud untuk
                                memperkaya diri sendiri/orang lain dan dapat mempengaruhi suatu
                                tindakan atau memuluskan/memastikan diperolehnya suatu manfaat
                                secara tidak patut terkait dengan bisnis PARA PIHAK.</p>
                            <p>(4) PARA PIHAK dengan ini menyatakan dan menjamin
                                bahwa ia dan/atau seluruh pemegang saham
                                langsungnya, termasuk direktur, dewan komisaris,
                                pejakat, karyawan ini telah mengetahui dan memahami
                                tentang undang-undang, pembatasan-pembatasan dan
                                prinsip-prinsip anti suap, anti korupsi dan anti
                                pencucian uang, dan oleh karena itu setuju untuk
                                mengambil langkah-langkah yang tepat untuk
                                menjamin kepatuhan orang-orang tersebut dalam
                                melaksanakan kewajibannya sebagaimana diatur dalam
                                Perjanjian.</p>
                        </div>
                    </div>
                </div>

                <!-- Kolom Kanan -->
                <div class="col-md-6">
                    <div class="pasal">
                        <div class="pasal-title">PASAL 16<br>KETENTUAN LAIN-LAIN</div>
                        <div class="pasal-content">
                            <p>(1) Apabila terdapat perubahan dan tambahan atas Perjanjian, maka perubahan dan tambahan
                                tersebut akan mengikat PARA PIHAK sepanjang dibuat secara tertulis dan dibuatkan
                                Addendum yang ditandatangani oleh PARA PIHAK, yang merupakan bagian yang tidak terpisahkan dengan
                                Perjanjian.</p>
                            <p>(2) Semua lampiran dalam Perjanjian atau yang akan dibuat kemudian oleh PARA PIHAK
                                merupakan bagian yang tidak terpisahkan dari Perjanjian.</p>
                            <p>(3) Perjanjian tetap mengikat penerus hak (succesor in title) atau penerima pengalihan
                                hak (assignee) dalam hal terjadi penunjukan, pengalihan hak, merger, akuisisi, perubahan
                                nama dan/atau perubahan kepemilikan saham KAI.</p>
                            <p>(4) Dalam hal terdapat perubahan berdasarkan hasil reviu instansi yang berwenang sesuai
                                ketentuan peraturan perundang-undangan, PARA PIHAK wajib menyesuaikan ketentuan dalam
                                Perjanjian ini yang dituangkan dalam Adendum Perjanjian.</p>
                            <p>(5) PARA PIHAK sepakat untuk melaksanakan Perjanjian dengan rasa penuh tanggung jawab
                                dengan didasari kepentingan bersama.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row-ttd">
                <div class="table-perjanjian">
                    <table class="kotak-table">
                        <thead>
                            <tr>
                                <th>KAI</th>
                                <th>PENYEWA</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="checkbox-cell">
                                    <input type="checkbox" class="simple-checkbox">
                                </td>
                                <td class="checkbox-cell">
                                    <input type="checkbox" class="simple-checkbox">
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Halaman 9: Tabel Perjanjian Bagian 1 -->
        <div class="page">
            <div class="header-dokumen">
                <h2>PERJANJIAN SEWA MENYEWA<br>ASET PT KERETA API INDONESIA (PERSERO)</h2>
                <p>NO. KAI : ...........................................</p>
                <p>NO. PENYEWA : ...........................................</p>
                <p>TANGGAL : <strong>{{ $dataps->masa_awal_perjanjian ?
                        strtoupper(\Carbon\Carbon::parse($dataps->dataMitra->tgl_perjanjian)
                        ->translatedFormat('d F Y')) : '' }}</strong></p>
            </div>

            <div class="konten konten-table1">
                <p>Perjanjian Sewa Menyewa Aset PT Kereta Api Indonesia (Persero) (selanjutnya disebut "Perjanjian")
                    dibuat oleh dan antara PT Kereta Api Indonesia (Persero), selanjutnya disebut "KAI", dalam hal ini
                    diwakili oleh "BAMBANG RESPATIONO", dalam kedudukan sebagai Executive Vice President berdasarkan
                    Keputusan Direksi Nomor PER.U/KL.713/II/1/KA-2019 Tanggal 14 Februari 2019 dan PENYEWA, selanjutnya
                    secara bersama-sama disebut "PARA PIHAK" dan masing-masing disebut "PIHAK", mengikatkan diri dan
                    menyepakati hal-hal sebagai berikut:</p>

                <table class="table-konten1">
                    <thead>
                        <tr>
                            <th class="no">No.</th>
                            <th class="sub">Substansi</th>
                            <th class="ket">Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- 1. PENYEWA -->
                        <tr>
                            <td rowspan="5">1.</td>
                            <td class="text-bold">PENYEWA</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>a. NAMA PENYEWA</td>
                            <td>{{ strtoupper($dataps->dataMitra->nama ?? '') }}</td>
                        </tr>
                        <tr>
                            <td>b. NAMA YANG MEWAKILI</td>
                            <td>{{ strtoupper($dataps->dataMitra->nama_perwakilan ?? '') }}<br>
                                SELAKU: {{ strtoupper($dataps->dataMitra->penyewa_selaku ?? '') }}<br>
                                BERDASARKAN: {{ strtoupper($dataps->dataMitra->penyewa_berdasarkan ?? '') }}</td>
                        </tr>
                        <tr>
                            <td>c. ALAMAT</td>
                            <td>{{ strtoupper($dataps->dataMitra->alamat ?? '') }}<br>
                                KOTA: {{ strtoupper($dataps->dataMitra->kota_penyewa ?? '') }}<br>
                                KODE POS: {{ $dataps->dataMitra->kode_pos ?? '' }}</td>
                        </tr>
                        <tr>
                            <td>d. TELEPON & EMAIL</td>
                            <td>NO. {{ $dataps->dataMitra->no_tlpn ?? '' }}<br>
                                EMAIL: {{ $dataps->dataMitra->email ?? '' }}</td>
                        </tr>

                        <!-- 2. DOKUMEN PENYEWA -->
                        <tr>
                            <td rowspan="8">2.</td>
                            <td class="text-bold">DOKUMEN PENYEWA</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>a. IDENTITAS PENANDATANGAN (KTP/SIM/PASPOR)</td>
                            <td>NO. {{ $dataps->dataMitra->no_identitas ?? '' }}<br>MASA BERLAKU: {{ $dataps->dataMitra->masa_berlaku_identitas }}</td>
                        </tr>
                        <tr>
                            <td>b. NPWP</td>
                            <td>NO. {{ $dataps->dataMitra->npwp ?? '' }}</td>
                        </tr>
                        <tr>
                            <td>c. IDENTITAS BADAN HUKUM/USAHA/INSTANSI</td>
                            <td>
                                NO. {{ $dataps->dataMitra->no_anggaran_dasar ?? '' }}<br>
                                TGL. {{ $dataps->dataMitra->tgl_anggaran_dasar ?
                                strtoupper(\Carbon\Carbon::parse($dataps->dataMitra->tgl_anggaran_dasar)->translatedFormat('d F Y')) : '' }}
                            </td>
                        </tr>
                        <tr>
                            <td>d. PENGESAHAN / PERSETUJUAN / PENETAPAN</td>
                            <td>NO. {{ $dataps->dataMitra->no_kenmenhum_dan_ham ?? '' }}<br>
                                TGL. {{ $dataps->dataMitra->tgl_persetujuan_kenmenhum_dan_ham ?
                                strtoupper(\Carbon\Carbon::parse($dataps->dataMitra->tgl_persetujuan_kenmenhum_dan_ham)->translatedFormat('d F Y')) : '' }}
                            </td>
                        </tr>
                        <tr>
                            <td>e. NOMOR INDUK BERUSAHA dan/atau IZIN USAHA</td>
                            <td>NO. {{ $dataps->dataMitra->no_izin_berusaha ?? '' }}<br>
                                TGL. {{ $dataps->dataMitra->tgl_izin_usaha ?
                                strtoupper(\Carbon\Carbon::parse($dataps->dataMitra->tgl_izin_usaha)->translatedFormat('d F Y')) : '' }}
                            </td>
                        </tr>
                        <tr>
                            <td>f. SURAT KETERANGAN TERDAFTAR DIRJEN PAJAK</td>
                            <td>NO. {{ $dataps->dataMitra->sk_dirjen_pajak ?? '' }}<br>
                                TGL. {{ $dataps->dataMitra->tgl_sk_dirjen_pajak ?
                                strtoupper(\Carbon\Carbon::parse($dataps->dataMitra->tgl_sk_dirjen_pajak)->translatedFormat('d F Y')) : '' }}
                            </td>
                        </tr>
                        <tr>
                            <td>g. SURAT PENGUKUHAN PENGUSAHA KENA PAJAK</td>
                            <td>NO. {{ $dataps->dataMitra->surat_pengukuhan_kena_pajak ?? '' }}<br>
                                TGL. {{ $dataps->dataMitra->tgl_surat_pengukuhan_kena_pajak ?
                                strtoupper(\Carbon\Carbon::parse($dataps->dataMitra->tgl_surat_pengukuhan_kena_pajak)->translatedFormat('d F Y')) : '' }}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="row-ttd">
                <div class="table-perjanjian">
                    <table class="kotak-table">
                        <thead>
                            <tr>
                                <th>KAI</th>
                                <th>PENYEWA</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="checkbox-cell">
                                    <input type="checkbox" class="simple-checkbox">
                                </td>
                                <td class="checkbox-cell">
                                    <input type="checkbox" class="simple-checkbox">
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Halaman 10: Tabel Perjanjian Bagian 2 -->
        <div class="page">
            <div class="konten konten-table1">
                <table class="table-konten1">
                    <tbody>
                        <!-- 3. OBJEK SEWA -->
                        <tr>
                            <td rowspan="3">3.</td>
                            <td class="text-bold">OBJEK SEWA</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>a. LOKASI</td>
                            <td>{{ strtoupper($dataps->dataAset->lokasi ?? '') }}</td>
                        </tr>
                        <tr>
                            <td>b. LUAS TANAH/BANGUNAN</td>
                            <td>-</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>c. PENGGUNAAN</td>
                            <td>{{ strtoupper($dataps->dataAset->penggunaan_objek ?? '') }}</td>
                        </tr>

                        <!-- 4. STATUS PERJANJIAN -->
                        <tr>
                            <td>4.</td>
                            <td class="text-bold">STATUS PERJANJIAN</td>
                            <td>BARU</td>
                        </tr>

                        <!-- 5. JANGKA WAKTU -->
                        <tr>
                            <td rowspan="4">5.</td>
                            <td class="text-bold">JANGKA WAKTU</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>a. JANGKA WAKTU SEWA</td>
                            <td>{{ strtoupper($dataps->jangka_waktu ?? '') }}</td>
                        </tr>
                        <tr>
                            <td>b. JANGKA WAKTU PERJANJIAN</td>
                            <td>
                                {{ $dataps->masa_awal_perjanjian ?
                                strtoupper(\Carbon\Carbon::parse($dataps->masa_awal_perjanjian)->translatedFormat('d F Y')) : '' }}
                                s.d
                                {{ $dataps->masa_akhir_perjanjian ?
                                strtoupper(\Carbon\Carbon::parse($dataps->masa_akhir_perjanjian)->translatedFormat('d F Y')) : '' }}
                            </td>
                        </tr>
                        <tr>
                            <td>MASA PEMANFAATAN</td>
                            <td>
                                {{ $dataps->masa_awal_manfaat ?
                                strtoupper(\Carbon\Carbon::parse($dataps->masa_awal_manfaat)->translatedFormat('d F Y')) : '' }}
                                s.d
                                {{ $dataps->masa_akhir_manfaat ?
                                strtoupper(\Carbon\Carbon::parse($dataps->masa_akhir_manfaat)->translatedFormat('d F Y')) : '' }}
                            </td>
                        </tr>

                        <!-- 6. HARGA DAN PEMBAYARAN -->
                        <tr>
                            <td rowspan="3">6.</td>
                            <td class="text-bold">HARGA DAN TATA CARA PEMBAYARAN SEWA</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>TATA CARA PEMBAYARAN</td>
                            <td>DIMUKA (LUNAS)</td>
                        </tr>
                        <tr>
                            <td>a. NILAI SEWA<br>b. BIAYA MASA PEMANFAATAN<br>c. BIAYA ADMINISTRASI<br>d.
                                PPN<br><strong>TOTAL HARGA</strong></td>
                            <td>
                                Rp. {{ number_format($dataps->harga_sewa ?? 0, 0, ',', '.') }},-<br>
                                Rp. {{ number_format($dataps->harga_sewa ?? 0, 0, ',', '.') }},-<br>
                                Rp. {{ number_format($dataps->biaya_admin_ukur ?? 0, 0, ',', '.') }},-<br>
                                Rp. {{ number_format($dataps->ppn_11_persen ?? 0, 0, ',', '.') }},-<br>
                                <strong>Rp. {{ number_format($dataps->total_harga ?? 0, 0, ',', '.') }},-</strong><br>
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>TERBILANG</td>
                            <td>{{ $dataps->terbilang ?? '' }}</td>
                        </tr>

                        <!-- 7. KORESPONDENSI -->
                        <tr>
                            <td rowspan="6">7.</td>
                            <td class="text-bold">KORESPONDENSI</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>a. KAI - ALAMAT</td>
                            <td>JL LEMPUYANGAN NO 1 YOGYAKARTA</td>
                        </tr>
                        <tr>
                            <td>- TELEPON</td>
                            <td>(0274) 7124213</td>
                        </tr>
                        <tr>
                            <td>- EMAIL</td>
                            <td>Pengusahaan.aset6@kai.id / Pengusahaan.aset6@gmail.com</td>
                        </tr>
                        <tr>
                            <td>b. PENYEWA - ALAMAT</td>
                            <td>{{ strtoupper($dataps->dataMitra->alamat ?? '') }}</td>
                        </tr>
                        <tr>
                            <td>- TELEPON & EMAIL</td>
                            <td>NO. {{ $dataps->dataMitra->no_tlpn ?? '' }}<br>
                                EMAIL: {{ $dataps->dataMitra->email ?? '' }}</td>
                        </tr>

                        <!-- 8. PENYELESAIAN PERSELISIHAN -->
                        <tr>
                            <td>8.</td>
                            <td class="text-bold">PENYELESAIAN PERSELISIHAN</td>
                            <td>PENGADILAN NEGERI YOGYAKARTA</td>
                        </tr>

                        <!-- 9. KETENTUAN TAMBAHAN -->
                        <tr>
                            <td>9.</td>
                            <td class="text-bold">KETENTUAN TAMBAHAN</td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="row-ttd">
                <div class="table-perjanjian">
                    <table class="kotak-table">
                        <thead>
                            <tr>
                                <th>KAI</th>
                                <th>PENYEWA</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="checkbox-cell">
                                    <input type="checkbox" class="simple-checkbox">
                                </td>
                                <td class="checkbox-cell">
                                    <input type="checkbox" class="simple-checkbox">
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Halaman 11: Penutup dan Tanda Tangan -->
        <div class="page">
            <div class="konten">
                <p class="mt-4 text-align-justify">PARA PIHAK telah menyetujui Perjanjian ini harus dibaca bersama-sama
                    dengan seluruh lampiran yang merupakan satu kesatuan yang tidak terpisahkan dari Perjanjian ini. Adapun
                    lampiran-lampiran sebagaimana dimaksud adalah sebagai berikut:<br>
                    a. Lampiran I : Syarat dan Ketentuan Perjanjian Sewa Menyewa Aset PT Kereta Api
                    Indonesia (Persero).<br>
                    b. Lampiran II : Gambar Situasi dan/atau Spesifik Teknis Objek Sewa.<br>
                    c. Lampiran III : Harga dan Tata Cara Pembayaran Sewa.<br>
                    d. Lampiran IV : Nomor Virtual Account.<br>
                    Perjanjian ini dibuat 2 (dua) rangkap, yang ditandatangani PARA PIHAK dengan bermeterai
                    cukup dan memiliki kekuatan hukum yang sama untuk masing-masing Pihak.
                </p>

                <div class="ttd-section">
                    <div class="row">
                        <div class="col-6">
                            <p class="text-bold">UNIVERSITAS ISLAM <br>INDONESIA</p>
                            <p class="mt-5">HANGGA FATHANA, S.IP., B.Int.St.,
                                M.A.<br>Sekretaris Eksekutif</p>
                        </div>
                        <div class="col-6">
                            <p class="text-bold">PT KERETA API INDONESIA (PERSERO)<br>DAERAH OPERASI 6 YOGYAKARTA</p>
                            <p class="mt-5">BAMBANG RESPATIONO<br>Executive Vice President</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>

        window.onload = function() {
            // Jika URL memiliki parameter print, langsung cetak
            if (window.location.search.includes('print=true')) {
                window.print();
            }
        };
    </script>
</body>

</html>