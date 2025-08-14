@extends('layout.layoutnav')
<!-- AdminLTE 3 -->
<!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css"> -->

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
   
        <div class="container-fluid px-4">

            <div class="container mt-4">
                <h2 class="text-center m-4">Jadwal Kegiatan</h2>
                 <!-- <div class="card mb-4"> -->
                    <div class="d-flex align-items-center gap-3 mb-3">
                        <div> <span class="badge" style="background-color:#0073b7;">&nbsp;&nbsp;</span> Mingguan (backup) </div>
                        <div> <span class="badge" style="background-color:#f39c12;">&nbsp;&nbsp;</span> Bulanan (backup & restore) </div>
                    </div>
                    
                    <div id="calendar"></div>
                <!-- </div> -->
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
