<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Formasi Jabatan</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
         <!-- <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css"> -->
        <!-- <link href="css/styles.css" rel="stylesheet" /> -->
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
        <!-- Leaflet CSS -->
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
        <!-- <link rel="icon" type="image/x-icon" href="{{ asset('img/simfoni.ico') }}"> -->

        <!-- Bootstrap 5 CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Font Awesome (Icons) -->
<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css"> -->

<!-- DataTables CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">

<!-- Optional: Simple Datatables CSS (if you actually use it) -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css">

<link href="https://cdn.jsdelivr.net/gh/StartBootstrap/startbootstrap-sb-admin-2@master/css/sb-admin-2.min.css" rel="stylesheet">

<!-- AdminLTE CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
<!-- FullCalendar CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.css">
<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    </head>
    <body class="sb-nav">
        <!-- Leaflet JS -->
        <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
        <!-- Chart.js -->
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <!-- jQuery -->


        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-secondary bg-gradient">
            
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3 " href="{{ url('home') }}">SiRonda  </a>
           
            <!-- Navbar-->
             <span class="text-white">Sistem Informasi Laporan Kegiatan Backup Data Server BPS Provinsi Banten</span>
            <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
            <!-- Navbar-->
            <ul class="navbar-nav ">
                 <li class="nav-item"><a class="nav-link active" aria-current="page"  href="{{ url('home') }}">Home</a></li>
                        <!-- <li class="nav-item"><a class="nav-link" href="#">Link</a></li> -->
                        @if($user!=null)  
                        <li class="nav-item dropdown">
                            <a class="nav-link active dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Monitoring backup</a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="{{ url('jadwal') }}">Kalendar</a></li>
                                 <li><a class="dropdown-item" href="{{ url('penjadwalan') }}">Jadwal Monitoring</a></li>
                                <li><a class="dropdown-item" href="{{ url('reports') }}">Laporan Monitoring backup/restore</a></li>
                                <li><hr class="dropdown-divider" /></li>
                                <li><a class="dropdown-item" href='{{ url('addInfo/create') }}'>Update Informasi Aplikasi Server</a></li>
                            </ul>
                        </li>
                        <li class="nav-item"><a class="nav-link active" aria-current="page"  href="{{ url('user') }}">Daftar Akun</a></li>
                        @endif
                <li class="nav-item dropdown">

                    <a class="nav-link dropdown-toggle " id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    @if($user!=null) 
                <li><a class="dropdown-item" href="">{{ $user->name }}</a></li>
                        @if ($user->role == "1")
               <li><a class="dropdown-item" href="">Admin</a></li>
                @endif
                @if ($user->role == "2")
                 <li><a class="dropdown-item" href="">Ketua</a></li>
                @endif
                @if ($user->role == "3")
                 <li><a class="dropdown-item" href="">Anggota</a></li>
                @endif 
                        <a class="nav-link text-black" href="{{ url('logout') }}">
                                <div class="sb-nav-link-icon text-black"><i class="fa-solid fa-right-from-bracket"></i></div>
                                Logout
                            </a>
                        </div>
                    </div>
                   
                    <!-- <div class="sb-sidenav-footer">
                        <div class="small">Logged in as:</div>
                        {{ $user->name }}
                        ({{ $user->role }})
                    </div> -->
                    @endif
                    @if ($user==null)
                    <li><a class="dropdown-item" href="{{ url('/login') }}">Login Akun</a></li>
                    @endif
                    </ul>
                </li>
            </ul>
            
            </form>
        </nav>
        <!-- <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-light bg-light" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">Dashboard</div>
                            <a class="nav-link" href="{{ url('dash') }}">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-sitemap"></i></div>
                                Formasi Jabatan
                            </a>
                            <a class="nav-link" href="{{ url('dip') }}">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-user-large"></i></div>
                                Informasi Pegawai (DIP)
                            </a>
                            <a class="nav-link" href="{{ url('dashsatker') }}">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-house-laptop"></i></div>
                                Satuan Kerja
                            </a>
                            <a class="nav-link" href="{{ url('dashjabatan') }}">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-layer-group"></i></div>
                                Kelas Jabatan
                            </a>
                    @if ($user==null)
                    <li>
                        <a class="nav-link" href="{{ url('/simfoni/admin') }}">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-right-to-bracket"></i></div>
                                Login Admin
                            </a>
                    </li>
                    @endif
                    @if($user!=null)
                            <div class="sb-sidenav-menu-heading">Master</div>
                            <a class="nav-link" href="#" data-bs-toggle="collapse" data-bs-target="#pagesCollapseubah" aria-expanded="false" aria-controls="pagesCollapse">
                                <div><i class="fa-solid fa-file-pen"></i> Perubahan Data</div>
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="pagesCollapseubah" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="{{ url('ubahdata') }}">Formasi Jabatan</a>
                                    <a class="nav-link" href="{{ url('ubahdip') }}">Informasi Pegawai (DIP)</a>
                                    <a class="nav-link" href="{{ url('ubahdatajabatan') }}">Kelas Jabatan</a>
                                </nav>
                            </div>
                            <div class="sb-sidenav-menu-heading">Akun</div>
                            <a class="nav-link" href="{{ url('pengguna') }}">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-user-large"></i></div>
                                User
                            </a>
                            <a class="nav-link" href="https://jws.jawarastatistik.id/simfoniweb/assets/Panduan Simfoni ver 1.0.pdf">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-user-large"></i></div>
                                Panduan Admin
                            </a> -->
                            <!-- <a class="nav-link" href="{{ url('logout') }}">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-right-from-bracket"></i></div>
                                Logout
                            </a>
                        </div>
                    </div>
                   
                    <div class="sb-sidenav-footer">
                        <div class="small">Logged in as:</div>
                        {{ $user->name }}
                        ({{ $user->role }})
                    </div>
                    @endif
                </nav>
            </div>
            <div id="layoutSidenav_content"> --> 
                <main>
                    
                    @include('komponen.pesan')
                    @yield('konten')

                </main>
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; BPS Provinsi Banten 2025</div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <!-- <script src="{{ asset('https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js') }}" crossorigin="anonymous"></script> -->
        <!-- <script src="{{ asset('js/scripts.js') }}"></script> -->
        <!-- Load jQuery -->
        <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

        <!-- Load DataTables JS -->
        <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

        <!-- <script src="{{ asset('https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js') }}" crossorigin="anonymous"></script> -->
        <!-- <script src="{{ asset('assets/demo/datatables-demo.js') }}"></script> -->
        <!-- Script Cloudflare Turnstile -->
        <script src="https://challenges.cloudflare.com/turnstile/v0/api.js" async defer></script>
        <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>

<!-- Bootstrap Bundle (with Popper) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>

<!-- Font Awesome JS (optional if CSS version above is used) -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/js/all.min.js"></script>

<!-- DataTables JS -->
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/chartjs-chart-matrix"></script>

<!-- Leaflet JS -->
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

<!-- Remove local scripts.js and datatables-demo.js -->
<script src="https://cdn.jsdelivr.net/gh/StartBootstrap/startbootstrap-sb-admin-2@master/js/sb-admin-2.min.js"></script>

    </body>
</html>
