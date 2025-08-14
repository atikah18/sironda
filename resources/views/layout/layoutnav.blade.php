<!DOCTYPE html>
<html lang="en">
    <head>
   <meta charset="utf-8"/>
        <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <meta
            name="description"
            content="Sistem Informasi Ronda - Monitoring Backup Database"/>
        <meta name="author" content="BPS Provinsi Banten"/>
        <title>SiRonda - Sistem Monitoring Backup</title>

        <!-- DataTables CSS -->
        <link
            rel="stylesheet"
            href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">

        <!-- Leaflet CSS & JS -->
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css">
        <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

        <!-- Chart.js -->
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

        <!-- Font Awesome -->
        <script
            src="https://use.fontawesome.com/releases/v6.3.0/js/all.js"
            crossorigin="anonymous"></script>

        <!-- Bootstrap CSS -->
        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"
            rel="stylesheet">

        <link rel="stylesheet" href="{{ asset('css/nav.css') }}">

        <!-- *** TAMBAHKAN INI UNTUK FLOATING NAVIGATION *** -->
        <link rel="stylesheet" href="{{ asset('css/floating-nav.css') }}">
        <!-- *** AKHIR PENAMBAHAN *** -->

        
    </head>
     <body class="d-flex flex-column min-vh-100">
        <!-- Navbar Modern -->
        <nav class="navbar navbar-expand-lg navbar-dark navbar-modern sticky-top">
            <div class="container-fluid">
                <a class="navbar-brand fw-bold" href="{{ url('home') }}">
                    <i class="fas fa-shield-alt me-2"></i>
                    SiRonda
                </a>
            <!-- Navbar-->
             <span class="text-white">Sistem Informasi Laporan Kegiatan Backup Data Server BPS Provinsi Banten</span>
            <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
            <!-- Navbar-->
            <ul class="navbar-nav ">
                 <li class="nav-item"><a class="nav-link active" aria-current="page"  href="{{ url('home') }}">Beranda</a></li>
                        <!-- <li class="nav-item"><a class="nav-link" href="#">Link</a></li> -->
                        @if(auth()->user()!=null)  
                         <li class="nav-item"><a class="nav-link active" aria-current="page"  href='{{ url('addInfo') }}'>Informasi</a></li>
                          <li class="nav-item"><a class="nav-link active" aria-current="page"  href="{{ url('penjadwalan')}}">Kegiatan Monitoring</a></li>
                        <!-- <li class="nav-item dropdown">
                            <a class="nav-link active dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Monitoring backup</a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                 <li><a class="dropdown-item" href="{{ url('jadwal') }}">Kalendar</a></li> 
                                 <li><a class="dropdown-item" href="{{ url('penjadwalan') }}">Jadwal Monitoring</a></li>
                                <li><a class="dropdown-item" href="{{ url('reports') }}">Laporan Monitoring backup/restore</a></li>
                                <li><hr class="dropdown-divider" /></li>
                                <li><a class="dropdown-item" href='{{ url('addInfo/create') }}'>Update Informasi Aplikasi Server</a></li>
                            </ul>
                        </li> -->
                        <li class="nav-item"></li><a class="nav-link active" aria-current="page" href="{{ asset('storage/SOP_33-4_Backup dan Restore Database dan Aplikasi_fix[sign).pdf') }}"target="_blank"> File SOP </a></li>
                        <li class="nav-item"><a class="nav-link active" aria-current="page"  href="{{ url('user') }}">Akun</a></li>
                        @endif
                <li class="nav-item dropdown">

                    <a class="nav-link dropdown-toggle " id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    @if(auth()->user()!=null) 
                <li><a class="dropdown-item disabled">{{ auth()->user()->name }}</a></li>
                @if (auth()->user()->role == "1")
              <li><a class="dropdown-item disabled" >Admin</a></li>
                @endif
                @if (auth()->user()->role == "2")
                 <li><a class="dropdown-item disabled" >Ketua</a></li>
                @endif
                @if (auth()->user()->role == "3")
                 <li><a class="dropdown-item disabled" >Anggota</a></li>
                @endif 
                        <a class="nav-link text-black" href="{{ url('logout') }}">
                                <div class="sb-nav-link-icon text-black"><i class="fa-solid fa-right-from-bracket"></i></div>
                                Logout
                            </a>
                        </div>
                    </div>
                   
                    @endif
                    @if (auth()->user()==null)
                    <li><a class="dropdown-item" href="{{ url('/login') }}">Login Akun</a></li>
                    @endif
                    </ul>
                </li>
            </ul>
            
            </form>
        </nav>
       
                  <!-- Main Content -->
        <main class="flex-shrink-0">
            <div class="container-fluid px-4">
                @include('komponen.pesan')
                <div class="fade-in">
                    @yield('konten')
                </div>
            </div>
        </main>

        <!-- Footer Modern -->
        <footer class="footer-modern mt-auto">
            <div class="container-fluid px-4">
                <div class="d-flex align-items-center justify-content-between small">
                    <div class="text-muted">
                        <i class="fas fa-copyright me-1"></i>
                        Copyright &copy; BPS Provinsi Banten 2025
                    </div>
                    <div class="text-muted">
                        <i class="fas fa-code me-1"></i>
                        Sistem Monitoring Backup Database
                    </div>
                </div>
            </div>
        </footer>

            </div>
        </div>
         <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
        <script
            src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>

        <!-- DataTables JS -->
        <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

        <!-- Custom Scripts -->
        <script src="{{ asset('js/scripts.js') }}"></script>
        <script src="{{ asset('assets/demo/datatables-demo.js') }}"></script>

        <!-- Cloudflare Turnstile -->
        <script
            src="https://challenges.cloudflare.com/turnstile/v0/api.js"
            async="async"
            defer="defer"></script>
 </body>
</html>
