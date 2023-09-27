<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeskTag extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'color', 'user_desk_id'];
    
}
