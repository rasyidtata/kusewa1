/**
 * copyExcel.js
 * Fungsi untuk copy data ke Excel dengan format yang SAMA PERSIS dengan export Excel
 */

// Fungsi utama untuk copy data ke Excel
function copyAsExcelFormat() {
    // Data dari server (di-passing dari Blade)
    const dataPerjanjian = typeof dataPerjanjianGlobal !== 'undefined'
        ? dataPerjanjianGlobal
        : JSON.parse(document.getElementById('data-perjanjian-json')?.textContent || '[]');

    // Debug: lihat data yang diterima
    console.log('Data received:', dataPerjanjian);
    if (dataPerjanjian.length > 0) {
        console.log('Sample data:', dataPerjanjian[0]);
        console.log('Available fields:', Object.keys(dataPerjanjian[0]));
    }

    // Cek apakah ada data
    if (!dataPerjanjian || dataPerjanjian.length === 0) {
        showNotification('Tidak ada data untuk di-copy', 'error');
        return;
    }

    // Helper function format tanggal (DD-MM-YYYY)
    function formatDate(dateString) {
        if (!dateString) return '';
        try {
            const date = new Date(dateString);
            if (isNaN(date.getTime())) return '';
            const day = String(date.getDate()).padStart(2, '0');
            const month = String(date.getMonth() + 1).padStart(2, '0');
            const year = date.getFullYear();
            return `${day}-${month}-${year}`;
        } catch (e) {
            return '';
        }
    }

    // Helper function format angka
    function formatNumber(value) {
        if (value === null || value === undefined || value === '') return '0';
        // Jika value adalah string dengan format Rp, hapus Rp dan titik
        if (typeof value === 'string') {
            value = value.replace(/[Rp\s.]/g, '');
        }
        const numValue = parseFloat(value) || 0;
        return numValue.toString();
    }

    // Helper function untuk mendapatkan nilai dengan fallback
    function getValue(obj, field, defaultValue = '') {
        if (!obj) return defaultValue;

        // Cek langsung - HAPUS CEK string kosong!
        if (obj[field] !== undefined && obj[field] !== null) {
            return obj[field]; // Kembalikan apapun nilainya, termasuk string kosong
        }

        // Coba dengan variasi huruf kapital
        const variations = [
            field,
            field.charAt(0).toUpperCase() + field.slice(1),
            field.toUpperCase(),
            field.toLowerCase(),
        ];

        for (let variant of variations) {
            if (obj[variant] !== undefined && obj[variant] !== null) {
                return obj[variant];
            }
        }

        return defaultValue;
    }

    // HEADER - SAMA PERSIS dengan DataPerjanjianExport.php
    const headers = [
        'No',
        'Kode Perjanjian',
        'Tanggal Update',

        // Data Mitra
        'Kategori',
        'Jenis Penyewa',
        'Nama Lengkap',
        'NIK/No. Identitas',
        'Masa Berlaku Identitas',
        'Email',
        'No. Telepon',
        'Tanggal Perjanjian Mitra',
        'Penyewa Berdasarkan',
        'Alamat Mitra',
        'Nama Perwakilan',
        'Perwakilan Selaku',
        'NPWP',
        'Kota Penyewa',
        'Kode Pos',
        'Fax Penyewa',
        'No. Akta Pendirian',
        'No. Anggaran Dasar',
        'Tanggal Anggaran Dasar',
        'No. Kemenkumham',
        'Tanggal Kemenkumham',
        'No. Penetapan Pengadilan',
        'Tanggal Penetapan Pengadilan',
        'No. Izin Berusaha',
        'Tanggal Izin Usaha',
        'SK Dirjen Pajak',
        'Tanggal SK Dirjen Pajak',
        'Surat Pengukuhan Kena Pajak',
        'Tanggal Surat Pengukuhan Kena Pajak',

        // Data Aset
        'Kode Aset',
        'Lokasi Aset',
        'Penggunaan Aset',
        'Luas Tanah',
        'Luas Bangunan',

        // Data Perjanjian Sewa
        'Jangka Waktu',
        'Masa Awal Perjanjian',
        'Masa Akhir Perjanjian',
        'Masa Awal Pemanfaatan',
        'Masa Akhir Pemanfaatan',
        'Harga Sewa',
        'Harga Pemanfaatan',
        'Biaya Admin Ukur',
        'Cost of Money',
        'Harga Sewa Admin',
        'Harga Sewa Admin COM',
        'PPN 11%',
        'Total Harga',
        'Terbilang',
        'Status'
    ];

    // Buat baris data
    let rows = [];

    // TAMBAHKAN HEADER (opsional, bisa di-comment jika tidak ingin header)
    //rows.push(headers.join('\t'));

    // DATA BARIS
    dataPerjanjian.forEach((item, index) => {
        const row = [
            // No urut

            // Kode Perjanjian
            getValue(item, 'kode_perjanjian'),

            // Tanggal Update
            formatDate(getValue(item, 'updated_at')),

            // Data Mitra - SESUAI DENGAN SELECT DI CONTROLLER
            getValue(item, 'kategori'),
            getValue(item, 'Jenis'),
            getValue(item, 'nama'),
            getValue(item, 'no_identitas'),
            getValue(item, 'masa_berlaku_identitas'),
            getValue(item, 'email'),
            getValue(item, 'no_tlpn'),
            formatDate(getValue(item, 'tgl_perjanjian')),
            getValue(item, 'penyewa_berdasarkan'),
            getValue(item, 'alamat'),
            getValue(item, 'nama_perwakilan'),
            getValue(item, 'penyewa_selaku'),
            getValue(item, 'npwp'),
            getValue(item, 'kota_penyewa'),
            getValue(item, 'kode_pos'),
            getValue(item, 'fax_penyewa'),
            getValue(item, 'no_akta_pendirian'),
            getValue(item, 'no_anggaran_dasar'),
            formatDate(getValue(item, 'tgl_anggaran_dasar')),
            getValue(item, 'no_kenmenhum_dan_ham'),
            formatDate(getValue(item, 'tgl_persetujuan_kenmenhum_dan_ham')),
            getValue(item, 'no_penetapan_pengadilan'),
            formatDate(getValue(item, 'tgl_penetapan_pengadilan')),
            getValue(item, 'no_izin_berusaha'),
            formatDate(getValue(item, 'tgl_izin_usaha')),
            getValue(item, 'sk_dirjen_pajak'),
            formatDate(getValue(item, 'tgl_sk_dirjen_pajak')),
            getValue(item, 'surat_pengukuhan_kena_pajak'),
            formatDate(getValue(item, 'tgl_surat_pengukuhan_kena_pajak')),

            // Data Aset
            getValue(item, 'kode_aset'),
            getValue(item, 'lokasi'),
            getValue(item, 'penggunaan_aset'),
            formatNumber(getValue(item, 'luas_tanah')),
            formatNumber(getValue(item, 'luas_bangunan')),

            // Data Perjanjian
            getValue(item, 'jangka_waktu'),
            formatDate(getValue(item, 'masa_awal_perjanjian')),
            formatDate(getValue(item, 'masa_akhir_perjanjian')),
            formatDate(getValue(item, 'masa_awal_manfaat')),
            formatDate(getValue(item, 'masa_akhir_manfaat')),
            formatNumber(getValue(item, 'harga_sewa')),
            formatNumber(getValue(item, 'harga_pemanfaatan')),
            formatNumber(getValue(item, 'biaya_admin_ukur')),
            formatNumber(getValue(item, 'cost_of_money')),
            formatNumber(getValue(item, 'harga_sewa_admin')),
            formatNumber(getValue(item, 'harga_sewa_admin_com')),
            formatNumber(getValue(item, 'ppn_11_persen')),
            formatNumber(getValue(item, 'total_harga')),
            getValue(item, 'terbilang'),
            getValue(item, 'status')
        ];

        // Gabungkan dengan tab sebagai pemisah
        rows.push(row.join('\t'));
    });

    // Gabungkan semua baris dengan new line
    const tsvData = rows.join('\n');

    // Copy ke clipboard
    if (navigator.clipboard && navigator.clipboard.writeText) {
        navigator.clipboard.writeText(tsvData).then(function () {
            showNotification(` data berhasil di-copy!`, 'success');
        }).catch(function (err) {
            console.error('Gagal copy: ', err);
            copyFallback(tsvData);
        });
    } else {
        copyFallback(tsvData);
    }
}

// Fallback untuk browser lama
function copyFallback(text) {
    const textarea = document.createElement('textarea');
    textarea.value = text;
    textarea.style.position = 'fixed';
    textarea.style.opacity = '0';
    textarea.style.pointerEvents = 'none';
    textarea.style.zIndex = '-1';
    document.body.appendChild(textarea);
    textarea.select();
    textarea.setSelectionRange(0, 99999);

    try {
        const success = document.execCommand('copy');
        if (success) {
            showNotification(' Data berhasil di-copy!', 'success');
        } else {
            showNotification(' Gagal copy data. Coba metode lain.', 'error');
        }
    } catch (err) {
        showNotification(' Gagal copy data: ' + err.message, 'error');
    }

    document.body.removeChild(textarea);
}

// Fungsi notifikasi
function showNotification(message, type = 'success') {
    const existingNotif = document.querySelector('.copy-excel-notification');
    if (existingNotif) {
        document.body.removeChild(existingNotif);
    }

    const notification = document.createElement('div');
    notification.className = 'copy-excel-notification';
    notification.innerHTML = message.replace(/\n/g, '<br>');

    const bgColor = type === 'success' ? '#28a745' : '#dc3545';
    notification.style.cssText = `
        position: fixed;
        top: 20px;
        right: 20px;
        background: ${bgColor};
        color: white;
        padding: 15px 25px;
        border-radius: 8px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.2);
        z-index: 9999;
        font-family: 'Segoe UI', Arial, sans-serif;
        font-size: 14px;
        font-weight: 500;
        max-width: 400px;
        min-width: 250px;
        animation: slideIn 0.3s cubic-bezier(0.68, -0.55, 0.265, 1.55);
        border-left: 4px solid ${type === 'success' ? '#1e7e34' : '#bd2130'};
        line-height: 1.6;
    `;

    document.body.appendChild(notification);

    setTimeout(() => {
        notification.style.animation = 'slideOut 0.3s ease forwards';
        setTimeout(() => {
            if (notification.parentNode) {
                document.body.removeChild(notification);
            }
        }, 300);
    }, 3000);
}

// Tambahkan style animasi
(function addStyles() {
    if (!document.getElementById('copy-excel-styles')) {
        const style = document.createElement('style');
        style.id = 'copy-excel-styles';
        style.textContent = `
            @keyframes slideIn {
                0% {
                    transform: translateX(100%) scale(0.5);
                    opacity: 0;
                }
                100% {
                    transform: translateX(0) scale(1);
                    opacity: 1;
                }
            }
            
            @keyframes slideOut {
                0% {
                    transform: translateX(0) scale(1);
                    opacity: 1;
                }
                100% {
                    transform: translateX(100%) scale(0.5);
                    opacity: 0;
                }
            }
            
            .copy-excel-notification {
                transition: all 0.3s ease;
            }
        `;
        document.head.appendChild(style);
    }
})();

// Export untuk module
if (typeof module !== 'undefined' && module.exports) {
    module.exports = { copyAsExcelFormat, copyFallback, showNotification };
} 