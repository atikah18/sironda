@extends('layout.layoutnav')
<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<!-- FullCalendar CSS -->
<link href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.css" rel="stylesheet">

<link rel="stylesheet" href="css/infodb.css">
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
          <table id="dataTable" class="table table-modern table-striped table-bordered align-middle">
                                <thead>
                                    <tr>
                                        <th><i class="fas fa-folder me-1"></i> Repository</th>
                                        <th><i class="fas fa-database me-1"></i> Nama Database</th>
                                        <th><i class="fas fa-info-circle me-1"></i> Status</th>
                                        <th><i class="fas fa-comment me-1"></i> Keterangan</th>
                                        @if($user != null)
                                        <th><i class="fas fa-cog me-1"></i> Aksi</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $item)
                                    <tr>
                                        <td><i class="fas fa-folder text-warning me-2"></i>{{ $item->folder_aplikasi }}</td>
                                        <td><i class="fas fa-database text-primary me-2"></i>{{ $item->nama_db }}</td>
                                        <td>
                                            @if ($item->status != "2")
                                            <span class="status-badge status-waiting">
                                                <i class="fas fa-clock me-1"></i>Menunggu Approval
                                            </span>
                                            @else
                                            <span class="status-badge status-approved">
                                                <i class="fas fa-check-circle me-1"></i>Approved
                                            </span>
                                            @endif
                                        </td>
                                        <td>{{ $item->update_note ?? '-' }}</td>
                                        @if($user != null)
                                        <td class="action-cell">
                                            <a href="{{ url('addInfo/'.$item->id) }}" class="btn btn-sm btn-warning btn-action" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form onsubmit="return confirm('Yakin akan menghapus data?')" class="d-inline" action="{{ url('addInfo/'.$item->id) }}" method="POST" style="margin: 0;">
                                                @csrf @method('DELETE')
                                                <button type="submit" name="submit" class="btn btn-sm btn-danger btn-action" title="Hapus">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
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