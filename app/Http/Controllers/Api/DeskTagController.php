<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\DeskTag;
use App\Models\UserDesk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DeskTagController extends Controller
{

    function showTagsForUserDesk(){
        $id = UserDesk::where('user_id', Auth::id())->first();

        return DeskTag::where('user_desk_id', $id->user_id)->latest()->get();

        
    }

    function createTagForUserDesk(Request $request){
        $userDesk = UserDesk::where('user_id', Auth::id())->first();

        $tag = DeskTag::create([
            'name' => $request->name,
            'user_desk_id' => $userDesk->id,
            'color' => $request->color,
        ]);

        return $tag;
    }

    function updateTagForUserDesk(Request $request){
        $desk = DeskTag::find($request->id);

        $validate = $request->validate([
            'name' => 'simetimes',
            'color' => 'sometimes',
        ]);

        $desk->update($validate);

        return $desk;
    }

    function deleteTagForUserDesk(Request $request){
        $desk = DeskTag::find($request->id)->delete();

        return $desk;
    }



}
