<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\List_db;
use App\Models\Tasks;
use App\Models\Backup_reports;
use App\Models\User;

class homeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       
        $user = Auth::user();
        $data = List_db::all();

        $tasks = Tasks::all();

    $events = [];

    foreach ($tasks as $task) {
        $events[] = [
            'title' => $task->user->name ?? 'Laporan',
            'start' => $task->start_date_range,
            'user' => $task->user->name, // Optional
            'color' => $task->type == '1' ? '#28a745' : '#dc3545' 
        ];
    }
        return view('sironda.home', compact('data','user','events'));
    }

    public function export_excel()
    {
        // return Excel::download(new ExportAbk, "formasi_jabatan_36.xlsx");
    }
//     public function calendar()
// {
//     $tasks = Tasks::all();

//     $events = [];

//     foreach ($tasks as $task) {
//         $events[] = [
//             'status' => $task->status ?? 'Laporan',
//             'start' => $task->start_date_range,
//             'url' => route('reports.show', $task->user_id), // Optional
//         ];
//     }

//     return view('calendar', compact('events'));
// }

 
}
