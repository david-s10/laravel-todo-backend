<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeskTask extends Model
{
    use HasFactory;


    // protected $table = 'desk_tasks';
    protected $fillable = ['name', 'description', 'status', 'user_desk_id', 'important'];

    protected $casts = [
        'created_at' => 'datetime:Y-m-d',  
    ];

    function tags(){
        return $this->belongsToMany(DeskTag::class, 'task_tags');
    }
    
}
