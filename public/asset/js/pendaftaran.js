// == CurrencyCalculator Module ==
const CurrencyCalculator = {
    // Fungsi untuk mengubah format rupiah ke angka
    convertToNumber(rupiahString) {
        if (!rupiahString) return 0;
        return parseInt(rupiahString.replace(/\./g, '')) || 0;
    },

    // Fungsi untuk memformat angka ke format rupiah
    formatDisplay(angka) {
        if (!angka && angka !== 0) return '';
        return new Intl.NumberFormat('id-ID').format(angka);
    },

    // Fungsi untuk mengubah angka menjadi terbilang
    terbilang(angka) {
        const bilangan = Math.abs(parseInt(angka));
        if (bilangan === 0) return "";

        const angkaTerbilang = ["", "Satu", "Dua", "Tiga", "Empat", "Lima", "Enam", "Tujuh", "Delapan", "Sembilan", "Sepuluh", "Sebelas"];

        let kalimat = "";
        if (bilangan < 12) {
            kalimat = angkaTerbilang[bilangan];
        } else if (bilangan < 20) {
            kalimat = this.terbilang(bilangan - 10) + " Belas";
        } else if (bilangan < 100) {
            const puluh = this.terbilang(Math.floor(bilangan / 10));
            const satuan = this.terbilang(bilangan % 10);
            kalimat = puluh + " Puluh" + (satuan ? " " + satuan : "");
        } else if (bilangan < 200) {
            kalimat = "Seratus " + this.terbilang(bilangan - 100);
        } else if (bilangan < 1000) {
            const ratus = this.terbilang(Math.floor(bilangan / 100));
            const sisa = this.terbilang(bilangan % 100);
            kalimat = ratus + " Ratus" + (sisa ? " " + sisa : "");
        } else if (bilangan < 2000) {
            kalimat = "Seribu " + this.terbilang(bilangan - 1000);
        } else if (bilangan < 1000000) {
            const ribu = this.terbilang(Math.floor(bilangan / 1000));
            const sisa = this.terbilang(bilangan % 1000);
            kalimat = ribu + " Ribu" + (sisa ? " " + sisa : "");
        } else if (bilangan < 1000000000) {
            const juta = this.terbilang(Math.floor(bilangan / 1000000));
            const sisa = this.terbilang(bilangan % 1000000);
            kalimat = juta + " Juta" + (sisa ? " " + sisa : "");
        } else if (bilangan < 1000000000000) {
            const milyar = this.terbilang(Math.floor(bilangan / 1000000000));
            const sisa = this.terbilang(bilangan % 1000000000);
            kalimat = milyar + " Milyar" + (sisa ? " " + sisa : "");
        } else if (bilangan < 1000000000000000) {
            const triliun = this.terbilang(Math.floor(bilangan / 1000000000000));
            const sisa = this.terbilang(bilangan % 1000000000000);
            kalimat = triliun + " Triliun" + (sisa ? " " + sisa : "");
        }

        return kalimat.trim().replace(/\s+/g, ' ');
    },

    // Fungsi untuk menghitung semua nilai
    calculateAll() {
        const hargaSewa = this.convertToNumber(document.getElementById('harga_sewa_display')?.value || '0');
        const biayaAdmin = this.convertToNumber(document.getElementById('biaya_admin_display')?.value || '0');
        const costOfMoney = this.convertToNumber(document.getElementById('cost_of_money_display')?.value || '0');
        const hargaPemanfaatan = this.convertToNumber(document.getElementById('harga_pemanfaatan_display')?.value || '0');

        const hargaSewaAdmin = hargaSewa + biayaAdmin;
        const hargaSewaAdminCom = hargaSewaAdmin + costOfMoney;
        const ppn = Math.round(hargaSewa * 0.11);
        const totalHarga = hargaSewaAdminCom + ppn;

        // Update hidden inputs
        const setVal = (id, val) => {
            const el = document.getElementById(id);
            if (el) el.value = val;
        };

        setVal('harga_sewa', hargaSewa);
        setVal('harga_pemanfaatan', hargaPemanfaatan);
        setVal('biaya_admin', biayaAdmin);
        setVal('cost_of_money', costOfMoney);
        setVal('harga_sewa_admin', hargaSewaAdmin);
        setVal('harga_sewa_admin_com', hargaSewaAdminCom);
        setVal('ppn', ppn);
        setVal('total_harga', totalHarga);

        // Update display inputs
        const setDisplay = (id, val) => {
            const el = document.getElementById(id);
            if (el) el.value = this.formatDisplay(val);
        };

        setDisplay('harga_sewa_admin_display', hargaSewaAdmin);
        setDisplay('harga_sewa_admin_com_display', hargaSewaAdminCom);
        setDisplay('ppn_display', ppn);
        setDisplay('total_harga_display', totalHarga);

        // Update terbilang
        const terbilangText = totalHarga > 0 ? this.terbilang(totalHarga) + " Rupiah" : "";
        setVal('terbilang', terbilangText);
    },

    // Format input saat diketik
    formatInput(event) {
        const input = event.target;
        const cursorPosition = input.selectionStart;
        const originalValue = input.value;

        let value = originalValue.replace(/\D/g, '');

        const hiddenInputId = input.id.replace('_display', '');
        const hiddenInput = document.getElementById(hiddenInputId);
        if (hiddenInput) hiddenInput.value = value;

        const formattedValue = value ? this.formatDisplay(parseInt(value)) : '';
        input.value = formattedValue;

        if (cursorPosition) {
            const diff = formattedValue.length - originalValue.length;
            const newCursorPosition = Math.max(1, cursorPosition + diff);
            setTimeout(() => {
                input.setSelectionRange(newCursorPosition, newCursorPosition);
            }, 10);
        }

        this.calculateAll();
    },

    // Inisialisasi nilai tampilan dari hidden input
    initializeDisplayFromHidden() {
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
                displayInput.value = this.formatDisplay(parseInt(hiddenInput.value) || 0);
            }
        });
    },

    // Setup event listener
    init() {
        const manualInputFields = [
            'harga_sewa_display',
            'harga_pemanfaatan_display',
            'biaya_admin_display',
            'cost_of_money_display'
        ];

        manualInputFields.forEach(id => {
            const input = document.getElementById(id);
            if (!input) return;

            // Pastikan tidak double bind
            input.removeEventListener('input', this.formatInput.bind(this));
            input.removeEventListener('blur', this.formatInput.bind(this));

            input.addEventListener('input', this.formatInput.bind(this));
            input.addEventListener('blur', this.formatInput.bind(this));

            input.addEventListener('paste', (e) => {
                e.preventDefault();
                const pastedText = (e.clipboardData || window.clipboardData).getData('text');
                const numbers = pastedText.replace(/\D/g, '');
                input.value = numbers ? this.formatDisplay(parseInt(numbers)) : '';

                const hiddenInputId = input.id.replace('_display', '');
                const hiddenInput = document.getElementById(hiddenInputId);
                if (hiddenInput) hiddenInput.value = numbers;

                this.calculateAll();
            });
        });

        this.initializeDisplayFromHidden();
        this.calculateAll(); // Hitung awal
    }
};

// == MultiStepForm Class ==
class MultiStepForm {
    constructor() {
        this.currentStep = 1;
        this.totalSteps = 3;
        this.init();
    }

    init() {
        this.bindEvents();
        this.updateProgress();
        this.togglePerusahaanFields();
    }

    bindEvents() {
        // Next step buttons
        document.querySelectorAll('.next-step').forEach(button => {
            button.addEventListener('click', (e) => {
                e.preventDefault();
                const nextStep = parseInt(e.target.dataset.next, 10);
                if (this.validateCurrentStep()) {
                    this.goToStep(nextStep);
                }
            });
        });

        // Previous step buttons
        document.querySelectorAll('.prev-step').forEach(button => {
            button.addEventListener('click', (e) => {
                e.preventDefault();
                const prevStep = parseInt(e.target.dataset.prev, 10);
                this.goToStep(prevStep);
            });
        });

        // Jenis penyewa radio buttons
        document.querySelectorAll('input[name="jenis_penyewa"]').forEach(radio => {
            radio.addEventListener('change', () => {
                this.togglePerusahaanFields();
            });
        });

        // Submit button
        const submitBtn = document.getElementById('submitFormBtn');
        if (submitBtn) {
            submitBtn.addEventListener('click', (e) => {
                e.preventDefault();
                this.submitForm();
            });
        }

        // Reset button
        const resetBtn = document.getElementById('resetStep1');
        if (resetBtn) {
            resetBtn.addEventListener('click', () => this.resetStep1());
        }
    }

    validateCurrentStep() {
        return this.validateStep(this.currentStep);
    }

    validateStep(step) {
        const stepElement = document.getElementById(`step-${step}`);
        if (!stepElement) return true;

        let isValid = true;
        const requiredFields = stepElement.querySelectorAll('[required]');

        requiredFields.forEach(field => this.clearError(field));

        requiredFields.forEach(field => {
            if (!field.value.trim()) {
                isValid = false;
                const fieldName = this.getFieldName(field);
                this.showError(field, `${fieldName} wajib diisi`);
            }
        });

        // Validasi tambahan per step
        if (step === 1) {
            const emailField = stepElement.querySelector('input[type="email"]');
            if (emailField && emailField.value) {
                const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                if (!emailRegex.test(emailField.value)) {
                    isValid = false;
                    this.showError(emailField, 'Format email tidak valid');
                }
            }

            const jenisPenyewa = document.querySelector('input[name="jenis_penyewa"]:checked');
            if (!jenisPenyewa) {
                isValid = false;
                const radioGroup = document.querySelector('input[name="jenis_penyewa"]');
                if (radioGroup) {
                    this.showError(radioGroup.closest('.form-group'), 'Jenis Penyewa wajib dipilih');
                }
            }

            const kategori = document.getElementById('kategori');
            if (kategori && !kategori.value) {
                isValid = false;
                this.showError(kategori, 'Kategori wajib dipilih');
            }
        }

        if (step === 2) {
            const masaAwal = document.getElementById('masa_awal_perjanjian')?.value;
            const masaAkhir = document.getElementById('masa_akhir_perjanjian')?.value;

            if (masaAwal && masaAkhir) {
                const startDate = new Date(masaAwal);
                const endDate = new Date(masaAkhir);
                if (endDate < startDate) {
                    isValid = false;
                    this.showError(document.getElementById('masa_akhir_perjanjian'), 'Masa akhir harus setelah masa awal');
                }
            }
        }

        if (step === 3) {
            const hargaSewa = document.getElementById('harga_sewa')?.value;
            if (!hargaSewa || parseFloat(hargaSewa) <= 0) {
                isValid = false;
                this.showError(document.getElementById('harga_sewa'), 'Harga sewa wajib diisi dan harus lebih dari 0');
            }
        }

        if (!isValid) {
            Swal.fire({
                icon: 'warning',
                title: 'Data Belum Lengkap',
                text: 'Silakan lengkapi semua field yang ditandai dengan warna merah',
                confirmButtonColor: '#f59e0b'
            });
        }

        return isValid;
    }

    getFieldName(field) {
        const label = field.previousElementSibling?.textContent ||
            field.parentElement?.previousElementSibling?.textContent ||
            field.placeholder ||
            field.name ||
            'Field ini';
        return label.replace(':', '').replace('*', '').trim();
    }

    showError(field, message) {
        if (field.type === 'radio') {
            field = field.closest('.form-group') || field;
        }

        field.classList.add('is-invalid');

        const errorDiv = document.createElement('div');
        errorDiv.className = 'invalid-feedback';
        errorDiv.textContent = message;
        field.parentNode.appendChild(errorDiv);
    }

    clearError(field) {
        if (field.type === 'radio') {
            field = field.closest('.form-group') || field;
        }

        field.classList.remove('is-invalid');
        const existingError = field.parentNode.querySelector('.invalid-feedback');
        if (existingError) {
            existingError.remove();
        }
    }

    goToStep(step) {
        const currentStepElement = document.getElementById(`step-${this.currentStep}`);
        const nextStepElement = document.getElementById(`step-${step}`);

        if (currentStepElement) currentStepElement.classList.remove('active');
        if (nextStepElement) nextStepElement.classList.add('active');

        this.currentStep = step;
        this.updateProgress();
    }

    updateProgress() {
        const progressBar = document.getElementById('form-progress');
        if (progressBar) {
            const progress = (this.currentStep / this.totalSteps) * 100;
            progressBar.style.width = `${progress}%`;
        }
        window.scrollTo({ top: 0, behavior: 'smooth' });
    }

    togglePerusahaanFields() {
        const jenisPenyewa = document.querySelector('input[name="jenis_penyewa"]:checked');
        if (!jenisPenyewa) return;

        const perusahaanFields = document.getElementById('data-perusahaan');
        if (!perusahaanFields) return;

        if (jenisPenyewa.value === 'Perusahaan') {
            perusahaanFields.style.display = 'block';
            perusahaanFields.querySelectorAll('[name="nama_perwakilan"], [name="npwp"], [name="perwakilan_selaku"]')
                .forEach(field => field.setAttribute('required', 'required'));
        } else {
            perusahaanFields.style.display = 'none';
            perusahaanFields.querySelectorAll('input, textarea')
                .forEach(field => field.removeAttribute('required'));
        }
    }

    resetStep1() {
        Swal.fire({
            title: 'Reset Data Step 1?',
            text: 'Semua data pada step 1 akan dihapus',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#f59e0b',
            cancelButtonColor: '#6b7280',
            confirmButtonText: 'Ya, Reset',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                const step1Fields = document.querySelectorAll('#step-1 input, #step-1 textarea, #step-1 select');
                step1Fields.forEach(field => {
                    if (field.type === 'radio' || field.type === 'checkbox') {
                        field.checked = false;
                    } else {
                        field.value = '';
                    }
                    this.clearError(field);
                });

                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: 'Data step 1 telah direset',
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 2000
                });
            }
        });
    }

    submitForm() {
        for (let step = 1; step <= 3; step++) {
            if (!this.validateStep(step)) {
                if (this.currentStep !== step) this.goToStep(step);
                return;
            }
        }

        this.showConfirmation();
    }

    showConfirmation() {
        const namaLengkap = document.getElementById('nama_lengkap')?.value || '';
        const jenisPenyewa = document.querySelector('input[name="jenis_penyewa"]:checked')?.value || '';
        const totalHarga = document.getElementById('total_harga')?.value || '0';
        const formattedHarga = CurrencyCalculator.formatDisplay(totalHarga);

        Swal.fire({
            title: 'Konfirmasi Pendaftaran',
            html: `
                <div class="text-center">
                    <div class="mb-3">
                        <i class="bi bi-person-check fs-1 text-primary"></i>
                    </div>
                    <h5 class="mb-3">Apakah data sudah benar?</h5>
                    <div class="alert alert-info text-start">
                        <p class="mb-1"><strong>Nama:</strong> ${namaLengkap}</p>
                        <p class="mb-1"><strong>Jenis Penyewa:</strong> ${jenisPenyewa}</p>
                        <p class="mb-0"><strong>Total Harga:</strong> Rp ${formattedHarga}</p>
                    </div>
                    <small class="text-muted">Data akan disimpan ke database</small>
                </div>
            `,
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Ya, Simpan',
            cancelButtonText: 'Periksa Kembali',
            confirmButtonColor: '#10b981',
            cancelButtonColor: '#6b7280'
        }).then((result) => {
            if (result.isConfirmed) {
                this.processSubmit();
            }
        });
    }

    async processSubmit() {
        Swal.fire({
            title: 'Menyimpan...',
            text: 'Sedang menyimpan data pendaftaran',
            allowOutsideClick: false,
            didOpen: () => Swal.showLoading()
        });

        const form = document.getElementById('multi-step-form');
        if (!form) {
            Swal.fire('Error', 'Form tidak ditemukan', 'error');
            return;
        }

        try {
            const formData = new FormData(form);
            const response = await fetch(form.action || '/pendaftaran', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || '',
                    'Accept': 'application/json'
                },
                body: formData
            });

            const result = await response.json();

            if (result.success) {
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: result.message || 'Pendaftaran berhasil disimpan',
                    confirmButtonColor: '#10b981'
                }).then(() => {
                    if (result.redirect_url) {
                        window.location.href = result.redirect_url;
                    }
                });
            } else {
                let errorMsg = result.message || 'Terjadi kesalahan';
                if (result.errors) {
                    this.displayValidationErrors(result.errors);
                    errorMsg = 'Terdapat kesalahan validasi';
                }
                Swal.fire('Gagal!', errorMsg, 'error');
            }
        } catch (error) {
            console.error('Error:', error);
            Swal.fire('Error', 'Terjadi kesalahan saat mengirim data', 'error');
        }
    }

    displayValidationErrors(errors) {
        document.querySelectorAll('.is-invalid').forEach(el => el.classList.remove('is-invalid'));
        document.querySelectorAll('.invalid-feedback').forEach(el => el.remove());

        for (const [fieldName, messages] of Object.entries(errors)) {
            const field = document.querySelector(`[name="${fieldName}"]`);
            if (field) {
                this.showError(field, messages[0]);
            }
        }
    }
}

// == Initialization ==
document.addEventListener('DOMContentLoaded', () => {
    // Inisialisasi CurrencyCalculator
    CurrencyCalculator.init();

    // Inisialisasi MultiStepForm
    window.multiStepForm = new MultiStepForm();
});