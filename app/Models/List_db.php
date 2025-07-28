<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class List_db extends Model
{
    

     protected $table = "list_db";
    protected $primaryKey = "id";
    protected $fillable = ['id','folder_aplikasi','nama_db','status','update_note','updated_at'];
    
}
