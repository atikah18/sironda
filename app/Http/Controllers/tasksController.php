<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Tasks;

class tasksController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       
        $user = Auth::user();
        $data = Tasks::all();

        return view('sironda.tasks', compact('data','user'));
    }
public function create()
    {
        $user = Auth::user();
        $data = Tasks::all();
        return view('form_tasks.create', compact('data','user'));
    }

    
    
 
}
