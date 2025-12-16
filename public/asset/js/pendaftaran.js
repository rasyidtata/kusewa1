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
                this.value = this.value.replace(/[^0-9]/g, '');
                if (this.value.length > 16) {
                    this.value = this.value.slice(0, 16);
                }
            });

            nikInput.addEventListener('paste', function (e) {
                e.preventDefault();
                let pastedText = (e.clipboardData || window.clipboardData).getData('text');
                pastedText = pastedText.replace(/[^0-9]/g, '').slice(0, 16);
                this.value = pastedText;
                this.dispatchEvent(new Event('input', { bubbles: true }));
            });
        }
    }

    validateStep(step) {
        let isValid = true;
        const currentStepElement = document.getElementById(`step-${step}`);

        // Validasi field required
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

        // Validasi NIK
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
        document.getElementById(`step-${this.currentStep}`).classList.remove('active');
        document.getElementById(`step-${step}`).classList.add('active');
        this.currentStep = step;
        this.updateProgress();
    }

    updateProgress() {
        const progress = (this.currentStep / this.totalSteps) * 100;
        document.getElementById('form-progress').style.width = `${progress}%`;
        window.scrollTo({ top: 0, behavior: 'smooth' });
    }

    togglePerusahaanFields() {
        const jenisPenyewa = document.querySelector('input[name="jenis_penyewa"]:checked');
        if (!jenisPenyewa) return;

        const perusahaanFields = document.getElementById('data-perusahaan');
        const jenisPenyewaValue = jenisPenyewa.value;

        if (jenisPenyewaValue === 'Perusahaan') {
            perusahaanFields.style.display = 'block';
            const requiredFields = ['nama_perwakilan', 'npwp', 'perwakilan_selaku'];
            perusahaanFields.querySelectorAll('input, textarea').forEach(field => {
                if (requiredFields.includes(field.name)) {
                    field.setAttribute('required', 'required');
                } else {
                    field.removeAttribute('required');
                }
            });
        } else {
            perusahaanFields.style.display = 'none';
            perusahaanFields.querySelectorAll('input, textarea').forEach(field => {
                field.removeAttribute('required');
            });
        }
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
                // Redirect atau reset form
                window.location.href = result.redirect_url || '/success';
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
        document.querySelectorAll('.is-invalid').forEach(field => {
            field.classList.remove('is-invalid');
        });
        document.querySelectorAll('.invalid-feedback').forEach(error => {
            error.remove();
        });

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
    success: function (response) {
        if (response.success) {
            alert(response.message);
            // Redirect otomatis
            window.location.href = response.redirect_url;
        }
    },
    error: function (xhr) {
        var errors = xhr.responseJSON.errors;
        // Tampilkan error validasi
    }
});