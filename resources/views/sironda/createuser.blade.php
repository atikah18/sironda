@extends('layout.template')
<!-- START FORM -->
@section('konten')
<div class="container-fluid px-4">
    <h1 class="mt-4">Register</h1>
    <ol class="breadcrumb mb-4">
        <!-- <li class="breadcrumb-item">Formasi Jabatan BPS Provinsi Banten</li> -->
    </ol>
    <div class="card mb-4">
    </div>
    <div class="card mb-4">
        <div class="card-header">
            <i class="fa-solid fa-circle-plus" aria-hidden="true"></i>
            Register
        </div>      
    <div class="card-body">

    <form action='{{ url('user') }}' method='post'>
    @csrf
    <a href="{{ url('login') }}" class="btn btn-secondary"><< Kembali</a>
        <div class="my-3 p-3 bg-body rounded shadow-sm">
            <div class="mb-3 row">
                <label for="name" class="col-sm-2 col-form-label">Nama</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name='name' value="{{ Session::get('name') }}" id="name">
                    </div>
            </div>
            <div class="mb-3 row">
                <label for="email" class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-10">
                        <input type="email" class="form-control" name='email' value="{{ Session::get('email') }}" id="email">
                    </div>
            </div>
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

            <div class="mb-3 row">
                <label for="role" class="col-sm-2 col-form-label">Role</label>
                    <div class="col-sm-10">
                        <select class="form-control select2" style="width: 100%;" name="role" id="role">
                        <option disabled value="">Pilih Role</option>
                            <option>{{ $data->role='admin' }}</option>
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