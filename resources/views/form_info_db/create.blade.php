@extends('layout.template')

<!-- START FORM -->
@section('konten')
<div class="container-fluid px-4">
    <h1 class="mt-4">Tambah Daftar Database</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item">Informasi Database untuk di-backup</li>
    </ol>
    <div class="card mb-4">
    </div>
    <div class="card mb-4">
        <div class="card-header">
            <i class="fa-solid fa-circle-plus"></i>
            Database Aplikasi
        </div>      
    <div class="card-body">

    <form action='{{ url('addInfo') }}' method='post'>
    @csrf
    <a href="{{ url('addInfo') }}" class="btn btn-secondary"><< Kembali</a>
        <div class="my-3 p-3 bg-body rounded shadow-sm">
            <div class="mb-3 row">
                <label for="folder_aplikasi" class="col-sm-2 col-form-label">Folder Aplikasi</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name='folder_aplikasi' value="{{ Session::get('folder_aplikasi') }}" id="folder_aplikasi">
                    </div>
            </div>
            <div class="mb-3 row">
                <label for="nama_db" class="col-sm-2 col-form-label">Nama DB</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name='nama_db' value="{{ Session::get('nama_db') }}"  id="nama_db">
                    </div>
            </div>
            <!-- <div class="mb-3 row">
                <label for="is_abk" class="col-sm-2 col-form-label m-0">Status ABK</label>
                    <div class="col-sm-10">
                      <select class="form-control select2" style="width: 100%;" name="is_abk" id="is_abk" placeholder="Pilih">
                        <option></option>
                        <option value=1 >Formasi daerah</option>
                        <option value=2 >Formasi pusat</option>
                        </select>
                    </div>
            </div> -->
            <div class="mb-3 row">
                <label class="col-sm-2 col-form-label"></label>
                    <div class="col-sm-10">
                        <button type="submit" class="btn btn-primary" name="submit">SIMPAN</button>
                        <button type="reset" class="btn btn-md btn-warning" name="reset">RESET</button>
                    </div>
            </div>
        </div>
    </form>
    </div>
    </div>
</div>
<!-- AKHIR FORM -->   
@endsection