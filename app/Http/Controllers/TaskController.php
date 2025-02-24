<?php

namespace App\Http\Controllers;
use App\Models\Task;

use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function store(Request $request){
        $validator = $request->validate([
            'name'=>"required",
            "due_date"=>"required",
            "assigned"=>"required",
        ]);
        $input = $request->all();

        Task::create([
            'name' => $input['name'],
            'date' => $input['due_date'],
            'assigned_to' => $input['assigned'],
        ]);
        return response()->json(['status'=>true, 'message'=>"success"]);
    }

    public function fetch(){
        $tasks = Task::all();
        return response()->json($tasks);
    }
    public function delete(Request $request){
        Task::find($request->id)->delete();
        return response()->json(["message"=>"DeletedSuccesfull"]);
    }
}
