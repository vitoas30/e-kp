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

class ProfileController extends Controller
{
    public function index()
    {
        $users = User::where('id', Auth::user()->id)->first();
        
        return view('user.profile.index', compact('users'));
    }
    
    public function setting()
    {
        $users = User::where('id', Auth::user()->id)->first();
        
        return view('user.profile.settings', compact('users'));
    }
    
    public function security()
    {
        $users = User::where('id', Auth::user()->id)->first();
        
        return view('user.profile.security', compact('users'));
    }
    
    public function task()
    {
        $users = User::where('id', Auth::user()->id)->first();
        $tasks = Task::where('assigned_to', Auth::user()->id)->get();
        $create = SubMenu::where('name', MethodEnums::POST)->where('position_id', Auth::user()->position->category_id)->exists();
        $update = SubMenu::where('name', MethodEnums::PUT)->where('position_id', Auth::user()->position->category_id)->exists();
        $delete = SubMenu::where('name', MethodEnums::DELETE)->where('position_id', Auth::user()->position->category_id)->exists();
        
        return view('user.profile.task', compact('users', 'tasks', 'create', 'update', 'delete'));
    }
}
