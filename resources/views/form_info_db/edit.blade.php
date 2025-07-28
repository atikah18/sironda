@extends('layout.template')
<!-- START FORM -->
@section('konten')
<div class="container-fluid px-4">
    <h1 class="mt-4">Edit Data</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item">Informasi Database untuk di-backup pada Server windows BPS Provinsi Banten</li>
    </ol>
    <div class="card mb-4">
    </div>
    <div class="card mb-4">
        <div class="card-header">
            <i class="fa-solid fa-circle-plus" aria-hidden="true"></i>
            Edit Info
        </div>      
    <div class="card-body">

    <form action='{{ url('addInfo/'.$data->id) }}' method='post' id="form">
    @csrf
    @method('PUT')
    <a href="{{ url('home') }}" class="btn btn-secondary"><< Kembali</a>
        <div class="my-3 p-3 bg-body rounded shadow-sm">
            <div class="mb-3 row">
                <label for="folder_aplikasi" class="col-sm-2 col-form-label">Folder Aplikasi </label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name='folder_aplikasi' value="{{ old('folder_aplikasi', $data->folder_aplikasi) }}" id="folder_aplikasi">
                    </div>
            </div>
            <div class="mb-3 row">
                <label for="nama_db" class="col-sm-2 col-form-label">Nama DB</label>
                    <div class="col-sm-10">
                        <input type="nama_db" class="form-control" name='nama_db' value="{{ old('nama', $data->nama_db) }}" id="nama_db">
                    </div>
            </div>
            
            
            <div class="mb-3 row">
                <label for="role" class="col-sm-2 col-form-label">Status</label>
                    <div class="col-sm-10">
                        <select class="form-control select2" style="width: 100%;" name="status" id="status">
                        <option disabled value=""></option>
                            <option value=1 <?php echo ($data->status == "1") ? 'selected' : ''; ?>>Waiting For Approval</option>
                             <option value=2 <?php echo ($data->status == "2") ? 'selected' : ''; ?>>Approved</option>
                         </select>
                    </div>
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
  
    </div>
    </div>
</div>

<!-- AKHIR FORM -->   
@endsection