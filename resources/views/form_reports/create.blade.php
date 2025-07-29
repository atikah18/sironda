@extends('layout.template')
<!-- START FORM -->
@section('konten')
<div class="container-fluid px-4">
    <h1 class="mt-4">Lapor Monitoring</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"> Laporan Monitoring Backup Server Windows BPS Provinsi Banten</li>
    </ol>
    <div class="card mb-4">
    </div>
    <div class="card mb-4">
        <div class="card-header">
            <i class="fa-solid fa-circle-plus" aria-hidden="true"></i>
            Tambah Laporan
        </div>      
    <div class="card-body">

    <form action='{{ url('reports') }}' method='post' id="form">
    @csrf
    <a href="{{ url('pengjadwalan') }}" class="btn btn-secondary">Kembali</a>
        <div class="my-3 p-3 bg-body rounded shadow-sm">
            <div class="mb-3 row">
                 <label for="task_id" class="col-sm-2 col-form-label">task_id</label>
                    <div class="col-sm-10">
               <select class="form-control select2" style="width: 100%;" name="task_id" id="task_id">
                                <option selected value="{{ $data->id }}">{{ $data->id  }}</option>
                                
                        </select>
                </div>
            </div>
            <div class="mb-3 row">
                 <label for="user_id" class="col-sm-2 col-form-label">Nama Petugas</label>
                    <div class="col-sm-10">
               <select class="form-control select2" style="width: 100%;" name="user_id" id="user_id">
                                <option selected value="{{ $data->user_id }}">{{ $data->user->name  }}</option>
                                
                        </select>
                </div>
            </div>
            <div class="mb-3 row">
                <label for="daterange" class="col-sm-2 col-form-label">Rentang Waktu</label>
                    <div class="col-sm-10">
                         <!-- <label for="daterange">Select Date Range:</label> -->
                      <input type="text" id="daterange" name="daterange" class="form-control" />
                    </div>
            </div>
            
            <div class="mb-3 row">
                <label for="type" class="col-sm-2 col-form-label">Jenis</label>
                    <div class="col-sm-10">
                        <select class="form-control select2" style="width: 100%;" name="type" id="type">
                        <option disabled value=""></option>
                            <option value=1 <?php echo ($data->type == "1") ? 'selected' : ''; ?>>Mingguan (backup) </option>
                             <option value=2 <?php echo ($data->type == "2") ? 'selected' : ''; ?>>Bulanan (Backup & Restore)</option>
                         </select>
                    </div>
            </div>
      <div class="mb-3 row">
        <label  for="log_file" class="col-sm-2 col-form-label">File Log (PDF/DOC/TXT)</label>
        <input type="file" name="log_file" id="log_file" class="form-control">
        @error('file') <small class="text-danger">{{ $message }}</small> @enderror
    </div>

    <div class="mb-3 row">
        <label  for="ss_result" class="col-sm-3 col-form-label">Screenshot Backup Result (JPG/PNG)</label>
        <input type="file" name="ss_result" id="ss_result" class="form-control">
        @error('image') <small class="text-danger">{{ $message }}</small> @enderror
    </div>

    <div class="mb-3 row">
        <label  for="notes" class="col-sm-2 col-form-label">Catatan Monitoring</label>
        <textarea name="notes" id="notes" class="form-control" rows="6" required></textarea>
        @error('description') <small class="text-danger">{{ $message }}</small> @enderror
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
         const startDate = "{{ $data->start_date_range }}";
        const endDate = "{{ $data->end_date_range }}";
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