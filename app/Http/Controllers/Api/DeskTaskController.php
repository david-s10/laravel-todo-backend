<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\DeskTask;
use App\Models\UserDesk;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DeskTaskController extends Controller
{   

    function showTaskForUserDesk(Request $request){
        $titleQuery = $request->input('name');
        $tagQuery = $request->input('tags');
        $dateQuery = $request->input('date');
        $statusQuery = $request->input('status');
        $importantQuery = $request->input('important');
        
        $task = DeskTask::query();
        

        if(!empty($titleQuery)){
            $task = $task->where('name', 'like', "%$titleQuery%");
        }

        if($importantQuery !== null){
            $task = $task->where('important', '=', $importantQuery);
        }

        if($statusQuery !== null){
            $task = $task->where('status', '=', $statusQuery);
        }

        if (!empty($tagQuery)) {
            $task = $task->whereHas('tags', function (Builder $query) use ($tagQuery)  {
                $query->where('name', $tagQuery );
            });
        }

        if(!empty($dateQuery)){
            $task = $task->whereDate('created_at', '=', $dateQuery);
        }

        $task = $task->where('user_desk_id', '=',  Auth::id())->latest()->paginate(5);

        $task->load('tags');
    
        return response()->json($task);  
    }

    function showOneTaskForUserDesk($id){
        $task = DeskTask::find($id)->load('tags');

        return $task;
    }
    
    function createTaskForUserDesk(Request $request){
        $userDesk = UserDesk::where('user_id', Auth::id())->first();


        $task = DeskTask::create([
            'name' => $request->name,
            'description' => $request->description,
            'user_desk_id' => $userDesk->id
        ]);


        if($request->has('tags') && !empty($request->tags)){
            $task->tags()->attach($request->tags);
        }

        return $task;
    }

    function updateTaskForUserDesk(Request $request){
        $task = DeskTask::find($request->id, );
        $tagsToAdd = $request->input('tagsToAdd', []);
        $tagsToRemove = $request->input('tagsToRemove', []);

        $validate = $request->validate([
            'name'=> 'sometimes',
            'description'=> 'sometimes',
            'status'=> 'sometimes',
            'important' => 'sometimes'
        ]);

        if($request->has('tagsToAdd') && !empty($tagsToAdd)){
            $task->tags()->attach($tagsToAdd);
        }

        if($request->has('tagsToRemove') && !empty($tagsToRemove)){
            $task->tags()->detach($tagsToRemove);
        }

        $task->update($validate);

        return $task;

    }

    function deleteTaskForUserDesk(Request $request){
        $task = DeskTask::find($request->id)->delete();   
        return $task;
    }
}
