document.addEventListener('DOMContentLoaded', function () {
    // Gunakan event delegation pada document atau parent element yang statis
    document.addEventListener('click', function(e) {
        const logoutBtn = e.target.closest('#logout-btn');
        
        if (logoutBtn) {
            e.preventDefault();
            
            Swal.fire({
                title: 'Apakah Anda yakin ingin keluar?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Logout',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('logout-form').submit();
                }
            });
        }
    });
});