<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\EmployeeType;
use Illuminate\Http\Request;

class EmployeeTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $employeeTypes = EmployeeType::all();
        // $employeeTypes = EmployeeType::withCount('users')->get();
        return view('admin.employee-types.index', compact('employeeTypes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:employee_types,name',
            'description' => 'nullable|string',
            'has_end_date' => 'required|in:1,0',
            'duration' => 'nullable|integer|min:1'
        ]);

        $hasEndDate = $request->has_end_date == 1 ? true : false;

        EmployeeType::create([
            'name' => $request->name,
            'description' => $request->description,
            'has_end_date' => $hasEndDate,
            'duration' => $hasEndDate ? $request->duration : null, // kalau tidak ada batas waktu, kosongkan duration
        ]);

        return redirect()
            ->route('admin.employee.type.index')
            ->with('success', 'Employee type created successfully.');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $employeeType = EmployeeType::findOrFail($id);
        $request->validate([
            'name' => 'required|string|max:255|unique:employee_types,name,' . $employeeType->id,
            'description' => 'nullable|string',
            'has_end_date' => 'required|in:1,0',
            'duration' => 'nullable|integer|min:1'
        ]);
        
        $employeeType->name = $request->name;
        $employeeType->description = $request->description;
        $employeeType->has_end_date = $request->has_end_date == 1 ? true : false;
        $employeeType->duration = $employeeType->has_end_date ? $request->duration : null;
        $employeeType->save();

        return redirect()->route('admin.employee.type.index')->with('success', 'Employee type updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $employeeType = EmployeeType::findOrFail($id);
        if($employeeType != null) {
            $employeeType->delete();
            return redirect()->route('admin.employee.type.index')->with('success', 'Employee type deleted successfully.');
        }
        return redirect()->route('admin.employee.type.index')->with('message', 'Employee type deletion failed.');
    }
}
