class MultiStepForm {
    constructor() {
        this.currentStep = 1;
        this.totalSteps = 3;
        this.formData = new FormData();
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
                const nextStep = parseInt(e.target.dataset.next);
                if (this.validateStep(this.currentStep)) {
                    this.goToStep(nextStep);

                }
            });
        });

        // Previous step buttons
        document.querySelectorAll('.prev-step').forEach(button => {
            button.addEventListener('click', (e) => {
                const prevStep = parseInt(e.target.dataset.prev);
                this.goToStep(prevStep);
            });
        });

        // Jenis penyewa radio buttons
        document.querySelectorAll('input[name="jenis_penyewa"]').forEach(radio => {
            radio.addEventListener('change', () => {
                this.togglePerusahaanFields();
            });
        });

        // Form submission
        document.getElementById('multi-step-form').addEventListener('submit', (e) => {
            e.preventDefault();
            this.submitForm();
        });

        // Batasi NIK maksimal 16 karakter
        const nikInput = document.getElementById('nik');
        if (nikInput) {
            nikInput.addEventListener('input', function () {
                // Hanya izinkan angka
                this.value = this.value.replace(/[^0-9]/g, '');
                // Batasi maksimal 16 karakter
                if (this.value.length > 16) {
                    this.value = this.value.slice(0, 16);
                }
            });

            nikInput.addEventListener('paste', function (e) {
                e.preventDefault();
                let pastedText = (e.clipboardData || window.clipboardData).getData('text');
                // Hanya ambil angka dan batasi 16 karakter
                pastedText = pastedText.replace(/[^0-9]/g, '').slice(0, 16);
                this.value = pastedText;
                // Trigger input event agar validasi lain tetap jalan
                this.dispatchEvent(new Event('input', { bubbles: true }));
            });
        }

        // Auto calculate fields
        this.bindCalculationEvents();


    }

    validateStep(step) {
        let isValid = true;
        const currentStepElement = document.getElementById(`step-${step}`);

        const requiredFields = currentStepElement.querySelectorAll('[required]');
        requiredFields.forEach(field => {
            if (!field.value.trim()) {
                isValid = false;
                this.showError(field, 'Field ini wajib diisi');
            } else {
                this.clearError(field);
            }
        });

        // Validasi email
        const emailField = currentStepElement.querySelector('input[type="email"]');
        if (emailField && emailField.value) {
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(emailField.value)) {
                isValid = false;
                this.showError(emailField, 'Format email tidak valid');
            }
        }

        // validate NIK
        if (step === 1) {
            const nik = document.getElementById('nik').value;
            if (nik.length !== 16) {
                alert('NIK harus terdiri dari 16 digit angka.');
                return false;
            }
        }


        return isValid;
    }

    showError(field, message) {
        this.clearError(field);
        field.classList.add('is-invalid');

        const errorDiv = document.createElement('div');
        errorDiv.className = 'invalid-feedback';
        errorDiv.textContent = message;
        field.parentNode.appendChild(errorDiv);
    }

    clearError(field) {
        field.classList.remove('is-invalid');
        const existingError = field.parentNode.querySelector('.invalid-feedback');
        if (existingError) {
            existingError.remove();
        }
    }

    goToStep(step) {
        // Hide current step
        document.getElementById(`step-${this.currentStep}`).classList.remove('active');

        // Show new step
        document.getElementById(`step-${step}`).classList.add('active');

        this.currentStep = step;
        this.updateProgress();
    }

    updateProgress() {
        const progress = (this.currentStep / this.totalSteps) * 100;
        document.getElementById('form-progress').style.width = `${progress}%`;
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    }

    togglePerusahaanFields() {
        const jenisPenyewa = document.querySelector('input[name="jenis_penyewa"]:checked').value;
        const perusahaanFields = document.getElementById('data-perusahaan');

        if (jenisPenyewa === 'Perusahaan') {
            perusahaanFields.style.display = 'block';
            const requiredFields = ['nama_perwakilan', 'npwp', 'kota_penyewa', 'kode_pos', 'perwakilan_selaku'];
            // Set required fields for perusahaan
            perusahaanFields.querySelectorAll('input, textarea').forEach(field => {
            if (requiredFields.includes(field.name)) {
                field.setAttribute('required', 'required');
            } else {
                field.removeAttribute('required');
            }
        });
        } else {
            perusahaanFields.style.display = 'none';
            // Remove required fields
            perusahaanFields.querySelectorAll('input, textarea').forEach(field => {
                field.removeAttribute('required');
            });
        }
    }

    bindCalculationEvents() {
        // Auto calculate harga sewa + admin
        const hargaSewa = document.getElementById('harga_sewa');
        const biayaAdmin = document.getElementById('biaya_admin');
        const hargaSewaAdmin = document.getElementById('harga_sewa_admin');

        if (hargaSewa && biayaAdmin && hargaSewaAdmin) {
            [hargaSewa, biayaAdmin].forEach(field => {
                field.addEventListener('input', () => {
                    const sewa = parseFloat(hargaSewa.value) || 0;
                    const admin = parseFloat(biayaAdmin.value) || 0;
                    hargaSewaAdmin.value = sewa + admin;
                    this.calculateTotal();
                });
            });
        }

        // Auto calculate total harga
        const costOfMoney = document.getElementById('cost_of_money');
        const ppn = document.getElementById('ppn');
        const totalHarga = document.getElementById('total_harga');

        if (costOfMoney && ppn && totalHarga) {
            [costOfMoney, ppn].forEach(field => {
                field.addEventListener('input', () => {
                    this.calculateTotal();
                });
            });
        }
    }

    calculateTotal() {
        const hargaSewaAdmin = parseFloat(document.getElementById('harga_sewa_admin').value) || 0;
        const costOfMoney = parseFloat(document.getElementById('cost_of_money').value) || 0;
        const ppn = parseFloat(document.getElementById('ppn').value) || 0;

        const hargaSewaAdminCom = hargaSewaAdmin + costOfMoney;
        const total = hargaSewaAdminCom + ppn;

        document.getElementById('hagra_sewa_admin_com').value = hargaSewaAdminCom;
        document.getElementById('total_harga').value = total;
    }

    async submitForm() {
        if (!this.validateStep(this.currentStep)) {
            alert('Harap lengkapi semua field yang wajib diisi');
            return;
        }

        const form = document.getElementById('multi-step-form');
        const formData = new FormData(form);

        try {
            const response = await fetch('/pendaftaran', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: formData
            });

            const result = await response.json();

            if (result.success) {
                alert('Pendaftaran berhasil disimpan!');
                form.reset();
                this.goToStep(1);
                // Redirect atau lakukan action lainnya
            } else {
                alert('Terjadi kesalahan: ' + result.message);
                if (result.errors) {
                    this.displayValidationErrors(result.errors);
                }
            }
        } catch (error) {
            console.error('Error:', error);
            alert('Terjadi kesalahan saat mengirim data');
        }
    }

    displayValidationErrors(errors) {
        // Clear all errors first
        document.querySelectorAll('.is-invalid').forEach(field => {
            field.classList.remove('is-invalid');
        });
        document.querySelectorAll('.invalid-feedback').forEach(error => {
            error.remove();
        });

        // Show new errors
        for (const [field, messages] of Object.entries(errors)) {
            const input = document.querySelector(`[name="${field}"]`);
            if (input) {
                input.classList.add('is-invalid');
                const errorDiv = document.createElement('div');
                errorDiv.className = 'invalid-feedback';
                errorDiv.textContent = messages[0];
                input.parentNode.appendChild(errorDiv);
            }
        }
    }
}

// Initialize form when document is ready
document.addEventListener('DOMContentLoaded', function () {
    new MultiStepForm();
});











// Contoh AJAX submit
$.ajax({
    url: '/pendaftaran',
    method: 'POST',
    data: formData,
    processData: false,
    contentType: false,
    success: function(response) {
        if (response.success) {
            alert(response.message);
            // Redirect otomatis
            window.location.href = response.redirect_url;
        }
    },
    error: function(xhr) {
        var errors = xhr.responseJSON.errors;
        // Tampilkan error validasi
    }
});