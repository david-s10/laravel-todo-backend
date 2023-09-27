<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserDeskResource;
use App\Models\UserDesk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserDeskController extends Controller
{
    function getUserDesk(){
        $desk = UserDesk::where('user_id', Auth::id())->first()->load('tasks', 'tags');
        
        return $desk;
    }
}
