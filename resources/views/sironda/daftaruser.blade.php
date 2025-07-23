@extends('layout.layoutnav')

<!-- START DATA -->
@section('konten')
<div class="container-fluid px-4">
    <h1 class="mt-4">Akun</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item">Daftar Akun</li>
    </ol>
    <div class="card mb-4">
    </div>
    <div class="card mb-4">
        <div class="card-header">
            <i class="fa-solid fa-file-pen"></i>
            Admin
        </div>      
    <div class="card-body">
    
    <!-- TOMBOL TAMBAH PENGGUNA -->
    <div class="pb-3">
        <a href="{{ url('user/create') }}" class="btn btn-primary">Tambah Akun</a>
    </div>  
    <div class="table-responsive">
    <table id="dataTable" class="datatable-table">
        <thead>
            <tr>
                <th scope="col">Nama</th>
                <th scope="col">Email</th>
                <th scope="col">Peran</th>
                <th scope="col">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $item)
            <tr>
                <td>{{ $item->name }}</td>
                <td>{{ $item->email }}</td>
                @if ($item->role == "1")
                <td>Admin</td>
                @endif
                @if ($item->role == "2")
                <td>Ketua</td>
                @endif
                @if ($item->role == "3")
                <td>Anggota</td>
                @endif
                <!-- <td>{{ $item->role }}</td> -->
                <td>
                    <a href='{{ url('edituser/'.$item->id) }}' class="btn btn-warning btn-sm">Edit</a>
                    <form onsubmit="return confirm('Yakin akan menghapus data?')" class="d-inline" action="{{ url('user/'.$item->id) }}" method="POST">
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