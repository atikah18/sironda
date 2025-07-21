<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
     <script src="https://cdn.jsdelivr.net/npm/chartjs-chart-matrix"></script>
            <link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/jquery.dataTables.min.css">

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://kit.fontawesome.com/978c41f040.js" crossorigin="anonymous"></script>
    <title>Login</title>
</head>
<body class="bg-light bg-gradient" >
    <div class="container py-5 mt-5" >
        <div class="container" >
            <div class="row justify-content-center">
                <div class="col-lg-5">
                    <div class="card shadow-lg border-0 rounded-lg mt-5">
                        
                      <div class="card-header"><h3 class="row justify-content-center" >SiRonda</h3> </div>
                       
                        <div class="card-body">

                            @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $item)
                                    <li>{{ $item }}</li>
                                    @endforeach
                                </ul>
                            </div>
                            @endif
                        
                         
                            <form action="" method="POST">
                                @csrf
                                <!-- Cloudflare Turnstile
                                <div class="cf-turnstile" data-sitekey="0x4AAAAAAA7s8UVAu-1oJHel"></div> <br> -->
                               
                                <div class="mb-3">
                               
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" value="{{ old('email') }}" name="email" class="form-control" placeholder="Masukkan email">
                                </div>
                                <div class="mb-3">
                                   
                                    <label for="password" class="form-label">Password</label>
                                     <!-- <i class="fa-solid fa-eye toggle-password" id="toggleIcon" onclick="togglePassword()"></i> -->
                                    <input type="password" id="password" class="form-control" placeholder="Masukkan password" name="password">
                                      
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
    <div class="pb-3 d-flex justify-content-center">
        <a href="{{ url('user/create') }}">Register</a>
    </div>  
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
<!-- Script Cloudflare Turnstile -->
<script src="https://challenges.cloudflare.com/turnstile/v0/api.js" async defer></script>
