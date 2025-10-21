<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Position;
use App\Models\PositionCategory;
use Illuminate\Http\Request;

class PositionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $positions = Position::get();
        $categories = PositionCategory::get();
        return view('admin.position.index', compact('positions', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required',
            'name' => 'required|string|max:100',
            'description' => 'nullable|string',
        ]);

        Position::create($request->only('category_id', 'name', 'description'));

        return redirect()->route('admin.position.index')
                         ->with('success', 'Position berhasil ditambahkan.');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'category_id' => 'required',
            'name' => 'nullable|string|max:100',
            'description' => 'nullable|string|max:500',
        ]);

        $positions = Position::findOrFail($id);

        $positions->category_id = $request->category_id;
        $positions->name = $request->name;
        $positions->description = $request->description;
        $positions->save();

        return redirect()->route('admin.position.index')
            ->with('success', 'Position berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $positions = Position::findOrFail($id);
        if($positions != null) {
            $positions->delete();
            
            return redirect()->route('admin.position.index')
            ->with('success', 'Position berhasil dihapus.');
        }
        return redirect()->route('admin.position.index')
                         ->with('message', 'Position gagal dihapus.');
    }
}
