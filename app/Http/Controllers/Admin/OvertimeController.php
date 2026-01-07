<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OvertimeController extends Controller
{
    public function index()
    {
        $overtimes = \App\Models\Overtime::with(['user', 'project', 'task'])
            ->latest()
            ->paginate(10);
            
        $users = \App\Models\User::all();
        $projects = \App\Models\Project::all();
        // Ideally fetch tasks via AJAX, but for now fetch all or handle in view logically
        $tasks = \App\Models\Task::all(); 

        return view('admin.overtime.index', compact('overtimes', 'users', 'projects', 'tasks'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'project_id' => 'required|exists:projects,id',
            'task_id' => 'nullable|exists:tasks,id',
            'date' => 'required|date',
            'start_time' => 'required',
            'end_time' => 'required|after:start_time',
            'reason' => 'required|string',
            'status' => 'required|in:pending,approved,rejected',
            'admin_notes' => 'nullable|string',
        ]);

        \App\Models\Overtime::create([
            'user_id' => $request->user_id,
            'project_id' => $request->project_id,
            'task_id' => $request->task_id,
            'date' => $request->date,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'reason' => $request->reason,
            'status' => $request->status,
            'admin_notes' => $request->admin_notes,
        ]);

        return back()->with('success', 'Data lembur berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:approved,rejected,pending',
            'admin_notes' => 'nullable|string'
        ]);

        $overtime = \App\Models\Overtime::findOrFail($id);
        
        $overtime->update([
            'status' => $request->status,
            'admin_notes' => $request->admin_notes
        ]);

        return back()->with('success', 'Status lembur berhasil diperbarui.');
    }
    
    public function destroy($id)
    {
        $overtime = \App\Models\Overtime::findOrFail($id);
        $overtime->delete();
        
        return back()->with('success', 'Data lembur berhasil dihapus.');
    }
}
