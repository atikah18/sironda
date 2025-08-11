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
       
        // $user = Auth::user();
        // $data = Tasks::all();
        // $reports =Backup_reports::orderBy('task_id', 'asc')->get();
        // return view('sironda.tasks', compact('data','user','reports'));
          $user = User::all();
        $data = Tasks::orderBy('start_date_range', 'desc')->get();
       
        $reports =Backup_reports::all();
    //     $reports = Backup_reports::with('Tasks')
    // ->get()
    // ->sortByDesc(function ($report) {
    //     return $report->tasks->start_date_range;
    // })
    // ->values(); // reset key index
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
            ['start_date_range', '=', $start],
            ['end_date_range', '=', $end],
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
            // $assignedUser = User::find($request->user_id);
            // if ($assignedUser) {
            //     $assignedUser->notify(new TaskAssigned($task, $request->daterange));
            // }
            // ci 3:
//   $email = $this->db->query(
// 					'SELECT email FROM pegawai 
// 					where id_level_user = 1 ')->result();
			
// 				foreach($email as $x) 	
// 					{

// 					$config = [
// 						'mailtype'  => 'html',
// 						'charset'   => 'utf-8',
// 						'protocol'  => 'smtp',
// 						'smtp_host' => 'smtp.bps.go.id',
// 						'smtp_user' => 'kasieipd3600@bps.go.id', 
// 						'smtp_pass'   => 'cow9tall',  
// 						'smtp_crypto' => 'ssl',
// 						'smtp_port'   => 465,
// 						'crlf'    => "\r\n",
// 						'newline' => "\r\n"
// 					];

// 				// Load library email dan konfigurasinya
// 				$this->load->library('email', $config);

// 				// Email dan nama pengirim
// 				$this->email->from('MPTIBanten@jawarastatistik.id', 'Tim MPTI 3600 - LINKZUM');

// 				// Email penerima
// 				$this->email->to($x->email);

// 				// Subject email
// 				$kegiatan = $this->input->post('nama_kegiatan');
// 				$this->email->subject($kegiatan);
			
// 				// Isi email
// 				$mulai = $this->input->post('waktu_mulai');
// 		// $mulai_formatted = date('d-m-Y', strtotime($mulai));

// 				$this->input->post('id_fungsi');
				
// 				$fungsi = $this->db->query('SELECT nama_fungsi from fungsi JOIN pegawai ON pegawai.id_fungsi = fungsi.id_fungsi')->row();

// 				$selesai = $this->input->post('waktu_selesai');


// 				$this->email->message("[No-Reply] <br> LINK-ZUM (Layanan Pemanfaatan Zoom Meeting BPS Provinsi Banten) <br><br>Kepada Tim Admin Aplikasi LINK-ZUM, mohon untuk dapat memberikan link dan approved Permintaan Link Zoom untuk kegiatan berikut :<br><br><strong>".$kegiatan."</strong> <br><br>Waktu Mulai Kegiatan   : ".date('d-m-Y H:i:s', strtotime($mulai))." WIB <br>Waktu Selesai kegiatan : ".date('d-m-Y H:i:s', strtotime($selesai))." WIB<br><br>Demikian yang dapat diinfokan. Atas kerjasamanya diucapkan terima kasih<br> <a href='https://jawarastatistik.id/linkzum/'>Lanjut Untuk Approval</a> ");

// 	     		$this->email->send();
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
