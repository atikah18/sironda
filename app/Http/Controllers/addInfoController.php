<?php

namespace App\Http\Controllers;
use App\Models\List_db;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
class addInfoController extends Controller
{
     public function show(string $id)
    {
    $user = Auth::user();
    $data = List_db::findorfail($id);
    return view('form_info_db.edit',compact('data','user'));
    }
    public function create()
    {
        $data = List_db::all();
        return view('form_info_db.create', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     */
   public function store(Request $request)
    {
        Session::flash('folder_aplikasi',$request->folder_aplikasi);
        Session::flash('nama_db',$request->nama_db);
        // Session::flash('is_abk',$request->is_abk);

        $hasKelasForJabatan = List_db::query()
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
        date_default_timezone_set('Asia/Jakarta');
        $user = Auth::user()->name;
            List_db::create([
                'folder_aplikasi' => $request->folder_aplikasi,
                'nama_db' => $request->nama_db,
                'status' => '1',
                'update_note' => 'dibuat pada '.now().' oleh '.$user,
            ]);
            return redirect()->to('home')->with('success','Berhasil menambahkan data');
        }
    }

    /**
     * Display the specified resource.
     */
    
    public function update(Request $request, string $id)
    {
        $request->validate([
        'folder_aplikasi'=>'required',
        'nama_db'=>'required',
        'status'=>'required',
        ],[
        'folder_aplikasi.required'=>'folder_aplikasi harus diisi',
        'nama_db.required'=>'nama_db harus diisi',
        'status.required'=>'status harus diisi',
        ]);

       date_default_timezone_set('Asia/Jakarta');
      $user = Auth::user()->name;
        $data = [
            'folder_aplikasi' => $request->folder_aplikasi,
            'nama_db' => $request->nama_db,
            'status' => $request->status,
            'update_note' => 'diedit pada '.now().' oleh '.$user,
        ];
        
        $app = List_db::findorfail($id);
        $app->update($data);
        return redirect()->to('home')->with('success','Berhasil melakukan update data!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
         List_db::where('id', $id)->delete();
        return redirect()->to('home')->with('success','Berhasil menghapus data!');
    }
}
