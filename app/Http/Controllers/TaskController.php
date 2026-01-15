<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function view_task()
    {
        $staffs = User::where('role', 'staff')->get();

        return view('manager.add_task', compact('staffs'));
    }

    public function add_task(Request $req)
    {
        $task = $req->validate([
            'title' => 'required|min:3|max:10',
            'status' => 'required|in:pending',
            'staff_id' => 'required|integer',
        ]);

        if ($task) {
            Task::create([
                'title' => $req->title,
                'status' => $req->status,
                'staff_id' => $req->staff_id,
            ]);
        }

        return redirect()->back()->with('successfuly added task');
    }

    public function task_list()
    {
        $tasks = Task::where('staff_id', auth()->id())->get();

        return view('staff.task_list', compact('tasks'));
    }

    public function complete_task($id)
    {
        $task = Task::where('id', $id)
            ->where('staff_id', auth()->id())
            ->firstOrFail();

            $task->status = 'completed';
            $task->save();

            return back()->with('success','success full completion');
    }
}
