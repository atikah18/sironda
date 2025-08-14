<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login SiRonda - Sistem Monitoring Backup</title>
    
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/login.css') }}">

    <link rel="icon" type="image/x-icon" href="{{ asset('assets/img/sironda.svg') }}">
    
    
</head>
<body>
    <div class="login-wrapper">
        <!-- Logo Header di Luar Card -->
        <div class="logo-header">
            <img src="{{ url('assets/img/bpsbanten.png') }}" alt="Logo BPS Banten" class="logo-img">
        </div>
        
        <!-- Login Card -->
        <div class="login-card">
            <div class="card-header">
              <h1 class="logo-text">SiRonda</h1>
              <p class="logo-subtitle">Sistem Monitoring Backup Database</p>
            </div>
            
            <div class="card-body">
                <!-- Error Message -->
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                         
                            <form action="" method="POST">
                                @csrf
                                <!-- Cloudflare Turnstile
                                <div class="cf-turnstile" data-sitekey="0x4AAAAAAA7s8UVAu-1oJHel"></div> <br> -->
                               
                                <!-- Email Field -->
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="fas fa-envelope"></i>
                            </span>
                            <input
                                type="email"
                                id="email"
                                name="email"
                                value="{{ old('email') }}"
                                class="form-control"
                                placeholder="Email"
                                required
                                autofocus
                            />
                        </div>
                    </div>
                                  <!-- Password Field -->
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="fas fa-lock"></i>
                            </span>
                            <input
                                type="password"
                                id="password"
                                name="password"
                                class="form-control"
                                placeholder="Password"
                                required
                            />
                            <i class="fas fa-eye toggle-password" id="togglePassword"></i>
                        </div>
                    </div>
                               <!-- <script>
  function togglePassword() {
    const input = document.getElementById("password");
    const icon = document.getElementById("toggleIcon");

    if (input.type === "password") {
      input.type = "text";
      icon.classList.remove("fa-eye");
      icon.classList.add("fa-eye-slash");
    } else {
      input.type = "password";
      icon.classList.remove("fa-eye-slash");
      icon.classList.add("fa-eye");
    }
  }
</script> -->
                                 <div class="mb-3 d-grid">
                                    <button name="submit" type="submit" class="btn btn-primary">Login</button>
                                </div>
                              </form>
                               <!-- TOMBOL TAMBAH PENGGUNA -->
    <!-- <div class="pb-3 d-flex justify-content-center">
        <a href="{{ url('user/create') }}">Register</a>
    </div>   -->  
    <div class="footer-text">
                    <p>©2025 BPS Provinsi Banten. Used by <b>Tim SPBE</b> </p>
                </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<!-- Bootstrap & Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        // Toggle Password Visibility
        document.addEventListener('DOMContentLoaded', function() {
            const togglePassword = document.querySelector('#togglePassword');
            const passwordInput = document.querySelector('#password');
            
            if (togglePassword && passwordInput) {
                togglePassword.addEventListener('click', function() {
                    const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                    passwordInput.setAttribute('type', type);
                    this.classList.toggle('fa-eye');
                    this.classList.toggle('fa-eye-slash');
                });
            }
            
            // Add focus effect to input groups
            const inputs = document.querySelectorAll('.form-control');
            inputs.forEach(input => {
                input.addEventListener('focus', function() {
                    this.closest('.input-group').classList.add('focus');
                });
                
                input.addEventListener('blur', function() {
                    this.closest('.input-group').classList.remove('focus');
                });
            });
        });
    </script>
</body>
</html>