<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OvertimeController extends Controller
{
    public function index()
    {
        $overtimes = \App\Models\Overtime::where('user_id', \Illuminate\Support\Facades\Auth::id())
            ->with(['project', 'task'])
            ->latest()
            ->paginate(10);
            
        $projects = \App\Models\Project::where('manager_id', \Illuminate\Support\Facades\Auth::id())
            ->orWhereHas('tasks', function($q) {
                $q->where('assigned_to', \Illuminate\Support\Facades\Auth::id());
            })->get();
            
        // Get all tasks assigned to user or created by user? 
        // For simplicity, let's get tasks assigned to user.
        // Actually, we should probably fetch tasks via AJAX based on project selection, but for now let's pass all user's tasks.
        $tasks = \App\Models\Task::where('assigned_to', \Illuminate\Support\Facades\Auth::id())->get();

        return view('user.overtime.index', compact('overtimes', 'projects', 'tasks'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'project_id' => 'required|exists:projects,id',
            'task_id' => 'nullable|exists:tasks,id',
            'date' => 'required|date',
            'start_time' => 'required',
            'end_time' => 'required|after:start_time',
            'reason' => 'required|string',
        ]);

        \App\Models\Overtime::create([
            'user_id' => \Illuminate\Support\Facades\Auth::id(),
            'project_id' => $request->project_id,
            'task_id' => $request->task_id,
            'date' => $request->date,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'reason' => $request->reason,
            'status' => 'pending',
        ]);

        return back()->with('success', 'Pengajuan lembur berhasil dibuat!');
    }
    
    public function destroy($id)
    {
        $overtime = \App\Models\Overtime::where('user_id', \Illuminate\Support\Facades\Auth::id())
            ->where('status', 'pending')
            ->findOrFail($id);
            
        $overtime->delete();
        
        return back()->with('success', 'Pengajuan lembur berhasil dihapus.');
    }
}
