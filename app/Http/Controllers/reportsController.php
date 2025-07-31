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
        $tasks = Tasks::all();
        $data = Backup_reports::orderBy('task_id', 'asc')->get();
        return view('sironda.reports', compact('data','tasks','user'));
    }
    public function create(string $id)
    {
        $user = User::all();
        $data = Tasks::findorfail($id);
        $data1 = Backup_reports::all();
        return view('form_reports.create', compact('data','data1','user'));
    }
    public function approve_reports(string $id)
    {
        // $username = Auth::user()->name;
        // $userrole = Auth::user()->role;
        // $sat = Satker::all();
        // $jab = Jabatan::all();
        // Update all rows in the table
        // date_default_timezone_set('Asia/Jakarta');
        $app = Backup_reports::findorfail($id);
        $app->update([
        'status' => '2',
         ]);

         return redirect()->to('reports')->with('success','Berhasil update status!');
    }
    public function reject_reports(string $id)
    {
        // $username = Auth::user()->name;
        // $userrole = Auth::user()->role;
        // $sat = Satker::all();
        // $jab = Jabatan::all();
        // Update all rows in the table
        // date_default_timezone_set('Asia/Jakarta');
        $app = Backup_reports::findorfail($id);
        $app->update([
        'status' => '3',
         ]);

         return redirect()->to('reports')->with('secondary','Berhasil update status!');
    }
    public function show(string $id)
    {
        $user = Auth::user();
         $tasks = Tasks::all();
        $data = Backup_reports::findorfail($id);
        return view('form_reports.edit',compact('data','tasks','user'));
    }
    public function store(Request $request)
    {
        Session::flash('task_id',$request->task_id);
        Session::flash('user_id',$request->user_id);
        Session::flash('daterange',$request->daterange);
        Session::flash('type',$request->type);
        Session::flash('log_file',$request->hasFile('log_file'));
        Session::flash('ss_result',$request->hasFile('ss_result'));
        Session::flash('catatan_monitoring',$request->catatan_monitoring);
        // Session::flash('is_abk',$request->is_abk);

       $task = Tasks::findorfail($request->task_id);
        $start = $task->start_date_range;
        $end = $task->end_date_range;
        date_default_timezone_set('Asia/Jakarta');
        $user = Auth::user()->name;
        $filePath = null;
        $imagePath = null;

        if ($request->hasFile('log_file')) {
            $filePath = $request->file('log_file')->store('uploads/files', 'public');
        }

        if ($request->hasFile('ss_result')) {
            $imagePath = $request->file('ss_result')->store('uploads/images', 'public');
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
                'log_file'        => 'nullable|mimes:pdf,doc,docx,txt|max:5120',  // max 5MB
            'ss_result'       => 'nullable|image|mimes:jpg,jpeg,png|max:2048', // max 2MB
            'catatan_monitoring' => 'required|string',
       
                // 'is_abk' => 'required'
            ],[
                'catatan_monitoring.required' => 'catatan harus diisi'
            ]);
            // dd($request->all(), $request->file('log_file'), $request->file('ss_result'));
            Backup_reports::create([
                'task_id' => $request->task_id,
                'user_id' => $task->user_id,
                'start_date_range' => $start,
                'end_date_range' => $end,
                'type'=> $task->type,
                'log_file'        => $filePath,
                'ss_result'       => $imagePath,
                'catatan_monitoring' => $request->catatan_monitoring,
                'status' => '1',
                'update_note' => 'diajukan oleh '.$user.' pada '.now()
            ]);
            return redirect()->to('reports')->with('success','Berhasil menambahkan data');
        }
    }
    public function update(Request $request, string $id)
    {
         Session::flash('task_id',$request->task_id);
        Session::flash('user_id',$request->user_id);
        Session::flash('daterange',$request->daterange);
        Session::flash('type',$request->type);
        Session::flash('log_file',$request->hasFile('log_file'));
        Session::flash('ss_result',$request->hasFile('ss_result'));
        Session::flash('catatan_monitoring',$request->catatan_monitoring);
        // Session::flash('is_abk',$request->is_abk);

        // $dates = explode(' - ', $request->daterange);
        // dd($request->daterange);
        // $start = $dates[0];
        // $end   = $dates[1];
        date_default_timezone_set('Asia/Jakarta');
        $user = Auth::user()->name;
        $prev = Backup_reports::findorfail($id);
        $start = $prev->start_date_range;
        $end = $prev->end_date_range;
        $filePath = $prev->log_file;
        $imagePath = $prev->ss_result;
      
         if ($request->hasFile('log_file')) {
            $filePath = $request->file('log_file')->store('uploads/files', 'public');
        }

        if ($request->hasFile('ss_result')) {
            $imagePath = $request->file('ss_result')->store('uploads/images', 'public');
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
                'log_file'        => 'nullable|mimes:pdf,doc,docx,txt|max:5120',  // max 5MB
            'ss_result'       => 'nullable|image|mimes:jpg,jpeg,png|max:2048', // max 2MB
            'catatan_monitoring' => 'required|string',
       
                // 'is_abk' => 'required'
            ],[
                // 'log_file.required' => 'file harus diisi',
                'catatan_monitoring.required' => 'catatan harus diisi'
            ]);}
        $data = [
            'task_id' => $prev->task_id,
                'user_id' => $prev->user_id,
                'start_date_range' => $start,
                'end_date_range' => $end,
                'type'=> $prev->type,
                'log_file'        => $filePath,
                'ss_result'       => $imagePath,
                'catatan_monitoring' => $request->catatan_monitoring,
                'status' => '1',
                'update_note' => 'diedit oleh '.$user.' pada '.now()
        ];
        
        $app = Backup_reports::findorfail($id);
        $app->update($data);
        return redirect()->to('reports')->with('success','Berhasil melakukan update data!');
    
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
         Backup_reports::where('id', $id)->delete();
        return redirect()->to('reports')->with('success','Berhasil menghapus data!');
    }
    
    
 
}
