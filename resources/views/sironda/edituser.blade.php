@extends('layout.template')
<!-- START FORM -->
@section('konten')
<div class="container-fluid px-4">
    <h1 class="mt-4">Edit Akun</h1>
    <ol class="breadcrumb mb-4">
        <!-- <li class="breadcrumb-item">Formasi Jabatan BPS Provinsi Banten</li> -->
    </ol>
    <div class="card mb-4">
    </div>
    <div class="card mb-4">
        <div class="card-header">
            <i class="fa-solid fa-circle-plus" aria-hidden="true"></i>
            Edit Akun
        </div>      
    <div class="card-body">

    <form action='{{ url('edituser/'.$data->id) }}' method='post' id="form">
    @csrf
    @method('PUT')
    <a href="{{ url('user') }}" class="btn btn-secondary"><< Kembali</a>
        <div class="my-3 p-3 bg-body rounded shadow-sm">
            <div class="mb-3 row">
                <label for="nama" class="col-sm-2 col-form-label">Nama </label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name='nama' value="{{ old('nama', $data->name) }}" id="nama">
                    </div>
            </div>
            <div class="mb-3 row">
                <label for="email" class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-10">
                        <input type="email" class="form-control" name='email' value="{{ old('nama', $data->email) }}" id="email">
                    </div>
            </div>
            @if($user->role==$data->role)
            <div class="mb-3 row">
                <label for="kata sandi" class="col-sm-2 col-form-label">Password <i class="fas fa-eye-slash" onclick="showpass()"></i> </label>
            
                    <div class="col-sm-10">
                        <input id="password" type="password" class="form-control @error ('password') tidak valid @enderror" name="password" required autocomplete="current-password" > 
                       
                        @error ('kata sandi') 
                            <span  class="tidak valid - umpan balik" role ="peringatan"> 
                                <strong >{{ $message }}</strong> 
                            </span> 
                        @enderror
                    </div>
            </div>
            <div class="mb-3 row">
                <label for="password" class="col-sm-2 m-0 col-form-label">Konfirmasi Password  <i class="fas fa-eye-slash" onclick="showpass2()"></i></label>
           
                    <div class="col-sm-10">
                        <input id="confpassword" type="password" class="form-control @error('password') tidak valid @enderror" name="password_confirmation" requiredautocomplete="current-password">
                              
                    </div>
            </div>
@endif
@if ($user->role == "1")
            <div class="mb-3 row">
                <label for="role" class="col-sm-2 col-form-label">Role</label>
                    <div class="col-sm-10">
                        <select class="form-control select2" style="width: 100%;" name="role" id="role">
                        <option disabled value="">Pilih Role</option>
                            <option value=1 <?php echo ($data->role == "1") ? 'selected' : ''; ?>>Admin</option>
                             <option value=2 <?php echo ($data->role == "2") ? 'selected' : ''; ?>>Ketua</option>
                              <option value=3 <?php echo ($data->role == "3") ? 'selected' : ''; ?>>Anggota</option>
                        </select>
                    </div>
            </div>
            @endif
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
    <script>
        
        const password = document.querySelector('#password');
      
       function showpass() {
            // Toggle the type attribute using
            // getAttribure() method
       
            const type = password
                .getAttribute('type') === 'password' ?
                'text' : 'password';
            password.setAttribute('type', type);
            // Toggle the eye and bi-eye icon
            this.classList.toggle('fa fa-eye');
            this.classList.toggle('fa-eye-slash');
        }
        const confpassword = document.querySelector('#confpassword');
      
       function showpass2() {
            // Toggle the type attribute using
            // getAttribure() method
       
            const type = password
                .getAttribute('type') === 'password' ?
                'text' : 'password';
            confpassword.setAttribute('type', type);
            // Toggle the eye and bi-eye icon
            this.classList.toggle('fa fa-eye');
            this.classList.toggle('fa-eye-slash');
        }
</script>
    </div>
    </div>
</div>

<!-- AKHIR FORM -->   
@endsection