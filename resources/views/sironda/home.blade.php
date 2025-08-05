@extends('layout.layoutnav')
<!-- AdminLTE 3 -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">

<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

<!-- FullCalendar CSS -->
<link href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.css" rel="stylesheet" />

<!-- FullCalendar JS -->
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js"></script>

<!-- START DATA -->
@section('konten')



<script>
document.addEventListener('DOMContentLoaded', function() {
  const events = <?php echo json_encode($events);?>;
    let calendarEl = document.getElementById('calendar');
    //var Calendar = FullCalendar.Calendar;
    let calendar = new FullCalendar.Calendar(calendarEl, {
        //initialView: 'dayGridMonth',
       // height: 'auto',
        //themeSystem: 'bootstrap',
        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,timeGridDay',
            backgroundColor: '#f56954',
            },
        events: events // Data from controller
    });

    calendar.render();
});
</script>


  <!-- Main content -->
  <section class="content">
    <div class="row">
   <div class="container-fluid px-4">
    
    <h1 class="mt-4">Informasi database</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item">Server windows BPS Provinsi Banten</li>
    </ol>
   
    
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-5"></i>
            Daftar Database untuk di-backup
        </div>
        <div class="card-body">
            <!-- <div class="pb-3">
                <a href='{{ url('addInfo/create') }}' class="btn btn-primary">Tambah Database</a>
            </div> -->
        <div class="table-responsive">
            <table id="dataTable" class="datatable-table">
                <thead>
                    <tr>
                        <th class="col-2">Repository Aplikasi</th>
                        <th class="col-2">Nama Database</th>
                        <th class="col-2">Status</th>
                        <th class="col-2">Keterangan</th>
                        @if($user!=null)
                        <th scope="col-2">Aksi</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
            
                @foreach ($data as $item)
                <tr>
                    <td>{{ $item->folder_aplikasi }}</td>
                    <td>{{ $item->nama_db}}</td>
                     @if ( $item->status<>"2")
                        <td>Waiting for Approval</td>
                    @endif
                    @if ( $item->status=="2")
                        <td>Approved</td>
                    @endif
                    <td>{{ $item->update_note}}</td>
                    @if($user!=null)
                    <td class="gap-2">
                        <a href="{{ url('addInfo/'.$item->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form onsubmit="return confirm('Yakin akan menghapus data?')" class="d-inline" action="{{ url('addInfo/'.$item->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" name="submit" class="btn btn-danger btn-sm">Hapus</button>
                     </form>
                    </td>

                    @endif
                </tr>
                @endforeach
                </tbody>
            </table>
        </div>
       
     </div>
    </div>
<div class="container mt-4">
     <h2 class="text-center m-4">Jadwal Kegiatan</h2>
                 <div class="card mb-4">
           <div class="d-flex align-items-center gap-3 mb-3">
  <div>
    <span class="badge" style="background-color:#0073b7;">&nbsp;&nbsp;</span> Mingguan (backup)
  </div>
  <div>
    <span class="badge" style="background-color:#f39c12;">&nbsp;&nbsp;</span> Bulanan (backup & restore)
  </div>
</div>
<div id="calendar"></div>
</div>
     </div>
     </div>
  </section>

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Bootstrap 4 Bundle (needed for AdminLTE) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

<!-- AdminLTE JS -->
<script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>

<!-- fullCalendar JS -->
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js"></script>


@endsection
