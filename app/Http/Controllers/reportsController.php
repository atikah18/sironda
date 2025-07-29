<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Models\Tasks;
use App\Models\Backup_reports;
use App\Models\User;
use Illuminate\Http\Request;

class reportsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       
        $user = Auth::user();
        $data = Tasks::all();
        $data1 = Backup_reports::all();
        return view('sironda.reports', compact('data','data1','user'));
    }
    public function create(string $id)
    {
        $user = User::all();
        $data = Tasks::findorfail($id);
        $data1 = Backup_reports::all();
        return view('form_reports.create', compact('data','data1','user'));
    }
     public function show(string $id)
    {
    $user = Auth::user();
    $data = Tasks::findorfail($id);
    $data = Backup_reports::findorfail($id);
    return view('form_tasks.edit',compact('data','user'));
    }
    public function store(Request $request)
    {
        Session::flash('task_id',$request->task_id);
        Session::flash('user_id',$request->user_id);
        Session::flash('daterange',$request->daterange);
        Session::flash('type',$request->type);
        // Session::flash('is_abk',$request->is_abk);

       $dates = explode(' - ', $request->daterange);
// dd($request->daterange);
        $start = $dates[0];
        $end   = $dates[1];
        date_default_timezone_set('Asia/Jakarta');
        $user = Auth::user()->name;
        $filePath = null;
        $imagePath = null;

        if ($request->hasFile('file')) {
            $filePath = $request->file('file')->store('uploads/files', 'public');
        }

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('uploads/images', 'public');
        }
        $hasKelasForJadwal = Tasks::where([
            ['start_date_range', '=', $request->input('start_date_range')],
            ['end_date_range', '=', $request->input('end_date_range')],
        ])->exists();
        if($hasKelasForJadwal)
        {
            return back()->withErrors([
                'daterange' => 'Jadwal sudah terdaftar pada database'
            ]);
        } else {
            $request->validate([
                'user_id' => 'required',
                'daterange' => 'required',
                  'log_file'        => 'nullable|mimes:pdf,doc,docx,txt|max:5120',  // max 5MB
            'ss_result'       => 'nullable|image|mimes:jpg,jpeg,png|max:2048', // max 2MB
            'notes' => 'required|string',
       
                // 'is_abk' => 'required'
            ],[
                'user_id.required' => 'Nama harus diisi',
                'daterange.required' => 'Jadwal harus diisi'
            ]);

            Backup_reports::create([
                'task_id' => $request->task_id,
                'user_id' => $request->user_id,
                'start_date_range' => $start,
                'end_date_range' => $end,
                'type'=> $request->type,
                'log_file'        => $filePath,
            'ss_result'       => $imagePath,
            'notes' => $request->description,
                'status' => '1',
                'update_note' => 'diajukan oleh '.$user.' pada '.now()
            ]);
            return redirect()->to('reports')->with('success','Berhasil menambahkan data');
        }
    }
    public function update(Request $request, string $id)
    {
       Session::flash('user_id',$request->user_id);
        Session::flash('daterange',$request->daterange);
        Session::flash('type',$request->type);
        // Session::flash('is_abk',$request->is_abk);

       $dates = explode(' - ', $request->daterange);
// dd($request->daterange);
        $start = $dates[0];
        $end   = $dates[1];
        date_default_timezone_set('Asia/Jakarta');
        $user = Auth::user()->name;
      
        $hasKelasForJadwal = Tasks::where([
            ['start_date_range', '=', $request->input('start_date_range')],
            ['end_date_range', '=', $request->input('end_date_range')],
        ])->exists();
        if($hasKelasForJadwal)
        {
            return back()->withErrors([
                'daterange' => 'Jadwal sudah terdaftar pada database'
            ]);
        } else {
            $request->validate([
                'user_id' => 'required',
                'daterange' => 'required',
                'type' => 'required'
                // 'is_abk' => 'required'
            ],[
                'user_id.required' => 'Nama harus diisi',
                'daterange.required' => 'Jadwal harus diisi',
                'type.required' => 'Jenis harus diisi'
            ]);
        }
        $data = [
             'user_id' => $request->user_id,
                'start_date_range' => $start,
                'end_date_range' => $end,
                'type'=> $request->type,
                 'status' => '2',
                'update_note' => 'diedit oleh '.$user.' pada '.now()
        ];
        
        $app = Tasks::findorfail($id);
        $app->update($data);
        return redirect()->to('pengjadwalan')->with('success','Berhasil melakukan update data!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
         Tasks::where('id', $id)->delete();
        return redirect()->to('pengjadwalan')->with('success','Berhasil menghapus data!');
    }
    
    
 
}
