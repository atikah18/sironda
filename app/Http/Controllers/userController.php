<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class userController extends Controller
{
    public function index(Request $request)
    {
    $user = Auth::user();
    $data = User::all();
    return view('simfoni.user',compact('data','user'));
    }

    public function create()
    {
        $user = Auth::user();
        $data = User::all();
        return view('sironda.createuser', compact('data','user'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Session::flash('name',$request->name);
        Session::flash('email',$request->email);
        Session::flash('role',$request->role);
        Session::flash('password',$request->password);

        $hasRoleForUser = User::query()
                                ->where('name', $request->input('name'))
                                ->where('email', $request->input('email'))
                                ->where('role', $request->input('role'))
                                ->exists();
        
        if($hasRoleForUser)
        {
            return back()->withErrors([
                'email' => 'User tersebut sudah ada di database'
            ]);
        } else {
            $request->validate([
                'name'=>'required',
                'email'=>'required|email|unique:users,email',
                'role'=>'required',
                'password'=>'required|min:8|confirmed'
            ],[
                'name.required'=>'Nama harus diisi',
                'email.required'=>'Email harus diisi',
                'email.email'=>'Email harus dalam format email',
                'email.unique'=>'Email sudah ada',
                'role.required'=>'Role harus diisi',
                'password.required'=>'Password harus diisi',
                'password.min'=>'Password harus minimal 8 karakter',
                'password.confirmed' => 'Konfirmasi password tidak sesuai'
            ]);
            
            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'role' => $request->role,
                'password' => $request->password,
            ]);
            return redirect()->to('login')->with('success','Berhasil menambahkan data!');
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        User::where('id', $id)->delete();
        return redirect()->to('pengguna')->with('success','Berhasil menghapus data!');
    }
}
