@extends('layout.layoutadmin')

<!-- START DATA -->
@section('konten')
<div class="container-fluid px-4">
    <h1 class="mt-4">Formasi Jabatan</h1>
    <ol class="breadcrumb mb-4">
       <li class="breadcrumb-item">BPS di Provinsi Banten</li>
    </ol>

</div>

<div class="row m-3 mb-0">
<!-- <script src="https://code.jscharting.com/latest/jscharting.js"></script> -->
     <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
     <script src="https://cdn.jsdelivr.net/npm/chartjs-chart-matrix"></script>
            <link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/jquery.dataTables.min.css">

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>

<!-- DataTables JS -->
<script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
   
        <div class="col-7 card-header p-0 pt-1">
            <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                <li class="nav-item">
                    <a
                        class="nav-link active"
                        id="custom-tabs-one-home-tab"
                        data-bs-toggle="pill"
                        href="#custom-tabs-one-home"
                        role="tab"
                        aria-controls="custom-tabs-one-home"
                        aria-selected="true">Total Pegawai</a>
                </li>
                <li class="nav-item">
                    <a
                        class="nav-link"
                        id="custom-tabs-one-stacked-tab"
                        data-bs-toggle="pill"
                        href="#custom-tabs-one-stacked"
                        role="tab"
                        aria-controls="custom-tabs-one-stacked"
                        aria-selected="false">Formasi Tersedia</a>
                </li>
                
            </ul>
                <div class="tab-content" id="nav-tabContent">
                <div
                class="tab-pane fade show active"
                    id="custom-tabs-one-home"
                    role="tabpanel"
                    aria-labelledby="custom-tabs-one-home-tab">
                    <div  id="map" style="height: 400px;background-color:rgba(255,0,0,0.0);"></div>
                </div>
                <div
                    class="tab-pane fade"
                    id="custom-tabs-one-stacked"
                    role="tabpanel"
                    aria-labelledby="custom-tabs-one-stacked-tab">
                
                    <div class="modal" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Peta Jabatan </h5>
                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body" id="isiModal">
                        
                        </div>
                        <!-- <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary">Send message</button>
                        </div> -->
                        </div>
                    </div>
                    </div>
                </div>
                </div>
        </div>
   
    <div class="col-5 ml-2" >
        <div class="row justify-content-md-center mt-5 mb-3">
            <div class="col mb-2">
                <div class="card  border-left-primary shadow m-2 h-100">
                    <div class="card-body">
                        <div class="col-auto p-0">
                            <i class="fa-solid fa-building fa-2x"></i>
                        </div>
                        <div class="row no-gutters align-items-center">

                            <div class="col mr-2">
                                <div class="text-md font-weight-bold text-primary text-uppercase mb-1"> Satuan Kerja </div>
                            </div>
                            
                        </div>
                        
                    </div> 
                    <div class="card-footer bg-primary border-success m-0"></div>
                </div>
            </div>
            <div class="col mb-2">         
                <div class="card  border-left-primary shadow m-2 h-100">
                    <div class="card-body">
                        <div class="col-auto p-0">
                            <i class="fa-solid fa-building-user fa-2x"></i>
                        </div>
                        <div class="row no-gutters align-items-center">

                            <div class="col mr-2">
                                <div class="text-md font-weight-bold text-primary text-uppercase mb-1">Kebutuhan Berdasarkan ABK </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer bg-primary border-success m-0"></div>
                </div>
            </div>
            </div>
            <div class="row justify-content-md-center">
                        <div class="col mb-2">
                        <div class="card border-left-primary shadow  m-2 h-100">
                                <div class="card-body">
                                    <div class="col-auto p-0">
                                    <i class="fa-solid fa-users-rectangle fa-2x"></i>
                                    </div>
                                    <div class="row no-gutters align-items-center">

                                        <div class="col mr-2">
                                            <div class="text-md font-weight-bold text-primary text-uppercase mb-1">Existing Pegawai </div>
                                         </div>

                                    </div>
                                </div>
                                <div class="card-footer bg-primary border-success m-0"></div>
                            </div>
                        </div>
  
                        <div class="col mb-2">
                        <div class="card border-left-primary shadow  m-2 h-100">
                                <div class="card-body">
                                    <div class="col-auto p-0">
                                    <i class="fa-solid fa-couch fa-2x"></i>
                                    </div>
                                    <div class="row no-gutters align-items-center">

                                        <div class="col mr-2">
                                            <div class="text-md font-weight-bold text-primary text-uppercase mb-1">Formasi Tersedia </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="card-footer bg-primary border-success m-0"></div>
                            </div>
                        </div>
            </div>
                        
        </div>
       
    </div>
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <div class="card m-4">
        <div class="card-header">
       
            <!-- Rekap Formasi Jabatan -->
            <a  type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne" style="color:black;"  onclick="toggleIcon()"> <span id="iconCollapse" class="fas fa-chevron-down"></span>
            Lihat Rekap Formasi  
        </a>
        </div>
        <div id="collapseOne" class="collapse" aria-labelledby="headingOne" >
        <div class="card-body">
         <div class="mb-3">
                   <a class="btn btn-success" href="{{ url('rekap/export/excel') }}">
                    <i class="fa fa-download"></i> Unduh File
                </a>
            </div>
            
      </div>
    </div>
    <script>
       function toggleIcon() {
    var icon = document.getElementById('iconCollapse');
    
    if (icon.classList.contains('fa-chevron-down')) {
        icon.classList.remove('fa-chevron-down');
        icon.classList.add('fa-chevron-up'); // Change to minus icon
    } else {
        icon.classList.remove('fa-chevron-up');
        icon.classList.add('fa-chevron-down'); // Back to plus
    }
}
</script>
       
    </div>
    <div class="card m-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            <!-- Formasi Jabatan -->
            <a type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo" style="color:black;">
            Formasi Jabatan 
        </a>
        </div>
        <div id="collapseTwo" class="collapse show" aria-labelledby="headingTwo" >
        <div class="card-body">
            <div class="mb-3">
                   <a class="btn btn-success" href="{{ url('abk/export/excel') }}">
                    <i class="fa fa-download"></i> Unduh File
                </a>
            </div>
            
      </div>
    </div>
      </div>
        </div>
    </div>

               
@endsection
