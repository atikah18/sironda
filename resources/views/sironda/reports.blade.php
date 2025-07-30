@extends('layout.layoutnav')

<!-- START DATA -->
@section('konten')
<div class="container-fluid px-4">
    <h1 class="mt-4">Pembagian Tugas Monitoring</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item">Daftar Jadwal Monitoring</li>
    </ol>
    <div class="card mb-4">
    </div>
    <div class="card mb-4">
        <div class="card-header">
            <i class="fa-solid fa-file-pen"></i>
            Petugas
        </div>      
    <div class="card-body">
    
    <!-- TOMBOL TAMBAH PENGGUNA -->
    <div class="pb-3">
        <!-- <a href="{{ url('reports/create') }}" class="btn btn-primary">Tambah </a> -->
    </div>  
    <div class="table-responsive">
    <table id="dataTable" class="datatable-table">
        <thead>
            <tr>
                <th scope="col">Jenis</th>
                <th scope="col">Mulai tanggal</th>
                <th scope="col">Hingga tanggal</th>
                <th scope="col">File</th>
                <th scope="col">Image</th>
                <th scope="col">Notes</th>
                <th scope="col">Status</th>
                <th scope="col">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $item)
            <tr>
               @if ($item->tasks->type == "1")
                <td>Mingguan (Backup)</td>
                @endif
                @if ($item->tasks->type == "2")
                <td>Bulanan (Restore)</td>
                @endif
                <td>{{ $item->tasks->start_date_range }}</td>
                <td>{{ $item->tasks->end_date_range }}</td>
                <!-- <td>{{ $item->log_file }}</td> -->
                 
                <!-- Link untuk unduh file -->
                @if($item->log_file)
                <td><a href="{{ asset('storage/' . $item->log_file) }}"target="_blank">Lihat File</a></td> 
                @endif
                @if($item->ss_result)
                <td><a href="{{ asset('storage/' . $item->ss_result) }}"target="_blank">Lihat screenshot</a></td> 
                @endif
               <!-- <td>{{ $item->ss_results }}</td> -->
                <td>{{ $item->catatan_monitoring }}</td>
                @if ($item->status == "1")
                <td>Submitted</td>
                @endif
                @if ($item->status == "2")
                <td>Approved</td>
                @endif
                @if ($item->status == "3")
                <td>Rejected</td>
                @endif
                <td>
                    <a href='{{ url('reports/'.$item->id) }}' class="btn btn-warning btn-sm">Edit</a>
                    <form onsubmit="return confirm('Yakin akan menghapus data?')" class="d-inline" action="{{ url('reports/'.$item->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" name="submit" class="btn btn-danger btn-sm">Hapus</button>
                    </form>
                    <!-- <a href='{{ url('reports/create/'.$item->id) }}' class="btn btn-success btn-sm">Upload</a> -->
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>    
    </div>
</div>
</div>
</div>
    <!-- AKHIR DATA -->
@endsection