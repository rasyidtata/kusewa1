

document.addEventListener('DOMContentLoaded', function () {
    // Fungsi untuk mengubah format rupiah ke angka
    function convertToNumber(rupiahString) {
        if (!rupiahString) return 0;
        // Hapus semua karakter non-digit termasuk titik (ribuan separator)
        return parseInt(rupiahString.replace(/\./g, '')) || 0;
    }

    // Fungsi untuk memformat angka ke format rupiah
    function formatDisplay(angka) {
        if (!angka && angka !== 0) return '';
        return new Intl.NumberFormat('id-ID').format(angka);
    }

    // Fungsi untuk mengubah angka menjadi terbilang
    function terbilang(angka) {
        var bilangan = Math.abs(parseInt(angka));
        if (bilangan === 0) return "";
        
        var kalimat = "";
        var angkaTerbilang = ["", "Satu", "Dua", "Tiga", "Empat", "Lima", "Enam", "Tujuh", "Delapan", "Sembilan", "Sepuluh", "Sebelas"];

        if (bilangan < 12) {
            kalimat = angkaTerbilang[bilangan];
        } else if (bilangan < 20) {
            kalimat = terbilang(bilangan - 10) + " Belas";
        } else if (bilangan < 100) {
            var puluh = terbilang(Math.floor(bilangan / 10));
            var satuan = terbilang(bilangan % 10);
            kalimat = puluh + " Puluh" + (satuan ? " " + satuan : "");
        } else if (bilangan < 200) {
            kalimat = "Seratus " + terbilang(bilangan - 100);
        } else if (bilangan < 1000) {
            var ratus = terbilang(Math.floor(bilangan / 100));
            var sisa = terbilang(bilangan % 100);
            kalimat = ratus + " Ratus" + (sisa ? " " + sisa : "");
        } else if (bilangan < 2000) {
            kalimat = "Seribu " + terbilang(bilangan - 1000);
        } else if (bilangan < 1000000) {
            var ribu = terbilang(Math.floor(bilangan / 1000));
            var sisa = terbilang(bilangan % 1000);
            kalimat = ribu + " Ribu" + (sisa ? " " + sisa : "");
        } else if (bilangan < 1000000000) {
            var juta = terbilang(Math.floor(bilangan / 1000000));
            var sisa = terbilang(bilangan % 1000000);
            kalimat = juta + " Juta" + (sisa ? " " + sisa : "");
        } else if (bilangan < 1000000000000) {
            var milyar = terbilang(Math.floor(bilangan / 1000000000));
            var sisa = terbilang(bilangan % 1000000000);
            kalimat = milyar + " Milyar" + (sisa ? " " + sisa : "");
        } else if (bilangan < 1000000000000000) {
            var triliun = terbilang(Math.floor(bilangan / 1000000000000));
            var sisa = terbilang(bilangan % 1000000000000);
            kalimat = triliun + " Triliun" + (sisa ? " " + sisa : "");
        }

        return kalimat.trim().replace(/\s+/g, ' ');
    }

    // Fungsi untuk menghitung semua nilai
    function calculateAll() {
        // Ambil nilai dari input display (yang sudah diformat)
        const hargaSewa = convertToNumber(document.getElementById('harga_sewa_display').value);
        const biayaAdmin = convertToNumber(document.getElementById('biaya_admin_display').value);
        const costOfMoney = convertToNumber(document.getElementById('cost_of_money_display').value);
        
        // Harga pemanfaatan tidak dihitung, hanya disimpan
        const hargaPemanfaatan = convertToNumber(document.getElementById('harga_pemanfaatan_display').value);

        // Hitung Harga Sewa + Admin
        const hargaSewaAdmin = hargaSewa + biayaAdmin;

        // Hitung Harga Sewa + Admin + COM
        const hargaSewaAdminCom = hargaSewaAdmin + costOfMoney;

        // Hitung PPN 11% dari Harga Sewa
        const ppn = Math.round(hargaSewa * 0.11);

        // Hitung Total Harga (Harga Sewa + Admin + COM + PPN)
        const totalHarga = hargaSewaAdminCom + ppn;

        // Update nilai hidden input
        document.getElementById('harga_sewa').value = hargaSewa;
        document.getElementById('harga_pemanfaatan').value = hargaPemanfaatan;
        document.getElementById('biaya_admin').value = biayaAdmin;
        document.getElementById('cost_of_money').value = costOfMoney;
        document.getElementById('harga_sewa_admin').value = hargaSewaAdmin;
        document.getElementById('harga_sewa_admin_com').value = hargaSewaAdminCom;
        document.getElementById('ppn').value = ppn;
        document.getElementById('total_harga').value = totalHarga;

        // Update display untuk field yang dihitung otomatis
        document.getElementById('harga_sewa_admin_display').value = formatDisplay(hargaSewaAdmin);
        document.getElementById('harga_sewa_admin_com_display').value = formatDisplay(hargaSewaAdminCom);
        document.getElementById('ppn_display').value = formatDisplay(ppn);
        document.getElementById('total_harga_display').value = formatDisplay(totalHarga);

        // Update terbilang
        const terbilangText = totalHarga > 0 ? terbilang(totalHarga) + " Rupiah" : "";
        document.getElementById('terbilang').value = terbilangText;
    }

    // Fungsi untuk memformat input saat diketik
    function formatInput(event) {
        const input = event.target;
        const cursorPosition = input.selectionStart;
        const originalValue = input.value;
        
        // Hapus semua karakter non-digit
        let value = originalValue.replace(/\D/g, '');
        
        // Simpan ke hidden input (tanpa format)
        const hiddenInputId = input.id.replace('_display', '');
        const hiddenInput = document.getElementById(hiddenInputId);
        if (hiddenInput) {
            hiddenInput.value = value;
        }
        
        // Format dengan titik sebagai ribuan separator
        const formattedValue = value ? formatDisplay(parseInt(value)) : '';
        
        // Update nilai display
        input.value = formattedValue;
        
        // Atur posisi kursor
        if (cursorPosition) {
            // Hitung perbedaan panjang
            const diff = formattedValue.length - originalValue.length;
            const newCursorPosition = Math.max(1, cursorPosition + diff);
            
            // Set timeout untuk memastikan DOM sudah update
            setTimeout(() => {
                input.setSelectionRange(newCursorPosition, newCursorPosition);
            }, 10);
        }
        
        // Hitung ulang semua nilai
        calculateAll();
    }

    // Fungsi untuk inisialisasi format dari hidden input
    function initializeDisplayFromHidden() {
        const fields = [
            'harga_sewa',
            'harga_pemanfaatan',
            'biaya_admin',
            'cost_of_money',
            'harga_sewa_admin',
            'harga_sewa_admin_com',
            'ppn',
            'total_harga'
        ];

        fields.forEach(id => {
            const displayInput = document.getElementById(`${id}_display`);
            const hiddenInput = document.getElementById(id);

            if (displayInput && hiddenInput && hiddenInput.value) {
                // Format angka dari hidden input
                const value = parseInt(hiddenInput.value) || 0;
                displayInput.value = formatDisplay(value);
            }
        });
    }

    // Setup event listeners untuk field input manual
    const manualInputFields = [
        'harga_sewa_display',
        'harga_pemanfaatan_display',
        'biaya_admin_display',
        'cost_of_money_display'
    ];

    manualInputFields.forEach(id => {
        const input = document.getElementById(id);
        if (input) {
            // Hapus event listener lama jika ada
            input.removeEventListener('input', formatInput);
            input.removeEventListener('blur', formatInput);
            
            // Tambah event listener baru
            input.addEventListener('input', formatInput);
            input.addEventListener('blur', formatInput);
            
            // Tambah event untuk paste
            input.addEventListener('paste', function(e) {
                e.preventDefault();
                const pastedText = (e.clipboardData || window.clipboardData).getData('text');
                const numbers = pastedText.replace(/\D/g, '');
                this.value = numbers ? formatDisplay(parseInt(numbers)) : '';
                
                // Update hidden input
                const hiddenInputId = this.id.replace('_display', '');
                const hiddenInput = document.getElementById(hiddenInputId);
                if (hiddenInput) {
                    hiddenInput.value = numbers;
                }
                
                calculateAll();
            });
        }
    });

    // Inisialisasi
    initializeDisplayFromHidden();
    calculateAll();
});