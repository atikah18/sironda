@extends('layout.layoutnav')
<!-- AdminLTE 3 -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">

<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

<!-- fullCalendar CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.css">

<!-- START DATA -->
@section('konten')
<div class="container-fluid px-4">
    <!-- <h1 class="mt-4">Formasi Jabatan</h1>
    <ol class="breadcrumb mb-4">
       <li class="breadcrumb-item">BPS di Provinsi Banten</li>
    </ol> -->

</div>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <!-- Left Column: Draggable Events -->
        <div class="col-md-3">
          <div class="sticky-top mb-3">
            <!-- Draggable Events -->
            <div class="card">
              <div class="card-header"><h4 class="card-title">Draggable Events</h4></div>
              <div class="card-body">
                <div id="external-events">
                  <div class="external-event bg-success">Lunch</div>
                  <div class="external-event bg-warning">Go home</div>
                  <div class="external-event bg-info">Do homework</div>
                  <div class="external-event bg-primary">Work on UI design</div>
                  <div class="external-event bg-danger">Sleep tight</div>
                  <p><input type="checkbox" id="drop-remove"> remove after drop</p>
                </div>
              </div>
            </div>

            <!-- Create Event -->
            <div class="card">
              <div class="card-header"><h4 class="card-title">Create Event</h4></div>
              <div class="card-body">
                <div class="btn-group" style="width:100%; margin-bottom:10px;">
                  <ul class="fc-color-picker" id="color-chooser">
                    <li><a class="text-primary" href="#"><i class="fas fa-square"></i></a></li>
                    <li><a class="text-warning" href="#"><i class="fas fa-square"></i></a></li>
                    <li><a class="text-success" href="#"><i class="fas fa-square"></i></a></li>
                    <li><a class="text-danger" href="#"><i class="fas fa-square"></i></a></li>
                    <li><a class="text-muted" href="#"><i class="fas fa-square"></i></a></li>
                  </ul>
                </div>
                <input id="new-event" type="text" class="form-control" placeholder="Event Title">
                <br>
                <button id="add-new-event" type="button" class="btn btn-primary btn-block">Add</button>
              </div>
            </div>
          </div>
        </div>

        <!-- Right Column: Calendar -->
        <div class="col-md-9">
          <div class="card card-primary">
            <div class="card-body p-0">
              <div id="calendar" style="width:100%; height:800px;"></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>

<!-- Required Scripts -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>

<!-- FullCalendar -->
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {
  var containerEl = document.getElementById('external-events');
  var Calendar = FullCalendar.Calendar;
  var Draggable = FullCalendar.Draggable;

  // Make external events draggable
  new Draggable(containerEl, {
    itemSelector: '.external-event',
    eventData: function (eventEl) {
      return {
        title: eventEl.innerText.trim(),
        backgroundColor: window.getComputedStyle(eventEl).backgroundColor,
        borderColor: window.getComputedStyle(eventEl).backgroundColor,
        textColor: '#fff'
      };
    }
  });

  // Initialize the calendar
  var calendarEl = document.getElementById('calendar');
  var calendar = new Calendar(calendarEl, {
    headerToolbar: {
      left: 'prev,next today',
      center: 'title',
      right: 'dayGridMonth,timeGridWeek,timeGridDay'
    },
    droppable: true, // allow things to be dropped
    editable: true,
    events: [
      { title: 'All Day Event', start: '2025-07-01', backgroundColor: '#f56954' },
      { title: 'Long Event', start: '2025-07-16', end: '2025-07-18', backgroundColor: '#f39c12' },
      { title: 'Meeting', start: '2025-07-20T10:30:00', backgroundColor: '#0073b7' },
      { title: 'Lunch', start: '2025-07-20T12:00:00', backgroundColor: '#00a65a' },
      { title: 'Birthday Party', start: '2025-07-21T19:00:00', backgroundColor: '#00c0ef' }
    ],
    drop: function (info) {
      if (document.getElementById('drop-remove').checked) {
        info.draggedEl.parentNode.removeChild(info.draggedEl);
      }
    }
  });
  calendar.render();

  // Add new event
  var currColor = '#3c8dbc'; // default color
  document.querySelectorAll('#color-chooser a').forEach(function (el) {
    el.addEventListener('click', function (e) {
      e.preventDefault();
      currColor = window.getComputedStyle(this.querySelector('i')).color;
    });
  });

  document.getElementById('add-new-event').addEventListener('click', function () {
    var val = document.getElementById('new-event').value;
    if (val.length === 0) return;

    var event = document.createElement('div');
    event.className = 'external-event';
    event.style.backgroundColor = currColor;
    event.style.borderColor = currColor;
    event.innerText = val;

    document.getElementById('external-events').prepend(event);

    new Draggable(event, {
      eventData: { title: val, backgroundColor: currColor, borderColor: currColor, textColor: '#fff' }
    });

    document.getElementById('new-event').value = '';
  });
});
</script>
<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Bootstrap 4 Bundle (needed for AdminLTE) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

<!-- AdminLTE JS -->
<script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>

<!-- fullCalendar JS -->
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js"></script>


@endsection
