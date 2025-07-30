<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Backup_reports extends Model
{
    

    protected $table = "backup_reports";
    // protected $primaryKey = "id";
    protected $fillable = ['id','task_id','user_id','log_file','ss_result','catatan_monitoring','status','created_at','updated_at'];
     public function user(){
        return $this->belongsTo(User::class);
    }
    public function tasks(){
        return $this->belongsTo(Tasks::class, 'task_id');
    }
}
