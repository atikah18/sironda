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
        <a href="{{ url('pengjadwalan/create') }}" class="btn btn-primary">Tambah </a>
    </div>  
    <div class="table-responsive">
    <table id="dataTable" class="datatable-table">
        <thead>
            <tr>
                <th scope="col">Nama Petugas</th>
                <th scope="col">Mulai tanggal</th>
                <th scope="col">Hingga tanggal</th>
                <th scope="col">Jenis</th>
                <th scope="col">Status</th>
                <th scope="col">Keterangan</th>
                <th scope="col">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $item)
            <tr>
                <td>{{ $item->user->name }}</td>
                <td>{{ $item->start_date_range }}</td>
                <td>{{ $item->end_date_range }}</td>
                <!-- <td>{{ $item->type }}</td> -->
                
                @if ($item->type == "1")
                <td>Mingguan (Backup)</td>
                @endif
                @if ($item->type == "2")
                <td>Bulanan (Restore)</td>
                @endif
                @if ($item->status == "1")
                <td>Assigned</td>
                @endif
                @if ($item->status == "2")
                <td>Rescheduled</td>
                @endif
                <td>{{ $item->update_note }}</td>
                <td>
                    <a href='{{ url('pengjadwalan/'.$item->id) }}' class="btn btn-warning btn-sm">Edit</a>
                    <form onsubmit="return confirm('Yakin akan menghapus data?')" class="d-inline" action="{{ url('pengjadwalan/'.$item->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" name="submit" class="btn btn-danger btn-sm">Hapus</button>
                    </form>
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