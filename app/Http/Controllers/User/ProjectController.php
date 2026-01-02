<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Task;
use App\Models\Project;
use App\Models\Permission;
use App\Models\Menu;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    private function checkPermission()
    {
        $user = Auth::user();
        if (!$user->position || !$user->position->category_id) {
            return false;
        }

        // Try to find the Project menu
        $menu = Menu::where('name', 'LIKE', '%Project%')
                    ->orWhere('name', 'LIKE', '%Proyek%')
                    ->first();

        if (!$menu) {
            return false;
        }

        $permissions = Permission::where('menu_id', $menu->id)
            ->where('position_id', $user->position->category_id)
            ->pluck('name')
            ->toArray();

        // Check if user has any of the management permissions
        $managementPermissions = ['GET', 'POST', 'PUT', 'DELETE'];
        
        return !empty(array_intersect($managementPermissions, $permissions));
    }

    public function index()
    {
        $isAdminAccess = $this->checkPermission();
        $user = Auth::user();

        // My Projects: Managed by me OR I have tasks in them
        $myProjects = Project::where(function($q) use ($user) {
            $q->where('manager_id', $user->id)
              ->orWhereHas('tasks', function($tq) use ($user) {
                  $tq->where('assigned_to', $user->id);
              });
        })->orderBy('created_at', 'desc')->get();

        $allProjects = collect();
        if ($isAdminAccess) {
            $allProjects = Project::orderBy('created_at', 'desc')->get();
        }

        // Calculate stats based on My Projects for the dashboard cards
        $totalProject = $myProjects->count();
        $averageProgress = $myProjects->avg('progress') ?? 0;
        $completedTasks = $myProjects->where('status', 'completed')->count();
        $inProgressTasks = $myProjects->where('status', 'in_progress')->count();
        $overdueTasks = $myProjects->filter(function($p) {
            return $p->end_date < now() && $p->status != 'completed';
        })->count();

        $users = User::all();

        return view('user.project.index', compact(
            'myProjects', 
            'allProjects', 
            'isAdminAccess', 
            'users', 
            'totalProject', 
            'averageProgress', 
            'completedTasks', 
            'inProgressTasks',
            'overdueTasks'
        ));
    }

    public function store(Request $request)
    {
        if (!$this->checkPermission()) {
            abort(403, 'Unauthorized action.');
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:255',
            'priority' => 'required',
            'status' => 'required',
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

        $project->save();
        
        // Notify Assigned Manager
        if ($request->leader_id) {
            $manager = User::find($request->leader_id);
            if ($manager && $manager->id != Auth::id()) {
                $manager->notify(new \App\Notifications\SystemNotification(
                    'New Project Assigned',
                    "You have been assigned as the manager for project '{$project->name}'.",
                    'info',
                    route('user.projects.index')
                ));
            }
        }

        return redirect()->route('user.projects.index')->with('success', 'Project created successfully.');
    }

    public function update(Request $request, string $id)
    {
        if (!$this->checkPermission()) {
            abort(403, 'Unauthorized action.');
        }

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

        // Notify Assigned Manager if changed
        if ($project->wasChanged('manager_id')) {
            $manager = User::find($request->leader_id);
            if ($manager && $manager->id != Auth::id()) {
                $manager->notify(new \App\Notifications\SystemNotification(
                    'Project Assignment',
                    "You are now the manager for project '{$project->name}'.",
                    'info',
                    route('user.projects.index')
                ));
            }
        }

        return redirect()->route('user.projects.index')->with('success', 'Project updated successfully.');
    }
    
    public function updateStatus(Request $request, string $id)
    {
        // Allow status update if Admin OR Project Manager
        $project = Project::findOrFail($id);
        $isManager = $project->manager_id == Auth::id();
        
        if (!$this->checkPermission() && !$isManager) {
             abort(403, 'Unauthorized action.');
        }

        $project->status = $request->status;
        $project->updated_by = Auth::user()->id;
        $project->save();

        return redirect()->route('user.projects.index')->with('success', 'Project status updated successfully.');
    }

    public function destroy(string $id)
    {
        if (!$this->checkPermission()) {
            abort(403, 'Unauthorized action.');
        }

        $project = Project::findOrFail($id);
        $project->delete();
        return redirect()->route('user.projects.index')->with('success', 'Project deleted successfully.');
    }
}
