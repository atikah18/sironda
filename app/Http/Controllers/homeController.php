<?php

namespace App\Http\Controllers;
use App\Exports\ExportAbk;
use App\Exports\ExportRekap;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Abk;
use App\Models\Dip;
use App\Models\Jabatan;
use App\Models\Satker;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class homeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       
        $user = Auth::user();
    

        return view('sironda.home', compact('user'));
    }

    public function export_excel()
    {
        // return Excel::download(new ExportAbk, "formasi_jabatan_36.xlsx");
    }
    
 
}
