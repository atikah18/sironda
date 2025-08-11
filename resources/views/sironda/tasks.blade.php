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
     @if (auth()->user()->role <> "3")
    <div class="pb-3">
        <a href="{{ url('penjadwalan/create') }}" class="btn btn-primary">Tambah </a>
    </div>  
     @endif
    <div class="table-responsive">
    <table id="dataTable" class="datatable-table">
        <thead>
            <tr>
                <th scope="col" >Mulai tanggal</th>
                <th scope="col">Hingga tanggal</th>
                <th scope="col">Nama Petugas</th>
                <th scope="col">Jenis</th>
                <th scope="col">Status</th>
                <th scope="col">Keterangan</th>
                <th scope="col">Aksi</th>
                <th scope="col">Progress</th>
                <th scope="col">File</th>
                <th scope="col">Image</th>
                <th scope="col">Notes</th>
                <th scope="col">Status</th>
                <th scope="col">Tanggal Submit</th>
                <th scope="col">Aksi Laporan</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $item)
            @if (auth()->user()->role == "3")
            @if ($item->user->name == auth()->user()->name)
            <tr>
                <td>{{ $item->start_date_range }}</td>
                <td>{{ $item->end_date_range }}</td>
                <td>{{ $item->user->name }}</td>
                
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
                        
               
                    <a href='{{ url('reports/create/'.$item->id) }}' class="btn btn-success btn-sm">Upload</a>
               
                </td>
                @php $hasReport = false; @endphp

                @foreach ($reports as $item2)
                    @if ($item2->task_id == $item->id)
                        <td><button type="submit" name="submit" class="btn btn-success btn-sm" disabled>Sudah ada Laporan</button></td>
                        
              
                @if($item2->log_file)
                <td><a href="{{ asset('storage/' . $item2->log_file) }}"target="_blank">Lihat File</a></td> 
                @endif
                @if($item2->ss_result)
                <td><a href="{{ asset('storage/' . $item2->ss_result) }}"target="_blank">Lihat screenshot</a></td> 
                @endif
               <!-- <td>{{ $item->ss_results }}</td> -->
                <td class="wrap-cell">{{ $item2->catatan_monitoring }}</td>
                @if ($item2->status == "1")
                <td>Submitted</td>
                @endif
               @if ($item2->status == "2")
                <td> <button type="submit" name="submit" class="btn btn-success btn-sm" disabled>Approved</button></td>
                @endif
                @if ($item2->status == "3")
                <td><button type="submit" name="submit" class="btn btn-danger btn-sm" disabled>Rejected</button></td>
                @endif
                <td>{{$item2->created_at  }}</td>
                 @if ($item2->status == "1")
                
                <td>
                    <a href='{{ url('reports/'.$item2->id) }}' class="btn btn-warning btn-sm">Edit</a>
                    <form onsubmit="return confirm('Yakin akan menghapus data?')" class="d-inline" action="{{ url('reports/'.$item2->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" name="submit" class="btn btn-danger btn-sm">Hapus</button>
                    </form>
                    <!-- <a href='{{ url('reports/create/'.$item->id) }}' class="btn btn-success btn-sm">Upload</a> -->
                </td>
                @elseif ($item2->status <> "1") <td></td>
                @endif
                @php $hasReport = true; @endphp
                        @break
                    @endif
                @endforeach

                @if (!$hasReport)
                    <td>Belum ada Laporan</td>
                    <td>  </td>
                    <td>  </td>
                    <td></td>
                    <td></td>
                 <td></td>
                    <td></td>
                @endif
            </tr>
            @endif
            @endif
            @if (auth()->user()->role <> "3")
            <tr>
                <td>{{ $item->start_date_range }}</td>
                <td>{{ $item->end_date_range }}</td>
                <td>{{ $item->user->name }}</td>
                
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
                    
                    <a href='{{ url('penjadwalan/'.$item->task_id) }}' class="btn btn-warning btn-sm">Edit</a>
                    <form onsubmit="return confirm('Yakin akan menghapus data?')" class="d-inline" action="{{ url('penjadwalan/'.$item->task_id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" name="submit" class="btn btn-danger btn-sm">Hapus</button>
                    </form>
                       @if (auth()->user()->role == "3")
                
               
                    <a href='{{ url('reports/create/'.$item->id) }}' class="btn btn-success btn-sm">Upload</a>
                     @endif
                </td>
                @php $hasReport = false; @endphp

                @foreach ($reports as $item2)
                    @if ($item2->task_id == $item->id)
                        <td><button type="submit" name="submit" class="btn btn-success btn-sm" disabled>Sudah ada Laporan</button></td>
                       
                   
                 <!-- Link untuk unduh file -->
                @if($item2->log_file)
                <td><a href="{{ asset('storage/' . $item2->log_file) }}"target="_blank">Lihat File</a></td> 
                @endif
                @if($item2->ss_result)
                <td><a href="{{ asset('storage/' . $item2->ss_result) }}"target="_blank">Lihat screenshot</a></td> 
                @endif
               <!-- <td>{{ $item->ss_results }}</td> -->
                <td class="wrap-cell">{{ $item2->catatan_monitoring }}</td>
                @if ($item2->status == "1")
                <td>Submitted</td>
                @endif
                @if ($item2->status == "2")
                <td> <button type="submit" name="submit" class="btn btn-success btn-sm" disabled>Approved</button></td>
                @endif
                @if ($item2->status == "3")
                <td><button type="submit" name="submit" class="btn btn-danger btn-sm" disabled>Rejected</button></td>
                @endif
                <td>{{$item2->created_at  }}</td>
                
                <td>
                 
                    <!-- <a href='' class="btn btn-success btn-sm">Terima</a> -->
                     <!-- <a href='' class="btn btn-secondary btn-sm">Tolak</a> -->
                     <form onsubmit="return confirm('Setujui Laporan?')" class="d-inline" action="{{ url('approve_reports/'.$item2->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <button type="submit" name="submit" class="btn btn-success btn-sm">Terima</button>
                    </form>
                     <form onsubmit="return confirm('Tolak Laporan?')" class="d-inline" action="{{ url('reject_reports/'.$item2->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <button type="submit" name="submit" class="btn btn-secondary btn-sm">Tolak</button>
                    </form>
                </td>
               
                 @php $hasReport = true; @endphp
                        @break
                 @endif
                @endforeach

                @if (!$hasReport)
                  <td>Belum ada Laporan</td>
                    <td>  </td>
                    <td>  </td>
                    <td></td>
                    <td></td>
                    <td></td>
                <td></td>
                @endif
            </tr>
            @endif
            @endforeach
        </tbody>
    </table>    
    </div>
</div>
</div>
</div>
    <!-- AKHIR DATA -->
 
@endsection