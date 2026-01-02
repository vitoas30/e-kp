<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        if (Auth::user()->hasRole('admin')) {
            return redirect()->route('admin.dashboard');
        }

        $projects = Project::where('manager_id', Auth::user()->id)->latest()->limit(3)->get();
        $tasks = Task::where('assigned_to', Auth::user()->id)->latest()->limit(3)->get();
        $completedTasks = Task::where('assigned_to', Auth::user()->id)->where('status', 'completed')->count();
        $inProgressTasks = Task::where('assigned_to', Auth::user()->id)->where('status', 'in_progress')->count();

        return view('dashboard', compact('projects','tasks', 'completedTasks', 'inProgressTasks'));
    }
}
