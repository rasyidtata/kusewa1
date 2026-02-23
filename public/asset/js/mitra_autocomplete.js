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
        var MITRA_SEARCH_URL = '/api/mitra/search';
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
                    <span class="badge bg-success">Existing</span>
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