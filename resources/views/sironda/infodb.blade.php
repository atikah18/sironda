@extends('layout.layoutnav')

<!-- START DATA -->
@section('konten')
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
            <div class="pb-3">
                <a href='{{ url('addInfo/create') }}' class="btn btn-primary">Tambah Database</a>
            </div>
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

     </div>
</div>
@endsection