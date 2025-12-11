class PerpanjangForm {
    constructor() {
        this.currentStep = 1;
        this.totalSteps = 3;
        this.init();
    }

    init() {
        this.bindEvents();
        this.togglePerusahaanFields(); // otomatis toggle field perusahaan berdasarkan data dari Blade
        this.updateProgress();         // set progress awal
    }

    bindEvents() {
        // Tombol NEXT
        document.querySelectorAll('.next-step').forEach(btn => {
            btn.addEventListener('click', () => {
                const nextStep = parseInt(btn.dataset.next);
                this.goToStep(nextStep);
            });
        });

        // Tombol PREVIOUS
        document.querySelectorAll('.prev-step').forEach(btn => {
            btn.addEventListener('click', () => {
                const prevStep = parseInt(btn.dataset.prev);
                this.goToStep(prevStep);
            });
        });

        // Jenis penyewa toggle field perusahaan
        document.querySelectorAll('input[name="jenis_penyewa"]').forEach(radio => {
            radio.addEventListener('change', () => {
                this.togglePerusahaanFields();
            });
        });
    }

    goToStep(step) {
        const current = document.getElementById(`step-${this.currentStep}`);
        const next = document.getElementById(`step-${step}`);

        if (!next) return;

        // Hides current step, shows next step
        current.classList.remove('active');
        next.classList.add('active');

        this.currentStep = step;

        // Update progress bar
        this.updateProgress();

        // Scroll ke atas
        window.scrollTo({ top: 0, behavior: 'smooth' });
    }

    togglePerusahaanFields() {
        const selected = document.querySelector('input[name="jenis_penyewa"]:checked');
        const perusahaanFields = document.getElementById('data-perusahaan');

        if (!selected || !perusahaanFields) return;

        if (selected.value === "Perusahaan") {
            perusahaanFields.style.display = "block";
        } else {
            perusahaanFields.style.display = "none";
        }
    }

    updateProgress() {
        const progressBar = document.getElementById('form-progress');
        if (!progressBar) return;

        const percent = (this.currentStep / this.totalSteps) * 100;
        progressBar.style.width = percent + '%';
        progressBar.setAttribute('aria-valuenow', percent);
    }
}

// Inisialisasi saat page ready
document.addEventListener('DOMContentLoaded', () => {
    new PerpanjangForm();
});
