<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tasks extends Model
{
    

    protected $table = "tasks";
    protected $primaryKey = "id";
    protected $fillable = ['id','user_id','start_date_range','end_date_range','type','status','update_note','created_at','updated_at'];
     public function user(){
        return $this->belongsTo(User::class);
    }
}
