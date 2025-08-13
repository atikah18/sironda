<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Models\Tasks;
use App\Models\Backup_reports;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

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
            // Kirim email ke Ketua
            $assignedUser = User::find($task->user_id);
            if ($assignedUser) {
                // mapping type ke nama
                if ($task->type == 1) {
                    $typeName = 'Mingguan';
                } elseif ($task->type == 2) {
                    $typeName = 'Bulanan';
                } else {
                    $typeName = 'Tidak Diketahui';
                }

                if ($task->type == 1) {
                    $typeBack = 'Backup';
                } elseif ($task->type == 2) {
                    $typeBack = 'Backup dan Restore';
                } else {
                    $typeBack = 'Tidak Diketahui';
                }

                $start = $task->start_date_range;
                $end = $task->end_date_range;
                $startFormatted = date('d-m-Y', strtotime($start));
                $endFormatted   = date('d-m-Y', strtotime($end));
                $upperName = strtoupper($assignedUser->name);

               $details = [
                'subject' => 'Notifikasi SiRonda: ' . $upperName . ' telah mengupload Laporan Kegiatan ' . $typeBack . ' Database Server Aplikasi Pada OS Windows',
                'body' => '
                    <div style="font-family: Arial, sans-serif; line-height: 1.6; color: #333;">
                        <p style="margin-bottom: 10px; font-size: 14px;">
                             [No-Reply],
                        </p>
                        
                        <p style="margin-bottom: 15px; font-size: 14px;">
                            ' . $upperName . ' sudah mengupload <strong style="color: green;">tugas</strong> :
                        </p>
                        
                        <table cellpadding="5" cellspacing="0" border="0" style="border-collapse: collapse; font-size: 14px;">
                            <tr>
                                <td style="font-weight: bold;">Mulai:</td>
                                <td>' . htmlspecialchars($startFormatted) . '</td>
                            </tr>
                            <tr>
                                <td style="font-weight: bold;">Selesai:</td>
                                <td>' . htmlspecialchars($endFormatted) . '</td>
                            </tr>
                            <tr>
                                <td style="font-weight: bold;">Jenis:</td>
                                <td>' . htmlspecialchars($typeName) . '</td>
                            </tr>
                        </table>
                        
                        <p style="margin-top: 15px; font-size: 14px;">
                            Silakan login ke aplikasi untuk detail lebih lanjut:
                            <a href="https://jws.jawarastatistik.id/sironda/" style="color: #007bff; text-decoration: none;">
                                SiRonda
                            </a>.
                        </p>
                    </div>
                '
            ];

                try {
                    Mail::send([], [], function ($message) use ($assignedUser, $details) {
                        $message->to($assignedUser->email) //GANTI EMAIL KETUA
                                ->subject($details['subject'])
                                ->html($details['body']);
                    });
                } catch (\Exception $e) {
                    Log::error('Gagal kirim email penugasan: '.$e->getMessage());
                }
            }

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
         $app =Backup_reports::findorfail($id);
         Backup_reports::where('id', $id)->delete();
         Storage::disk('public')->delete($app->log_file);
         Storage::disk('public')->delete($app->ss_result);
        return redirect()->to('reports')->with('success','Berhasil menghapus data!');
    }
    
    
 
}
