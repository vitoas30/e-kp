<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CategoryItem;
use Illuminate\Http\Request;

class CategoryItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = CategoryItem::all();

        return view('admin.items.category', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        CategoryItem::create([
            'name' => $request->name,
            'status' => $request->status,
            'description' => $request->description,
        ]);

        return redirect()->route('admin.items.category.index')->with('success', 'Category Item created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $category = CategoryItem::findOrFail($id);
        $category->update([
            'name' => $request->name,
            'status' => $request->status,
            'description' => $request->description,
        ]);

        return redirect()->route('admin.items.category.index')->with('success', 'Category Item updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = CategoryItem::findOrFail($id);
        $category->delete();
        return redirect()->route('admin.items.category.index')->with('success', 'Category Item deleted successfully.');
    }
}
