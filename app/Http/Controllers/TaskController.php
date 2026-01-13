<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Task;


class TaskController extends Controller
{
    
    public function view_task(){
        $staffs = User::where('role','staff')->get();
        return view('manager.add_task', compact('staffs'));
    } 

    public function add_task(Request $req){
        $task = $req->validate([
            'title' => 'required|min:3|max:10',
            'status' => 'required|in:pending',
            'staff_id' => 'required|integer'
        ]);

        if($task){
            Task::create([
                'title' => $req->title,
                'status' => $req->status, 
                'staff_id' => $req->staff_id
            ]);
        }

        return redirect()->back()->with('successfuly added task');
    }
}
