<?php

namespace App\Http\Controllers\User;

use App\Enums\MethodEnums;
use App\Http\Controllers\Controller;
use App\Models\Task;
use App\Models\Project;
use App\Models\SubMenu;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function index(string $id)
    {
        $tasks = Task::where('project_id', $id)->get();
        $project = Project::where('id', $id)->first();
        $users = User::all();
        $totalTasks = Task::where('project_id', $id)->count();
        $progressPercentage = Task::where('project_id', $id)->avg('progress');
        $completedTasks = Task::where('project_id', $id)->where('status', 'completed')->count();
        $inProgressTasks = Task::where('project_id', $id)->where('status', 'in_progress')->count();
        $create = SubMenu::where('name', MethodEnums::POST)->where('position_id', Auth::user()->position->category_id)->exists();
        $update = SubMenu::where('name', MethodEnums::PUT)->where('position_id', Auth::user()->position->category_id)->exists();
        $delete = SubMenu::where('name', MethodEnums::DELETE)->where('position_id', Auth::user()->position->category_id)->exists();
        return view('user.task.index', compact('tasks','project', 'create', 'update', 'delete', 'users', 'totalTasks', 'progressPercentage', 'completedTasks', 'inProgressTasks'));
    }

    public function myTask(string $id)
    {
        $tasks = Task::where('project_id', $id)->where('assigned_to', Auth::user()->id)->get();
        $project = Project::where('id', $id)->first();
        $totalTasks = Task::where('project_id', $id)->where('assigned_to', Auth::user()->id)->count();
        $progressPercentage = Task::where('project_id', $id)->where('assigned_to', Auth::user()->id)->avg('progress');
        $completedTasks = Task::where('project_id', $id)->where('assigned_to', Auth::user()->id)->where('status', 'completed')->count();
        $inProgressTasks = Task::where('project_id', $id)->where('assigned_to', Auth::user()->id)->where('status', 'in_progress')->count();
        $create = SubMenu::where('name', MethodEnums::POST)->where('position_id', Auth::user()->position->category_id)->exists();
        $update = SubMenu::where('name', MethodEnums::PUT)->where('position_id', Auth::user()->position->category_id)->exists();
        $delete = SubMenu::where('name', MethodEnums::DELETE)->where('position_id', Auth::user()->position->category_id)->exists();
        return view('user.task.my-task', compact('tasks', 'project', 'create', 'update', 'delete', 'totalTasks', 'progressPercentage', 'completedTasks', 'inProgressTasks'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
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
        $task->created_by = Auth::user()->id;
        $task->save();

        return redirect()->route('user.tasks.index', $request->project)->with('success', 'Task created successfully.');
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
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
        $task->updated_by = Auth::user()->id;
        $task->save();

        return redirect()->route('user.tasks.index', $request->project)->with('success', 'Task updated successfully.');
    }

    public function updateStatus(Request $request, string $id)
    {
        $task = Task::findOrFail($id);
        $task->status = $request->status;
        $task->updated_by = Auth::user()->id;
        $task->save();

        return redirect()->route('user.tasks.index', $task->project_id)->with('success', 'Project updated successfully.');
    }

    public function destroy(string $id)
    {
        $task = Task::findOrFail($id);
        $idProject = $task->project_id;
        $task->delete();

        return redirect()->route('user.tasks.index', $idProject)->with('success', 'Task deleted successfully.');
    }
}
