<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Allowance;
use Illuminate\Http\Request;

class AllowanceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $allowances = Allowance::all();
        // $allowances = Allowance::withCount('users')->get();
        return view('admin.allowances.index', compact('allowances'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:employee_types,name',
            'amount' => 'nullable|string',
        ]);
        Allowance::create($request->only('name', 'amount'));
        return redirect()->route('admin.allowance.index')->with('success', 'Allowance created successfully.');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $allowance = Allowance::findOrFail($id);
        $request->validate([
            'name' => 'required|string|max:255|unique:allowances,name,' . $allowance->id,
            'amount' => 'nullable|string',
        ]);

        $allowance->name = $request->name;
        $allowance->amount = $request->amount;
        $allowance->save();

        return redirect()->route('admin.allowance.index')->with('success', 'Allowance updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $allowance = Allowance::findOrFail($id);
        if($allowance != null) {
            $allowance->delete();
            return redirect()->route('admin.allowance.index')->with('success', 'Allowance deleted successfully.');
        }
        return redirect()->route('admin.allowance.index')->with('message', 'Allowance deletion failed.');
    }
}
