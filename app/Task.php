<?php

//namespace App\Http\Models;
namespace App;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $table = "tasks";

    protected $fillable = ['task_title','task_desc','user_id','task_time'];

    public function user()
    {
        return $this->belongsTo('\App\User');
    }
}
