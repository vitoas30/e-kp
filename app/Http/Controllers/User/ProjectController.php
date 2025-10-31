<?php

namespace App\Http\Controllers\User;

use App\Enums\MethodEnums;
use App\Http\Controllers\Controller;
use App\Models\Task;
use App\Models\Project;
use App\Models\SubMenu;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index()
    {
        if(SubMenu::where('name', MethodEnums::GET)->where('position_id', Auth::user()->position->category_id)->exists()){
            $projects = Project::paginate(6);
            $totalProject = Project::count();
            $averageProgress = Project::avg('progress');
            $completedTasks = Project::where('status', 'completed')->count();
            $inProgressTasks = Project::where('status', 'in_progress')->count();
        } else {
            $exists = Project::where('manager_id', Auth::user()->id)->exists();
            if($exists) {
                $projects = Project::where('manager_id', Auth::user()->id)->paginate(6);
                $totalProject = Project::where('manager_id', Auth::user()->id)->count();
                $averageProgress = Project::where('manager_id', Auth::user()->id)->avg('progress');
                $completedTasks = Project::where('status', 'completed')->where('manager_id', Auth::user()->id)->count();
                $inProgressTasks = Project::where('manager_id', Auth::user()->id)->where('status', 'in_progress')->count();
            } else {
                $task = Task::where('assigned_to', Auth::user()->id)->groupBy('project_id')->pluck('project_id');
                $projects = Project::whereIn('id', $task)->paginate(6);
                $totalProject = Project::whereIn('id', $task)->count();
                $averageProgress = Project::whereIn('id', $task)->avg('progress');
                $completedTasks = Project::whereIn('id', $task)->where('status', 'completed')->count();
                $inProgressTasks = Project::whereIn('id', $task)->where('status', 'in_progress')->count();
            }
        }
        $users = User::all();
        $create = SubMenu::where('name', MethodEnums::POST)->where('position_id', Auth::user()->position->category_id)->exists();
        $update = SubMenu::where('name', MethodEnums::PUT)->where('position_id', Auth::user()->position->category_id)->exists();
        $delete = SubMenu::where('name', MethodEnums::DELETE)->where('position_id', Auth::user()->position->category_id)->exists();
        return view('user.project.index', compact('projects', 'create', 'update', 'delete', 'users', 'totalProject', 'averageProgress', 'completedTasks', 'inProgressTasks'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:255',
        ]);

        $project = new Project();
        $project->name = $request->name;
        $project->code = $request->code;
        $project->start_date = $request->start_date;
        $project->end_date = $request->end_date;
        $project->manager_id = $request->leader_id;
        $project->priority = $request->priority;
        $project->description = $request->description;
        $project->status = $request->status;
        $project->created_by = Auth::user()->id;
        $project->save();

        return redirect()->route('user.projects.index')->with('success', 'Project created successfully.');
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:255',
        ]);

        $project = Project::findOrFail($id);
        $project->name = $request->name;
        $project->code = $request->code;
        $project->start_date = $request->start_date;
        $project->end_date = $request->end_date;
        $project->manager_id = $request->leader_id;
        $project->priority = $request->priority;
        $project->description = $request->description;
        $project->status = $request->status;
        $project->updated_by = Auth::user()->id;
        $project->save();

        return redirect()->route('user.projects.index')->with('success', 'Project updated successfully.');
    }
    
    public function updateStatus(Request $request, string $id)
    {
        $project = Project::findOrFail($id);
        $project->status = $request->status;
        $project->updated_by = Auth::user()->id;
        $project->save();

        return redirect()->route('user.projects.index')->with('success', 'Project updated successfully.');
    }

    public function destroy(string $id)
    {
        $project = Project::findOrFail($id);
        $project->delete();
        return redirect()->route('user.projects.index')->with('success', 'Project deleted successfully.');
    }
}
