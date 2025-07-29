@extends('layout.template')

<!-- START FORM -->
@section('konten')
<div class="container-fluid px-4">
    <h1 class="mt-4">Tambah Jadwal Monitoring</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item">Jadwal Laporan Monitoring Backup Server Windows BPS Provinsi Banten</li>
    </ol>
    <div class="card mb-4">
    </div>
    <div class="card mb-4">
        <div class="card-header">
            <i class="fa-solid fa-circle-plus"></i>
            Jadwal Petugas
        </div>      
    <div class="card-body">

    <form action='{{ url('pengjadwalan') }}' method='post'>
    @csrf
    <a href="{{ url('pengjadwalan') }}" class="btn btn-secondary"> Kembali</a>
        <div class="my-3 p-3 bg-body rounded shadow-sm">
            <div class="mb-3 row">
                <label for="user_id" class="col-sm-2 col-form-label">Nama Petugas</label>
                    <div class="col-sm-10">
                        <!-- <input type="text" class="form-control" name='nama_petugas' value="{{ Session::get('nama_petugas') }}" id="nama_petugas"> -->
                        <select class="form-control select2" style="width: 100%;" name="user_id" id="user_id">
                        <option></option>
                            @foreach ($user as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
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
                <label for="type" class="col-sm-2 col-form-label">Type</label>
                    <div class="col-sm-10">
                        <!-- <input type="text" class="form-control" name='nama_petugas' value="{{ Session::get('nama_petugas') }}" id="nama_petugas"> -->
                        <select class="form-control select2" style="width: 100%;" name="type" id="type">
                            <option value="1">Backup</option>
                            <option value="2">Restore</option>
                        </select>
                    </div>
            </div>
            <div class="mb-3 row">
                <label class="col-sm-2 col-form-label"></label>
                    <div class="col-sm-10">
                        <button type="submit" class="btn btn-primary" name="submit">SIMPAN</button>
                        <button type="reset" class="btn btn-md btn-warning" name="reset">RESET</button>
                    </div>
            </div>
        </div>
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
$(function() {
    $('#daterange').daterangepicker({
        opens: 'right',           // posisi popup (left/right/center)
        locale: {
            format: 'YYYY-MM-DD'  // format tanggal
        },
        startDate: moment().startOf('month'),
        endDate: moment().endOf('month')
    }, function(start, end, label) {
        console.log("Selected range: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
    });
});
</script>

    </div>
    </div>
</div>

@endsection