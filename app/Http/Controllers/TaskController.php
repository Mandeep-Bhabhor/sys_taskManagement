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
                'manager_id' => auth()->id(),
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

        return back()->with('success', 'success full completion');
    }

    public function task_list_manager()
    {
        $tasks = Task::with('staff')
            ->where('manager_id', auth()->id())
            ->get();
        return view('manager.task_list_moderation', compact('tasks'));
    }

    public function edit_task_page($id)
    {
        $task = Task::findOrFail($id);

        if ($task->status !== 'pending' && $task->manager_id !== auth()->id()) {
            return redirect()->back()->with('warning', 'not found');

        }
        $staff = User::where('role', 'staff')->get();

        return view('manager.edit_task', compact('task', 'staff'));
    }

    public function edit_task(Request $req, $id)
    {
        $task = Task::findOrFail($id);

        if ($task->status !== 'pending' && $task->manager_id !== auth()->id()) {
            return redirect()->back()->with('error', 'Completed tasks cannot be edited.');
        }

        $req->validate([
            'title' => 'required|string',
            'status' => 'required|in:pending,completed',
            'staff_id' => 'required|exists:users,id',
        ]);

        $task->update([
            'title' => $req->title,
            'staff_id' => $req->staff_id,
            'status' => $req->status,
        ]);

        return redirect()->route('task.list.manager')->with('success', 'Task updated successfully.');

    }
}
