<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Login</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- SweetAlert2 untuk alert yang lebih baik -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        body {
            background-color: #f0f2f5;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 20px;
        }
        
        .login-container {
            background-color: white;
            border-radius: 12px;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
            padding: 40px 30px;
            transition: transform 0.3s ease;
        }
        
        .login-container:hover {
            transform: translateY(-5px);
        }
        
        .login-header {
            text-align: center;
            margin-bottom: 30px;
        }
        
        .login-header h1 {
            color: #2c3e50;
            font-size: 28px;
            margin-bottom: 8px;
        }
        
        .login-header p {
            color: #7f8c8d;
            font-size: 15px;
        }
        .logo-kai {
            display: flex;
            align-items: center;
            justify-content: center;
            margin: -20px auto 20px;
        }
        .logo-kai img {
            width: 100px;
            height: auto;
        }
        
        .logo {
            display: flex;
            align-items: center;
            justify-content: center;
            margin: -10px auto 40px;
        }
        .logo img {
            width: 100px;
            height: auto;
        }
        .login-header p {
            color: #666;
            font-size: 14px;
            margin-top: 2px;
            line-height: 1.5;
        }
        
        .input-group {
            margin-bottom: 20px;
            position: relative;
        }
        
        .input-group label {
            display: block;
            margin-bottom: 8px;
            color: #2c3e50;
            font-weight: 600;
            font-size: 14px;
        }
        
        .input-group input {
            width: 100%;
            padding: 12px 12px 12px 45px;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            font-size: 14px;
            transition: all 0.3s;
        }
        
        .input-group input:focus {
            border-color: #3498db;
            outline: none;
            box-shadow: 0 0 0 3px rgba(52, 152, 219, 0.2);
        }
        
        .input-group input.error {
            border-color: #e74c3c;
        }
        
        .input-group input.success {
            border-color: #2ecc71;
        }
        
        .input-icon {
            position: absolute;
            left: 15px;
            top: 45px;
            color: #7f8c8d;
            font-size: 12px;
        }
        
        .show-password {
            position: absolute;
            right: 15px;
            top: 45px;
            color: #7f8c8d;
            cursor: pointer;
            font-size: 12px;
        }
        
        .options {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
            font-size: 14px;
        }
        
        .remember-me {
            display: flex;
            align-items: center;
        }
        
        .remember-me input {
            margin-right: 8px;
        }
        
        .forgot-password {
            color: #3498db;
            text-decoration: none;
            transition: color 0.2s;
        }
        
        .forgot-password:hover {
            color: #2980b9;
            text-decoration: underline;
        }
        
        .login-btn {
            background-color: #3498db;
            color: white;
            border: none;
            width: 100%;
            padding: 14px;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: background-color 0.3s;
            margin-bottom: 20px;
            position: relative;
        }
        
        .login-btn:hover {
            background-color: #2980b9;
        }
        
        .login-btn:active {
            transform: translateY(2px);
        }
        
        .login-btn.loading {
            background-color: #2980b9;
            cursor: not-allowed;
        }
        
        .login-btn.loading:after {
            content: '';
            position: absolute;
            width: 20px;
            height: 20px;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            margin: auto;
            border: 3px solid transparent;
            border-top-color: #ffffff;
            border-radius: 50%;
            animation: button-loading-spinner 1s ease infinite;
        }
        
        @keyframes button-loading-spinner {
            from {
                transform: rotate(0turn);
            }
            to {
                transform: rotate(1turn);
            }
        }
        
        .register-link {
            text-align: center;
            font-size: 15px;
            color: #7f8c8d;
        }
        
        .register-link a {
            color: #3498db;
            text-decoration: none;
            font-weight: 600;
        }
        
        .register-link a:hover {
            text-decoration: underline;
        }
        
        .error-message {
            color: #e74c3c;
            font-size: 14px;
            margin-top: 5px;
            display: none;
        }
        
        .error-message.show {
            display: block;
        }
        
        .divider {
            display: flex;
            align-items: center;
            margin: 25px 0;
            color: #95a5a6;
            font-size: 14px;
        }
        
        .divider::before, .divider::after {
            content: "";
            flex: 1;
            height: 1px;
            background-color: #ecf0f1;
        }
        
        .divider::before {
            margin-right: 15px;
        }
        
        .divider::after {
            margin-left: 15px;
        }
        
        @media (max-width: 480px) {
            .login-container {
                padding: 30px 20px;
            }
            
            .options {
                flex-direction: column;
                align-items: flex-start;
                gap: 10px;
            }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-header">
            <div class="logo-kai">
                <img src="{{ asset('asset/img/logo_kna.png') }}" alt="Logo">
            </div>
            <div class="logo">
                <img src="{{ asset('asset/img/kusewa.png') }}" alt="Logo">
            </div>
            <h3>Selamat Datang</h3>
            <p>Silakan masuk ke akun Anda</p>
        </div>
        
        <form action="{{ url('submit/login') }}" id="loginForm" method="POST">
            @csrf
            <div class="input-group">
                <label for="email">Email</label>
                <i class="fas fa-envelope input-icon"></i>
                <input type="email" id="email" name="email" placeholder="Masukkan email" value="{{ old('email') }}">
                <div class="error-message" id="email-error">Email harus diisi dengan format yang valid</div>
            </div>
            
            <div class="input-group">
                <label for="password">Password</label>
                <i class="fas fa-lock input-icon"></i>
                <input type="password" id="password" name="password" placeholder="Masukkan password">
                <i class="fas fa-eye show-password" id="togglePassword"></i>
                <div class="error-message" id="password-error">Password harus diisi (minimal 6 karakter)</div>
            </div>
            
            <!-- Menampilkan error dari server jika ada -->
            @if(session('error'))
                <div class="error-message show" style="text-align: center; margin-bottom: 15px;">
                    {{ session('error') }}
                </div>
            @endif
            
            @if($errors->any())
                <div class="error-message show" style="text-align: center; margin-bottom: 15px;">
                    @foreach($errors->all() as $error)
                        {{ $error }}<br>
                    @endforeach
                </div>
            @endif
            
            <button type="submit" class="login-btn" id="submitBtn">Masuk</button>
        </form>
        
        
    </div>

    <script>
        // Toggle show/hide password
        document.getElementById('togglePassword').addEventListener('click', function() {
            const passwordInput = document.getElementById('password');
            const icon = this;
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        });
        
        // Validasi form client-side
        const loginForm = document.getElementById('loginForm');
        const emailInput = document.getElementById('email');
        const passwordInput = document.getElementById('password');
        const emailError = document.getElementById('email-error');
        const passwordError = document.getElementById('password-error');
        const submitBtn = document.getElementById('submitBtn');
                                                                                                                                                                    
        
        // Fungsi validasi email
        function isValidEmail(email) {
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            return emailRegex.test(email);
        }
        
        // Fungsi tampilkan error
        function showError(inputElement, errorElement, message) {
            inputElement.classList.remove('success');
            inputElement.classList.add('error');
            errorElement.textContent = message;
            errorElement.classList.add('show');
        }
        
        // Fungsi hapus error
        function removeError(inputElement, errorElement) {
            inputElement.classList.remove('error');
            errorElement.classList.remove('show');
        }
        
        // Fungsi tampilkan success
        function showSuccess(inputElement) {
            inputElement.classList.remove('error');
            inputElement.classList.add('success');
        }
        
        // Validasi saat input berubah
        emailInput.addEventListener('input', function() {
            if (this.value.trim() === '') {
                showError(this, emailError, 'Email harus diisi');
            } else if (!isValidEmail(this.value.trim())) {
                showError(this, emailError, 'Format email tidak valid');
            } else {
                removeError(this, emailError);
                showSuccess(this);
            }
        });
        
        passwordInput.addEventListener('input', function() {
            if (this.value.trim() === '') {
                showError(this, passwordError, 'Password harus diisi');
            } else if (this.value.length < 6) {
                showError(this, passwordError, 'Password minimal 6 karakter');
            } else {
                removeError(this, passwordError);
                showSuccess(this);
            }
        });
        
        // Validasi saat form disubmit
        loginForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            let isValid = true;
            
            // Validasi email
            if (emailInput.value.trim() === '') {
                showError(emailInput, emailError, 'Email harus diisi');
                isValid = false;
            } else if (!isValidEmail(emailInput.value.trim())) {
                showError(emailInput, emailError, 'Format email tidak valid');
                isValid = false;
            }
            
            // Validasi password
            if (passwordInput.value.trim() === '') {
                showError(passwordInput, passwordError, 'Password harus diisi');
                isValid = false;
            } else if (passwordInput.value.length < 6) {
                showError(passwordInput, passwordError, 'Password minimal 6 karakter');
                isValid = false;
            }
            
            // Jika valid, kirim form
            if (isValid) {
                // Tampilkan loading state
                submitBtn.classList.add('loading');
                submitBtn.disabled = true;
                
                // Kirim form secara manual
                const formData = new FormData(this);
                
                fetch(this.action, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    // Hapus loading state
                    submitBtn.classList.remove('loading');
                    submitBtn.disabled = false;
                    
                    if (data.success) {
                        // Tampilkan alert sukses
                        Swal.fire({
                            icon: 'success',
                            title: 'Login Berhasil!',
                            text: 'Selamat datang kembali!',
                            timer: 1500,
                            showConfirmButton: false,
                            willClose: () => {
                                // Redirect ke dashboard
                                window.location.href = data.redirect;
                            }
                        });
                    } else {
                        // Tampilkan error dari server
                        Swal.fire({
                            icon: 'error',
                            title: 'Login Gagal',
                            text: data.message || 'Email atau password salah',
                        });
                    }
                })
                .catch(error => {
                    // Hapus loading state
                    submitBtn.classList.remove('loading');
                    submitBtn.disabled = false;
                    
                    // Jika fetch gagal, submit form secara tradisional
                    console.error('Fetch error:', error);
                    this.submit();
                });
            }
            
            return false;
        });
        
        // Cek apakah ada error dari session saat halaman dimuat
        document.addEventListener('DOMContentLoaded', function() {
            @if(session('error') || $errors->any())
                Swal.fire({
                    icon: 'error',
                    title: 'Login Gagal',
                    text: '{{ session('error') ?? ($errors->first() ?: "Terjadi kesalahan") }}',
                });
            @endif
            
            @if(session('success'))
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil',
                    text: '{{ session('success') }}',
                });
            @endif
        });
    </script>
</body>
</html>