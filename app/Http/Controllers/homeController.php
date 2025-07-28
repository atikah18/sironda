<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\List_db;

class homeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       
        $user = Auth::user();
        $data = List_db::all();

        return view('sironda.home', compact('data','user'));
    }

    public function export_excel()
    {
        // return Excel::download(new ExportAbk, "formasi_jabatan_36.xlsx");
    }
    
 
}
