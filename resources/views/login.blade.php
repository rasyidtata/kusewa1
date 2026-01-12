<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Login</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
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
            border-color: #d5eeffff;
            outline: none;
            box-shadow: 0 0 0 3px rgba(52, 152, 219, 0.2);
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
        }
        
        .login-btn:hover {
            background-color: #2980b9;
        }
        
        .login-btn:active {
            transform: translateY(2px);
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
                <label for="name">Username atau Email</label>
                <i class="fas fa-user input-icon"></i>
                <input type="email" id="email" name="email" placeholder="Masukkan username atau email">
                <div class="error-message" id="name-error">Username atau email harus diisi</div>
            </div>
            
            <div class="input-group">
                <label for="password">Password</label>
                <i class="fas fa-lock input-icon"></i>
                <input type="password" id="password" name="password" placeholder="Masukkan password">
                <i class="fas fa-eye show-password" id="togglePassword"></i>
                <div class="error-message" id="password-error">Password harus diisi (minimal 6 karakter)</div>
            </div>
            
            <button type="submit" class="login-btn">Masuk</button>
        </form>
    </div>

    <script>
document.addEventListener('DOMContentLoaded', function() {
    const loginForm = document.getElementById('loginForm');
    const emailInput = document.getElementById('email');
    const passwordInput = document.getElementById('password');
    const togglePassword = document.getElementById('togglePassword');
    const emailError = document.getElementById('name-error');
    const passwordError = document.getElementById('password-error');
    
    // Toggle password visibility
    togglePassword.addEventListener('click', function() {
        const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordInput.setAttribute('type', type);
        this.classList.toggle('fa-eye');
        this.classList.toggle('fa-eye-slash');
    });
    
    // Validasi form sebelum submit
    loginForm.addEventListener('submit', function(event) {
        event.preventDefault();
        
        // Reset error messages
        resetErrors();
        
        let isValid = true;
        
        // Validasi email
        if (!emailInput.value.trim()) {
            showError(emailError, 'Email harus diisi');
            highlightInput(emailInput, false);
            isValid = false;
        } else if (!isValidEmail(emailInput.value)) {
            showError(emailError, 'Format email tidak valid');
            highlightInput(emailInput, false);
            isValid = false;
        } else {
            highlightInput(emailInput, true);
        }
        
        // Validasi password
        if (!passwordInput.value.trim()) {
            showError(passwordError, 'Password harus diisi');
            highlightInput(passwordInput, false);
            isValid = false;
        } else if (passwordInput.value.length < 6) {
            showError(passwordError, 'Password minimal 6 karakter');
            highlightInput(passwordInput, false);
            isValid = false;
        } else {
            highlightInput(passwordInput, true);
        }
        
        // Jika valid, lakukan submit AJAX
        if (isValid) {
            submitLoginForm();
        }
    });
    
    // Fungsi untuk submit form dengan AJAX
    function submitLoginForm() {
        const formData = new FormData(loginForm);
        
        // Tampilkan loading state
        const submitBtn = document.querySelector('.login-btn');
        const originalText = submitBtn.textContent;
        submitBtn.textContent = 'Memproses...';
        submitBtn.disabled = true;
        
        fetch(loginForm.action, {
            method: 'POST',
            body: formData,
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json'
            }
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            if (data.success) {
                // Login berhasil
                showSuccessMessage();
                
                // Redirect setelah 2 detik
                setTimeout(() => {
                    if (data.redirect_url) {
                        window.location.href = data.redirect_url;
                    } else {
                        window.location.href = '/home/dashboard';
                    }
                }, 2000);
            } else {
                // Login gagal
                if (data.errors) {
                    // Tampilkan error dari server
                    if (data.errors.email) {
                        showError(emailError, data.errors.email[0]);
                        highlightInput(emailInput, false);
                    }
                    if (data.errors.password) {
                        showError(passwordError, data.errors.password[0]);
                        highlightInput(passwordInput, false);
                    }
                    if (data.errors.login) {
                        showGeneralError(data.errors.login);
                    }
                } else if (data.message) {
                    showGeneralError(data.message);
                } else {
                    showGeneralError('Login gagal. Periksa email dan password Anda.');
                }
                
                // Reset button
                submitBtn.textContent = originalText;
                submitBtn.disabled = false;
            }
        })
        .catch(error => {
            console.error('Error:', error);
            
            // Fallback: submit form secara normal jika AJAX gagal
            showGeneralError('Koneksi bermasalah. Mencoba login kembali...');
            
            setTimeout(() => {
                loginForm.submit();
            }, 1000);
            
            submitBtn.textContent = originalText;
            submitBtn.disabled = false;
        });
    }
    
    // Fungsi bantuan
    function isValidEmail(email) {
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return emailRegex.test(email);
    }
    
    function showError(element, message) {
        element.textContent = message;
        element.style.display = 'block';
    }
    
    function highlightInput(input, isValid) {
        if (isValid) {
            input.style.borderColor = '#2ecc71';
        } else {
            input.style.borderColor = '#e74c3c';
        }
    }
    
    function resetErrors() {
        emailError.style.display = 'none';
        passwordError.style.display = 'none';
        emailInput.style.borderColor = '#e0e0e0';
        passwordInput.style.borderColor = '#e0e0e0';
        
        // Hapus pesan error umum jika ada
        const existingError = document.querySelector('.general-error');
        if (existingError) {
            existingError.remove();
        }
    }
    
    function showGeneralError(message) {
        // Hapus pesan error sebelumnya
        const existingError = document.querySelector('.general-error');
        if (existingError) {
            existingError.remove();
        }
        
        // Buat elemen error baru
        const errorDiv = document.createElement('div');
        errorDiv.className = 'general-error';
        errorDiv.style.cssText = `
            background-color: #ffebee;
            color: #c62828;
            padding: 12px;
            border-radius: 6px;
            margin-bottom: 20px;
            border-left: 4px solid #c62828;
            font-size: 14px;
            display: flex;
            align-items: center;
            gap: 10px;
            animation: fadeIn 0.3s ease;
        `;
        
        errorDiv.innerHTML = `
            <i class="fas fa-exclamation-circle"></i>
            <span>${message}</span>
        `;
        
        // Sisipkan setelah login-header
        const loginHeader = document.querySelector('.login-header');
        loginHeader.parentNode.insertBefore(errorDiv, loginHeader.nextSibling);
        
        // Animasi fade in
        setTimeout(() => {
            errorDiv.style.opacity = '1';
        }, 10);
    }
    
    function showSuccessMessage() {
        // Tampilkan pesan sukses
        const loginContainer = document.querySelector('.login-container');
        const originalContent = loginContainer.innerHTML;
        
        loginContainer.innerHTML = `
            <div class="login-header">
                <div class="logo-kai">
                    <img src="{{ asset('asset/img/logo_kai.png') }}" alt="Logo">
                </div>
                <div class="logo">
                    <img src="{{ asset('asset/img/kusewa.png') }}" alt="Logo">
                </div>
                <div style="color: #2ecc71; font-size: 48px; margin: 20px 0;">
                    <i class="fas fa-check-circle"></i>
                </div>
                <h3 style="color: #27ae60;">Login Berhasil!</h3>
                <p>Selamat, Anda sudah login</p>
                <p style="margin-top: 10px; font-weight: bold; color: #2c3e50;">
                    Selamat datang di aplikasi KUsewa :)
                </p>
                <div style="margin-top: 20px; padding: 15px; background-color: #f8f9fa; border-radius: 8px;">
                    <p style="color: #7f8c8d; font-size: 14px; margin: 0;">
                        <i class="fas fa-spinner fa-spin"></i>
                        Mengarahkan ke dashboard...
                    </p>
                </div>
            </div>
        `;
        
        // Tambahkan style untuk animasi
        loginContainer.style.textAlign = 'center';
        loginContainer.style.animation = 'fadeIn 0.5s ease';
    }
    
    // Validasi real-time
    emailInput.addEventListener('blur', function() {
        if (this.value.trim() && !isValidEmail(this.value)) {
            showError(emailError, 'Format email tidak valid');
            highlightInput(this, false);
        } else if (this.value.trim()) {
            emailError.style.display = 'none';
            highlightInput(this, true);
        }
    });
    
    passwordInput.addEventListener('blur', function() {
        if (this.value.trim() && this.value.length < 6) {
            showError(passwordError, 'Password minimal 6 karakter');
            highlightInput(this, false);
        } else if (this.value.trim()) {
            passwordError.style.display = 'none';
            highlightInput(this, true);
        }
    });
    
    // Tambahkan CSS untuk animasi
    const style = document.createElement('style');
    style.textContent = `
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            10%, 30%, 50%, 70%, 90% { transform: translateX(-5px); }
            20%, 40%, 60%, 80% { transform: translateX(5px); }
        }
        
        .shake {
            animation: shake 0.5s ease;
        }
        
        .success-checkmark {
            width: 80px;
            height: 80px;
            margin: 0 auto;
            position: relative;
        }
        
        .success-checkmark .check-icon {
            width: 80px;
            height: 80px;
            position: relative;
            border-radius: 50%;
            box-sizing: content-box;
            border: 4px solid #2ecc71;
        }
        
        .success-checkmark .check-icon::before {
            top: 3px;
            left: -2px;
            width: 30px;
            transform-origin: 100% 50%;
            border-radius: 100px 0 0 100px;
        }
        
        .success-checkmark .check-icon::after {
            top: 0;
            left: 30px;
            width: 60px;
            transform-origin: 0 50%;
            border-radius: 0 100px 100px 0;
            animation: rotate-circle 4.25s ease-in;
        }
        
        .success-checkmark .check-icon .icon-line {
            height: 5px;
            background-color: #2ecc71;
            display: block;
            border-radius: 2px;
            position: absolute;
            z-index: 10;
        }
        
        .success-checkmark .check-icon .icon-line.line-tip {
            top: 46px;
            left: 14px;
            width: 25px;
            transform: rotate(45deg);
            animation: icon-line-tip 0.75s;
        }
        
        .success-checkmark .check-icon .icon-line.line-long {
            top: 38px;
            right: 8px;
            width: 47px;
            transform: rotate(-45deg);
            animation: icon-line-long 0.75s;
        }
        
        @keyframes rotate-circle {
            0% { transform: rotate(-45deg); }
            5% { transform: rotate(-45deg); }
            12% { transform: rotate(-405deg); }
            100% { transform: rotate(-405deg); }
        }
        
        @keyframes icon-line-tip {
            0% { width: 0; left: 1px; top: 19px; }
            54% { width: 0; left: 1px; top: 19px; }
            70% { width: 50px; left: -8px; top: 37px; }
            84% { width: 17px; left: 21px; top: 48px; }
            100% { width: 25px; left: 14px; top: 45px; }
        }
        
        @keyframes icon-line-long {
            0% { width: 0; right: 46px; top: 54px; }
            65% { width: 0; right: 46px; top: 54px; }
            84% { width: 55px; right: 0px; top: 35px; }
            100% { width: 47px; right: 8px; top: 38px; }
        }
    `;
    document.head.appendChild(style);
});
</script>
</body>
</html>