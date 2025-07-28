<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class jadwalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       
        $user = Auth::user();
    

        return view('sironda.jadwal', compact('user'));
    }

    public function export_excel()
    {
        // return Excel::download(new ExportAbk, "formasi_jabatan_36.xlsx");
    }
    
 
}
