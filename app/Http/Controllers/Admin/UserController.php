<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Allowance;
use App\Models\EmployeeContract;
use App\Models\EmployeeType;
use App\Models\Position;
use App\Models\Role;
use App\Models\User;
use App\Models\UserAllowance;
use Carbon\Carbon;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::latest()->paginate(10);
        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $positions = Position::with('category')->whereHas('category')->join('position_categories', 'positions.category_id', '=', 'position_categories.id')
            ->orderBy('position_categories.name', 'asc')
            ->select('positions.*')
            ->get();

        $employeeTypes = EmployeeType::all();
        $allowances = Allowance::all();
        return view('admin.users.create', compact('positions', 'employeeTypes', 'allowances'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->position_id = $request->position_id;
        $user->employee_type_id = $request->employee_type_id;
        $user->phone = $request->phone;
        $user->status = $request->status;
        $user->salary = str_replace(['.', ','], ['', '.'], $request->salary);
        $user->save();

        if ($request->has('allowance_id')) {
            foreach ($request->allowance_id as $allowanceId) {
                $type = Allowance::find($allowanceId);
                $allowances = new UserAllowance();
                $allowances->user_id = $user->id;
                $allowances->allowance_id = $allowanceId;
                $allowances->custom_amount = str_replace(['.', ','], ['', '.'], $type->amount);
                $allowances->save();
            }
        }

        if($request->has('employee_type_id')){
            $type = EmployeeType::find($request->employee_type_id);

            $employeeStatus = $request->is_active == 1 ? true : false;
            $employeeTypes = new EmployeeContract();
            $employeeTypes->user_id = $user->id;
            $employeeTypes->employee_type_id = $request->employee_type_id;
            $employeeTypes->start_date = now();
            if ($type->has_end_date === true) {
                $employeeTypes->end_date = Carbon::parse($request->start_date)->addMonths($type->duration);
            }
            $employeeTypes->is_active = $employeeStatus;
            $employeeTypes->save();
        }

        $userRole = Role::where('name', $request->role)->first();

        if ($userRole) {
            $user->roles()->attach($userRole);
        }

        return redirect()->route('admin.users.index')->with('success', 'User created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::findOrFail($id);
        $positions = Position::with('category')->whereHas('category')->join('position_categories', 'positions.category_id', '=', 'position_categories.id')
            ->orderBy('position_categories.name', 'asc')
            ->select('positions.*')
            ->get();
        return view('admin.users.detail', compact('user', 'positions'));
    }
    
    /**
     * Display the specified resource.
     */
    public function employee(string $id)
    {
        $user = User::findOrFail($id);
        $positions = Position::with('category')->whereHas('category')->join('position_categories', 'positions.category_id', '=', 'position_categories.id')
            ->orderBy('position_categories.name', 'asc')
            ->select('positions.*')
            ->get();
        $employeeStatus = EmployeeContract::where('user_id', $user->id)->get();
        $employeeTypes = EmployeeType::all();
        return view('admin.users.employee', compact('user', 'positions', 'employeeStatus', 'employeeTypes'));
    }
    
    /**
     * Display the specified resource.
     */
    public function allowance(string $id)
    {
        $user = User::findOrFail($id);
        $positions = Position::with('category')->whereHas('category')->join('position_categories', 'positions.category_id', '=', 'position_categories.id')
            ->orderBy('position_categories.name', 'asc')
            ->select('positions.*')
            ->get();
        $allowancesStatus = UserAllowance::where('user_id', $user->id)->get();

        $allowancesStatusIds = $allowancesStatus->pluck('allowance_id')->toArray();
        $allowances = Allowance::whereNotIn('id', $allowancesStatusIds)->get();
        return view('admin.users.allowance', compact('user', 'positions', 'allowancesStatus', 'allowances'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        $positions = Position::with('category')->whereHas('category')->join('position_categories', 'positions.category_id', '=', 'position_categories.id')
            ->orderBy('position_categories.name', 'asc')
            ->select('positions.*')
            ->get();

        $employeeTypes = EmployeeType::all();
        $allowances = Allowance::all();
        return view('admin.users.edit', compact('user', 'positions', 'employeeTypes', 'allowances'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->position_id = $request->position_id;
        $user->phone = $request->phone;
        $user->status = $request->status;
        $user->salary = str_replace(['.', ','], ['', '.'], $request->salary);
        $user->save();

        $userRole = Role::firstWhere('name', $request->role);
        if ($userRole) {
            $user->roles()->sync($userRole->id);
        }

        return redirect()->route('admin.users.show', $user->id)->with('success', 'User updated successfully.');
    }
    
    /**
     * Update the specified resource in storage.
     */
    public function updateEmployeeType(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $request->validate([
            'employee_type_id' => 'required|integer',
            'start_date' => 'nullable|date',
            'is_active' => 'required|in:0,1',
        ]);
        
        if($request->start_date != null){
            $request->validate([
                'end_date' => 'date|after_or_equal:start_date',
            ]);
        }

        $user->employee_type_id = $request->employee_type_id;
        $user->save();

        $employeeStatus = $request->is_active == 1 ? true : false;

        $employeeStatusActive = EmployeeContract::where('user_id', $user->id)->first();
        $employeeStatusActive->is_active = false;
        $employeeStatusActive->save();

        $type = EmployeeType::find($request->employee_type_id);

        $employeeTypes = new EmployeeContract();
        $employeeTypes->user_id = $user->id;
        $employeeTypes->employee_type_id = $request->employee_type_id;
        if($request->start_date != null){
            $employeeTypes->start_date = $request->start_date;
        } else {
            $employeeTypes->start_date = now();
        }
        if ($type->has_end_date === true) {
            $employeeTypes->end_date = Carbon::parse($request->start_date)->addMonths($type->duration);
        } else {
            if($request->end_date != null){
                $employeeTypes->end_date = $request->end_date;
            }
        }
        $employeeTypes->is_active = $employeeStatus;
        $employeeTypes->save();

        return redirect()->route('admin.users.employee', $user->id)->with('success', 'User updated successfully.');
    }
    
    /**
     * Update the specified resource in storage.
     */
    public function updateEmployeeTypeUpdate(Request $request, $id)
    {
        $employeeTypes = EmployeeContract::findOrFail($id);
        $user = User::findOrFail($employeeTypes->user_id);
        $request->validate([
            'employee_type_id' => 'required|integer',
            'start_date' => 'nullable|date',
            'is_active' => 'required|in:0,1',
        ]);

        if($request->start_date != null){
            $request->validate([
                'end_date' => 'date|after_or_equal:start_date',
            ]);
        }

        
        $employeeStatus = $request->is_active == 1 ? true : false;
        
        if($employeeTypes->is_active != $employeeStatus){
            $user->employee_type_id = $request->employee_type_id;
            $user->save();
            
            $employeeStatusActive = EmployeeContract::where('user_id', $user->id)->where('is_active', true)->first();
            if($employeeStatusActive){
                $employeeStatusActive->is_active = false;
                $employeeStatusActive->save();
            }
        }

        $employeeTypes->user_id = $user->id;
        $employeeTypes->employee_type_id = $request->employee_type_id;
        $employeeTypes->start_date = $request->start_date;
        $employeeTypes->end_date = $request->end_date;
        $employeeTypes->is_active = $employeeStatus;
        $employeeTypes->save();

        return redirect()->route('admin.users.employee', $user->id)->with('success', 'User updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('admin.users.index')->with('success', 'User deleted successfully.');
    }
}
