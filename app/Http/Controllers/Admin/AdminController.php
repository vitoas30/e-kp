<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Role;
use App\Models\Project;
use App\Models\Task;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Display the admin dashboard.
     */
    public function dashboard()
    {
        try {
            $totalUsers = User::count();
            $totalProjects = Project::count();
            $totalTasks = Task::count();
            $activeProjects = Project::where('status', 'in_progress')->count();
            $completedTasks = Task::where('status', 'completed')->count();
            $activeTasks = Task::where('status', 'in_progress')->count();
        } catch (\Exception $e) {
            // If database tables don't exist or there's an error, set defaults to 0
            $totalUsers = 0;
            $totalProjects = 0;
            $totalTasks = 0;
            $activeProjects = 0;
            $completedTasks = 0;
            $activeTasks = 0;
        }

        // Get recent activities (Projects and Tasks combined)
        $recentProjects = Project::with('manager')->latest()->take(5)->get();
        $recentTasks = Task::with('assignee')->latest()->take(5)->get();

        // Merge and sort
        $recentActivities = $recentProjects->concat($recentTasks)->sortByDesc('created_at')->take(5);

        return view('admin.dashboard', [
            'totalUsers' => $totalUsers,
            'totalProjects' => $totalProjects,
            'totalTasks' => $totalTasks,
            'activeProjects' => $activeProjects,
            'completedTasks' => $completedTasks,
            'activeTasks' => $activeTasks,
            'recentActivities' => $recentActivities
        ]);
    }

    /**
     * Display users management page.
     */
    public function users()
    {
        $users = User::with('roles')->paginate(10);
        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new user.
     */
    public function createUser()
    {
        $roles = Role::all();
        return view('admin.users.create', compact('roles'));
    }

    /**
     * Store a newly created user.
     */
    public function storeUser(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'roles' => 'required|array',
            'roles.*' => 'exists:roles,id',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        $user->roles()->attach($request->roles);

        return redirect()->route('admin.users.index')->with('success', 'User created successfully.');
    }

    /**
     * Show the form for editing a user.
     */
    public function editUser(User $user)
    {
        $roles = Role::all();
        return view('admin.users.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified user.
     */
    public function updateUser(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8|confirmed',
            'roles' => 'required|array',
            'roles.*' => 'exists:roles,id',
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password ? bcrypt($request->password) : $user->password,
        ]);

        $user->roles()->sync($request->roles);

        return redirect()->route('admin.users.index')->with('success', 'User updated successfully.');
    }

    /**
     * Remove the specified user.
     */
    public function destroyUser(User $user)
    {
        $user->roles()->detach();
        $user->delete();

        return redirect()->route('admin.users.index')->with('success', 'User deleted successfully.');
    }

    /**
     * Display roles management page.
     */
    public function roles()
    {
        $roles = Role::withCount('users')->get();
        return view('admin.roles.index', compact('roles'));
    }

    /**
     * Display settings page.
     */
    public function settings()
    {
        return view('admin.settings');
    }

    /**
     * Display reports page.
     */
    public function reports()
    {
        $totalUsers = User::count();
        $adminUsers = User::whereHas('roles', function($q) {
            $q->where('name', 'admin');
        })->count();
        $regularUsers = User::whereHas('roles', function($q) {
            $q->where('name', 'user');
        })->count();

        return view('admin.reports', compact('totalUsers', 'adminUsers', 'regularUsers'));
    }
}
