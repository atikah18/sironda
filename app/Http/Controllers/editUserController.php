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
        $request->validate([
        'nama'=>'required',
        'email'=>'required',
        'role'=>'required',
        ],[
        'nama.required'=>'nama harus diisi',
        'email.required'=>'email harus diisi',
        'role.required'=>'role harus diisi',
        ]);

       
      
        $data = [
            'nama' => $request->nama,
            'email' => $request->email,
            'role' => $request->role,
        ];
        
        $akun = User::findorfail($id);
        $akun->update($data);
        return redirect()->to('user')->with('success','Berhasil melakukan update data!');
    }

}