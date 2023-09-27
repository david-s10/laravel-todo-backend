<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserDesk extends Model
{
    use HasFactory;

    protected $fillable = ['id','name', 'user_id'];

    function tasks(){
        return $this->hasMany(DeskTask::class);
    }
    function tags(){
        return $this->hasMany(DeskTag::class);
    } 
}
