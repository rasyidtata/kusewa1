
document.addEventListener('DOMContentLoaded', function () {
    // Daftar semua field yang perlu format rupiah
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

        if (!displayInput || !hiddenInput) return;

        // Format saat input
        displayInput.addEventListener('input', function () {
            let value = this.value.replace(/\D/g, ''); // Hanya ambil angka
            if (value === '') {
                hiddenInput.value = '';
                this.value = '';
                return;
            }

            // Format dengan titik (ribuan)
            const formatted = new Intl.NumberFormat('id-ID').format(value);
            this.value = formatted;

            // Simpan nilai asli (tanpa titik) ke hidden input
            hiddenInput.value = value;
        });

        // Isi display dari hidden input saat load (jika ada old() data)
        if (hiddenInput.value) {
            displayInput.value = new Intl.NumberFormat('id-ID').format(hiddenInput.value);
        }
    });
});



