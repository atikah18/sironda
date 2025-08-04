@extends('layout.template')
<!-- START FORM -->
@section('konten')
<div class="container-fluid px-4">
    <h1 class="mt-4">Edit Laporan</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item">Hasil Laporan Monitoring Backup Server Windows BPS Provinsi Banten</li>
    </ol>
    <div class="card mb-4">
    </div>
    <div class="card mb-4">
        <div class="card-header">
            <i class="fa-solid fa-circle-plus" aria-hidden="true"></i>
            Edit Data
        </div>      
    <div class="card-body">

    <form action='{{ url('reports/'.$data->id) }}' method='post' id="form" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <a href="{{ url('/reports') }}" class="btn btn-secondary">Kembali</a>
        <div class="my-3 p-3 bg-body rounded shadow-sm">
             <div class="mb-3 row">
                    <div class="col-sm-10">
                         <input type="hidden" id="task_id" name="task_id" value="{{ $data->task_id }}">
                </div>
            </div>
            <div class="mb-3 row">

                 <label for="user_id" class="col-sm-2 col-form-label">Nama Petugas</label>
                    <div class="col-sm-10">
               <select class="form-control select2" style="width: 100%;" name="user_id" id="user_id" disabled>
                                <option selected value="{{ $data->user_id }}">{{ $data->user->name  }}</option>
                                @foreach ($user as $item)
                                    
                                    @if  ($user->id <> $data->user_id) 
                                    
                                    <option value="{{ $item->id }}">{{ $item->user->name }}</option>
                                    @endif
                                @endforeach
                        </select>
                </div>
            </div>
            <div class="mb-3 row">
                <label for="daterange" class="col-sm-2 col-form-label">Rentang Waktu</label>
                    <div class="col-sm-10">
                         <!-- <label for="daterange">Select Date Range:</label> -->
                      <input type="text" id="daterange" name="daterange" class="form-control" disabled/>
                    </div>
            </div>
            
            <div class="mb-3 row">
                <label for="type" class="col-sm-2 col-form-label">Jenis</label>
                    <div class="col-sm-10">
                        <select class="form-control select2" style="width: 100%;" name="type" id="type" disabled>
                        <option disabled value=""></option>
                            <option value=1 <?php echo ($data->tasks->type == "1") ? 'selected' : ''; ?>>Mingguan (backup) </option>
                             <option value=2 <?php echo ($data->tasks->type == "2") ? 'selected' : ''; ?>>Bulanan (Backup & Restore)</option>
                         </select>
                    </div>
            </div>
             {{-- Tampilkan file lama (PDF) --}}
    @if($data->log_file)
        <p>File laporan saat ini:
            <a href="{{ asset('storage/'.$data->log_file) }}" target="_blank">Lihat File</a>
        </p>
    @endif
    <div class="mb-3">
        <label for="log_file">Upload File Laporan (PDF/DOC):</label>
        <input type="file" name="log_file" class="form-control">
    </div>

             {{-- Tampilkan gambar lama --}}
    @if($data->ss_result)
        <p>Screenshot hasil saat ini:</p>
        <img src="{{ asset('storage/'.$data->ss_result) }}" 
             alt="Screenshot" 
             style="max-width: 200px; height: auto; display:block; margin-bottom:10px;">
    @endif
    <div class="mb-3">
        <label for="ss_result">Upload Screenshot Baru (JPG/PNG):</label>
        <input type="file" name="ss_result" class="form-control">
    </div>

    <div class="mb-3">
        <label for="catatan_monitoring">Deskripsi:</label>
        <textarea name="catatan_monitoring" class="form-control">{{ old('catatan_monitoring', $data->catatan_monitoring) }}</textarea>
    </div>
            <div class="mb-3 row">
                <label class="col-sm-2 col-form-label"></label>
                    <div class="col-sm-10">
                        <button type="submit" class="btn btn-primary" name="submit">SIMPAN</button>
                    </div>
            </div>
        </div>
    </form>
     <!-- <script>
            alert("{{ $data->name }}");
        </script> -->
    <!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Daterangepicker CSS -->
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

<!-- jQuery & Moment.js -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/moment@2.29.4/moment.min.js"></script>

<!-- Daterangepicker JS -->
<script src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

<!-- AKHIR FORM -->   
    </form>
     <script>
         const startDate = "{{ $data->tasks->start_date_range }}";
        const endDate = "{{ $data->tasks->end_date_range }}";
$(function() {
    $('#daterange').daterangepicker({
       
        opens: 'right',           // posisi popup (left/right/center)
        locale: {
            format: 'YYYY-MM-DD'  // format tanggal
        },
        startDate: startDate,
        endDate: endDate
    }, function(start, end, label) {
        console.log("Selected range: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
    });
});
</script>

    </div>
    </div>
</div>

<!-- AKHIR FORM -->   
@endsection