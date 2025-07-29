<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Models\Tasks;
use App\Models\User;
use Illuminate\Http\Request;

class tasksController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       
        $user = Auth::user();
        $data = Tasks::all();

        return view('sironda.tasks', compact('data','user'));
    }
    public function create()
    {
        $user = User::all();
        $data = Tasks::all();
        return view('form_tasks.create', compact('data','user'));
    }
    public function store(Request $request)
    {
        Session::flash('nama_petugas',$request->nama_petugas);
        Session::flash('rentang_waktu',$request->rentang_waktu);
        // Session::flash('is_abk',$request->is_abk);

        $hasKelasForJabatan = Tasks::query()
                              ->where('folder_aplikasi', $request->input('folder_aplikasi'))
                              ->exists();
      
        if($hasKelasForJabatan)
        {
            return back()->withErrors([
                'folder_aplikasi' => 'Jabatan sudah terdaftar pada database'
            ]);
        } else {
            $request->validate([
                'folder_aplikasi' => 'required',
                'nama_db' => 'required'
                // 'is_abk' => 'required'
            ],[
                'folder_aplikasi.required' => 'Aplikasi harus diisi',
                'nama_db.required' => 'Nama database harus diisi'
            ]);

            List_db::create([
                'folder_aplikasi' => $request->folder_aplikasi,
                'nama_db' => $request->nama_db,
                'status' => '1'
            ]);
            return redirect()->to('home')->with('success','Berhasil menambahkan data');
        }
    }
    
    
 
}
