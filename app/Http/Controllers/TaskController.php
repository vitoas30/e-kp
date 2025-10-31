<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::all();
        return view('tasks.index', compact('tasks'));
    }

    public function create()
    {
        $projects = Project::all();
        $users = User::all();
        return view('tasks.create', compact('projects', 'users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'project' => 'required',
        ]);

        $task = new Task();
        $task->name = $request->name;
        $task->project_id = $request->project;
        $task->start_date = $request->start_date;
        $task->due_date = $request->due_date;
        $task->assigned_to = $request->assign_to;
        $task->priority = $request->priority;
        $task->description = $request->description;
        $task->status = $request->status;
        $task->save();

        return redirect()->route('admin.tasks.index')->with('success', 'Task created successfully.');
    }

    public function show(string $id)
    {
        $task = Task::findOrFail($id);
        return view('tasks.detail', compact('task'));
    }

    public function edit(string $id)
    {
        $task = Task::findOrFail($id);
        $users = User::all();
        $projects = Project::all();

        return view('tasks.edit', compact('task', 'users', 'projects'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'project' => 'required',
        ]);

        $task = Task::findOrFail($id);
        $task->name = $request->name;
        $task->project_id = $request->project;
        $task->start_date = $request->start_date;
        $task->due_date = $request->due_date;
        $task->assigned_to = $request->assign_to;
        $task->priority = $request->priority;
        $task->description = $request->description;
        $task->status = $request->status;
        $task->save();

        return redirect()->route('admin.tasks.index')->with('success', 'Task updated successfully.');
    }

    public function destroy(string $id)
    {
        $task = Task::findOrFail($id);
        $task->delete();

        return redirect()->route('admin.tasks.index')->with('success', 'Task deleted successfully.');
    }
}
