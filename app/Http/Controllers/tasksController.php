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
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

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

            // Kirim email ke petugas
            $assignedUser = User::find($request->user_id);
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
                'subject' => 'Tugas Baru dari Ketua Tim Untuk Melakukan ' . $typeBack . ' Database Server Aplikasi Pada OS Windows',
                'body' => '
                    <div style="font-family: Arial, sans-serif; line-height: 1.6; color: #333;">
                        <p style="margin-bottom: 10px; font-size: 14px;">
                            ' . $upperName . ',
                        </p>
                        
                        <p style="margin-bottom: 15px; font-size: 14px;">
                            Anda mendapatkan <strong style="color: green;">tugas baru</strong> dari <strong>Ketua Tim</strong>:
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
                        $message->to($assignedUser->email)
                                ->subject($details['subject'])
                                ->html($details['body']);
                    });
                } catch (\Exception $e) {
                    Log::error('Gagal kirim email penugasan: '.$e->getMessage());
                }
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
         // Kirim email notifikasi update
        $assignedUser = User::find($request->user_id);
        if ($assignedUser) {
            // Mapping jenis
            if ($request->type == 1) {
                $typeName = 'Mingguan';
            } elseif ($request->type == 2) {
                $typeName = 'Bulanan';
            } else {
                $typeName = 'Tidak Diketahui';
            }

            if ($request->type == 1) {
                $typeBack = 'Backup';
            } elseif ($request->type == 2) {
                $typeBack = 'Backup dan Restore';
            } else {
                $typeBack = 'Tidak Diketahui';
            }

            $startFormatted = date('d-m-Y', strtotime($start));
            $endFormatted   = date('d-m-Y', strtotime($end));
            $upperName = strtoupper($assignedUser->name);

           $details = [
            'subject' => 'Tugas Anda Untuk Melakukan ' . $typeBack . ' Telah Diperbarui',
            'body' => '
                <div style="font-family: Arial, sans-serif; line-height: 1.6; color: #333;">
                    <p style="margin-bottom: 10px; font-size: 14px;">
                        ' . $upperName . ',
                    </p>

                    <p style="margin-bottom: 15px; font-size: 14px;">
                        Tugas Anda telah
                        <strong style="color: #007bff;">diperbarui</strong>
                        oleh
                        <strong>' . htmlspecialchars($user) . '</strong>:
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
                    $message->to($assignedUser->email)
                            ->subject($details['subject'])
                            ->html($details['body']);
                });
            } catch (\Exception $e) {
                Log::error('Gagal kirim email update task: ' . $e->getMessage());
            }
        }
        return redirect()->to('penjadwalan')->with('success','Berhasil melakukan update data!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Ambil task sebelum dihapus
        $task = Tasks::findOrFail($id);
        $assignedUser = User::find($task->user_id);

        // Hapus task
        $task->delete();

        // Kirim email notifikasi untuk hapus data
        if ($assignedUser) {
            // mapping type ke nama
            if ($task->type == 1) {
                $typename = 'Mingguan';
            } elseif ($task->type == 2) {
                $typename = 'Bulanan';
            } else {
                $typename = 'Tidak Diketahui';
            }

            $startFormatted = date('d-m-Y', strtotime($task->start_date_range));
            $endFormatted   = date('d-m-Y', strtotime($task->end_date_range));
            $upperName = strtoupper($assignedUser->name);
            
            $details = [
                'subject' => 'Tugas Anda Telah Dihapus',
                'body' => '
                    <div style="font-family: Arial, sans-serif; line-height: 1.6; color: #333;">
                        <p style="margin-bottom: 10px; font-size: 14px;">
                            ' . $upperName . ',
                        </p>
                        
                        <p style="margin-bottom: 15px; font-size: 14px;">
                            Tugas yang diberikan telah <strong style="color: red;">dihapus</strong>:
                        </p>
                        
                        <table cellpadding="5" cellspacing="0" border="0" style="border-collapse: collapse; font-size: 14px;">
                            <tr>
                                <td style="font-weight: bold;">Jenis:</td>
                                <td>' . htmlspecialchars($typename) . '</td>
                            </tr>
                            <tr>
                                <td style="font-weight: bold;">Mulai:</td>
                                <td>' . htmlspecialchars($startFormatted) . '</td>
                            </tr>
                            <tr>
                                <td style="font-weight: bold;">Selesai:</td>
                                <td>' . htmlspecialchars($endFormatted) . '</td>
                            </tr>
                        </table>
                        
                        <p style="margin-top: 15px; font-size: 14px;">
                            Mohon abaikan tugas ini karena sudah tidak berlaku.
                        </p>
                    </div>
                '
            ];
            try {
                Mail::send([], [], function ($message) use ($assignedUser, $details) {
                    $message->to($assignedUser->email)
                            ->subject($details['subject'])
                            ->html($details['body']);
                });
            } catch (\Exception $e) {
                Log::error('Gagal kirim email penghapusan task: ' . $e->getMessage());
            }
        }

        return redirect()->to('penjadwalan')->with('success','Berhasil menghapus data!');
    }
    
    
 
}
