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

        $projects = Project::with(['tasks', 'createdBy'])->where('manager_id', Auth::user()->id)->latest()->limit(3)->get();
        $tasks = Task::where('assigned_to', Auth::user()->id)->latest()->limit(3)->get();
        $completedTasks = Task::where('assigned_to', Auth::user()->id)->where('status', 'completed')->count();
        $inProgressTasks = Task::where('assigned_to', Auth::user()->id)->where('status', 'in_progress')->count();

        $todayAttendance = \App\Models\Attendance::where('user_id', Auth::id())
            ->where('date', now()->toDateString())
            ->first();

        // Calculate Statistics
        $userId = Auth::id();
        $currentMonth = now()->month;
        $currentYear = now()->year;

        // 1. Absent
        // 1. Absent
        $absentCount = \App\Models\Attendance::where('user_id', $userId)
            ->where('status', 'absent')
            ->count();

        // 2. Present (Includes both 'present' and 'late' statuses because they are physically present)
        // 2. Present (Includes both 'present' and 'late' statuses because they are physically present)
        $presentCount = \App\Models\Attendance::where('user_id', $userId)
            ->whereIn('status', ['present', 'late'])
            ->count();

        // 5. Total Late Duration (Minutes/Hours)
        // 5. Total Late Duration (Minutes/Hours)
        $lateCheckIns = \App\Models\Attendance::where('user_id', $userId)
            ->where('status', 'late')
            ->get();
            
        $totalLateSeconds = 0;
        // Threshold based on AttendanceController (currently 00:00:00 for testing purposes as per user context)
        $lateThreshold = \Carbon\Carbon::parse('09:00:00'); 

        foreach ($lateCheckIns as $attendance) {
            if ($attendance->check_in) {
                // Parse check_in as time today
                $checkIn = \Carbon\Carbon::parse($attendance->check_in);
                
                // Let's set both to arbitrary date to compare only time
                $checkInTime = \Carbon\Carbon::createFromTime($checkIn->hour, $checkIn->minute, $checkIn->second);
                $thresholdTime = \Carbon\Carbon::createFromTime($lateThreshold->hour, $lateThreshold->minute, $lateThreshold->second);
                
                if ($checkInTime > $thresholdTime) {
                    $totalLateSeconds += $thresholdTime->diffInSeconds($checkInTime);
                }
            }
        }
        
        // Format Total Late
        $hours = floor($totalLateSeconds / 3600);
        $minutes = floor(($totalLateSeconds % 3600) / 60);
        $totalLateDuration = "{$hours}h {$minutes}m";

        // 6. Leave Requests (Permission/Sick/Leave/WFH) - User calls this "Pending Izin"
        // Since we don't have a distinct "pending" status, we count all permissions for the month
        // OR we count pending Overtime as "Requests"?
        // User said: "Leave Requests itu pengajuan izin yang masih pending"
        // I will count actual Attendance Permissions for now as "Leave Requests"
        // 6. Leave Requests (Permission/Sick/Leave/WFH) - User calls this "Pending Izin"
        // Since we don't have a distinct "pending" status, we count all permissions for the month
        // OR we count pending Overtime as "Requests"?
        // User said: "Leave Requests itu pengajuan izin yang masih pending"
        // I will count actual Attendance Permissions for now as "Leave Requests"
        $leaveRequestCount = \App\Models\Attendance::where('user_id', $userId)
            ->whereIn('status', ['sick', 'permission', 'leave', 'wfh'])
            ->count();
            
        // Just in case user means Overtime Pending:
        $pendingOvertimeCount = \App\Models\Overtime::where('user_id', $userId)
            ->where('status', 'pending')
            ->count();

        return view('dashboard', compact(
            'projects',
            'tasks', 
            'completedTasks', 
            'inProgressTasks', 
            'todayAttendance', 
            'absentCount', 
            'presentCount', 
            'totalLateDuration', 
            'leaveRequestCount',
            'pendingOvertimeCount'
        ));
    }
}
