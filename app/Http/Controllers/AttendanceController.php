<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AttendanceController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $hasFullAccess = $user->hasPermission('GET') && $user->hasPermission('POST') && $user->hasPermission('PUT') && $user->hasPermission('DELETE');

        // Always fetch my attendance
        $myAttendances = Attendance::where('user_id', $user->id)->latest()->get();

        $allAttendances = null;
        $users = collect([]);

        // Fetch all attendance if has permission
        if ($hasFullAccess) {
            $allAttendances = Attendance::with('user')->latest()->get();
            $users = \App\Models\User::all();
        }

        return view('user.attendance.index', compact('myAttendances', 'allAttendances', 'users', 'hasFullAccess'));
    }

    public function store(Request $request)
    {
        $attendance = Attendance::where('user_id', Auth::id())
            ->where('date', now()->toDateString())
            ->first();

        if ($attendance) {
            return back()->with('error', 'Anda sudah melakukan Check-in hari ini!');
        }

        $currentTime = now()->toTimeString();
        $status = $currentTime > '09:00:00' ? 'late' : 'present';

        Attendance::create([
            'user_id' => Auth::id(),
            'date' => now()->toDateString(),
            'check_in' => $currentTime,
            'status' => $status,
        ]);

        return back()->with('success', 'Berhasil Check-in!');
    }

    public function storePermission(Request $request)
    {
        $request->validate([
            'status' => 'required|in:sick,permission,wfh,leave',
            'notes' => 'required|string|max:255',
            'file' => 'nullable|file|mimes:jpg,jpeg,png,pdf,doc,docx|max:2048',
        ]);

        $attendance = Attendance::where('user_id', Auth::id())
            ->where('date', now()->toDateString())
            ->first();

        if ($attendance) {
            return back()->with('error', 'Anda sudah melakukan absensi atau pengajuan hari ini!');
        }

        $data = [
            'user_id' => Auth::id(),
            'date' => now()->toDateString(),
            'status' => $request->status,
            'notes' => $request->notes,
        ];

        if ($request->hasFile('file')) {
            $path = $request->file('file')->store('attendance_files', 'public');
            $data['file_path'] = $path;
        }



        Attendance::create($data);

        return back()->with('success', 'Pengajuan berhasil disimpan!');
    }

    public function storeManual(Request $request)
    {
        if (!Auth::user()->hasPermission('POST')) {
            return back()->with('error', 'Unauthorized action.');
        }

        $request->validate([
            'user_id' => 'required|exists:users,id',
            'date' => 'required|date',
            'check_in' => 'required',
            'check_out' => 'nullable',
            'status' => 'required',
        ]);

        $exists = Attendance::where('user_id', $request->user_id)
            ->where('date', $request->date)
            ->exists();

        if ($exists) {
            return back()->with('error', 'Data absensi untuk user dan tanggal ini sudah ada.');
        }

        Attendance::create([
            'user_id' => $request->user_id,
            'date' => $request->date,
            'check_in' => $request->check_in,
            'check_out' => $request->check_out,
            'status' => $request->status,
            'notes' => $request->notes ?? null,
        ]);

        return back()->with('success', 'Attendance created successfully');
    }

    public function update(Request $request)
    {
        $attendance = Attendance::where('user_id', Auth::id())
            ->where('date', now()->toDateString())
            ->first();

        if (!$attendance) {
            return back()->with('error', 'Anda belum melakukan Check-in hari ini!');
        }

        if ($attendance->check_out) {
            return back()->with('error', 'Anda sudah melakukan Check-out hari ini!');
        }

        $attendance->update([
            'check_out' => now()->toTimeString(),
        ]);

        return back()->with('success', 'Berhasil Check-out!');
    }

    public function updateRecord(Request $request, $id)
    {
        if (!Auth::user()->hasPermission('PUT')) {
            return back()->with('error', 'Unauthorized action.');
        }

        $request->validate([
            'check_in' => 'required',
            'check_out' => 'nullable',
        ]);

        $user = Auth::user();
        $hasFullAccess = $user->hasPermission('GET') && $user->hasPermission('POST') && $user->hasPermission('PUT') && $user->hasPermission('DELETE');

        if ($hasFullAccess) {
             $attendance = Attendance::findOrFail($id);
        } else {
             $attendance = Attendance::where('user_id', $user->id)->findOrFail($id);
        }
        
        $attendance->check_in = $request->check_in;
        $attendance->check_out = $request->check_out;
        $attendance->save();

        return back()->with('success', 'Attendance updated successfully');
    }

    public function destroy($id)
    {
        if (!Auth::user()->hasPermission('DELETE')) {
            return back()->with('error', 'Unauthorized action.');
        }

        $user = Auth::user();
        $hasFullAccess = $user->hasPermission('GET') && $user->hasPermission('POST') && $user->hasPermission('PUT') && $user->hasPermission('DELETE');

        if ($hasFullAccess) {
             $attendance = Attendance::findOrFail($id);
        } else {
             $attendance = Attendance::where('user_id', $user->id)->findOrFail($id);
        }

        $attendance->delete();

        return back()->with('success', 'Attendance deleted successfully');
    }
}
