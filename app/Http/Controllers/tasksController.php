<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Models\Tasks;
use App\Models\Backup_reports;
use App\Models\User;
use App\Notifications\TaskAssigned;
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
        $reports =Backup_reports::orderBy('task_id', 'asc')->get();
        return view('sironda.tasks', compact('data','user','reports'));
    }
    public function create()
    {
        $user = User::all();
        $data = Tasks::all();
        return view('form_tasks.create', compact('data','user'));
    }
     public function show(string $id)
    {
        $auth=Auth::user();
    $user = User::all();
    $data = Tasks::findorfail($id);
    return view('form_tasks.edit',compact('data','user','auth'));
    }
    public function store(Request $request)
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
                'daterange' => 'required'
                // 'is_abk' => 'required'
            ],[
                'user_id.required' => 'Nama harus diisi',
                'daterange.required' => 'Jadwal harus diisi'
            ]);

            // Tasks::create([
            //     'user_id' => $request->user_id,
            //     'start_date_range' => $start,
            //     'end_date_range' => $end,
            //     'type'=> $request->type,
            //     'status' => '1',
            //     'update_note' => 'diajukan oleh '.$user.' pada '.now()
            // ]);
            $task = Tasks::create([
                'user_id' => $request->user_id,
                'start_date_range' => $start,
                'end_date_range' => $end,
                'type'=> $request->type,
                'status' => '1',
                'update_note' => 'diajukan oleh '.$user.' pada '.now()
            ]);

            // Notify user
            $assignedUser = User::find($request->user_id);
            if ($assignedUser) {
                $assignedUser->notify(new TaskAssigned($task, $request->daterange));
            }

            return redirect()->to('penjadwalan')->with('success','Berhasil menambahkan data');
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
        return redirect()->to('penjadwalan')->with('success','Berhasil melakukan update data!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
         Tasks::where('id', $id)->delete();
        return redirect()->to('penjadwalan')->with('success','Berhasil menghapus data!');
    }
    
    
 
}
