<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class editUserController extends Controller
{
    public function show(string $id)
    {
    $user = Auth::user();
    $data = User::findorfail($id);
    return view('sironda.edituser',compact('data','user'));
    }
    public function update(Request $request, string $id)
    {
         Session::flash('name',$request->name);
        Session::flash('email',$request->email);
        Session::flash('role',$request->role);
        Session::flash('password',$request->password);
        $akun = User::findorfail($id);
        $role=$akun->role;
        $pw=$akun->password;
        if($request->role){
            $role=$request->role;
        }
        if($request->password){
            $pw=$request->password;
$request->validate([
              'name'=>'required',
                'email'=>'required',
                'password'=>'required|min:4|confirmed'
                ],[
                'name.required'=>'nama harus diisi',
                'email.required'=>'email harus diisi',
                'password.required'=>'Password harus diisi',
                'password.confirmed' => 'Konfirmasi password tidak sesuai'
                  ]);
        }  else {
             $request->validate([
        'name'=>'required',
        'email'=>'required',
        // 'role'=>'required',
        ],[
        'name.required'=>'nama harus diisi',
        'email.required'=>'email harus diisi',
        // 'role.required'=>'role harus diisi',
            ]);}
       
       

       
      
        $data = [
             'name' => $request->name,
            'email' => $request->email,
            'role' => $role,
            'password' => $pw,
        ];
        
        
        $akun->update($data);
        return redirect()->to('user')->with('success','Berhasil melakukan update data!');
    }

}