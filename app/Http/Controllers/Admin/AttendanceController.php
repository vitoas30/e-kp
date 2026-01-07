<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    public function index()
    {
        $attendances = Attendance::with('user')->latest()->paginate(10);
        $users = \App\Models\User::all();
        return view('admin.attendance.index', compact('attendances', 'users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'date' => 'required|date',
            'check_in' => 'required',
            'check_out' => 'nullable',
            'status' => 'required',
        ]);

        // Check if attendance already exists
        $exists = Attendance::where('user_id', $request->user_id)
            ->where('date', $request->date)
            ->exists();

        if ($exists) {
            return back()->with('error', 'Attendance for this user on this date already exists.');
        }

        Attendance::create([
            'user_id' => $request->user_id,
            'date' => $request->date,
            'check_in' => $request->check_in,
            'check_out' => $request->check_out,
            'status' => $request->status,
            'notes' => $request->notes ?? null,
        ]);

        return redirect()->route('admin.attendance.index')->with('success', 'Attendance created successfully');
    }



    public function update(Request $request, $id)
    {
        $request->validate([
            'check_in' => 'required',
            'check_out' => 'nullable',
        ]);

        $attendance = Attendance::findOrFail($id);
        
        $attendance->check_in = $request->check_in;
        $attendance->check_out = $request->check_out;
        
        $attendance->save();

        return redirect()->route('admin.attendance.index')->with('success', 'Attendance updated successfully');
    }

    public function destroy($id)
    {
        $attendance = Attendance::findOrFail($id);
        $attendance->delete();

        return redirect()->route('admin.attendance.index')->with('success', 'Attendance deleted successfully');
    }
}
